<?php

/**
 * Shop_service_model.php
 * Author   : cren
 * Date     : 2016/12/26
 * Time     : 下午8:29
 */
class Shop_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/shop_dao_model', 'shop_dao');
    }
    
    public function join($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fuser_id']) || empty($option['Fproduct_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        // 是否加入购物车
        $in_cart = $this->shop_dao->in_cart($option);
        if ($in_cart) {
            $ret['code'] = 'order_error_1';
            return $ret;
        }
        $option['Fcreate_time'] = time();
        $res = $this->shop_dao->join($option);
        if ($res) {
            return $ret;
        } else {
            $ret['code'] = 'product_error_9';
            return $ret;
        }
    }

    public function remove($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fuser_id']) || empty($option['Fid'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $res = $this->shop_dao->remove($option);
        if ($res) {
            return $ret;
        } else {
            $ret['code'] = 'posts_error_2';
            return $ret;
        }
    }

    public function update($where, $data)
    {
        $ret = array('code' => 0);
        if (empty($where['Fuser_id']) || empty($where['Fid'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $res = $this->shop_dao->update($where, $data);
        if ($res) {
            return $ret;
        } else {
            $ret['code'] = 'posts_error_2';
            return $ret;
        }
    }

    public function getList($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fuser_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $this->load->model('dao/order_dao_model');
        $res = $this->shop_dao->getList($option);
        foreach ($res as &$v) {
            $where = array('Fproduct_id' => $v['Fproduct_id']);
            $product = $this->order_dao_model->getProductByPid($where);
            $v['Fproduct_name'] = $product['Fproduct_name'];
            $v['Fproduct_price'] = $product['Fproduct_price'];
            $v['Fcovarimage'] = $product['Fcoverimage'];
        }
        $ret['data'] = $res;
        return $ret;
    }
}