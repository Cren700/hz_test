<?php

class wx extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/test_service_model');
    }

    public function index()
    {
        echo 1234;
        $this->smarty->display('test.tpl');
    }
}