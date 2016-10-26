<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver;
use MongoClient;

Class servicesController extends Controller
{

    public  function main(){
        return view('services/services');
    }

    public  function electronic(){
       return view('services/electronic');
    }

    public  function new_electronic(Request $request){
        //update to mongo of this user
        $wx_openid = $request->input('wx_openid');






        return view('services/services');
    }
}