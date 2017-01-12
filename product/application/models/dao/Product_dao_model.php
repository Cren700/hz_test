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
    private $_favourite_article_table = 't_favourite_article';

    private $p = null; // 产品库
    public function __construct()
    {
        parent::__construct();
        $this->p = $this->load->database('product', true);// 产品库
    }

    public function productNum($where, $like, $where_in) {
        dbEscape($like);
        dbEscape($where);
        $this->p->select('count(*) as num')->from($this->_product_table)->where($where);
        !empty($where_in) ? $this->p->where_in('Fproduct_status', $where_in) : '';
        $count = $this->p->like($like)->count_all_results();
        return $count;
    }

    public function productList($where, $like, $where_in, $page, $page_size) {
        dbEscape($where);
        dbEscape($like);
        $this->p->select('*')
                ->from($this->_product_table)
                ->where($where);
        !empty($where_in) ? $this->p->where_in('Fproduct_status', $where_in) : '';
        $query = $this->p->like($like)
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

    public function collect($data)
    {
        dbEscape($data);
        return $this->p->insert($this->_favourite_article_table, $data);
    }

    public function is_collect($where)
    {
        dbEscape($where);
        return $this->p->get_where($this->_favourite_article_table, $where)->row_array();
    }

    public function cancelCollect($where){
        return $this->p->delete($this->_favourite_article_table, $where);
    }

    public function postsCollectNum($where, $like) {

        dbEscape($like);
        dbEscape($where);
        $count = $this->p->select('count(*) as num')
            ->from($this->_favourite_article_table . ' as f')
            ->where($where)
            ->like($like)
            ->count_all_results();
        return $count;
    }

    public function postsCollectList($where, $like, $page, $page_size) {
        dbEscape($like);
        dbEscape($where);
        $query = $this->p->select('f.*, p.Fproduct_name')
            ->from($this->_favourite_article_table . ' as f')
            ->join($this->_product_table.' as p', 'f.Fproduct_id = p.Fproduct_id', 'left')
            ->where($where)
            ->like($like)
            ->order_by('f.Fid', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
        $res = $query->result_array();
        return filterData($res);
    }

    public function getCollectListByUid($where)
    {
        $res = $this->p->select('f.*, p.Fproduct_name, p.Fproduct_price, p.Fcoverimage, p.Fdescription, p.Fclaims_num, p.Fturnover')
            ->from($this->_favourite_article_table . ' as f')
            ->join($this->_product_table.' as p', 'f.Fproduct_id = p.Fproduct_id', 'left')
            ->where($where)
            ->order_by('f.Fid', 'DESC')
            ->get()
            ->result_array();
        return filterData($res);
    }

    public function search($where)
    {
        $res = $this->p->where($where)->order_by('Fproduct_id DESC')->get($this->_product_table)->result_array();
        return filterData($res);
    }
}