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
			<table class="table table-bordered">
				<tr>
					<th>Nomor Pesanan</th>
					<th class="text-center">Aksi</th>
				</tr>
				@if($data['role']->id==1)
					@foreach($data['pesanan'] as $aktif)
						<tr>
							{!! '<td>'.$aktif->nomor_pesanan.'</td>' !!}
							<td class="text-center">
								<a class="btn btn-primary btn-sm" href="{{ url('/pesanan/lihat?id=').$aktif->id }}">Lihat</a> 
								<a class="btn btn-success btn-sm" href="{{ url('/pesanan/edit?id=').$aktif->id }}">Edit</a>
								<a class="btn btn-info btn-sm" href="{{ url('/pesanan/bayar?id=').$aktif->id }}">Bayar</a>
							</td>
						</tr>
					@endforeach
				@endif
				@if($data['role']->id!=1)
					@foreach($data['pesanan'] as $aktif)
						<tr>
							{!! '<td>'.$aktif->nomor_pesanan.'</td>' !!}
							<td class="text-center">
								<a class="btn btn-primary btn-sm" href="{{ url('/pesanan/lihat?id=').$aktif->id }}">Lihat</a> 
								<a class="btn btn-success btn-sm" href="{{ url('/pesanan/edit?id=').$aktif->id }}">Edit</a>
							</td>
						</tr>
					@endforeach
				@endif
			</table>
		</div>
	</div>
</div>
@endsection