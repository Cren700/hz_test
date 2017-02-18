<?php

/**
 * Shop_service_model.php
 * Author   : cren
 * Date     : 2016/12/26
 * Time     : 下午7:37
 */
class Shop_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // 关注
    public function collect($pid)
    {
        $option = array('user_id' => $this->_user_id, 'product_id' => $pid);
        return $this->myCurl('product', 'collect', $option);
    }

    // 加入购物车
    public function join($pid)
    {
        $option = array('user_id' => $this->_user_id, 'product_id' => $pid);
        return $this->myCurl('order', 'join', $option, true);
    }

    // 移动购物车
    public function remove($id)
    {
        $option = array('user_id' => $this->_user_id, 'id' => $id);
        return $this->myCurl('order', 'remove', $option);
    }
    
    //购物车列表
    public function getList()
    {
        $option = array('user_id' => $this->_user_id);
        return $this->myCurl('order', 'getCartList', $option, true);
    }
    
}