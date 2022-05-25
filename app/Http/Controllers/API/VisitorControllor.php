<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VisitorControllor extends Controller
{
    public function ListUser()
    {
        return Auth::user()->all();
    }
    public function ListVisitor(Request $request)
    {
        if($request->report == "blog")
        {
            $stringWhere = "vistor_blogs.id = vistor_blogs.id";
            if(isset($request->dateStart))
            {
                $stringWhere = $stringWhere." AND vistor_blogs.updated_at >= '".$request->dateStart."' ";
            }
            if(isset($request->dateEnd))
            {
                $stringWhere = $stringWhere." AND vistor_blogs.updated_at <= '".$request->dateEnd."' ";
            }
            if(isset($request->UserName))
            {
                $stringWhere = $stringWhere." AND users.name = '".$request->UserName."' ";
            }
            
            return DB::table('vistor_blogs')
            ->selectRaw(" vistor_blogs.count,vistor_blogs.updated_at,blogs.name,blogs.id,users.name as 'UserName'")
            ->join('blogs', 'vistor_blogs.blog_id', '=', 'blogs.id')
            ->join('users', 'blogs.user_id', '=', 'users.id')
            ->whereRaw($stringWhere)
            ->orderBy('vistor_blogs.count', 'DESC')
            ->paginate(10);
        }
        else
        {
            $stringWhere = "vistorposts.id = vistorposts.id";
            if(isset($request->dateStart))
            {
                $stringWhere = $stringWhere." AND vistorposts.updated_at >= '".$request->dateStart."' ";
            }
            if(isset($request->dateEnd))
            {
                $stringWhere = $stringWhere." AND vistorposts.updated_at <= '".$request->dateEnd."' ";
            }
            if(isset($request->UserName))
            {
                $stringWhere = $stringWhere." AND users.name = '".$request->UserName."' ";
            }

            if(isset($request->CategoryName))
            {
                $stringWhere = $stringWhere." AND categories.name = '".$request->CategoryName."' ";
            }

            // return $stringWhere;
            return DB::table('vistorposts')
            ->selectRaw(" vistorposts.count,vistorposts.updated_at,posts.name,posts.id,users.name as 'UserName',categories.name as 'nameCaegory'")
            ->join('posts', 'vistorposts.post_id', '=', 'posts.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->whereRaw($stringWhere)
            ->orderBy('vistorposts.count', 'DESC')
            ->paginate(10);
        }

    }
}
