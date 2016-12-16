<?php

/**
 * MY_Model.php
 * Author   : cren
 * Date     : 16/7/10
 * Time     : 上午12:28
 */
class HZ_Model extends CI_Model
{
    protected $_uid = null;
    protected $_user_id = null;
    public function __construct()
    {
        parent::__construct();
        $this->_uid = $this->session->userdata('uid');
        $this->_user_id = $this->session->userdata('username');
    }

    protected function myCurl($host, $control, $data = array(), $is_post = false)
    {
        if(is_array($data))
        {
            $data = http_build_query($data);
        }
        $userAgent = 'mobile-web/2.0';

        $this->load->config('curl_api');
        $api = $this->config->item($host);
        $url = $api['host'].strtolower($api['api'][$control]);
        $url = $is_post ? $url : $url.'?'.$data;

        $ip = get_client_ip();
        $header = array(
            'X-APP-CHANNEL: 2', // mobile
            "X-UID: {$this->_uid}",
            "X-USER-ID: {$this->_user_id}",
            "REMOTE-ADDR: {$ip}",
            "CLIENT-IP: {$ip}",
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);//echo $host;//exit();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

        if($is_post === true)
        {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $res = curl_exec($ch);
//        echo $res;die;
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);//print_r($httpCode);exit();
        curl_close($ch);

        if($httpCode != '200')
        {
            $res = '';

        }
        return json_decode($res, true);
    }
}