<?php
/**
 * Storeorder_service_model.php
 * Author   : cren
 * Date     : 2017/2/5
 * Time     : 下午4:26
 */

class Storeorder_service_model extends HZ_Model
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
}
