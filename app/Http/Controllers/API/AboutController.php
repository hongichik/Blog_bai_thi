<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function UpdateAbout(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Info-Web')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 

        $fileName = public_path() . '/uploads/blog/Contact.blog';
        $fileContact = file_put_contents($fileName,$request->content);
        return;
    }
    public function getAbout()
    {
        $path = public_path() . '/uploads/blog/';
        return file_get_contents($path.'Contact.blog');
    }
}
