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
        $count = $this->_news->select('count(*) as num')
            ->from($this->_posts_table)
            ->where($where)
            ->like($like)
            ->count_all_results();
        return $count;
    }

    public function postsList($where, $like, $page, $page_size) {
        $query = $this->_news->select('*')
            ->from($this->_posts_table)
            ->where($where)
            ->like($like)
            ->order_by('Fupdate_time', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
        return $query->result_array();
    }

    public function add($data)
    {
        return $this->_news->insert($this->_posts_table, $data);
    }


    public function getPostsByPid($where)
    {
        $query = $this->_news->get_where($this->_posts_table, $where);
        return $query->row_array();
    }

    public function update($where, $data)
    {
        return $this->_news->update($this->_posts_table, $data, $where);
    }

    public function del($where)
    {
        return $this->_news->delete($this->_posts_table, $where);
    }

    public function changeStatus($data, $where)
    {
        return $this->_news->update($this->_posts_table, $data, $where);
    }

    public function relatedPosts($like, $where)
    {
        $this->_news->select('Fid')
            ->from($this->_posts_table)
            ->where($where);
        foreach($like as $l)
        {
            $this->_news->or_like($l);
        }
        $query = $this->_news->order_by('Fupdate_time', 'DESC')
            ->limit(5)
            ->get();
        echo $this->_news->last_query();die;
        return $query->result_array();

    }


}