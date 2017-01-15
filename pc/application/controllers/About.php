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
    }

    /**
     * 关于我们
     */
    public function index()
    {
        $jsArr = array(
            'about.js',
            'personal.js'
        );
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('about/index.tpl');
    }
}