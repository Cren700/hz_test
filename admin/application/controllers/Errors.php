<?php

/**
 * errors.php
 * Author   : cren
 * Date     : 2016/12/7
 * Time     : 下午11:09
 */
class Errors extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function error_404()
    {
        $msg = $this->input->get('msg');
        $this->smarty->assign('msg', $msg);
        $this->smarty->display('errors/404.tpl');
    }
}