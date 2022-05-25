<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\contact;

class ContactController extends Controller
{
    public function CeaterContact(Request $request)
    {
        return (bool) contact::create($request->all());
    }
    public function GetContact()
    {
        return contact::paginate(10);
    }

    public function DeleteContact(Request $request)
    {
        return (bool)contact::where('id',$request->id)->delete();
        
    }
}
