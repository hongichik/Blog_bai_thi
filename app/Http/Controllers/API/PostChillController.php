<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\postChilld;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostChillController extends Controller
{
    public function UpdatePostChill(Request $request)
    {
        
        if (!$request->user()->hasPermission('Manage-Personal-post')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 

        $postChilld = postChilld::where('id',$request->id)->first();
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
            File::delete($path.$postChilld->image);
            $postChilld->image = $fileNameImg;
        }
        $pathContent = public_path().'/uploads/blog/'.$postChilld->content;
        $pathContent = fopen($pathContent, 'w');
        fwrite($pathContent, $request->content);
        fclose($pathContent);

        $postChilld->name = $request->name;
        $postChilld->summany = $request->summary;
        return $postChilld->save();

    }
    public function getPostchill(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Personal-post')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 
        $postChilld = postChilld::where('id',$request->id)->first();

        $pathContent = public_path().'/uploads/blog/'.$postChilld->content;
        $container = file_get_contents($pathContent);

        return response([
            "name" => $postChilld->name,
            "image" => $postChilld->image,
            "summany" => $postChilld->summany,
            "content" => $container,
        ]);

    }

    public function DeletePostChill(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Personal-post')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 
        $postChilld = postChilld::where('id',$request->id)->first();
        $content_path = public_path().'/uploads/blog/'.$postChilld->content;
        File::delete($content_path);

        // delete img
        $image_path = public_path().'/uploads/images/'.$postChilld->image; 
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        return $postChilld->delete();
    }
    public function CountPostChill(Request $request)
    {
        return ceil(postChilld::All()->Where('post_id',$request->id)->Count()/10);
    }
    public function ListPostChill(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Personal-post')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 

        $CountPostOnePage = 10;
        $startpage = ($request->page -1)*$CountPostOnePage;
        return DB::select('SELECT * FROM post_chillds WHERE
         post_id = ? ORDER BY id DESC LIMIT ?, ?', [$request->id,$startpage,$CountPostOnePage]);
    }
    public function NewPostChill(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Personal-post')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 

        //add new file .blog
        $path = public_path() . '/uploads/blog/';
        $fileNameChildPost = uniqid().'.blog';
        while(file_exists($path.$fileNameChildPost))
        {
            $fileNameChildPost = uniqid().'.blog';
        }
        $fullname = $path.$fileNameChildPost;
        $fileChildPost = fopen($fullname, "x"); // open file just for write
        fwrite($fileChildPost, $request->content); // write file
        fclose($fileChildPost); // close file

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

        $new_post = new postChilld();
        $new_post->name = $request->name;
        $new_post->summany = $request->summary;
        $new_post->image = $fileNameImg;
        $new_post->content = $fileNameChildPost;
        $new_post->user_id = Auth::user()->id;
        $new_post->post_id = $request->post_id;
        return $new_post->save();
    }
}
