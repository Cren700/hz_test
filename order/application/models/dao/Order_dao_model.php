<?php

/**
 * Order_dao_model.php
 * Author   : cren
 * Date     : 2016/12/26
 * Time     : 下午11:46
 */
class Order_dao_model extends HZ_Model
{

    private $_product_table = 't_product';
    private $_order_table = 't_order';
    private $_cart_table = 't_mycart';
    private $_withdraw_table = 't_withdraw_order';
    private $_claim_table = 't_claims';
    private $p_db = null; // 产品库
    private $o_db = null; // order库
    public function __construct()
    {
        parent::__construct();
        $this->o_db = $this->load->database('order', true);// order库
    }

    public function getProductByPid($where)
    {
        $this->p_db = $this->load->database('product', true);// 产品库
        dbEscape($where);
        $res = $this->p_db->get_where($this->_product_table, $where)->row_array();

        return filterData($res);
    }

    // 更新产品库存
    public function updateProductNum($where, $num)
    {
        dbEscape($where);
        $this->p_db->where($where)
            ->set('Fproduct_num', 'Fproduct_num-'.$num, FALSE)
            ->update($this->_product_table);
    }

    public function create($data)
    {
        dbEscape($data);
        return $this->o_db->insert($this->_order_table, $data);
    }

    public function orderNum($where, $like) {
        dbEscape($like);
        dbEscape($where);
        $count = $this->o_db->select('count(*) as num')
            ->from($this->_order_table)
            ->where($where)
            ->like($like)
            ->count_all_results();
        return $count;
    }

    public function orderList($where, $like, $page, $page_size) {
        dbEscape($like);
        dbEscape($where);
        $query = $this->o_db->select('*')
            ->from($this->_order_table)
            ->where($where)
            ->like($like)
            ->order_by('Fupdate_time', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
        $res = $query->result_array();
        return filterData($res);
    }

    public function getCartInfo($where)
    {
        $res = $this->o_db->select('*')->get_where($this->_cart_table, $where)->row_array();
        return filterData($res);
    }

    public function orderStatus($where, $data)
    {
        return $this->o_db->update($this->_order_table, $data, $where);
    }

    public function getOderListByUid($where)
    {
        $res = $this->o_db->select('*')->get_where($this->_order_table, $where)->result_array();
        return filterData($res);
    }
    
    public function txOrderNum($where, $like) {
        dbEscape($like);
        dbEscape($where);
        $count = $this->o_db->select('count(*) as num')
            ->from($this->_withdraw_table)
            ->where($where)
            ->like($like)
            ->count_all_results();
        return $count;
    }

    public function txOrderList($where, $like, $page, $page_size) {
        dbEscape($like);
        dbEscape($where);
        $query = $this->o_db->select('*')
            ->from($this->_withdraw_table)
            ->where($where)
            ->like($like)
            ->order_by('Fcreate_time', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
        $res = $query->result_array();
        return filterData($res);
    }

    public function txOrderStatus($where, $data)
    {
        return $this->o_db->update($this->_withdraw_table, $data, $where);
    }

    public function claimOrderNum($where, $like) {
        dbEscape($like);
        dbEscape($where);
        $count = $this->o_db->select('count(*) as num')
            ->from($this->_claim_table)
            ->where($where)
            ->like($like)
            ->count_all_results();
        return $count;
    }

    public function claimOrderList($where, $like, $page, $page_size) {
        dbEscape($like);
        dbEscape($where);
        $query = $this->o_db->select('*')
            ->from($this->_claim_table)
            ->where($where)
            ->like($like)
            ->order_by('Fcreate_time', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
        $res = $query->result_array();
        return filterData($res);
    }

    public function claimOrderStatus($where, $data)
    {
        return $this->o_db->update($this->_claim_table, $data, $where);
    }

    public function queryPayOrderStat($option)
    {
        $data = array();
        $order = $this->o_db->select('count(DISTINCT Fuser_id) as num, sum(Fproduct_tol_amt) as total, count(*) as c')->from($this->_order_table)->where($option)->get()->row_array();
//        $order_total = $this->o_db->select('sum(Fproduct_tol_amt) as total, Forder_status')->from($this->_order_table)->where($option)->group_by('Forder_status')->get()->result_array();
//        $order_total = $this->o_db->select('sum(Fproduct_tol_amt) as total')->from($this->_order_table)->where($option)->get()->row_array();
//        $order_count = $this->o_db->select('count(*) as c')->from($this->_order_table)->where($option)->get()->row_array();
//        $_tmp = array();
//        foreach($order_total as $o) {
//            $_tmp[$o['Forder_status']] = $o['total'];
//        }
        $data['order_num'] = empty($order['num']) ? 0 : $order['num'];
        $data['order_total'] = empty($order['total']) ? 0 : $order['total'];
        $data['order_count'] = empty($order['c']) ? 0 : $order['c'];
        return $data;
    }
    
    public function queryTxOrderStat($option)
    {
        $data = array();
        $order = $this->o_db->select('count(DISTINCT Fuser_id) as num, sum(Famount) as total, count(*) as c')->from($this->_withdraw_table)->where($option)->get()->row_array();
        $data['order_num'] = empty($order['num']) ? 0 : $order['num'];
        $data['order_total'] = empty($order['total']) ? 0 : $order['total'];
        $data['order_count'] = empty($order['c']) ? 0 : $order['c'];
        return $data;
    }
    
    public function queryClaimOrderStat($option)
    {
        $data = array();
        $order = $this->o_db->select('count(DISTINCT Fuser_id) as num, sum(Famount) as total, count(*) as c')->from($this->_claim_table)->where($option)->get()->row_array();
        $data['order_num'] = empty($order['num']) ? 0 : $order['num'];
        $data['order_total'] = empty($order['total']) ? 0 : $order['total'];
        $data['order_count'] = empty($order['c']) ? 0 : $order['c'];
        return $data;
    }

    public function querySaleStatNum($where) {
        dbEscape($where);
        $count = $this->o_db->select('count(*) as num')
            ->from($this->_order_table)
            ->where($where)
            ->group_by('Fproduct_id')
            ->count_all_results();
        return $count;
    }

    public function querySaleStatList($where, $page, $page_size) {
        dbEscape($where);
        $query = $this->o_db->select('Fproduct_id, count(Fproduct_id) as num, sum(Fproduct_tol_amt) as total')
            ->from($this->_order_table)
            ->where($where)
            ->group_by('Fproduct_id')
            ->order_by('num', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
        $res = $query->result_array();
        return filterData($res);
    }


}