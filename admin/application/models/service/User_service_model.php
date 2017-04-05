<?php

/**
 * User_service_model.php
 * Author   : cren
 * Date     : 2016/11/27
 * Time     : 下午6:37
 */
class User_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function self()
    {
        return $this->myCurl('account', 'detail', array('id' => $this->_uid, 'type' => 'admin'));
    }

    public function save($data)
    {
        $is_new = $data['is_new'];
        unset($data['is_new']);
        if ($is_new) {
            $res = $this->myCurl('account', 'addAdminDetail', $data, true);
        } else {
            $res = $this->myCurl('account', 'modifyAdminDetail', $data, true);
        }
        if ($res['code'] === 0) {
            $res['data']['url'] = getBaseUrl('/home.html');
        }
        return $res;
    }
    
    public function addUser($data)
    {
        return $this->myCurl('account', 'addAccount', $data, true);
    }

    public function query($data)
    {
        return $this->myCurl('account', 'queryUser', $data, false);
    }

    public function getInfo($data)
    {
        return $this->myCurl('account', 'getInfo', $data, false);
    }
    
    public function saveInfo($data)
    {
        $res = $this->myCurl('account', 'saveDetail', $data, true);
        return $res;
    }

    public function changeStatus($option)
    {
        return $this->myCurl('account', 'changeStatus', $option, false);
    }

    public function queryBlackList($data)
    {
        return $this->myCurl('account', 'queryBlackList', $data, false);
    }

    public function role()
    {
        return $this->myCurl('account', 'role', array(), false);
    }

    public function adminAction()
    {
        return $this->myCurl('account', 'adminAction', array(), false);
    }
    
    public function saveRole($option)
    {
        return $this->myCurl('account', 'saveRole', $option, true);
    }

    public function addRole($option)
    {
        return $this->myCurl('account', 'addRole', $option, true);
    }

    public function delRole($option)
    {
        return $this->myCurl('account', 'delRole', $option, true);
    }

    public function getRole($option)
    {
        return $this->myCurl('account', 'getRole', $option, false);
    }

    public function getRoleCount()
    {
        return $this->myCurl('account', 'getRoleCount', array());
    }


    public function adminList($option)
    {
        return $this->myCurl('account', 'adminList', $option, false);
    }

    public function changeAdminStatus($option)
    {
        return $this->myCurl('account', 'changeAdminStatus', $option, false);
    }

    public function getAdminInfo($data)
    {
        return $this->myCurl('account', 'getAdminInfo', $data, false);
    }

    public function updateAdminPwd($option)
    {
        return $this->myCurl('account', 'updateAdminPwd', $option, true);
    }

    public function updateAdminRole($option)
    {
        return $this->myCurl('account', 'updateAdminRole', $option, true);
    }

    public function addAccountAdmin($option)
    {
        return $this->myCurl('account', 'addAccountAdmin', $option, true);
    }

    public function batchDelUser($option)
    {
        return $this->myCurl('account', 'batchDelUser', $option, true);
    }
}