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

    public function detail()
    {
        return $this->myCurl('account', 'detail', array('user_id' => $this->_user_id));
    }

    public function modifyPwd($data)
    {
        return $this->myCurl('account', 'modifyPwd', $data, true);
    }

    public function save($data)
    {
        $is_new = $data['is_new'];
        unset($data['is_new']);
        if ($is_new) {
            return $this->myCurl('account', 'addDetail', $data, true);
        } else {
            return $this->myCurl('account', 'modifyDetail', $data, true);
        }
    }
}