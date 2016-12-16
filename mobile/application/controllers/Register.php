<?php

/**
 * Register.php
 * Author   : cren
 * Date     : 2016/11/27
 * Time     : 上午11:06
 */
class Register extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/account_service_model');
    }

    /**
     * 注册页
     */
    public function index()
    {
        $this->smarty->display();
    }

    /**
     * 提交注册
     */
    public function doRegister()
    {
//        $user_id = $this->input->post('user_id');
//        $passwd = $this->input->post('passwd');
        $user_id = 'user';
        $passwd = '123456';
        $res = $this->account_service_model->add($user_id, $passwd);
        echo json_encode_data($res);
    }

}