<?php

/**
 * Order_service_model.php
 * Author   : cren
 * Date     : 2016/12/27
 * Time     : 下午10:57
 */
class Order_service_model extends HZ_Model
{
    private $_api = 'order';
    public function __construct()
    {
        parent::__construct();
    }

    public function query($data)
    {
        return $this->myCurl($this->_api, 'queryOrders', $data, false);
    }

    public function orderStatus($option)
    {
        return $this->myCurl($this->_api, 'orderStatus', $option, true);
    }

    public function queryTixian($data)
    {
        return $this->myCurl($this->_api, 'queryTxOrders', $data, false);
    }

    public function txOrderStatus($option)
    {
        return $this->myCurl($this->_api, 'txOrderStatus', $option, true);
    }

    public function queryClaim($data)
    {
        return $this->myCurl($this->_api, 'queryClaim', $data, false);
    }

    public function claimOrderStatus($option)
    {
        return $this->myCurl($this->_api, 'claimOrderStatus', $option, true);
    }
}