<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $Category = Category::where('name',$request->name)->first();
        if($Category  == "")
        {
            return view('user.Category');
        }
        else
        {
            $Post = Post::where('category_id',$Category->id)->paginate(10);
            return view('user.Category',
            [
                'Posts' => $Post,
                'category' => $request->name
            ]);
        }

    }
}
