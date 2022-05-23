<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class categoryController extends Controller
{
    public function listAllCategory()
    {
        $Categories = Category::whereNull('father_id')->get();
        $arrayAll;
        foreach($Categories as $Category)
        {
            
            $arrayAll[] = array(
                'name' => $Category->name,
                'id' =>$Category->id,
                'Chill' =>$Category->ChillCategory,
            );
            foreach($Category->ChillCategory as $CategoryChill)
            {
                
                $arrayAll[] = array(
                    'name' => $CategoryChill->name,
                    'id' =>$CategoryChill->id,
                );
            }
        }
        return response()->json($arrayAll);
    }
    public function UpdateCategory(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Category')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 
        $validated = $request->validate([
            'name'=> 'required',
        ]);
        $Category = Category::find($request->id);
        $Category->update($request->all());
        return $Category;
    }
    public function DeleteCategory(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Category')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 
        
        $Category =  Category::where('id',$request->id)->first();
        $Category->delete();
        return 'oke';
    }
    public function listCategory()
    {
        $Categories = Category::whereNull('father_id')->get();
        $arrayAll;
        foreach($Categories as $Category)
        {
            
            $arrayAll[] = array(
                'name' => $Category->name,
                'id' =>$Category->id,
                'Chill' =>$Category->ChillCategory,
            );
        }
        return response()->json($arrayAll);
    }
    public function ShowPatherCategory()
    {
        $Categories = Category::whereNull('father_id')->get();
        return $Categories;
    }

    public function newCategory(Request $request)
    {
        if (!$request->user()->hasPermission('Manage-Category')) {
            return response([
                'status' => false,
                'message' => 'Bạn không có quyền truy cập vào chức năng này' 
            ], 200);
        } 
        
        $validated = $request->validate([
            'name'=> 'required|unique:categories,name',
        ]);
        return  (bool)Category::create($request->all()); 
    }
}
