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
    }

    public function add($user_id, $passwd)
    {
        $post_data = array(
            'user_id'   => $user_id,
            'passwd'    => $passwd,
        );
        return $this->myCurl('account', 'addAccount', $post_data, true);
    }

    /**
     * 登录
     * @param $user_id
     * @param $passwd
     * @return array
     */
    public function login($user_id, $passwd)
    {
        $post_data = array('user_id' => $user_id, 'passwd' => $passwd);
        $res = $this->myCurl('account', 'login', $post_data, true);
        if ($res['code'] === 0) {
            // 保存session
            $session = array('uid' => $res['data']['uid'], 'username' => $res['data']['username']);
            $this->session->set_userdata($session);
        }
        return $res;
    }

}