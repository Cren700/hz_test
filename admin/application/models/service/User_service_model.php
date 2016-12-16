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
}