@extends('layouts.app')

@section('title','Buat Pesanan')

@section('navbar')
	@parent
@endsection

@section('content-title','Daftar Menu')

@section('content')

<div class="card-body px-lg-5 pt-0">
	<form method="post" action="{{ url('/pesanan/process').'/'.Auth::id() }}">
		{{ csrf_field() }}
	<div class="row" style="margin-top: 30px; margin-bottom: 30px;">
			<div class="col-md-12">
				<label>Nomor Meja: </label>
				<select name="meja">
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
				@foreach($menus as $menu)
					@if($menu->jenis == 'Makanan')
						@if($menu->stock > 0)
							<label style="width: 70%;">{{ $menu->nama }}</label><input style="width: 30%;" min="0" max="{{ $menu->stock }}" type="number" name="{{ $menu->id }}">
						@endif
						@if($menu->stock == 0)
							<label style="width: 70%;"> <strike> {{ $menu->nama }} </strike> </label><input style="width: 30%;" min="0" type="number" name="{{ $menu->id }}" disabled="">
						@endif
					@endif
				@endforeach
			</div>
			<div class="col-md-6">
				<label class="col-md-12 text-center">Minuman</label>
				<hr>
				@foreach($menus as $menu)
					@if($menu->jenis == 'Minuman')
						@if($menu->stock > 0)
							<label style="width: 70%;">{{ $menu->nama }}</label><input style="width: 30%;" min="0" max="{{ $menu->stock }}" type="number" name="{{ $menu->id }}">
						@endif
						@if($menu->stock == 0)
							<label style="width: 70%;"> <strike> {{ $menu->nama }} </strike> </label><input style="width: 30%;" min="0" type="number" name="{{ $menu->id }}" disabled="">
						@endif
					@endif
				@endforeach
			</div>

			<div class="col-md-12 text-center">
				<hr>
				<a href="{{ url('/home').'/'.Auth::id() }}" class="btn btn-danger btn-sm">Kembali</a>
				<button id="pesan" class="btn btn-info btn-sm" type="submit">Pesan</button>
			</div>
	</div>
	</form>
</div>
@endsection