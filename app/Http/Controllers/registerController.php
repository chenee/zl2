<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver;
use MongoClient;

Class registerController extends Controller
{

    public  function normal(){
        return view('register/normal');
    }


    public  function new_normal(Request $request){
        //update to mongo of this user
        $wx_openid = $request->input('wx_openid');


        return "wxid:".$wx_openid;
        return view('register/normal');
    }
}