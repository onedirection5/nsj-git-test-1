<!-- FORM UNTUK EDIT SISWA -->
@extends('template')

@section('main')
	<div id="siswa">
		<h2>Edit Siswa</h2>
		
{!! Form::model($siswa, ['method' => 'PATCH', 'files' => true, 'action' => ['SiswaController@update', $siswa->id]]) !!} <!-- Form Model Binding -->
@include('siswa.form', ['submitButtonText' => 'Update Siswa'])
		{!! Form::close() !!}
	</div>
@stop

@section('footer')
	@include('footer')
@stop
			