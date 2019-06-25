@extends('template')	<!--FORM INI UNTUK MENAMBAH DATA USER-->

@section('main')
	<div id="user">
		<h2>Tambah User</h2>
		
		{!! Form::open(['url' => 'user']) !!}
	@include('user.form', ['submitButtonText' => 'Tambah User'])
		{!! Form::close() !!}
	</div>
@stop

@section('footer')
	@include('footer')
@stop