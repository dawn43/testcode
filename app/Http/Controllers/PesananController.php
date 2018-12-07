<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Menu;
use App\Pesanan;
use App\Role;

class PesananController extends Controller
{
	public function menus($id){
	    $menus = Menu::get();
    	return view('forms.pesanan_buat')->with('menus',$menus);
	}

	public function process(Request $request, $id){
		$menus = Menu::get();
		$meja = $request->input('meja');
		$data['meja'] = $meja;
		foreach ($menus as $menu) {
			if ($request->input($menu->id)>0 && $request->input($menu->id) != null) {
				$data['pesanan'][$menu->id]['nama'] = $menu->nama;
				$data['pesanan'][$menu->id]['jumlah'] = $request->input($menu->id);
			}
		}
		return view('forms.pesanan_process')->with('dataPesanan',$data);
	}

	public function simpan(Request $request, $id){
		$menus = Menu::get();
		$meja = $request->input('meja');

		//Generate the code
		$waktu = date("dmY");
		$code = '';
		for ($i=1; $i < 100 ; $i++) { 
			if ($i<10) {
				$kode = "ERP".$waktu."-00".$i;
				$kodePesanan = Pesanan::where('nomor_pesanan',$kode)->first();
				if (empty($kodePesanan)) {
					$code = $kode;
					break;
				}
			}
			elseif ($i>=10) {
				$kode = "ERP".$waktu."-0".$i;
				$kodePesanan = Pesanan::where('nomor_pesanan',$kode)->first();
				if (empty($kodePesanan)) {
					$code = $kode;
					break;
				}
			}
		}

		$pesanan = Pesanan::create([
			'user_id' => $id,
			'meja' => $meja,
			'nomor_pesanan' => $code,
			'status' => 'berjalan'
		]);

		$getPesanan = Pesanan::where('nomor_pesanan',$kode)->first();
		$idPesanan = $getPesanan->id;
		foreach ($menus as $menu) {
			if ($request->input($menu->id)>0 && $request->input($menu->id) != null) {
				$arr = [
					'menu_id' => $menu->id,
					'jumlah' => $request->input($menu->id),
					'pesanan_id' => $idPesanan
				];
				DB::table('menu_pesanan')->insert($arr);
			}
		}

		foreach ($menus as $menu) {
			if ($request->input($menu->id)>0 && $request->input($menu->id) != null) {
				$jumlahData = $menu->stock;
				$jumlahPesanan = $request->input($menu->id);
				$sisaStock = $jumlahData-$jumlahPesanan;
				$dataUpdate[$menu->id] = $sisaStock;
			}
		}
		foreach ($dataUpdate as $key => $value) {
			$menu = Menu::where('id',$key)->update(['stock'=>$value]);
		}
	}

	public function daftar($id){
		$pesanan = Pesanan::where('status', 'berjalan')->get();
		$role = Role::findOrFail($id);
		$data['pesanan'] = $pesanan;
		$data['role'] = $role;
		return view('forms.pesanan_daftar')->with('data',$data);
	}

	public function lihat(Request $request){
		$id = $request->input('id');
		$pesanan = Pesanan::where('id',$id)->get();
		foreach ($pesanan as $nomor) {
			$dataMenu['pesanan']['kode'] = $nomor->nomor_pesanan;
		}
		$daftarMenu = DB::table('menu_pesanan')->where('pesanan_id', $id)->get();
		foreach ($daftarMenu as $menu) {
			$dataMenu['menu'][$menu->menu_id]['nama'] = Menu::where('id',$menu->menu_id)->first()->nama;
			$dataMenu['menu'][$menu->menu_id]['jumlah'] = $menu->jumlah;
		}
		// return $dataMenu;
		return view('forms.pesanan_lihat')->with('data',$dataMenu);
	}

