<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\postChilld;

class PostController extends Controller
{
    public function ListPost(Request $request)
    {
        return $post = Post::where('name',$request->name)->first();
        
        return view('user.posts');
    }
}
