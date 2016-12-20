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
    private $p = null; // 产品库
    public function __construct()
    {
        parent::__construct();
        $this->p = $this->load->database('product', true);// 产品库
    }

    public function productNum($where, $like) {
        $count = $this->p->select('count(*) as num')
            ->from($this->_product_table)
            ->where($where)
            ->like($like)
            ->count_all_results();
        return $count;
    }

    public function productList($where, $like, $page, $page_size) {
        $query = $this->p->select('*')
                ->from($this->_product_table)
                ->where($where)
                ->like($like)
                ->order_by('Fproduct_id', 'DESC')
                ->limit($page_size, $page_size * ($page - 1))
                ->get();
        return $query->result_array();
    }

    public function add($data)
    {
        return $this->p->insert($this->_product_table, $data);
    }


    public function getProductInfoByFId($where)
    {
        $query = $this->p->get_where($this->_product_table, $where);
        return $query->row_array();
    }

    public function update($where, $data)
    {
        return $this->p->update($this->_product_table, $data, $where);
    }

    public function del($where)
    {
        return $this->p->delete($this->_product_table, $where);
    }

    public function changeStatus($data, $where)
    {
        return $this->p->update($this->_product_table, $data, $where);
    }

}