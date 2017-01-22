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
    private $_post_comments_table = 't_post_comments';
    private $_post_praise_table = 't_praise';
    private $_theme_table = 't_themes';
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
        $res = $query->result_array();
        return filterData($res);
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
        $res = $query->result_array();
        return filterData($res);
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

    public function getPostsByPids($where)
    {
        dbEscape($where);
        $query = $this->_news->select('Fid, Fpost_title, Fpost_coverimage, Fpost_excerpt')->where_in('Fid', $where)->order_by('Fupdate_time DESC')->get($this->_posts_table);
        $res = $query->result_array();
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
        $sql = 'SELECT Fid, Fpost_title, Fpost_author, Fupdate_time, Fpost_coverimage FROM '. $this->_posts_table . ' WHERE ' . $where_not_in . ' AND ( ' . $where .') ORDER BY Fupdate_time DESC LIMIT 5 ';
        $query = $this->_news->query($sql);
        $res = $query->result_array();
        return filterData($res);
    }

    public function submitComment($data)
    {
        dbEscape($data);
        return $this->_news->insert($this->_post_comments_table, $data);
    }

    public function getCommentListByPid($option)
    {
        dbEscape($option);
        $res = $this->_news->from($this->_post_comments_table)
            ->where($option)
            ->order_by('Fcomment_id', 'DESC')
            ->get()
            ->result_array();
        return filterData($res);
    }

    public function getPraiseCountByPid($option)
    {
        dbEscape($option);
        return $this->_news->from($this->_post_praise_table)
            ->where($option)
            ->count_all_results();
    }

    public function getIsPraise($option)
    {
        dbEscape($option);
        return $this->_news->from($this->_post_praise_table)
            ->where($option)
            ->count_all_results();
    }

    public function addPraise($option)
    {
        dbEscape($option);
        return $this->_news->insert($this->_post_praise_table, $option);
    }

    public function delPraise($option)
    {
        dbEscape($option);
        return $this->_news->delete($this->_post_praise_table, $option);
    }

    public function postsCommentNum($where, $like) {

        dbEscape($like);
        dbEscape($where);
        $count = $this->_news->select('count(*) as num')
            ->from($this->_post_comments_table)
            ->where($where)
            ->like($like)
            ->count_all_results();
        return $count;
    }

    public function postsCommentList($where, $like, $page, $page_size) {
        dbEscape($like);
        dbEscape($where);
        $query = $this->_news->select('c.*, p.Fpost_title')
            ->from($this->_post_comments_table . ' as c')
            ->join($this->_posts_table.' as p', 'c.Fcomment_post_id = p.Fid', 'left')
            ->where($where)
            ->like($like)
            ->order_by('Fcomment_id', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
        $res = $query->result_array();
        return filterData($res);
    }

    public function statusComment($data, $where)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->_news->update($this->_post_comments_table, $data, $where);
    }

    public function delComment($where)
    {
        dbEscape($where);
        return $this->_news->delete($this->_post_comments_table, $where);
    }

    public function postsPraiseNum($where, $like) {

        dbEscape($like);
        dbEscape($where);
        $count = $this->_news->select('count(*) as num')
            ->from($this->_post_praise_table . ' as pp')
            ->where($where)
            ->like($like)
            ->count_all_results();
        return $count;
    }

    public function postsPraiseList($where, $like, $page, $page_size) {
        dbEscape($like);
        dbEscape($where);
        $query = $this->_news->select('pp.*, p.Fpost_title')
            ->from($this->_post_praise_table . ' as pp')
            ->join($this->_posts_table.' as p', 'pp.Fpraise_post_id = p.Fid', 'left')
            ->where($where)
            ->like($like)
            ->order_by('pp.Fpraise_id', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
        $res = $query->result_array();
        return filterData($res);
    }

    public function getPraiseListByUid($where)
    {
        $res = $this->_news
            ->join($this->_posts_table .' as pp', 'pp.Fid = p.Fpraise_post_id', 'left')
            ->order_by('p.Fpraise_id DESC')
            ->get_where($this->_post_praise_table .' as p', $where)
            ->result_array();
        return filterData($res);
    }

    public function getCommentListByUid($where)
    {
        $res = $this->_news
            ->select('c.*, p.Fpost_title')
            ->join($this->_posts_table .' as p', 'p.Fid = c.Fcomment_post_id', 'left')
            ->order_by('c.Fcomment_id DESC')
            ->get_where($this->_post_comments_table .' as c', $where)->result_array();
        return filterData($res);
    }

    public function userDelComment($where)
    {
        dbEscape($where);
        return $this->_news->delete($this->_post_comments_table, $where);
    }

    public function search($where1, $where2)
    {
        $res = $this->_news->or_where($where1)->or_where($where2)->where('Fis_del = 0')->get($this->_posts_table)->result_array();
        return filterData($res);
    }

    public function addTheme($data)
    {
        dbEscape($data);
        return $this->_news->insert($this->_theme_table, $data);
    }


    public function getThemeByPid($where)
    {
        dbEscape($where);
        $query = $this->_news->get_where($this->_theme_table, $where);
        $res = $query->row_array();
        return filterData($res);
    }

    public function updateTheme($where, $data)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->_news->update($this->_theme_table, $data, $where);
    }

    public function delTheme($where)
    {
        dbEscape($where);
        return $this->_news->delete($this->_theme_table, $where);
    }

    public function changeThemeStatus($data, $where)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->_news->update($this->_theme_table, $data, $where);
    }

    public function themeNum() {
        $count = $this->_news->select('count(*) as num')
            ->from($this->_theme_table)
            ->count_all_results();
        return $count;
    }

    public function themeList($page, $page_size) {
        $query = $this->_news->select('*')
            ->from($this->_theme_table)
            ->order_by('Fupdate_time', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
        $res = $query->result_array();
        return filterData($res);
    }

    public function addThemePost($data, $where)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->_news->update($this->_theme_table, $data, $where);
    }

    public function getThemeList($where)
    {
        dbEscape($where);
        $res = $this->_news->order_by('Fupdate_time DESC')->get_where($this->_theme_table, $where)->result_array();
        return filterData($res);
    }

}