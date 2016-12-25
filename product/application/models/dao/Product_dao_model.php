<?php

/**
 * Product_dao_model.php
 * Author   : cren
 * Date     : 2016/11/28
 * Time     : 下午11:44
 */
class Product_dao_model extends HZ_Model
{
    private $_product_table = 't_product';
    private $_product_detail_table = 't_product_detail';

    private $p = null; // 产品库
    public function __construct()
    {
        parent::__construct();
        $this->p = $this->load->database('product', true);// 产品库
    }

    public function productNum($where, $like, $where_in) {
        dbEscape($like);
        dbEscape($where);
        $count = $this->p->select('count(*) as num')
            ->from($this->_product_table)
            ->where($where)
            ->where_in('Fproduct_status', $where_in)
            ->like($like)
            ->count_all_results();
        return $count;
    }

    public function productList($where, $like, $where_in, $page, $page_size) {
        dbEscape($where);
        dbEscape($like);
        $query = $this->p->select('*')
                ->from($this->_product_table)
                ->where($where)
                ->where_in('Fproduct_status', $where_in)
                ->like($like)
                ->order_by('Fproduct_id', 'DESC')
                ->limit($page_size, $page_size * ($page - 1))
                ->get();
        $res = $query->result_array();
        return filterData($res);
    }

    // 添加产品基础信息
    public function add($data)
    {
        dbEscape($data);
        $this->p->insert($this->_product_table, $data);
        return $this->p->insert_id();
    }

    // 添加产品详情信息
    public function addDetail($data)
    {
        dbEscape($data);
        return $this->p->insert($this->_product_detail_table, $data);
    }


    public function getProductInfoByFId($where)
    {
        dbEscape($where);
        $query = $this->p->get_where($this->_product_table, $where);
        $res = $query->row_array();
        return filterData($res);
    }

    public function getProductDetailByFId($where)
    {
        dbEscape($where);
        $query = $this->p->get_where($this->_product_detail_table, $where);
        $res =  $query->row_array();
        return filterData($res);
    }

    public function update($where, $data)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->p->update($this->_product_table, $data, $where);
    }

    public function updateDetail($where, $data)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->p->update($this->_product_detail_table, $data, $where);
    }

    public function del($where)
    {
        dbEscape($where);
        return $this->p->delete($this->_product_table, $where);
    }

    public function changeStatus($data, $where)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->p->update($this->_product_table, $data, $where);
    }

}