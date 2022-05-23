<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PermissionController extends Controller
{
    public function UpdateInfo(Request $request)
    {
        if($request->image != "0")
        {
            if(Auth::user()->image != 'defaultImage.jpg')
            {
                $path = public_path() . '/uploads/images/';
                File::delete($path.Auth::user()->image);
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
            $User_update= User::where('id',Auth::user()->id)->update(
                [
                    'name' => $request->Fullname,
                    'email' => $request->Gmail,
                    'address' =>$request->address,
                    'birthday'=>$request->birthday,
                    'image'=>$fileNameImg
                ]);
        }
        else
        {
            $User_update= User::where('id',Auth::user()->id)->update(
                [
                    'name' => $request->Fullname,
                    'email' => $request->Gmail,
                    'address' =>$request->address,
                    'birthday'=>$request->birthday,
                ]);
        }


        return;
    }
    public function GetInfo()
    {
        return Auth::user();
    }
    public function UpdateAcount(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Account')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 
        if($request->pass != "demo")
        {
            $User_update =User::where('id',$request->id)->update(
                [
                    'name' => $request->Fullname,
                    'email' => $request->Gmail,
                    'address' =>$request->address,
                    'birthday'=>$request->birthday,
                    'password' => bcrypt($request->Pass)
                ]);
        }
        else
        {
            $User_update= User::where('id',$request->id)->update(
                [
                    'name' => $request->Fullname,
                    'email' => $request->Gmail,
                    'address' =>$request->address,
                    'birthday'=>$request->birthday,
            ]);
        }
        $updatePer = User::where('id',$request->id)->first();
        return $updatePer->permissions()->sync(array_map('intval', explode(",", $request->Permission)));
         
    }
    public function GetInfoAcount(Request $request)
    {
        return User::where('id',$request->id)->first();
    }
    public function GetInfoAcountPer(Request $request)
    {
        return User::where('id',$request->id)->first()->permissions;
    }
    public function DeleteAcount(Request $request){
        if (!$request->user()->hasPermission('Manage-Account')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 
        return User::where('id',$request->id)->delete();
    }
    public function GetAllAdmin()
    {
        return User::all();
    }
    public function NewAccount(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Account')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 
        $admin_create = new User();
        $admin_create->name = $request->Fullname;
        $admin_create->email = $request->Gmail;
        $admin_create->password = bcrypt($request->Pass);
        $admin_create->birthday = $request->birthday;
        $admin_create->address = $request->address;
        $admin_create->save();
        $admin_create->permissions()->sync(array_map('intval', explode(",", $request->Permission)));
        return true;
    }
    public function GetPermisson()
    {
        return Permission::All();
    }
    public function ShowPermissionAll()
    {
        $user = request()->user();
        return $user->permissions;
    }

    public function CheckPermission(Request $request)
    {
        if($request->user()->hasPermission($request->Permission))
            return "1";
        return "0";
    }
}
