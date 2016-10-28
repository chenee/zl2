<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver;
use MongoClient;

Class projectlistController extends Controller
{
    public function show()
    {
        $m = new MongoClient();
        $db = $m->zl;
        $collection = $db->orders;


        $cursor = $collection->find(array('wx_openid'=> session('wx_openid')));

        // 迭代显示文档标题

        $objArray = array();
        foreach ($cursor as $document) {

            $json = json_encode($document);
            $obj = json_decode($json);
            array_push($objArray,$obj);
        }

        return view('projectlist/index',['lists'=>$objArray]);
    }

    public function detail($id)
    {
        $m = new MongoClient();
        $db = $m->zl;
        $collection = $db->orders;

        $item = $collection->findOne(array('_id'=>new \MongoId($id)));

        return view('projectlist/detail',['item'=>$item]);
    }

    public function new_detail(Request $request)
    {
        // 连接到mongodb
        $m = new MongoClient();
        $db = $m->zl;
        $collection = $db->orders;

        $document = array(
            "from" => "client",
            "time" => date('Y-m-d H:i:s',time()),
            "msg" => $request->input('msg'),
        );

//        $collection->insert($document);

        $id = new \MongoId($request->input('id'));
        $ret = $collection->update( array("_id"=>$id),array('$push'=>array("沟通"=>$document)));
        $item = $collection->findOne(array('_id'=>$id));

        return view('projectlist/detail',['item'=>$item]);

    }
}