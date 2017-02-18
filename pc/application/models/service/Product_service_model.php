<?php

/**
 * Product_service_model.php
 * Author   : cren
 * Date     : 2016/12/25
 * Time     : 下午1:08
 */
class Product_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCate()
    {
        return $this->myCurl('product', 'category', array());
    }

    public function detail($id)
    {
        $where = array('product_id' => $id);
        return $this->myCurl('product', 'getProductByPid', $where);
    }

    public function getProductList($option)
    {
        return $this->myCurl('product', 'queryProduct', $option);
    }

    public function search($where)
    {
        return $this->myCurl('product', 'search', $where);
    }

    /**
     * 收藏产品列表
     */
    public function collectList($option)
    {
        return $this->myCurl('product', 'getCollectListByUid', $option);
    }
}