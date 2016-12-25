<?php

/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/7/9
 * Time: 下午2:47
 */
class Category_dao_model extends HZ_Model
{
    private $_cate_table = 't_category';
    private $p = null; // 产品库
    public function __construct()
    {
        parent::__construct();
        $this->p = $this->load->database('product', true);// 产品库
    }

    public function lists()
    {
        $query = $this->p->get_where($this->_cate_table);
        $res = $query->result_array();
        return filterData($res);
    }

    public function getCategory($where)
    {
        dbEscape($where);
        $query = $this->p->get_where($this->_cate_table, $where);
        $res = $query->row_array();
        return filterData($res);
    }

    public function getCateInfoByCateId($cate_id)
    {
        $where = array('Fcategory_id' => $cate_id);
        dbEscape($where);
        $query = $this->p->get_where($this->_cate_table, $where);
        $res = $query->row_array();
        return filterData($res);
    }

    public function add($data)
    {
        dbEscape($data);
        return $this->p->insert($this->_cate_table, $data);
    }

    public function del($where)
    {
        dbEscape($where);
        return $this->p->delete($this->_cate_table, $where);
    }

    public function update($where, $data)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->p->update($this->_cate_table, $data, $where);
    }
}