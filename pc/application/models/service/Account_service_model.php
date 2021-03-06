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

    public function add($option)
    {
        $option['recommend_uid'] = $this->session->userdata('_re');
        $res = $this->myCurl('account', 'addAccount', $option, true);
        if ($res['code'] == 0) {
            // 保存session
            $res['data']['url'] = getBaseUrl('/home.html');
            $session = array('w_uid' => $res['data']['Fid'], 'w_username' => $res['data']['Fuser_id'], 'w_type' => $res['data']['Fuser_type']);
            $this->session->set_userdata($session);
        }
        return $res;
    }

    /**
     * 登录
     * @param $option
     * @return array
     */
    public function login($option)
    {
        $res = $this->myCurl('account', 'login', $option, true);
        if ($res['code'] == 0) {
            // 保存session
            $res['data']['url'] = getBaseUrl('/home.html');
            $data = array('w_uid' => $res['data']['uid'], 'w_username' => $res['data']['username'], 'w_type' => $res['data']['user_type'], 'w_image_path' => $res['data']['image_path']);
            $this->saveInfoToSession($data);
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
            $res = $this->myCurl('account', 'modifyPwd', $data, true);
            if ($res['code'] == 0) {
                $res['data']['url'] = getBaseUrl('/home.html');
            }
        }
        return $res;
    }

    /**
     * 保存短信sms
     * @param $status
     * @param $resultMsgId
     * @param $createTime
     * @param $content
     * @param $mobile_no
     * @param $resultMsg
     */
    public function saveVerifySms($status, $resultMsgId, $createTime, $content, $mobile_no, $resultMsg)
    {
        $option = array(
            'buss_type' => 1, // 短信验证
            'sms_id' => $resultMsgId, // smsid
            'sms_content' => $content,
            'mobile_no' => $mobile_no,
            'status' => $status,
            'ret_msg' => $resultMsg,
            'create_time' => $createTime
        );
        $this->myCurl('account', 'saveVerifySms', $option, true);
    }

    /**
     * 保存verifycode
     * @param $createTime
     * @param $endTime
     * @param $code
     */
    public function saveVerifyCode($createTime, $endTime, $code)
    {
        $option = array(
            'verifycode' => $code,
            'begin_time' => $createTime,
            'end_time' => $endTime,
            'status' => 1,
        );
        $this->myCurl('account', 'saveVerifyCode', $option, true);
    }

    public function modifyHdImg($option)
    {
        $this->myCurl('account', 'modifyHdImg', $option, true);
    }

    public function loginPhone($option)
    {
        $option['recommend_uid'] = $this->session->userdata('_re');
        $ret = array('code' => 0);
        $res = $this->myCurl('account', 'loginPhone', $option, true);
        if ($res['code'] == 0) {
            // 保存session
            $ret['data']['url'] = getBaseUrl('/home.html');
            $data = array('w_uid' => $res['data']['Fid'], 'w_username' => $res['data']['Fuser_id'], 'w_type' => $res['data']['Fuser_type'], 'w_image_path' => isset($res['data']['Fimage_path']) ? $res['data']['Fimage_path'] : '' );
            $this->saveInfoToSession($data);
        } else {
            $ret['code'] = $res['code'];
            $ret['msg'] = $res['msg'];
        }
        return $ret;
    }

    /**
     * 第三方登录处理,返回用户信息
     * @param $openid
     * @param $nickname
     * @param $imgurl
     * @param $log_type
     * @param $type
     * @return mixed
     */
    public function oauthLogin($openid, $nickname, $imgurl, $log_type, $type)
    {
        $option = array(
            'user_id' => $openid,
            'nickname' => $nickname,
            'recommend_uid' => $this->session->userdata('_re'),
            'imgurl' => $imgurl,
            'log_type' => $log_type,
            'type' => $type
        );
        $res = $this->myCurl('account', 'oauthLogin', $option, true);
        if ($res['code'] == 0) {
            // 保存session
            $res['data']['url'] = getBaseUrl('/home.html');
            $data = array('w_uid' => $res['data']['Fid'], 'w_username' => $res['data']['Fuser_id'], 'w_type' => $res['data']['Fuser_type'], 'w_log_type' => $res['data']['Flog_type'],'w_image_path' => isset($res['data']['Fimage_path']) ? $res['data']['Fimage_path'] : '' );
            $this->saveInfoToSession($data);
        }
        return $res;
    }
}