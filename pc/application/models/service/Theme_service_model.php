<?php

/**
 * Theme_service_model.php
 * Author   : cren
 * Date     : 2016/12/18
 * Time     : 下午9:20
 */
class Theme_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getThemeList()
    {
        $option = array('theme_status' => 1);
        return $this->myCurl('posts', 'getThemeList', $option, false);
    }

    public function getPostsThemeByPid($data)
    {
        return $this->myCurl('posts', 'getPostsThemeByPid', $data, false);
    }
}