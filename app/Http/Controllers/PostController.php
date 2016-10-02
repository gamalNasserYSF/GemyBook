<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Auth;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{
	public function postStatus(Request $request)
	{		
		$this->validate($request,[
			'status' => 'required|max:200',
		]);		
		
		$status = Auth::user()->posts()->create([
			'body' => $request->get('status'),
		]);
		
		$status->save();
		return ['body' => $status->body, 
				'createdAt' => $status->created_at->diffForHumans(),
				'author' => $status->user->getNameOrUsername(),
				'avatar' => $status->user->getAvatarUrl(),
				'id' => $status->id,
				];
	}
	
	public function postReply(Request $request)
	{	
		$statusId  = $request->input('id');
		$this->validate($request,[
			"reply" => 'required|max:1000'
		],[
			'required' =>'the reply body is required.'
		]);

		$status = Post::notReply()->find($statusId);
		
		if (!$status) {
			return redirect()->route('home');
		}
		
		$reply = Post::create([
			'body'=> $request->input("reply"),
		])->user()->associate(Auth::user());

		$status->replies()->save($reply);
		return ['body' => $reply->body, 
				'createdAt' => $reply->created_at->diffForHumans(),
				'author' => $reply->user->getNameOrUsername(),
				'avatar' => $reply->user->getAvatarUrl(),
				];
	}

	public function getLike($statusId)
	{
		$status = Post::find($statusId);

		if (!$status) {
			return redirect()->route('home');
		}
		if (!Auth::user()->isFriendsWith($status->user)) {
			return redirect()->route('home');
		}
		if (Auth::user()->hasLikedStatus($status)) {
			// dd('liked');
			return redirect()->back();
		}
		$like = $status->likes()->create([]);
		Auth::user()->likes()->save($like);

		return redirect()->back();

	}
}