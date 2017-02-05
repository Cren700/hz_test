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

    /**
     * 用户基本信息
     * @param $where
     * @return mixed
     */
    public function getUserBaseInfoByFid($where)
    {
        dbEscape($where);
        $res = $this->account->get_where($this->_user_table, $where)->row_array();
        return filterData($res);
    }

    public function getUserDetailByFuserId($data)
    {
        dbEscape($data);
        $query = $this->account->get_where($this->_user_table, $data);
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
}