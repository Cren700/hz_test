<?php

/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/7/9
 * Time: 上午11:16
 */
class Account_service_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/account_dao_model');
    }

    public function addAccount($username, $pwd, $table_type, $role_type)
    {
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $username,
                'rules' => 'required|min_length[4]|max_length[16]',
                'field' => '用户名'
            ),
            array(
                'value' => $pwd,
                'rules' => 'required|min_length[6]|max_length[16]',
                'field' => '密码'
            ),
            array(
                'value' => $table_type,
                'rules' => 'required',
                'field' => '表类别'
            ),
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }

        $hasUsername = $this->account_dao_model->getInfoByUsername($username, $role_type);
        if( $hasUsername ) {
            return array('code' => 'account_error_2'); // 用户名已存在
        }
        $salt = saltCode();
        $pwdCode = encodePwd($table_type, $salt, $pwd);
        if ($this->account_dao_model->addAccount($username, $pwdCode, $table_type, $role_type, $salt) ){
            return array('code' => 0);
        } else {
            return array('code' => 'account_error_3');
        }
    }

    public function accountLogin($username, $pwd, $table_type)
    {
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $username,
                'rules' => 'required|min_length[4]|max_length[16]',
                'field' => '用户名'
            ),
            array(
                'value' => $pwd,
                'rules' => 'required|min_length[6]|max_length[16]',
                'field' => '密码'
            ),
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }
        $info = $this->account_dao_model->getInfoByUsername($username, $table_type);
        if (!$info) return array('code' => 'account_error_0'); // 账户不存在
        $pwdCode = encodePwd(0, $info['salt'], $pwd);
        if ($info['pwd'] !== $pwdCode) {
            return array('code' => 'account_error_1');         // 账户密码不一致
        } else {
            return array('code' => 0);
        }
    }

}