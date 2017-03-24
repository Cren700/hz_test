<?php

/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/7/9
 * Time: 下午2:47
 */
class Category_dao_model extends HZ_Model
{
    private $_cate_table = 't_posts_category';
    private $_news = null; // 资讯库
    public function __construct()
    {
        parent::__construct();
        $this->_news = $this->load->database('news', true);// 产品库
    }

    public function lists($where)
    {
        dbEscape($where);
        $query = $this->_news->order_by('Fpriority', 'ASC')->get_where($this->_cate_table, $where);
        $res = $query->result_array();
        return filterData($res);

    }

    public function getCategory($where)
    {
        dbEscape($where);
        $query = $this->_news->get_where($this->_cate_table, $where);
        $res = $query->row_array();
        return filterData($res);
    }

    public function getCateInfoByCateId($cate_id)
    {
        $where = array('Fpost_category_id' => $cate_id);
        dbEscape($where);
        $query = $this->_news->get_where($this->_cate_table, $where);
        $res = $query->row_array();
        return filterData($res);
    }

    public function add($data)
    {
        dbEscape($data);
        return $this->_news->insert($this->_cate_table, $data);
    }

    public function del($where)
    {
        dbEscape($where);
        return $this->_news->delete($this->_cate_table, $where);
    }

    public function update($where, $data)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->_news->update($this->_cate_table, $data, $where);
    }
}