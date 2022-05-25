<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\postChilld;
use App\Models\Category;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $Post = Post::where('name','LIKE','%'.$request->searchName.'%')->paginate(10);
        return view('user.SearchPost',
        [
            'SearchName' => $request->searchName,
            'Posts' =>$Post
        ]);

    }
}
