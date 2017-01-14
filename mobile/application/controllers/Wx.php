<?php

class Wx extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
//        $this->load->model('service/wx_service_model');
    }

    public function config()
    {
        echo file_get_contents('./static/MP_verify_iBHavzn7sVRrz8zH.txt');
    }


    public function index()
    {
        if(empty($_SESSION['wx_user'])){
            $this->jump(getBaseUrl("/wx/logwx.html"));
        }else{
            print_r($_SESSION['user']);
        }
    }

    public function logwx()
    {
        $appid = "wx8630ddb14433ee21";
        $bakUrl = urlencode(getBaseUrl("/wx/bak.html"));
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$bakUrl.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        header("Location:".$url);
    }

    public function bak()
    {
        $appid = "wx8630ddb14433ee21";
        $secret = "de6b1cb06a97b1fa8f6d9d25e1391a15";
        $code = $_GET["code"];
        $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$get_token_url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $res = curl_exec($ch);
        curl_close($ch);
        $json_obj = json_decode($res,true);

//根据openid和access_token查询用户信息
        $access_token = $json_obj['access_token'];
        $openid = $json_obj['openid'];
        $get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$get_user_info_url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $res = curl_exec($ch);
        curl_close($ch);

//解析json
        $user_obj = json_decode($res,true);
        $_SESSION['wx_user'] = $user_obj;
        print_r($user_obj);
    }
}