<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\vistorBlog;

class BlogController extends Controller
{
    public function viewCommentBlog(Request $request)
    {
        $blog = blog::where('id',$request->id)->first();

        return redirect('/Blog/'.$blog->name);
    }
    public function index(Request $request,$nameBlog)
    {
        $blog = blog::where('name',$nameBlog)->first();

        $path = public_path().'/uploads/blog/'.$blog->content;
        $container = file_get_contents($path);

        $CheckIp = vistorBlog::where('ip',$request->getClientIp())->where('blog_id',$blog->id)->count();
        if($CheckIp >0)
        {
            $vistorBlog = vistorBlog::where('ip',$request->getClientIp())->where('blog_id',$blog->id)->first();
            vistorBlog::where('ip',$request->getClientIp())->where('blog_id',$blog->id)->update(['count' => $vistorBlog->count+1]);
        }
        else
        {
            $vistorBlog = new vistorBlog();
            $vistorBlog->count = 1;
            $vistorBlog->ip = $request->getClientIp();
            $vistorBlog->blog_id = $blog->id;
            $vistorBlog->save();
        }

        return view('user.Blog',
            [
                'container'=>$container,
                'BlogName' =>$blog->name,
                'BlogId' =>$blog->id
            ]
        );
    }
    public function ListBlog(Request $request)
    {
        $blog = blog::paginate(10);
        return view('user.ListBlog',
            [
                'ListBlog'=>$blog
            ]
        );
    }
}
