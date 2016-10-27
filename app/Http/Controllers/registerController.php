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
        //update to mongo of this user

        // 连接到mongodb
        $m = new MongoClient();
        echo "Connection to database successfully";
        // 选择一个数据库
        $db = $m->zl;
        echo "Database zl selected";
        $collection = $db->user;
        echo "Collection selected succsessfully";
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

        echo "Document inserted successfully";


        return view('register/normal');
    }
}