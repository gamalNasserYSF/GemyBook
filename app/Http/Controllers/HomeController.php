<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\Post;

class HomeController extends Controller
{
	public function getIndex()
	{
		if (Auth::check()) {
			$posts = Post::notReply()
					->orderBy('created_at','desc')
					->get(); 

		return view('timeline.index')
				->with('statuses', $posts);
		}

		return view('home');
	}


}