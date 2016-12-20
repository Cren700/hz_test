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
        return $this->myCurl('account', 'addAccountAdmin', $post_data, true);
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
        $res = $this->myCurl('account', 'loginAdmin', $post_data, true);
        if ($res['code'] === 0) {
            // 保存session
            $session = array('uid' => $res['data']['uid'], 'username' => $res['data']['username']);
            $this->session->set_userdata($session);
        }
        return $res;
    }

    /**
     * 修改密码
     */
    public function modifyPwd($passwd, $new_passwd, $re_passwd)
    {
        $res = array(
            'code' => 0
        );
        if ($new_passwd !== $re_passwd) {
            $res['code'] = -1;  // 密码输入不一致
            $res['msg'] = '新密码输入不一致';
        } elseif($new_passwd === $passwd) {
            $res['code'] = -2;  // 新密码与旧密码一样
            $res['msg'] = '新密码与旧密码一样';
        } else {
            $data = array(
                'user_id' => $this->_user_id,
                'passwd' => $passwd,
                'new_passwd' => $new_passwd
            );
            $res = $this->myCurl('account', 'modifyPwdAdmin', $data, true);
            if ($res['code'] == 0) {
                $res['data']['url'] = getBaseUrl('/home.html');
            }
        }
        return $res;
    }

}