<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver;
use MongoClient;

Class registerController extends Controller
{

    public function normal()
    {
        return view('register/normal');
    }


    public function new_normal(Request $request)
    {
        $m = new MongoClient();
        $db = $m->zl;
        $collection = $db->user;
        $document = array(
            "wx_openid" => $request->input('wx_openid'),

            "wx_nickname" => $request->input("wx_nickname"),
            "wx_headimgurl" => $request->input("wx_headimgurl"),

            "name" => $request->input("name"),
            "sex" => $request->input("sex"),
            "birthday" => $request->input("birthday"),

            "cellphone" => $request->input("cellphone"),
            "email" => $request->input("email"),
            "company_name" => $request->input("company_name"),

            "company_address" => $request->input("company_address"),
            "experience" => $request->input("experience"),
            "product_info" => $request->input("product_info"),

            "source_info" => $request->input("source_info"),
            "register_time" => time()
        );
        $collection->insert($document);

        return view('register/profile',['item'=>$document]);
    }

    public function profile(Request $request)
    {
        $m = new MongoClient();
        $db = $m->zl;
        $collection = $db->user;

        $item = $collection->findOne(array('wx_openid'=> $request->input('wx_openid')));

        return view('register/profile',['item'=>$item]);
    }

    public function new_profile(Request $request)
    {
        $m = new MongoClient();
        $db = $m->zl;
        $collection = $db->user;

        $document = array(
//            "wx_openid" => $request->input('wx_openid'),
//            "wx_nickname" => $request->input("wx_nickname"),
//            "wx_headimgurl" => $request->input("wx_headimgurl"),
//            "register_time" => time()

            "name" => $request->input("name"),
            "sex" => $request->input("sex"),
            "birthday" => $request->input("birthday"),

            "cellphone" => $request->input("cellphone"),
            "email" => $request->input("email"),
            "company_name" => $request->input("company_name"),

            "company_address" => $request->input("company_address"),
            "experience" => $request->input("experience"),
            "product_info" => $request->input("product_info"),

            "source_info" => $request->input("source_info"),
        );
        $collection->update(array('wx_openid'=> $request->input('wx_openid')), array('$set'=>$document));

        //
        $item = $collection->findOne(array('wx_openid'=> $request->input('wx_openid')));

        return view('register/profile',['item'=>$item]);
    }
}