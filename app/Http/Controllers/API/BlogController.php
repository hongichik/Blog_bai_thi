<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\blog;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function getBlog(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Personal-blog')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 
        $blog = blog::where('id',$request->id)->first();

        $pathContent = public_path().'/uploads/blog/'.$blog->content;
        $container = file_get_contents($pathContent);

        return response([
            "name" => $blog->name,
            "image" => $blog->image,
            "summany" => $blog->summany,
            "content" => $container,
        ]);

    }
    public function UpdateBlog(Request $request)
    {
        
        if (!$request->user()->hasPermission('Manage-Personal-blog')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 

        $blog = blog::where('id',$request->id)->first();
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
            File::delete($path.$blog->image);
            $blog->image = $fileNameImg;
        }
        $pathContent = public_path().'/uploads/blog/'.$blog->content;
        $pathContent = fopen($pathContent, 'w');
        fwrite($pathContent, $request->content);
        fclose($pathContent);

        $blog->name = $request->name;
        $blog->summany = $request->summary;
        return $blog->save();

    }

    public function DeleteBlog(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Personal-blog')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 
        $blog = blog::where('id',$request->id)->first();
        $content_path = public_path().'/uploads/blog/'.$blog->content;
        File::delete($content_path);

        // delete img
        $image_path = public_path().'/uploads/images/'.$blog->image; 
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        return $blog->delete();
    }
    public function ListAllBlog(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-blog-All')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 

        return DB::table('blogs')
        ->selectRaw('blogs.*,users.name as `UserName`')
        ->join('users', 'blogs.user_id', '=', 'users.id')
        ->orderBy('blogs.id', 'DESC')
        ->paginate(10);
    }
    public function CountAllBlog()
    {
        return ceil(blog::All()->Count()/10);
    }

    public function ListBlog(Request $request)
    {
        $CountOnePage = 10;
        $startpage = ($request->page -1)*$CountOnePage;

        return DB::table('blogs')
        ->selectRaw('blogs.*,users.name as `UserName`')
        ->join('users', 'blogs.user_id', '=', 'users.id')
        ->where('users.id',Auth::user()->id)
        ->orderBy('blogs.id', 'DESC')
        ->paginate(10);
    }
    public function CountBlog()
    {
        return ceil(blog::All()->Where('user_id',Auth::user()->id)->Count()/10);
    }
    public function NewBlog(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Personal-blog')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 

        //add new file .blog
        $path = public_path() . '/uploads/blog/';
        $fileNameChild = uniqid().'.blog';
        while(file_exists($path.$fileNameChild))
        {
            $fileNameChild = uniqid().'.blog';
        }
        $fullname = $path.$fileNameChild;
        $fileChild = fopen($fullname, "x"); // open file just for write
        fwrite($fileChild, $request->content); // write file
        fclose($fileChild); // close file

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

        $new_Blog = new blog();
        $new_Blog->name = $request->name;
        $new_Blog->summany = $request->summary;
        $new_Blog->image = $fileNameImg;
        $new_Blog->content = $fileNameChild;
        $new_Blog->user_id = Auth::user()->id;
        return $new_Blog->save();
    }
}
