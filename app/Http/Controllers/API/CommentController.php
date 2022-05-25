<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        return (bool) Comment::create($request->all());
    }

    public function ListComment(Request $request)
    {
        if(isset($request->post_id))
        {
            return Comment::where('post_id',$request->post_id)->where('status',true)->orderBy('id', 'DESC')->paginate(3);
        }
        else
        {
            return  Comment::where('blog_id',$request->blog_id)->where('status',true)->orderBy('id', 'DESC')->paginate(3);
        }
    }

    public function UpdateComment(Request $request)
    {
        return Comment::where('id',$request->id)->update(['status' => true]);
    }

    public function DeleteComment(Request $request)
    {
        return Comment::where('id',$request->id)->delete();
    }
    public function ListALLComment(Request $request)
    {
        return  Comment::where('status',false)->orderBy('id', 'DESC')->paginate(5);
        
    }
}
