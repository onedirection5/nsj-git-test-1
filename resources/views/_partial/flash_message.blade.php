<!--UNTUK FLASH MESSAGE-->
@if (Session::has('flash_message'))
	<div class="alert alert-success {{ Session::has('penting') ?
	'alert-important' : '' }}">
		<button type="buttton" class="close" data-dismiss="alert"
		aria-hidden="true">&times;</button>
		{{ Session::get('flash_message') }}
	</div>
@endif