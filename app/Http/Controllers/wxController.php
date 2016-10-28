<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

Class wxController extends Controller
{

    private $appid = "wx9756628d86fa20fc";
    private $appsecret = "aa4c2500bcfa15901ed6915a5201a15a";

    public function getinfo()
    {
        $redirect_url = urlencode("http://zl2.chenee.cn/wxinfo");
//        $scope = snsapi_base;
        $scope = "snsapi_userinfo";

        $newURL = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$this->appid&redirect_uri=$redirect_url&response_type=code&scope=$scope&state=STATE#wechat_redirect";

        header('Location: ' . $newURL);
    }


    private function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }

    public function  wxinfo(Request $request)
    {

        $code = $request->input('code');

//$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' + $appid + '&secret='+ $appsecret + '&code='+ $code +'&grant_type=authorization_code';
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$this->appid&secret=$this->appsecret&code=$code&grant_type=authorization_code";


        $res = json_decode($this->httpGet($url));
        $access_token = $res->access_token;
        if ($access_token) {
            $openid = $res->openid;
            if ($openid) {
                $url2 = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";

                $ret = $this->httpGet($url2);
                echo var_dump($ret);

                $wxinfo = json_decode($ret);
                //echo "<img src=$wxinfo->headimgurl>";
            }

        } else {
            echo "<h1>access_token is null!!</h1>";//debug
        }

    }
}