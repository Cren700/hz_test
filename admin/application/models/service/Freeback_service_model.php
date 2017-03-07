<?php

/**
 * Freeback.php
 * Author   : cren
 * Date     : 2017/3/7
 * Time     : 下午10:03
 */
class Freeback_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function queryFreeback($option)
    {
        return $this->myCurl('promo', 'queryFreeback', $option);
    }

    public function freebackStatus($option)
    {
        return $this->myCurl('promo', 'freebackStatus', $option, true);
    }
}