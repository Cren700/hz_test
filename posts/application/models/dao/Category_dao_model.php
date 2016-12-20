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
        $query = $this->_news->get_where($this->_cate_table, $where);
        return $query->result_array();
    }

    public function getCategory($where)
    {
        $query = $this->_news->get_where($this->_cate_table, $where);
        return $query->row_array();
    }

    public function getCateInfoByCateId($cate_id)
    {
        $where = array('Fpost_category_id' => $cate_id);
        $query = $this->_news->get_where($this->_cate_table, $where);
        return $query->row_array();
    }

    public function add($data)
    {
        return $this->_news->insert($this->_cate_table, $data);
    }

    public function del($where)
    {
        return $this->_news->delete($this->_cate_table, $where);
    }

    public function update($where, $data)
    {
        return $this->_news->update($this->_cate_table, $data, $where);
    }
}