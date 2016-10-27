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


        $cursor = $collection->find(array('wx_openid'=>'wxidchenee123456'));

        // 迭代显示文档标题

        $objArray = array();
        foreach ($cursor as $document) {

            $json = json_encode($document);
            $obj = json_decode($json);
            array_push($objArray,$obj);
        }

        return view('projectlist/index',['lists'=>$objArray]);
    }

}