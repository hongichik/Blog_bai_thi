<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function index(Request $request,$NameCategory)
    {
        $Category = Category::where('name',$NameCategory)->get();
        if($Category  == "")
        {
            return view('user.Category');
        }
        elseif($Category->Count() > 1 )
        {
            $where = "";
            for($i = 0;$i<$Category->Count();$i++)
            {
                if($Category->Count()-1 != $i)
                {
                    $where = $where.'category_id = '.$Category[$i]->id.' or ';
                }
                else
                {
                    $where = $where.'category_id = '.$Category[$i]->id;
                }
            }
            $Post = Post::whereRaw($where)->paginate(10);
            return view('user.Category',
            [
                'Posts' => $Post,
                'category' => $NameCategory
            ]);
        }
        else
        {
            $Post = Post::where('category_id',$Category[0]->id)->paginate(10);
            if($Post->count() == 0)
            {
                return view('user.Category');
            }
            return view('user.Category',
            [
                'Posts' => $Post,
                'category' => $NameCategory
            ]);
        }

    }
}
