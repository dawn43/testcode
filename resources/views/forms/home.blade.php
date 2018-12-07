@extends('layouts.app')

@section('title','Home')

@section('navbar')
	@parent
@endsection

@section('content-title','Home Page '.$dataUser['role'])

@section('content')
<div class="card-body px-lg-5 pt-0">

	<div class="row" style="margin-top: 120px; margin-bottom: 120px;">
		<div class="col-md-12 text-center">
			<label class="control-label">Selamat Datang {{ $dataUser['user_name'] }}</label><br>
			<a style="width: 50%;" href="{{ url('/pesanan/buat').'/'.Auth::id() }}" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-plus"></i> Buat Pesanan</a>
			<a style="width: 50%;" href="{{ url('/pesanan/daftar').'/'.Auth::id() }}" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-list"></i> Daftar Pesanan</a>
		</div>
	</div>

</div>
@endsection