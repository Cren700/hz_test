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
    private $_tabel_blackUser = 't_blackuser_list';
    private $_account_table = 't_account';
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
        dbEscape($like);
        dbEscape($where);
        $count = $this->u->select('count(*) as num')
                ->from($this->_tabel_user . ' as u')
                ->where($where)
                ->like($like)
                ->count_all_results();
        return $count;
    }

    public function userList($where, $like, $page, $page_size) {
        dbEscape($like);
        dbEscape($where);
        $query = $this->u->select('u.Fid, u.Fuser_id, u.Fuser_type, u.Fcreate_time, u.Fstatus, ud.Fatte_status, ud.Fnick_name, ud.Freal_name')
            ->from($this->_tabel_user . ' as u')
            ->join($this->_tabel_user_detail . ' as ud', 'u.Fid = ud.Fuser_id', 'left')
            ->where($where)
            ->like($like)
            ->order_by('u.Fid', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
         $res = $query->result_array();
        return filterData($res);
    }

    public function getInfo($where)
    {
        dbEscape($where);
        $query = $this->u->select('u.Fid, u.Fuser_id, u.Fcreate_time, u.Fstatus, ud.*')
            ->from($this->_tabel_user . ' as u')
            ->join($this->_tabel_user_detail . ' as ud', 'u.Fid = ud.Fuser_id', 'left')
            ->where($where)
            ->get();
        $res = $query->row_array();
        return filterData($res);
    }

    public function changeUserStatus($where, $data)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->u->update($this->_tabel_user, $data, $where);
    }

    public function changeUserAtteStatus($where, $data)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->u->update($this->_tabel_user_detail, $data, $where);
    }

    public function addBlackUser($data)
    {
        dbEscape($data);
        return $this->u->insert($this->_tabel_blackUser, $data);
    }

    public function getBlackUsrByUid($where)
    {
        dbEscape($where);
        $query = $this->u->get_where($this->_tabel_blackUser, $where);
        $res = $query->row_array();
        return filterData($res);
    }

    public function blackUserCounts($where, $like) {
        dbEscape($like);
        dbEscape($where);
        $count = $this->u->select('count(*) as num')
            ->from($this->_tabel_user . ' as u')
            ->where($where)
            ->like($like)
            ->count_all_results();
        return $count;
    }

    public function blackUserList($where, $like, $page, $page_size) {
        dbEscape($like);
        dbEscape($where);
        $query = $this->u->select('u.Fid, u.Fuser_id, u.Fuser_type, u.Fcreate_time, u.Fstatus, ud.Fatte_status, ud.Fnick_name, ud.Freal_name, b.Fcreate_time as bFcreate_time')
            ->from($this->_tabel_user . ' as u')
            ->join($this->_tabel_user_detail . ' as ud', 'u.Fid = ud.Fuser_id', 'left')
            ->join($this->_tabel_blackUser . ' as b', 'u.Fid = b.Fid', 'left')
            ->where($where)
            ->like($like)
            ->order_by('u.Fid', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
        $res = $query->result_array();
        return filterData($res);
    }

    public function capitalAccountCounts($where, $like) {
        dbEscape($like);
        dbEscape($where);
        $count = $this->u->select('count(*) as num')
            ->from($this->_account_table .' as a')
            ->join($this->_tabel_user . ' as u', 'u.Fuser_id = a.Fuser_id', 'left')
            ->where($where)
            ->like($like)
            ->count_all_results();
        return $count;
    }

    public function capitalAccountList($where, $like, $page, $page_size) {
        dbEscape($like);
        dbEscape($where);
        $query = $this->u->select('a.*, u.Fuser_type')
            ->from($this->_account_table .' as a')
            ->join($this->_tabel_user . ' as u', 'u.Fuser_id = a.Fuser_id', 'left')
            ->where($where)
            ->like($like)
            ->order_by('u.Fid', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
        $res = $query->result_array();
        return filterData($res);
    }

    public function getUserCenter($where)
    {
        dbEscape($where);
        $res = $this->u->get_where($this->_account_table, $where)
            ->row_array();
//        echo $this->u->last_query();die;
        return filterData($res);
    }

    public function addCenterInfo($data)
    {
        $this->u->insert($this->_account_table, $data);
    }

    public function updateCenterCnt($where, $data)
    {
        $this->u->where($where);
        if ($data['Famount']) {
            $this->u->set('Famount', 'Famount + ' . $data['Famount'], FALSE);
        }
        if ($data['Fintegral']) {
            $this->u->set('Fintegral', 'Fintegral + ' . $data['Fintegral'], FALSE);
        }
        $this->u->set('Fupdate_time', time(), FALSE);
        $this->u->update($this->_account_table);
    }
}