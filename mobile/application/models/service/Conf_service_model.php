<?php

/**
 * Order_service_model.php
 * Author   : cren
 * Date     : 2016/12/27
 * Time     : 下午10:57
 */
class Conf_service_model extends HZ_Model
{
    private $_api = 'conf';
    public function __construct()
    {
        parent::__construct();
    }

    public function query()
    {
        return $this->myCurl($this->_api, 'queryConf', array(), false);
    }
}