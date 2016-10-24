<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

Class zlController extends Controller
{
    public  function select(){
        $user = DB::select('select * from test');
//        var_dump($user);
          return view('chenee/main',['dumpValues'=>var_dump($user)]);
    }

    public  function insert(){
        $bool = DB::insert('insert into test (name) values (?)',['chenee']);
//        var_dump($bool);
        return $this->select();
    }

    public  function update(){
        $num = DB::update('update test set name = ? WHERE  name = ?',['chenee1','chenee']);
//        var_dump($num);
        return $this->select();
    }

    public  function  delete(){
        $num = DB::delete('delete from test where id> ?',[2]);
//        var_dump($num);
        return $this->select();
    }

}