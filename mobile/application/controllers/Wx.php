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
        // 读取MP_verify_iBHavzn7sVRrz8zH文件内容
        echo file_get_contents('./static/MP_verify_iBHavzn7sVRrz8zH.txt');
    }
}