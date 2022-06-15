<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\postChilld;
use App\Models\Category;
use App\Models\vistorpost;

class PostController extends Controller
{
    public function viewCommentPost(Request $request)
    {
        $post = Post::where('id',$request->id)->first();

        return redirect('/Post/'.$post->name);
    }
    public function PostChill(Request $request,$NamePost,$NamePostChill)
    {
        $post = Post::where('name',$NamePost)->first();
        $Category = Category::where('id',$post->category_id)->first();
        if($post  == "")
        {
            return  redirect('user.Home');
        }

        $postChilld = postChilld::where('name',$NamePostChill)->first();
        
        $path = public_path().'/uploads/blog/'.$postChilld->content;
        $container = file_get_contents($path);


        $CheckIp = vistorpost::where('ip',$request->getClientIp())->where('post_id',$post->id)->count();
        if($CheckIp >0)
        {
            $vistorpost = vistorpost::where('ip',$request->getClientIp())->where('post_id',$post->id)->first();
            vistorpost::where('ip',$request->getClientIp())->where('post_id',$post->id)->update(['count' => $vistorpost->count+1]);
        }
        else
        {
            $vistorpost = new vistorpost();
            $vistorpost->count = 1;
            $vistorpost->ip = $request->getClientIp();
            $vistorpost->post_id = $post->id;
            $vistorpost->save();
        }


        return view('user.PostChill',[
            'container' => $container,
            'category'=>$Category->name,
            'PostName'=>$NamePost,
            'postChilldName'=>$postChilld->name,
            'PostChillId'=>$postChilld->id
        ]);
    }
    public function ListPost(Request $request,$NamePost)
    {
        $post = Post::where('name',$NamePost)->first();
        $Category = Category::where('id',$post->category_id)->first();
        if($post  == "")
        {
            return view('user.Post');
        }
        $postChilld = postChilld::where('post_id',$post->id)->paginate(10);
        return view('user.Post',[
            'Posts' => $postChilld,
            'category'=>$Category->name,
            'PostName'=>$NamePost
        ]);
    }
}
