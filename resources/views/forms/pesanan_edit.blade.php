@extends('layouts.app')

@section('title','Buat Pesanan')

@section('navbar')
	@parent
@endsection

@section('content-title','Daftar Menu')

@section('content')
<script type="text/javascript">
	$(document).ready(function(){
		$("#pesan").click(function(e){
			e.preventDefault();
			$.ajax({
				url: $('#form').attr('action'),
				method: "post",
				data: $('#form').serialize(),
				dataType: "text",
				success: function(){
					alert("Sukses input data");
					window.location.href = "{{ url('/home').'/'.Auth::id() }}";
				}
			});
		})
	})
</script>
<div class="card-body px-lg-5 pt-0">
	<form id="form" method="post" action="{{ url('/pesanan/edit/simpan').'/'.Auth::id() }}">
		{{ csrf_field() }}
		<input type="hidden" name="nomor_pesanan" value="{{ $data['pesanan']['kode'] }}">
		<input type="hidden" name="lamameja" value="{{ $data['pesanan']['meja'] }}">
		@foreach($data['menu'] as $keyMenu => $menu)
			<input type="hidden" name="lama{{ $keyMenu }}" value="{{ $menu['jumlah'] }}">
		@endforeach
		<div class="row" style="margin-top: 30px; margin-bottom: 30px;">
			<div class="col-md-12">
				<label>Nomor Pesanan: {{ $data['pesanan']['kode'] }}</label><br>
				<label>Meja: {{ $data['pesanan']['meja'] }}</label><br>
				<hr>
				<label class="control-label">Pesanan Sebelumnya:</label><br>
				@foreach($data['menu'] as $keyMenuSebelumnya => $menuSebelumnya)
					<label class="control-label">{!! $menuSebelumnya['nama']." Jumlah ".$menuSebelumnya['jumlah'] !!}</label><br>
				@endforeach
				<hr>
			</div>
				<div class="col-md-12">
					<label class="control-label">Pesanan Baru:</label><br>
					<label>Nomor Meja: </label>
					<select name="barumeja">
						<option value="001">001</option>
						<option value="002">002</option>
						<option value="003">003</option>
						<option value="004">004</option>
						<option value="005">005</option>
						<option value="006">006</option>
						<option value="007">007</option>
					</select>
					<hr>
				</div>
				<div class="col-md-6">
					<label class="col-md-12 text-center">Makanan</label>
					<hr>
					@foreach($data['daftarMenu'] as $menu)
						@if($menu->jenis == 'Makanan')
							<?php $x = 0; ?>
							@foreach($data['menu'] as $kMenu => $vMenu)
								@if($menu->id == $kMenu)
									<?php $x=1; ?>
								@endif
							@endforeach
							@if($x==1)
								<label style="width: 70%;">{{ $menu->nama }}</label><input style="width: 30%;" min="0" type="number" name="{{ 'baru'.$menu->id }}" value="{{ $data['menu'][$menu->id]['jumlah'] }}">
							@endif
							@if($x==0)
								<label style="width: 70%;">{{ $menu->nama }}</label><input style="width: 30%;" min="0" type="number" name="{{ 'baru'.$menu->id }}">
							@endif
						@endif
					@endforeach
				</div>
				<div class="col-md-6">
					<label class="col-md-12 text-center">Minuman</label>
					<hr>
					@foreach($data['daftarMenu'] as $menu)
						@if($menu->jenis == 'Minuman')
							<?php $x = 0; ?>
							@foreach($data['menu'] as $kMenu => $vMenu)
								@if($menu->id == $kMenu)
									<?php $x=1; ?>
								@endif
							@endforeach
							@if($x==1)
								<label style="width: 70%;">{{ $menu->nama }}</label><input style="width: 30%;" min="0" type="number" name="{{ 'baru'.$menu->id }}" value="{{ $data['menu'][$menu->id]['jumlah'] }}">
							@endif
							@if($x==0)
								<label style="width: 70%;">{{ $menu->nama }}</label><input style="width: 30%;" min="0" type="number" name="{{ 'baru'.$menu->id }}">
							@endif
						@endif
					@endforeach
				</div>

				<div class="col-md-12 text-center">
					<hr>
					<a href="{{ url('/pesanan/daftar').'/'.Auth::id() }}" class="btn btn-danger btn-sm">Batal</a>
					<button id="pesan" class="btn btn-info btn-sm" type="submit">Pesan</button>
				</div>
		</div>
	</form>
</div>
@endsection