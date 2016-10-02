@extends('templates.default')

@section('content')
<style type="text/css">
	  


</style>
<div class="row ">
	<div class="col-lg-6">
		<form class="form-horizontal" method="post" role="form" action="{{route('auth.signup')}}">
		<fieldset>

			<legend>Registeration Form</legend>

			<!-- Text input-->
			<div class="form-group{{ $errors->has('email') ? ' has-error':''}}">
			  <label class="col-md-4 control-label" for="email">E-mail Address</label>  
			  <div class="col-md-4">
			  <input id="email" name="email" value="{{Request::old('email')}}" type="text" placeholder="email" class="form-control input-md">
			    
			  </div>
			@if ($errors->has('email'))
				<span class="help-block">*{{ $errors->first('email') }}</span>
			@endif
			</div>

			<!-- Text input-->
			<div class="form-group{{ $errors->has('username') ? ' has-error':''}}">
			  <label class="col-md-4 control-label" for="username">Choose a username</label>  
			  <div class="col-md-4">
			  	<input id="username" name="username" value="{{Request::old('username')}}" type="text" placeholder="username" class="form-control input-md" > 
			  </div>
			  @if ($errors->has('username'))
				<span class="help-block">*{{ $errors->first('username') }}</span>
			@endif
			</div>

			<!-- Text input-->
			<div class="form-group{{ $errors->has('password') ? ' has-error':'' }}">
			  <label class="col-md-4 control-label" for="password">Choose a password</label>  
			  <div class="col-md-4">
			  	<input id="password" name="password"  type="password" placeholder="password" class="form-control input-md" >  
			  </div>
			   @if ($errors->has('password'))
				<span class="help-block">*{{ $errors->first('password') }}</span>
			@endif
			</div>

			<div class=" form-group">
			<label class="col-md-4 control-label"></label>  
				<div class="col-md-4">
				<button type="submit" class="btn btn-primary" name="">Sign up</button>	
				</div>		
			</div>
			<input type="hidden" name="_token" value="{{Session::token()}}">
		</fieldset>
		</form>
	</div>
</div>
@endsection