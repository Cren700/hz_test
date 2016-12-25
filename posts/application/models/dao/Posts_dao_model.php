<?php

/**
 * Posts_dao_model.php
 * Author   : cren
 * Date     : 2016/11/28
 * Time     : 下午11:44
 */
class Posts_dao_model extends HZ_Model
{
    private $_posts_table = 't_posts';
    private $_news = null; // 资讯库
    public function __construct()
    {
        parent::__construct();
        $this->_news = $this->load->database('news', true);// 产品库
    }

    public function postsNum($where, $like) {

        dbEscape($like);
        dbEscape($where);
        $count = $this->_news->select('count(*) as num')
            ->from($this->_posts_table)
            ->where($where)
            ->like($like)
            ->count_all_results();
        return $count;
    }

    public function postsList($where, $like, $page, $page_size) {
        dbEscape($like);
        dbEscape($where);
        $query = $this->_news->select('*')
            ->from($this->_posts_table)
            ->where($where)
            ->like($like)
            ->order_by('Fupdate_time', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
        return $query->result_array();
    }


    public function postsNumByCate($where) {
        dbEscape($where);
        $count = $this->_news->select('count(*) as num')
            ->from($this->_posts_table)
            ->where(array('Fpost_status' => 3))
            ->where_in('Fpost_category_id', $where)
            ->count_all_results();
        return $count;
    }

    public function postsListByCate($where, $page, $page_size) {
        dbEscape($where);
        $query = $this->_news->select('*')
            ->from($this->_posts_table)
            ->where(array('Fpost_status' => 3))
            ->where_in('Fpost_category_id', $where)
            ->order_by('Fupdate_time', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
        return $query->result_array();
    }

    public function add($data)
    {
        dbEscape($data);
        return $this->_news->insert($this->_posts_table, $data);
    }


    public function getPostsByPid($where)
    {
        dbEscape($where);
        $query = $this->_news->get_where($this->_posts_table, $where);
        $res = $query->row_array();
        return filterData($res);
    }

    public function update($where, $data)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->_news->update($this->_posts_table, $data, $where);
    }

    public function del($where)
    {
        dbEscape($where);
        return $this->_news->delete($this->_posts_table, $where);
    }

    public function changeStatus($data, $where)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->_news->update($this->_posts_table, $data, $where);
    }

    public function relatedPosts($where, $where_not_in)
    {
        dbEscape($where);
        $sql = 'SELECT Fid, Fpost_title, Fpost_author, Fupdate_time, Fpost_coverimage FROM '. $this->_posts_table . ' WHERE ' . $where_not_in . ' AND ( ' . $where .') ORDER BY Fupdate_time DESC LIMIT 5 ';
        $query = $this->_news->query($sql);
        $res = $query->result_array();
        return filterData($res);

    }


}