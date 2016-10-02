$(document).ready(function() {
	$('.postForm').click(function(){
		$.ajax({
			headers: {
	                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
	        },
			type: "post",
		    url : config.routes[0].post,
		    data: {'status':$('textarea[name=status]').val()},
		    success: function(data) {
		    var x ='<div class="media" id="newPost">';
				x+='<a class="pull-left" href="#">';
				x+='<img class="media-object" alt="" src="'+data['avatar']+'"></a>';						
				x+='<div class="media-body"><h4 class="media-heading">';
				x+='<a href="#">'+data['author']+'</a></h4>';
				x+='<p>'+data['body']+'</p>';
				x+='<ul class="list-inline">';
				x+='<li><span id="gly" class="glyphicon glyphicon-time"></span></li>';
				x+='<li>'+data['createdAt']+'</li></ul>';
				x+='<form action='+config.routes[0].comment+' method="post" id="replyForm'+data['id']+'">';
				x+='<div class="form-group">';
				x+='<textarea placeholder="Replay to this status" name="reply-'+data['id']+'" class="form-control" id="reply" rows="2"></textarea>';
				x+='<span class="help-block"></span></div>';
				x+='<input type="submit" value="Reply" id="'+data['id']+'" class="btn btn-default btn-sm replyForm">';
				x+='<input type="hidden" name="_token" value='+config.routes[0].session_token+'></div>';
				$('.item').prepend(x);
				$('#newPost').hide().fadeIn(1600);
				$('#addPost').trigger("reset");
				$('.empty').fadeOut();
		    },
		});
		return false;
		// e.preventdefault()
	});

	$('.replyForm').click(function(){
		var replyId = $(this).attr('id');
		$.ajax({
			headers: {
	                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
	        },
			type: "post",
		    url : config.routes[0].comment,
		    data: { 
		    		'reply':$('textarea[name=reply-'+replyId+']').val(),
		    	    'id': replyId,
			},
		    success: function(data) {
		    	
		    	x ='<div class="media" id="replyAj"><a class="pull-left" href="#">';
				x+='<img class="media-object" alt="" width="40" style="border-radius:20px;" src='+data['avatar']+'></a>';
				x+='<div class="media-body"><h5 class="media-heading"><a href="#">'+data['author']+'</a></h5>';
				x+='<p>'+data['body']+'</p><ul class="list-inline">';
				x+='<li><span id="gly" class="glyphicon glyphicon-time"></span></li><li>'+data['createdAt']+'</li></ul></div></div>';
				
				$('#post'+replyId).append(x);
				$('#replyAj').hide().fadeIn(1600);
				$('#replyForm'+replyId).trigger("reset");
				
		    },		   
		});
		return false;
		// e.preventdefault()
	});
});

