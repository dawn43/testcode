@extends('layouts.app')

@section('title','Buat Pesanan')

@section('navbar')
	@parent
@endsection

@section('content-title','Daftar Menu')

@section('content')

<div class="card-body px-lg-5 pt-0">
	<div class="row">
		<div class="col-md-12" style="margin-top: 70px; margin-bottom: 70px;">
			{!! "<label>Nomor Pesanan: </label>".$data['pesanan']['kode'] !!}
			<table class="table table-bordered">
				<tr>
					<th>Menu</th>
					<th class="text-center">Jumlah</th>
				</tr>
				@foreach($data['menu'] as $key => $value)
				<tr>
					{!! "<td>".$value['nama']."</td>" !!}
					{!! "<td class='text-center'>".$value['jumlah']."</td>" !!}
				</tr>
				@endforeach
			</table>
			<div class="col-md-12 text-center">
				<a href="{{ url('/pesanan/daftar').'/'.Auth::id() }}" class="btn btn-danger btn-sm">Kembali</a>
			</div>
		</div>
	</div>
</div>
@endsection