<?php

/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/7/9
 * Time: 上午11:16
 */
class Account_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/account_dao_model');
    }

    /**
     * 注册
     * @param $data
     * @param $type 'admin':为后台登录
     * @return array
     */
    public function addAccount($data, $type)
    {
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Fuser_id'],
                'rules' => 'required|min_length[4]|max_length[16]',
                'field' => '用户名'
            ),
            array(
                'value' => $data['Fpasswd'],
                'rules' => 'required|min_length[6]|max_length[16]',
                'field' => '密码'
            ),
            array(
                'value' => $data['Fuser_type'],
                'rules' => 'required',
                'field' => '用户类型'
            ),
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }

        $hasUserid = $this->account_dao_model->getInfoByUserid($data['Fuser_id'], $type);
        if( $hasUserid ) {
            return array('code' => 'account_error_2'); // 用户名已存在
        }
        $salt = saltCode();
        $data['Fsalt'] = $salt;
        $data['Fpasswd'] = encodePwd($salt, $data['Fpasswd']);
        if ($this->account_dao_model->addAccount($data, $type) ){
            return array('code' => 0);
        } else {
            return array('code' => 'account_error_3');
        }
    }

    /**
     * 登录
     * @param $data
     * @param $type 'admin':为后台登录
     * @return array
     */
    public function login($data, $type)
    {
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Fuser_id'],
                'rules' => 'required|min_length[4]|max_length[16]',
                'field' => '用户名'
            ),
            array(
                'value' => $data['Fpasswd'],
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
        $info = $this->account_dao_model->getInfoByUserid($data['Fuser_id'], $type);
        if (!$info) return array('code' => 'account_error_0'); // 账户不存在
        $pwdCode = encodePwd($info['Fsalt'], $data['Fpasswd']);
        if ($info['Fpasswd'] !== $pwdCode) {
            return array('code' => 'account_error_1');         // 账户密码不一致
        } else {
            $resData = array('uid' => $info['Fid'], 'username' => $info['Fuser_id']);
            return array('code' => 0, 'data' => $resData);
        }
    }

    /**
     * 修改密码
     * @param $data
     * @param $type 'admin':为后台登录
     * @return array
     */
    public function modifyPwd($data, $type){
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Fpasswd'],
                'rules' => 'required|min_length[6]|max_length[16]',
                'field' => '密码'
            ),
            array(
                'value' => $data['new_passwd'],
                'rules' => 'required|min_length[6]|max_length[16]',
                'field' => '新密码'
            ),
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }
        $info = $this->account_dao_model->getInfoByUserid($data['Fuser_id'], $type);
        if (!$info) return array('code' => 'account_error_0'); // 账户不存在
        $pwdCode = encodePwd($info['Fsalt'], $data['Fpasswd']);
        if ($info['Fpasswd'] !== $pwdCode) {
            $ret = array('code' => 'account_error_1');         // 账户密码不一致
        } else {
            $where = array('Fuser_id' => $data['Fuser_id']);
            $salt = saltCode();
            $passwd = encodePwd($salt, $data['new_passwd']);
            $tmp = array('Fpasswd' => $passwd, 'Fsalt' => $salt, 'Fupdate_time' => time());
            unset($data);
            $res = $this->account_dao_model->modifyPwd($where, $tmp, $type);
            if ($res) {
                $ret = array('code' => 0);
            } else {
                $ret = array('code' => 'system_error_2');
            }
        }
        return $ret;
    }

    /**
     * 用户详情
     * @param $data
     * @return array
     */
    public function detail($data)
    {
        $ret = array('code' => 0);
        if (empty($data['Fuser_id'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
        } else {
            $res = $this->account_dao_model->getDetailByUserId($data['Fuser_id'], $data['type']);
            $ret['data'] = $res;
        }
        return $ret;
    }

    /**
     * 添加用户详情
     * @param $data
     * @return array
     */
    public function addDetail($data)
    {
        $ret = array('code' => 0);
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Fuser_id'],
                'rules' => 'required',
                'field' => '用户名'
            )
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }

        $user = $this->account_dao_model->getDetailByUserId($this->_uid);
        if (!empty($user)) {
            $ret['code'] = 'account_error_6'; // 已经存在用户详情
            return $ret;
        }
        $res = $this->account_dao_model->addDetail($data);
        if (!$res) {
            $ret['code'] = 'account_error_3';
        }
        return $ret;
    }

    /**
     * 修改用户详情
     * @param $where
     * @param $data
     * @param $type 区分后台、用户
     * @return array|string
     */
    public function modifyDetail($where, $data, $type)
    {
        $ret = array('code' => 0);
        // 数据验证
        if (!$where['Fuser_id']) {
            return $ret['code'] = 'account_error_5';
        }
        $res = $this->account_dao_model->modifyDetail($where, $data, $type);
        if (!$res) {
            $ret['code'] = 'account_error_3';
        }
        return $ret;
    }


    /**
     * 添加后台用户详情
     * @param $data
     * @return array
     */
    public function addAdminDetail($data)
    {
        $ret = array('code' => 0);
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Fuser_id'],
                'rules' => 'required',
                'field' => '用户名'
            )
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }
        $user = $this->account_dao_model->getDetailByUserId($this->_uid, 'admin');
        if (!empty($user)) {
            $ret['code'] = 'account_error_6'; // 已经存在用户详情
            return $ret;
        }

        $res = $this->account_dao_model->addAdminDetail($data);
        if (!$res) {
            $ret['code'] = 'account_error_3';
        }
        return $ret;
    }

    /**
     * 修改用户详情
     * @param $where
     * @param $data
     * @return array|string
     */
    public function modifyAdminDetail($where, $data)
    {
        $ret = array('code' => 0);
        // 数据验证
        if (!$where['Fuser_id']) {
            return $ret['code'] = 'account_error_5';
        }
        $res = $this->account_dao_model->modifyAdminDetail($where, $data);
        if (!$res) {
            $ret['code'] = 'account_error_3';
        }
        return $ret;
    }
}