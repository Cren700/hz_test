<?php

/**
 * Info_dao_model.php
 * Author   : cren
 * Date     : 2016/12/12
 * Time     : 下午10:24
 */
class Info_dao_model extends HZ_Model
{
    private $u = null;
    private $_tabel_user = 't_user';
    private $_tabel_user_detail = 't_user_detail';
    public function __construct()
    {
        parent::__construct();
        $this->u = $this->load->database('default', true);// 用户库
    }

    /**
     * 查询对应的用户数量
     * @param $where
     * @param $like
     * @return int
     */
    public function userCounts($where, $like) {
        $where = dbEscape($where); // 转义输入数据
        $count = $this->u->select('count(*) as num')
                ->from($this->_tabel_user . ' as u')
                ->where($where)
                ->like($like)
                ->count_all_results();
        return $count;
    }

    public function userList($where, $like, $page, $page_size) {
        $where = dbEscape($where); // 转义输入数据
        $query = $this->u->select('u.Fid, u.Fuser_id, u.Fcreate_time, u.Fstatus, ud.Fatte_status, ud.Fnick_name, ud.Freal_name')
            ->from($this->_tabel_user . ' as u')
            ->join($this->_tabel_user_detail . ' as ud', 'u.Fid = ud.Fuser_id', 'left')
            ->where($where)
            ->like($like)
            ->order_by('u.Fid', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
         return $query->result_array();
    }
}