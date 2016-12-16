<?php

/**
 * Home.php
 * Author   : cren
 * Date     : 2016/12/4
 * Time     : 下午5:57
 */
class Home extends BaseControllor
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->smarty->display('home/index.tpl');
    }
}