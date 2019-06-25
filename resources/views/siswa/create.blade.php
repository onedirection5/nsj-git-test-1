@extends('template')

@section('main')
	<div id="siswa">
		<h2>Tambah Siswa</h2>
		
		{{--@include('errors.form_error_list')-- UNTUK ERROR DENGAN FORM}}
		{{-- <form action = "{{ route('siswa_store') }}" method="POST"> --}}
		{!! Form::open(['url' => 'siswa', 'files' => true]) !!}
			@csrf
			@include('siswa.form', ['submitButtonText' => 'Tambah Siswa'])
		{!! Form::close() !!}
	</div>
@stop

@section('footer')
	@include('footer')
@stop