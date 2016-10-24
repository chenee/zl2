<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use MongoDB\Driver;
use MongoClient;

Class zlController extends Controller
{
    public  function select(){
        $user = DB::select('select * from test');
//        var_dump($user);
          return view('chenee/main',['dumpValues'=>var_dump($user)]);
    }

    public  function insert(){
        if(0){
            $bool = DB::insert('insert into test (name) values (?)',['chenee']);
        } else{
            $bool = DB::table('test')->insert(
                [['name'=>'chenee101','age'=>20],
                ['name'=>'chenee102','age'=>11],]
            );

        }
        return $this->select();
    }

    public  function update(){
        if(0){
            $num = DB::update('update test set name = ? WHERE  name = ?',['chenee1','chenee']);
        }else{
            $num = DB::table('test')->where('age',0)->update(['age'=>30]);
        }
//        var_dump($num);
        return $this->select();
    }

    public  function  delete(){
        if(0){
            $num = DB::delete('delete from test where id> ?',[2]);
        }else{
            $num = DB::table('test')
                ->where('id','>',2)
                ->delete();

        }
//        var_dump($num);
        return $this->select();
    }
    public  function  mongo1(){
        try {

            $mng = new Driver\Manager();
            $query = new Driver\Query([]);

            $rows = $mng->executeQuery("testdb.cars", $query);

            foreach ($rows as $row) {

                echo "$row->name : $row->price\n";
            }

        } catch (Driver\Exception\Exception $e) {

            $filename = basename(__FILE__);

            echo "The $filename script has experienced an error.\n";
            echo "It failed with the following exception:\n";

            echo "Exception:", $e->getMessage(), "\n";
            echo "In file:", $e->getFile(), "\n";
            echo "On line:", $e->getLine(), "\n";
        }

        echo "........................\n";

        $filter = ['id' => 2];
        $options = [
            'projection' => ['_id' => 0],
        ];
        $query = new Driver\Query($filter, $options);
        $rows = $mng->executeQuery('test.user', $query); // $mongo contains the connection object to MongoDB
        foreach($rows as $r){
            print_r($r);
        }

    }

    public  function mongo2(){
        $m = new MongoClient();

        echo "Connection to database successfully\n";

        // 选择一个数据库

        $db = $m->testdb;

        echo "Database mydb selected\n";

        $collection = $db->cars;

        echo "Collection selected succsessfully\n";



        $cursor = $collection->find();

        // 迭代显示文档标题

        foreach ($cursor as $document) {

            echo $document["name"] .  $document["price"] . "\n";
            //echo "$document->name : $document->price\n";

        }

    }
}