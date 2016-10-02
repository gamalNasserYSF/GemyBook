@if (Session::has('info'))
	<div class="alert alert-info" id="aaa" role="alert">
		{{ Session::get('info') }}
	</div>
@endif