@extends('templates.default')

@section('content')
<style type="text/css">
	  
	  .main {
	    max-width: 320px;
	    margin: 0 auto;
	  }

</style>
  
  <div class="row">
  	
	    <div class="main">
	      
	   
	      <form method="post" action="">
	        <div class="form-group{{ $errors->has('email') ? ' has-error':''}}">
	          <label for="email">E-mail</label>
	          <input type="text" name="email" class="form-control" id="email" value="{{ empty(Session::get('current_user')->email)? '':Session::get('current_user')->email }}">
	        @if ($errors->has('email'))
				<span class="help-block">*{{ $errors->first('email') }}</span>
			@endif
	        </div>
	        
	        <div class="form-group{{ $errors->has('password') ? ' has-error':''}}">
	          <a class="pull-right" href="#">Forgot password?</a>
	          <label for="password">Password</label>
	          <input type="password" name="password" class="form-control" id="password">
	          @if ($errors->has('password'))
				<span class="help-block">*{{ $errors->first('password') }}
				</span>
			  @endif
	        </div>
	        <div class="checkbox pull-right">
	          <label>
	            <input type="checkbox" name="remember">
	            Remember me </label>
	        </div>
	        <button type="submit" class="btn btn-primary">
	          Log In
	        </button>
	        <input type="hidden" name="_token" value="{{ Session::token()}}">
	      </form>
	    
	    </div>
    
  </div>

@endsection