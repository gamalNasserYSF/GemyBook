@extends('templates.default')

@section('content')
	<div class="row">
		<div class="col-lg-6">
			<form action="{{ route('status.post')}}" method="post" id="addPost">
				<div class="form-group{{ $errors->has('status')?' has-error':''}}">
					<textarea placeholder="What's in your mind" name="status" class="form-control" rows="3"></textarea>
				</div>
				<button type="submit" id="" class="btn btn-default postForm">Post Status</button>
				<input type="hidden" name="_token" value="{{Session::token()}}">
			</form>
			<hr>
		</div>
	</div>

	<div class="row" id="VueApp">
		<div class="col-lg-5 item">
			@if (!$statuses->count())
				<p class="empty">There's no thing in your timeline, yet.</p>
			@else
				@foreach ($statuses as $status)
					<div class="media">
						<a class="pull-left" href="#">
							<img class="media-object" alt="" src="{{$status->user->getAvatarUrl()}}">
						</a>						
						<div class="media-body">
							<h4 class="media-heading">
							    <a href="#">{{$status->user->getNameOrUsername()}}</a>
							</h4>
							<p>{{ $status->body }}</p>
							<ul class="list-inline">
								<li><span class="glyphicon glyphicon-time"></span></li>
								<li>{{$status->created_at->diffForHumans()}}</li>
							</ul>
							<div id="post{{$status->id}}">
								@foreach ($status->replies as $reply)
								<div class="media">
									<a class="pull-left" href="#">
										<img class="media-object" alt="" width="40" style="border-radius:20px;" src="{{$reply->user->getAvatarUrl()}}">
									</a>														
									<div class="media-body">
										<h5 class="media-heading">
											<a href="#">{{$reply->user->getNameOrUsername()}}</a>
											<input type="hidden" v-model="reply_auther" id="reply_auther" value="{{ Auth::user()->getNameOrUsername() }}">
											<input type="hidden" v-model="post_auther" value="{{ $status->user->getNameOrUsername()}}">											
										</h5>
										<p>{{ $reply->body }}</p>
											<ul class="list-inline">
												<li><span class="glyphicon glyphicon-time"></span></li>
												<li>{{$reply->created_at->diffForHumans()}}</li>
											</ul>
									</div>
								</div>
								@endforeach
							</div>
							<form action="{{ route('status.reply')}}" method="post" id="replyForm{{$status->id}}">
								<div class="form-group">
									<textarea placeholder="Replay to this status" name="reply-{{$status->id}}" class="form-control" id="reply" rows="2"></textarea>
								</div>
								<input type="submit" @click="createNoty()" value="Reply" id="{{$status->id}}" class="btn btn-default btn-sm replyForm">
								<input type="hidden" name="_token" value="{{Session::token()}}">
							</form>
						</div>
					</div>
				@endforeach
				
			@endif
			
 
		</div>	
	</div>
@endsection

@section('script')
     
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.4.1/firebase.js"></script>
<script>
            // Initialize Firebase
            var config = {
                apiKey: "{{ config('services.firebase.api_key') }}",
                authDomain: "{{ config('services.firebase.auth_domain') }}",
                databaseURL: "{{ config('services.firebase.database_url') }}",
                storageBucket: "{{ config('services.firebase.storage_bucket') }}",
            };

            firebase.initializeApp(config);
            new Vue({
                el: '#VueApp',
                data: {
                    post_auther:'',
                    reply_auther: '',
                    notifications: [] 
                },
                ready: function() {
                    var self = this;
                    // Initialize firebase realtime database.
                    firebase.database().ref('notifications/').on("child_added", function(snapshot, prevChildKey) {
                    // Everytime the Firebase data changes, update the noties array.
                    var newNoty = snapshot.val();
                    self.$set('notifications', newNoty.post_auther);
                	});
             	},
                methods: {
                    /**
                     * Create a new noty and synchronize it with Firebase
                     */
                    createNoty: function() {
                        var self = this;

                        $.post("{{url('/notify')}}", {
                            _token: '{!! csrf_token() !!}',
                            reply_auther: self.reply_auther,
                            post_auther: self.post_auther
                        });
                        this.reply_auther = '';
                        this.post_auther = '';
                    }
                }
            });
</script>

<!-- ////////////////////////////////// -->
<script>
    // global app configuration object
    var config = {
        routes: [
            { 
            	post: "{{ route('status.post')}}",
                comment: "{{ route('status.reply')}}",
                session_token: "{{Session::token()}}",
            }
        ]
    };
</script>
<script src="{{asset('resources/assets/js/main.js')}}"></script>
@endsection