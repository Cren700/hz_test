<?php

/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/7/9
 * Time: 下午2:47
 */
class Account_dao_model extends MY_Model
{
    private $_account_admin_table = 'cr_admins';
    private $_account_merchant_table = 'cr_merchants';
    public function __construct()
    {
        parent::__construct();
        $this->account = $this->load->database('account', true);
    }

    /**
     * 添加管理员账号
     * @param $username
     * @param $pwdCode
     * @param $table_type   0: admin, 1: account
     * @param $role_type    0:普通管理员 1:超级管理员
     * @param $salt
     * @return mixed
     */
    public function addAccount($username, $pwdCode, $table_type, $role_type, $salt)
    {
        $data = array(
            'username'  => $username,
            'pwd'       => $pwdCode,
            'salt'      => $salt
        );
        if ($table_type == 0 ) {
            // 管理员
            $data['type'] = $role_type;
            $_table = $this->_account_admin_table;
        } else {
            // 商户
            $_table = $this->_account_merchant_table;
        }
        $data = dbEscape($data); // 转义输入数据
        return $this->account->insert($_table, $data);
    }

    public function getInfoByUsername($username, $table_type){
        $data = array(
            'username'  => $username,
        );
        $data = dbEscape($data); // 转义输入数据
        if ($table_type == 0 ) {
            // 管理员
            $_table = $this->_account_admin_table;
        } else {
            // 商户
            $_table = $this->_account_merchant_table;
        }
        $query = $this->account->get_where($_table, $data, 1);
        return $query->row_array();
    }

}