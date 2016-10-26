<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use MongoDB\Driver;
use MongoClient;

Class mongoController extends Controller
{
    public  function __construct(){

        $this->connect();
    }
    private  $db;

    private function connect(){
        try{
            if ( !class_exists('Mongo')){
                echo ("The MongoDB PECL extension has not been installed or enabled");
                return false;
            }
            //$connection=  new \MongoClient($config['connection_string'],array('username'=>$config['username'],'password'=>$config['password']));
            $connection=  new \MongoClient();
            return $this->db = $connection->selectDB('testdb');
        }catch(Exception $e) {
            return false;
        }
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