<?php

/**
 * error.php
 * Author   : cren
 * Date     : 2016/12/7
 * Time     : 下午11:09
 */
class error extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function error_404()
    {
        $this->smarty->assign('uri', getBaseUrl(''));
        $this->smarty->display('errors/404.tpl');
    }
}