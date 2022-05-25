<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\postChilld;

class HomeController extends Controller
{
    public function index()
    {
        $PostNew = Post::orderBy("id",'DESC')->first();
        $PostNewChill = postChilld::where('post_id',$PostNew->id)->offset(0)->limit(1)->get();
        $Yeschill = 0;
        if($PostNewChill->count() < 2)
        {
            $PostNewChill = Post::orderBy("id",'DESC')->where('id', '<', $PostNew->id)->offset(0)->limit(2)->get();
            $Yeschill = 1;
        }
        return view('user.home',[
            "NewPost" => $PostNew,
            "PostNewChill" => $PostNewChill,
            "Yeschill" => $Yeschill
        ]);
    }
}
