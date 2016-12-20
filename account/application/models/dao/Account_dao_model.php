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
    private $account ;
    public function __construct()
    {
        parent::__construct();
        $this->account = $this->load->database('default', true);// 默认为用户库
    }

    /**
     * 添加管理员账号
     * @param $data
     * @return mixed
     */
    public function addAccount($data, $type = 'user')
    {
        $table = $type === 'admin' ? $this->_admin_table : $this->_user_table;
        return $this->account->insert($table, $data);
    }

    public function modifyPwd($where, $data, $type = 'user')
    {
        return $this->account->update($this->_sel_table($type), $data, $where);
    }

    public function addDetail($data)
    {
        return $this->account->insert($this->_user_detail_table, $data);
    }

    public function modifyDetail($where, $data)
    {
        return $this->account->update($this->_user_detail_table, $data, $where);
    }

    public function addAdminDetail($data)
    {
        return $this->account->insert($this->_admin_detail_table, $data);
    }

    public function modifyAdminDetail($where, $data)
    {
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
        $query = $this->account->get_where($this->_sel_table($type), $where, 1);
        return $query->row_array();
    }

    /**
     * 账户详细信息
     * @param $array
     * @param string $type
     * @return mixed
     */
    public function getDetailByOp($array, $type = 'user')
    {
        $query = $this->account->get_where($this->_sel_detail_table($type), $array);
        return $query->row_array();
    }

    private function _sel_table($type)
    {
        return $type === 'admin' ? $this->_admin_table : $this->_user_table;
    }

    private function _sel_detail_table($type)
    {
        return $type === 'admin' ? $this->_admin_detail_table: $this->_user_detail_table;
    }
}