	public function edit(Request $request){
		$dataMenu['daftarMenu'] = Menu::get();
		$dataMenu['keyHelper'] = [];
		$id = $request->input('id');
		$pesanan = Pesanan::where('id',$id)->get();
		foreach ($pesanan as $nomor) {
			$dataMenu['pesanan']['kode'] = $nomor->nomor_pesanan;
			$dataMenu['pesanan']['meja'] = $nomor->meja;
		}
		$daftarMenu = DB::table('menu_pesanan')->where('pesanan_id', $id)->get();
		foreach ($daftarMenu as $menu) {
			$dataMenu['menu'][$menu->menu_id]['nama'] = Menu::where('id',$menu->menu_id)->first()->nama;
			$dataMenu['menu'][$menu->menu_id]['jumlah'] = $menu->jumlah;
			array_push($dataMenu['keyHelper'], $menu->menu_id);
		}

		// return $dataMenu;
		return view('forms.pesanan_edit')->with('data',$dataMenu);
	}

	public function editSimpan(Request $request, $id){
		$menus = Menu::get();
		$lama = 'lama';
		$baru = 'baru';

		$pesanan['nomor'] = $request->input('nomor_pesanan');
		$pesanan['meja']['lama'] = $request->input('lamameja');
		$pesanan['meja']['baru'] = $request->input('barumeja');
		foreach ($menus as $menu) {
			$id = $menu->id;
			$nama = $lama.$id;
			if ($request->input($nama)!=null) {
				$pesanan['lama'][$id] = $request->input($nama);
			}
		}
		foreach ($menus as $menu) {
			$id = $menu->id;
			$nama = $baru.$id;
			if ($request->input($nama)!=null) {
				$pesanan['baru'][$id] = $request->input($nama);
			}
		}
		//Update meja apabila terjadi perubahan meja
		$idPesanan = Pesanan::where('nomor_pesanan',$pesanan['nomor'])->first()->id;
		if ($pesanan['meja']['lama']!=$pesanan['meja']['baru']) {
			Pesanan::where('id',$idPesanan)->update(['meja'=>$pesanan['meja']['baru']]);
		}
		//Pengolahan stock menu
		foreach ($pesanan['lama'] as $kLama => $vLama) {
			$dataStock = Menu::find($kLama);
			$stock[$kLama] = $dataStock->stock;
		}
		foreach ($stock as $kStock => $vStock) {
			foreach ($pesanan['lama'] as $kLama => $vLama) {
				if ($kStock==$kLama) {
					$stock[$kStock]+=$vLama;
				}
			}
		}

		foreach ($stock as $kStock => $vStock) {
			Menu::where('id',$kStock)->update(['stock'=>$vStock]);
		}


		DB::table('menu_pesanan')->where('pesanan_id',$idPesanan)->delete();
		foreach ($pesanan['baru'] as $kBaru => $vBaru) {
			$arr = [
				'menu_id' => $kBaru,
				'jumlah' => $vBaru,
				'pesanan_id' => $idPesanan
			];
			DB::table('menu_pesanan')->insert($arr);
		}

		foreach ($pesanan['baru'] as $kBaru => $vBaru) {
			$menu = Menu::find($kBaru);
			$stock = $menu->stock;
			$stock = $stock-$vBaru;
			$menu->update(['stock'=>$stock]);
		}
	}

	public function bayar(Request $request){
		$idPesanan = $request->input('id');
		$data['pesanan'] = Pesanan::find($idPesanan);
		$data['menu_pesanan'] = DB::table('menu_pesanan')->where('pesanan_id',$idPesanan)->get();
		$data['menu'] = [];
		foreach ($data['menu_pesanan'] as $menuPesanan) {
			$id = $menuPesanan->menu_id;
			$data['menu'][] = Menu::find($id);
		}
		foreach ($data['menu'] as $menu) {
			foreach ($data['menu_pesanan'] as $menuPesanan) {
				if($menu->id==$menuPesanan->menu_id){
					$data['entitas'][$menu->id]['nama'] = $menu->nama;
					$data['entitas'][$menu->id]['harga'] = $menu->harga;
					$data['entitas'][$menu->id]['jumlah'] = $menuPesanan->jumlah;
				}
			}
		}
		$total = 0;
		foreach ($data['entitas'] as $entitas) {
			$total += $entitas['harga']*$entitas['jumlah'];
		}
		$data['total'] = $total;
		// return $data;
		return view('forms.pesanan_bayar')->with('data',$data);
	}

	public function bayarProcess(Request $request){
		$id = $request->input('id_pesanan');
		$pesanan = Pesanan::findOrFail($id);
		$pesanan->update(['status'=>'berhenti']);
	}
}
