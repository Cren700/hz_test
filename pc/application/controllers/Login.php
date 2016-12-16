<?php

/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/7/9
 * Time: 下午2:37
 */
class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/account_service_model');
    }
    /**
     * 管理员登录接口
     */
    public function adminAccountLogin()
    {
        $username = trim($this->input->post('username'));
        $pwd = trim($this->input->post('pwd'));
        $table_type = trim($this->input->post('table_type'));
        $res = $this->account_service_model->accountLogin($username, $pwd, $table_type);
        echo outPutJsonData($res);
    }
}
