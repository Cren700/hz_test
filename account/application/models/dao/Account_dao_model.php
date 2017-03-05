<?php

/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/7/9
 * Time: 下午2:47
 */
class Account_dao_model extends HZ_Model
{
    private $_user_table = 't_user';
    private $_admin_table = 't_admin';
    private $_user_detail_table = 't_user_detail';
    private $_admin_detail_table = 't_admin_detail';
    private $_sms_send = 't_sms_send';
    private $_verify_code = 't_verify_code';
    private $account;// 默认为用户库
    private $common;// 配置库
    public function __construct()
    {
        parent::__construct();
        $this->account = $this->load->database('default', true);
        $this->common = $this->load->database('common', true);
    }

    /**
     * 添加账号
     * @param $data
     * @return mixed
     */
    public function addAccount($data, $type = 'user')
    {
        dbEscape($data);
        $table = $type === 'admin' ? $this->_admin_table : $this->_user_table;
        $this->account->insert($table, $data);
        return $this->account->insert_id();
    }

    public function modifyPwd($where, $data, $type = 'user')
    {
        dbEscape($data);
        dbEscape($where);
        return $this->account->update($this->_sel_table($type), $data, $where);
    }

    public function addDetail($data)
    {
        dbEscape($data);
        return $this->account->insert($this->_user_detail_table, $data);
    }

