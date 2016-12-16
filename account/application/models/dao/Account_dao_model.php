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
        $data = dbEscape($data); // 转义输入数据
        return $this->account->insert($table, $data);
    }

    public function modifyPwd($where, $data, $type = 'user')
    {
        return $this->account->update($this->_sel_table($type), $data, $where);
    }

    public function getInfoByUserid($user_id, $type = 'user')
    {
        $where = array(
            'Fuser_id'  => $user_id,
        );
        $where = dbEscape($where); // 转义输入数据
        $query = $this->account->get_where($this->_sel_table($type), $where, 1);
        return $query->row_array();
    }

    public function addDetail($data)
    {
        $data = dbEscape($data);
        return $this->account->insert($this->_user_detail_table, $data);
    }

    public function modifyDetail($where, $data)
    {
        $where = dbEscape($where);
        $data = dbEscape($data);
        return $this->account->update($this->_user_detail_table, $data, $where);
    }

    public function addAdminDetail($data)
    {
        $data = dbEscape($data);
        return $this->account->insert($this->_admin_detail_table, $data);
    }

    public function modifyAdminDetail($where, $data)
    {
        $where = dbEscape($where);
        $data = dbEscape($data);
        return $this->account->update($this->_admin_detail_table, $data, $where);
    }

    public function getDetailByUserId($user_id, $type = 'user')
    {
        $query = $this->account->get_where($this->_sel_detail_table($type), array('Fuser_id' => $user_id));
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