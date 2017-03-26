<?php

/**
 * About.php
 * Author   : cren
 * Date     : 2017/1/8
 * Time     : 下午7:36
 */
class About extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/conf_service_model');
    }

    /**
     * 关于我们
     */
    public function index()
    {
        $res = $this->conf_service_model->query();
        $this->smarty->assign('info', isset($res['data']['list']) ? $res['data']['list'] : array());
        $this->smarty->display('about/index.tpl');
    }
}