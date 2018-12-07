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
					alert("Pembayaran berhasil");
					window.location.href = "{{ url('/pesanan/daftar').'/'.Auth::id() }}";
				}
			});
		})
	})
</script>
<div class="card-body px-lg-5 pt-0">
	<div class="row">
		<div class="col-md-12" style="margin-top: 40px; margin-bottom: 40px;">
			<form id="form" method="post" action="{{ url('/pesanan/bayar/process') }}">
				{{ csrf_field() }}
				<input type="hidden" name="id_pesanan" value="{{ $data['pesanan']->id }}">
				<div class="form-group">
					<label class="form-control">Meja:{{ $data['pesanan']->meja }}</label>
					<label class="form-control">Nomor Pesanan:{{ $data['pesanan']->nomor_pesanan }}</label>
				</div>
				<table class="table table-bordered">
					<tr>
						<th>Menu</th>
						<th>Harga</th>
						<th>Jumlah</th>
					</tr>
					@foreach($data['entitas'] as $entitas)
					<tr>
						<td>{{ $entitas['nama'] }}</td>
						<td>{{ $entitas['harga'] }}</td>
						<td>{{ $entitas['jumlah'] }}</td>
					</tr>
					@endforeach
					<tr>
						<td colspan="2" class="text-center">Total</td>
						<td>{{ $data['total'] }}</td>
					</tr>
				</table>
				<div class="col-md-12 text-center">
					<a href="{{ url('/pesanan/daftar').'/'.Auth::id() }}" class="btn btn-danger btn-sm">Kembali</a>
					<button id="pesan" type="submit" class="btn btn-info btn-sm">Bayar</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection