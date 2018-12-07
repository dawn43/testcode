@extends('layouts.app')

@section('title','Buat Pesanan')

@section('navbar')
	@parent
@endsection

@section('content-title','Konformasi Pesanan')

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
					window.location.href = "{{ url('/pesanan/buat').'/'.Auth::id() }}";
				}
			});
		})
	})
</script>
<div class="card-body px-lg-5 pt-0">
	<div class="row">
		<div class="col-md-8 offset-md-2" style="margin-top: 70px; margin-bottom: 70px;">
			@if(empty($dataPesanan['pesanan']))
			<div class="text-center" style="margin-top: 70px; margin-bottom: 70px;">
				<label>Tidak ada pesanan</label><br>
				<a href="{{ url('/pesanan/buat').'/'.Auth::id() }}" class="btn btn-danger btn-sm">Kembali</a>
			</div>
			@endif
			@if(isset($dataPesanan['pesanan']))
				<form id="form" method="post" action="{{ url('/pesanan/simpan').'/'.Auth::id() }}">
					{{ csrf_field() }}
					<input type="hidden" name="meja" value="{{ $dataPesanan['meja'] }}">
					@foreach($dataPesanan['pesanan'] as $key => $data)
					<input type="hidden" name="{{ $key }}" value="{{ $data['jumlah'] }}">
					@endforeach
					<label>Meja: {{ $dataPesanan['meja'] }}</label>
					<table class="table table-bordered">
						<tr>
							<th>Menu</th>
							<th>Jumlah</th>
						</tr>
					@foreach($dataPesanan['pesanan'] as $key => $data)
					<tr>
						{!! "<td>".$data['nama']."</td>" !!}
						{!! "<td>".$data['jumlah']."</td>" !!}
					</tr>
					@endforeach
					</table>
					<hr>
					<div class="col-md-12 text-center">
						<a href="{{ url('/pesanan/buat').'/'.Auth::id() }}" class="btn btn-danger btn-sm">Kembali</a>
						<button id="pesan" type="submit" class="btn btn-primary btn-sm">Pesan</button>
					</div>
				</form>
			@endif
		</div>
	</div>
</div>
@endsection