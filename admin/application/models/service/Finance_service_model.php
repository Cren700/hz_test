<?php

/**
 * Finance_service_model.php
 * Author   : cren
 * Date     : 2017/1/4
 * Time     : 下午8:39
 */
class Finance_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function queryAccount($option)
    {
        // 账户列表
        return $this->myCurl('account', 'queryCapitalAccount', $option);
    }
    
    public function queryOrderStat($option)
    {
        return $this->myCurl('order', 'queryOrderStat', $option);
    }

    public function querySaleStat($option)
    {
        return $this->myCurl('order', 'querySaleStat', $option);
    }
}