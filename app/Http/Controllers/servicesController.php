<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver;
use MongoClient;

Class servicesController extends Controller
{

    public function main()
    {
        return view('services/services');
    }

    public function electronic()
    {
        return view('services/electronic');
    }

    public function new_electronic(Request $request)
    {
        //TODO:update to mongo of this user

        // 连接到mongodb
        $m = new MongoClient();
        //select db
        $db = $m->zl;
        //select collection
        $collection = $db->orders;

        //insert or update
        $document = array(
            "wx_openid" => $request->input('wx_openid'),
            "requirement" => $request->input('requirement'),
            "number" => $request->input('number'),

            "pay" => array(
                "state" => 1,
                "history" => array(
                    array(
                        "name" => "基本需求付款",
                        "cash" => 999,
                        "payed" => false,
                    ),
                ),
            ),
            "沟通" => array(
                array(
                    "from" => "client",
                    "time" => date('Y-m-d',time()),
                    "msg" => "我提了一个需求,请提供服务?",
                ),

            ),
        );

        $collection->insert($document);

        return "Document inserted successfully";

//        return view('services/services');
    }

}