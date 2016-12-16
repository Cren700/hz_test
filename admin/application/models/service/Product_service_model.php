<?php

/**
 * Product_service_model.php
 * Author   : cren
 * Date     : 2016/11/30
 * Time     : 下午8:19
 */
class Product_service_model extends HZ_Model
{
    private $_api = 'product';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function query($data)
    {
        return $this->myCurl($this->_api, 'queryProduct', $data, false);
    }


    public function getProductByPid($data)
    {
        return $this->myCurl($this->_api, 'getProductByPid', $data, false);
    }

    public function status($data)
    {
        return $this->myCurl($this->_api, 'changeStatus', $data, true);
    }

    public function save($data)
    {
        $is_new = $data['is_new'];
        unset($data['is_new']);
        if ($is_new) {
            $res = $this->myCurl($this->_api, 'addProduct', $data, true);
        } else {
            $res = $this->myCurl($this->_api, 'updateProduct', $data, true);
        }
        if ($res['code'] === 0) {
            $res['data']['url'] = getBaseUrl('/product.html');
        }
        return $res;
    }

    public function del($data)
    {
        return $this->myCurl($this->_api, 'delProduct', $data, false);
    }



    public function category()
    {
        return $this->myCurl($this->_api, 'category', array());
    }


    public function getCategory($data)
    {
        return $this->myCurl($this->_api, 'getCategory', $data, false);
    }

    public function saveCate($data)
    {
        $is_new = $data['is_new'];
        unset($data['is_new']);
        if ($is_new) {
            return $this->myCurl($this->_api, 'addCategory', $data, true);
        } else {
            return $this->myCurl($this->_api, 'updateCategory', $data, true);
        }
    }

    public function delCate($data)
    {
        return $this->myCurl($this->_api, 'delCategory', $data, false);
    }
}