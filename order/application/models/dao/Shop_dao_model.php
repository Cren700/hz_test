<?php

/**
 * Shop_dao_model.php
 * Author   : cren
 * Date     : 2016/12/26
 * Time     : 下午10:16
 */
class Shop_dao_model extends HZ_Model
{
    private $_cart_table = 't_mycart';
    private $o_db = null; // order库
    public function __construct()
    {
        parent::__construct();
        $this->o_db = $this->load->database('order', true);// order库
    }

    public function join($option)
    {
        dbEscape($option);
        return $this->o_db->insert($this->_cart_table, $option);
    }

    public function remove($option)
    {
        dbEscape($option);
        return $this->o_db->delete($this->_cart_table, $option);
    }

    public function update($where, $data)
    {
        dbEscape($where);
        dbEscape($data);
        return $this->o_db->update($this->_cart_table, $data, $where);
    }

    public function in_cart($option)
    {
        dbEscape($option);
        $res = $this->o_db->get_where($this->_cart_table, $option)->row_array();
        return filterData($res);
    }

    public function getList($option)
    {
        dbEscape($option);
        $res = $this->o_db->get_where($this->_cart_table, $option)->result_array();
        return filterData($res);
    }
}