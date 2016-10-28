<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

Class wxController extends Controller
{

    private  $appid=wx9756628d86fa20fc;
    private  $appsecret=aa4c2500bcfa15901ed6915a5201a15a;

    public function getinfo()
    {
//require_once(dirname(__FILE__)."/wxid.php");

$next=$_REQUEST["next"];


$redirect_url = urlencode("http://zl2.chenee.cn/zl/wxinfo");
#$scope = snsapi_base;
$scope = snsapi_userinfo;

$newURL = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$this->$appid&redirect_uri=$redirect_url&response_type=code&scope=$scope&state=STATE#wechat_redirect";

header('Location: '.$newURL);
    }

}