    public function modifyDetail($where, $data)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->account->update($this->_user_detail_table, $data, $where);
    }

    public function addAdminDetail($data)
    {
        dbEscape($data);
        return $this->account->insert($this->_admin_detail_table, $data);
    }

    public function modifyAdminDetail($where, $data)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->account->update($this->_admin_detail_table, $data, $where);
    }

    /**
     * 账户基础信息
     * @param array $where
     * @param string $type
     * @return mixed
     */
    public function getInfoByOp($where, $type = 'user')
    {
        dbEscape($where);
        $query = $this->account->get_where($this->_sel_table($type), $where, 1);
        $res = $query->row_array();
        return filterData($res);
    }

    /**
     * 账户详细信息
     * @param $where
     * @param string $type
     * @return mixed
     */
    public function getDetailByOp($where, $type = 'user')
    {
        dbEscape($where);
        $query = $this->account->get_where($this->_sel_detail_table($type), $where);
        $res = $query->row_array();
        return filterData($res);
    }

    public function getAccountTotalInfo($where, $type = 'user')
    {
        $user_type = $type === 'user' ? 1 : 0;
        $select = 't1.Fid as Fid, t1.Fuser_id, '.$user_type.' as t1.Fuser_type=, t1.Fstatus, t2.Freal_name, t2.Fatte_status, t2.Fimage_path';
        dbEscape($where);
        $res = $this->account->select($select)
            ->from($this->_sel_table($type) . ' as t1')
            ->join($this->_sel_detail_table($type) . ' as t2', 't1.Fid = t2.Fuser_id', 'left')
            ->where($where)
            ->get()
            ->row_array();
        return $res;
    }

    /**
     * 用户基本信息
     * @param $where
     * @return mixed
     */
    public function getUserBaseInfoByFid($where)
    {
        dbEscape($where);
        $res = $this->account->select('Fid, Fuser_id, Fuser_type, Flog_type, Fis_blackuser, Fstatus, Fcreate_time, Fupdate_time, Fremark, Frecommend_uid')
            ->get_where($this->_user_table, $where)
            ->row_array();
        return filterData($res);
    }

    public function getUserDetailByWhere($data)
    {
        dbEscape($data);
        $query = $this->account->get_where($this->_user_table, $data);
        $res = $query->row_array();
        return filterData($res);
    }

    public function getAdminInfo($where)
    {
        dbEscape($where);
        $query = $this->account->get_where($this->_admin_table, $where);
        $res = $query->row_array();
        return filterData($res);
    }

    private function _sel_table($type)
    {
        return $type === 'admin' ? $this->_admin_table : $this->_user_table;
    }

    private function _sel_detail_table($type)
    {
        return $type === 'admin' ? $this->_admin_detail_table: $this->_user_detail_table;
    }

    public function saveVerifySms($option)
    {
        dbEscape($option);
        return $this->common->insert($this->_sms_send, $option);
    }

    public function saveVerifyCode($option)
    {
        dbEscape($option);
        return $this->common->insert($this->_verify_code, $option);
    }

    public function modifyHdImg($data, $where)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->account->update($this->_user_detail_table, $data, $where);
    }

    public function checkVerifyCode($where)
    {
        dbEscape($where);
        $res = $this->common->get_where($this->_verify_code, $where)->row_array();
        if ($res) {
            $u_where = array('Fverifycode_id' => $res['Fverifycode_id']);
            $u_data = array('Fstatus' => 0);
            $res = $this->common->update($this->_verify_code, $u_data, $u_where);
        }
        return $res;
    }

    public function hasMediumPower($option)
    {
        dbEscape($option);
        $res = $this->account->select("*")
                    ->from($this->_user_table . ' as u ')
                    ->join($this->_user_detail_table . ' as ud', 'ud.Fuser_id = '.$option['Fuser_id'])
                    ->where('u.Fuser_type = 3 and ud.Fatte_status = 1 and u.Fid = ' . $option['Fid'])
                    ->get()
                    ->row_array();
        return $res;
    }

    public function hasStorePower($option)
    {
        dbEscape($option);
        $res = $this->account->select("*")
            ->from($this->_user_table . ' as u ')
            ->join($this->_user_detail_table . ' as ud', 'ud.Fuser_id = '.$option['Fuser_id'])
            ->where('u.Fuser_type = 2 and ud.Fatte_status = 1 and u.Fid = ' . $option['Fid'])
            ->get()
            ->row_array();
        return $res;
    }

    public function adminAction()
    {
        $res = $this->account->get('t_admin_action')->result_array();
        return $res;
    }

    public function role()
    {
        $res = $this->account->get('t_admin_role')->result_array();
        return $res;
    }

    public function addRole($option)
    {
        $res = $this->account->insert('t_admin_role', $option);
        return $res;
    }

    public function saveRole($where, $option)
    {
        $this->account->update('t_admin_role', $option, $where);
    }

    public function getRole($where)
    {
        return $this->account->get_where('t_admin_role', $where)->row_array();
    }

    public function getActions($ids)
    {
        return $this->account->where_in('Fid', $ids)->get('t_admin_action')->result_array();
    }

    public function adminCounts($where, $like) {
        dbEscape($like);
        dbEscape($where);
        $count = $this->account->select('count(*) as num')
            ->from($this->_admin_table . ' as u')
            ->where($where)
            ->like($like)
            ->count_all_results();
        return $count;
    }

    public function adminList($where, $like, $page, $page_size) {
        dbEscape($like);
        dbEscape($where);
        $query = $this->account->select('u.Fid, u.Fuser_id, u.Frole_id, u.Fcreate_time, u.Fupdate_time, u.Fstatus, r.Frole_name')
            ->from($this->_admin_table . ' as u')
            ->join('t_admin_role as r', 'u.Frole_id = r.Frole_id')
            ->where($where)
            ->like($like)
            ->order_by('u.Fupdate_time', 'DESC')
            ->limit($page_size, $page_size * ($page - 1))
            ->get();
        $res = $query->result_array();
        return filterData($res);
    }

    public function updateAdmin($where, $data)
    {
        return $this->account->update($this->_admin_table, $data, $where);
    }

    public function powerUrl($where)
    {
        dbEscape($where);
        $action_ids = $this->account->get_where('t_admin_role', $where)->row_array();
        $actionWhere = explode(',', $action_ids['Faction_ids']);
        $res = $this->account->where_in('Fid', $actionWhere)->get('t_admin_action')->result_array();

        return filterData($res);
    }
}