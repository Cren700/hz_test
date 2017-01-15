<?php

/**
 * Order_service_model.php
 * Author   : cren
 * Date     : 2016/12/29
 * Time     : 下午7:34
 */
class Order_service_model extends HZ_Model
{
    private $_host = 'order';
    public function __construct()
    {
        parent::__construct();
    }
    
    public function orderDetail($option)
    {
        return $this->myCurl($this->_host, 'orderDetail', $option);
    }

    // 通过购物车获取数据
    public function previewByCid($cid)
    {
        $option = array('user_id' => $this->_user_id, 'id' => $cid);
        return $this->myCurl($this->_host, 'previewByCid', $option);
    }

    // 通过产品获取数据
    public function previewByPid($pid)
    {
        $option = array('product_id' => $pid);
        return $this->myCurl($this->_host, 'previewByPid', $option);
    }

    // 通过购物车下单页面
    public function create($id)
    {
        $option = array('user_id' => $this->_user_id, 'id' => $id);
        return $this->myCurl($this->_host, 'createByCid', $option, true);
    }

    // 通过产品直接下单页面
    public function insCreate($id)
    {
        $option = array('user_id' => $this->_user_id, 'product_id' => $id);
        return $this->myCurl($this->_host, 'createByPid', $option, true);
    }

    /**
     * 保存理赔信息
     * @param $option
     * @return mixed
     */
    public function saveClaims($option)
    {
        return $this->myCurl($this->_host, 'saveClaims', $option, true);
    }

    /**
     * 获取理赔信息
     * @param $option
     * @return mixed
     */
    public function claimsDetail($option)
    {
        return $this->myCurl($this->_host, 'claimsDetail', $option);
    }

    public function updateClaims($option)
    {
        return $this->myCurl($this->_host, 'updateClaims', $option, true);
    }

}