<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class postController extends Controller
{
    public function ListAllPost(Request $request)
    {
        $CountPostOnePage = 10;
        $startpage = ($request->page -1)*$CountPostOnePage;

        return DB::select('SELECT posts.*,users.name as `UserName`,categories.name as `CategoryName`,
        (SELECT COUNT(id) FROM post_chillds WHERE post_id = posts.id) as `count` 
        FROM `posts` 
        JOIN `users` ON posts.user_id = users.id
        JOIN categories ON posts.category_id = categories.id
        ORDER BY posts.id DESC
        LIMIT ?, ?', [$startpage,$CountPostOnePage]);
    }


    public function CountAllPost()
    {
        return ceil(Post::All()->Count()/10);
    }


    public function ListPost(Request $request)
    {
        $CountPostOnePage = 10;
        $startpage = ($request->page -1)*$CountPostOnePage;

        return DB::select('SELECT posts.*,users.name as `UserName`,categories.name as `CategoryName`,
        (SELECT COUNT(id) FROM post_chillds WHERE post_id = posts.id) as `count` 
        FROM `posts` 
        JOIN `users` ON posts.user_id = users.id
        JOIN categories ON posts.category_id = categories.id
        WHERE users.id = ?
        ORDER BY posts.id DESC
        LIMIT ?, ?', [Auth::user()->id,$startpage,$CountPostOnePage]);
    }



    public function CountPost()
    {
        return ceil(Post::All()->Where('user_id',Auth::user()->id)->Count()/10);
    }

    public function getPost(Request $request)
    {
        return Post::where('id',$request->id)->first();
    }
    public function DeletePost(Request $request)
    {
        return Post::where('id',$request->id)->first()->delete();
    }
    public function UpdatePost(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Personal-post')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 
        $post = Post::where('id',$request->id)->first();
        if($request->image != "0")
        {
            $path = public_path() . '/uploads/images/';
            //upload image
            if(!$request->hasFile('image')) {
                return response()->json(['Tải ảnh lên thất bại'], 400);
            }
            $file = $request->file('image');
            if(!$file->isValid()) {
                return response()->json(['Tải ảnh lên thất bại'], 400);
            }
            $fileNameImg = uniqid().'.'.$file->getClientOriginalExtension();
            while(file_exists($path.$fileNameImg))
            {
                $fileNameImg = uniqid().'.'.$file->getClientOriginalExtension();
            }
            $file->move($path, $fileNameImg);
            File::delete($path.$post->image);
            $post->image = $fileNameImg;
        }



        $post->name = $request->name;
        $post->summany = $request->summary;
        $post->category_id = $request->category_id;
        return $post->save();
    }

    public function NewPost(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Personal-post')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 
        //upload image
        $path = public_path() . '/uploads/images/';
        if(!$request->hasFile('image')) {
            return response()->json(['Tải ảnh lên thất bại'], 400);
        }
        $file = $request->file('image');
        if(!$file->isValid()) {
            return response()->json(['Tải ảnh lên thất bại'], 400);
        }

        $fileNameImg = uniqid().'.'.$file->getClientOriginalExtension();
        while(file_exists($path.$fileNameImg))
        {
            $fileNameImg = uniqid().'.'.$file->getClientOriginalExtension();
        }
        $file->move($path, $fileNameImg);

        $new_post = new Post();
        $new_post->name = $request->name;
        $new_post->summany = $request->summary;
        $new_post->image = $fileNameImg;
        $new_post->user_id = Auth::user()->id;
        $new_post->category_id = $request->category_id;
        return $new_post->save();
    }
}
