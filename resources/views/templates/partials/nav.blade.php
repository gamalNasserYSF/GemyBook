<style type="text/css">
  .noty_item{
    display: none;
    width: 250px;
    float: right;
    position: absolute;
    top: 50px;
    right: 120px;
  }
  .reightList{
    margin-top:5px; 
  }
</style>

<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{route('home')}}">GemyBook</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
     @if(Auth::check())  
      <ul class="nav navbar-nav navbar-left">       
        <li ><a href="{{route('home')}}"><span class="sr-only">(current)</span></a></li>
        <form class="navbar-form navbar-left" action="" method="get" role="search">
          <div class="form-group">
            <input type="text" name="query" class="form-control" placeholder="Find people">
          </div>
          <button type="submit" class="btn btn-default">Search</button>
        </form>
      </ul>
    @endif
    
    <ul class="nav nav-pills navbar-right reightList" role="tablist">       
      @if(Auth::check())  
        <li role="presentation"><a href="#">{{ Auth::user()->getNameOrUsername() }}</a></li>
        <li role="presentation" class="notifyTab"><a href="#"> Notification <span class="badge">4</span></a></li>
        <li><a href="{{ route('auth.signout') }}">Sign Out</a></li>
      @else
        <li role="presentation"><a href="{{route('auth.signup')}}">Sign Up</a></li>
        <li role="presentation"><a href="{{route('auth.signin')}}">Sign In</a></li>
        
      @endif 
    </ul>
    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="list-group noty_item">
      <a href="#" class="list-group-item">gmal comment on your post</a>
      <a href="#" class="list-group-item">gmal comment on your post</a>
      <a href="#" class="list-group-item">gmal comment on your post</a>
      <a href="#" class="list-group-item">gmal comment on your post</a>
      <a href="#" class="list-group-item">gmal comment on your post</a>
</div>
 <script src="{{asset('resources/assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('resources/assets/js/jquery-1.11.3.min.js')}}"></script>
        <script src="{{asset('resources/assets/js/vue.js')}}"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<script type="text/javascript">
  $('.notifyTab').click(function(){
    $('.noty_item').toggle('4000');
  });

</script>
