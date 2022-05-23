<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class imageController extends Controller
{
    public function ShowImg($fileName){
        $path = public_path().'/uploads/images/'.$fileName;
        return Response::file($path);        
    }
}
