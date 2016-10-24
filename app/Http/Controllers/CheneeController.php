<?php
namespace App\Http\Controllers;

Class CheneeController extends Controller
{
    public function info($id){
//        return "chenee is pig ".$id;
        //return view('CheneeInfo');
        return view('chenee/info',['name'=>'chenee','age'=>18]);
    }
}