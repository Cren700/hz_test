<?php

/**
 * User.php
 * Author   : cren
 * Date     : 2016/11/27
 * Time     : 下午6:24
 */
class Account extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/account_service_model');
        $this->load->model('service/user_service_model');
    }

    /**
     * 密码登录页
     */
    public function index()
    {
        $jsArr = array('account_login.js');
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('account/index.tpl');
    }

    /**
     * 密码登录接口
     */
    public function doLogin()
    {
        $user_id = $this->input->post('user_id');
        $passwd = $this->input->post('passwd');
        $uri = $this->input->post('uri');
        $res = $this->account_service_model->login($user_id, $passwd);
        if ($res['code'] === 0) {
            $res['data']['url'] = $uri ? HOST_URL . $uri : getBaseUrl('/home.html');
        }
        echo json_encode_data($res);
    }

    /**
     * 注册页
     */
    public function register()
    {
        $jsArr = array('account_register.js');
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('account/register.tpl');
    }

    /**
     * 提交注册
     */
    public function doRegister()
    {
        $user_id = $this->input->post('user_id');
        $passwd = $this->input->post('passwd');
        $res = $this->account_service_model->add($user_id, $passwd);
        echo json_encode_data($res);
    }

    /**
     * 退出登录
     */
    public function logOut()
    {
        $this->session->sess_destroy();
        $this->jump(getBaseUrl('/home.html'));
    }

    /**
     * 修改密码页面
     */
    public function pwd()
    {
        $jsArr = array(
            'account_pwd.js'
        );
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('account/pwd.tpl');
    }

    /**
     * 修改密码
     */
    public function modifyPwd()
    {
        $passwd = $this->input->post('passwd');
        $new_passwd = $this->input->post('new_passwd');
        $re_passwd = $this->input->post('re_passwd');
        $res = $this->account_service_model->modifyPwd($passwd, $new_passwd, $re_passwd);
        echo json_encode_data($res);
    }

    /**
     * 查看用户信息
     * @return null
     */
    public function detail()
    {
        $info = $this->user_service_model->detail();
//        p($info);
        $this->smarty->assign('user', $info['data']);
        $this->smarty->display('account/detail.tpl');
    }

    public function modify()
    {
        $jsArr = array(
            'uploadify/jquery.uploadify.min.js',
            'account_modify.js'
        );
        $cssArr = array('uploadify.css');
        $info = $this->user_service_model->detail();
//        p($info);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('user', $info['data']);
        $this->smarty->display('account/modify.tpl');
    }

    /**
     * 保存用户信息
     */
    public function saveInfo()
    {
        $option = $this->input->post();//提交的数据
        $option['id'] = $this->_uid;
        $res = $this->user_service_model->saveInfo($option);
        if ($res['code'] != 0) {
            $this->jump404();
        } else {
            $url = getBaseUrl('/account/detail');
            $this->jump($url);
        }
    }

    /**
     * 账户中心
     */
    public function center()
    {
        $info = $this->user_service_model->center();
        $this->smarty->assign('user', $info['data']);
        $this->smarty->display('account/center.tpl');
    }

    /**
     * 设置
     */
    public function set()
    {
        $info = $this->user_service_model->detail();
//        p($info);
        $this->smarty->assign('user', $info['data']);
        $this->smarty->display('account/set.tpl');
    }


    /**
     * 获取验证码
     * VerificationCode
     */
    public function getVC()
    {
        $this->load->library('captcha');
        $code = $this->captcha->getCaptcha();
        $this->session->set_userdata('code', $code);
        $this->captcha->showImg();
        $this->session->set_userdata('vc', $code);
    }

    /**
     * 检验验证码
     */
    public function checkVC()
    {
        $code = strtoupper($this->input->get('vc'));
        $vc = $this->session->userdata('vc');
        if ($code == $vc) {
            echo json_encode(array('code' => 0));
        } else {
            echo json_encode(array('code' => 1, 'msg' => '验证码错误'));
        }
    }

    public function logwx()
    {
        $this->config->load('wx_conf');
        $state  = md5(uniqid(rand(), TRUE));
        $this->session->set_userdata(array('wx_state' => $state));
        $appid = $this->config->item('appid');
        $bakUrl = $this->config->item('log_bak_url');
        $url = 'https://open.weixin.qq.com/connect/qrconnect?appid='.$appid.'&redirect_uri='.$bakUrl.'&response_type=code&scope=snsapi_login&state='.$state.'#wechat_redirect';
        https://open.weixin.qq.com/connect/qrconnect?appid=wx0ab6bc88e6d36a93&scope=snsapi_login&redirect_uri=http%3a%2f%2fwww.imhuzhu.com%2fwxlogin.aspx&state=&login_type=jssdk
        header("Location:".$url);
    }

    public function wxLogBak()
    {
        if($_GET['state']!=$_SESSION["wx_state"]){
            exit("5001");
        }
        $this->config->load('wx_conf');
        $appid = $this->config->item('appid');
        $secret = $this->config->item('secret');
        $code = $_GET['code'];
        $url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        $json =  curl_exec($ch);
        curl_close($ch);
        $arr=json_decode($json,1);
        //得到 access_token 与 openid
        $url='https://api.weixin.qq.com/sns/userinfo?access_token='.$arr['access_token'].'&openid='.$arr['openid'].'&lang=zh_CN';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        $json =  curl_exec($ch);
        curl_close($ch);
        $arr=json_decode($json,1);
        //得到 用户资料
        print_r($arr);
    }

    /**
     * 发送模板短信
     */
    public function phoneLog()
    {
        $code = mt_rand(100000, 999999);
        $data = array($code, 5);
        $to = $this->input->get('phone');
        $tempID = 1; // 短信模板ID
        $content = json_encode_data(array('code' => $data, 'tempId' => $tempID));
        $resValidation = validationData($to, 'phone');
        if (!empty($resValidation)) {
            return outputResponse($resValidation);
        }
        for($i = 0; $i<3;){
            // 保存短信消息
            $result = sms($to, $data, $tempID);
            $resultCode = isset($result->statusCode) ? $result->statusCode : '';
            $resultMsgId = isset($result->smsMessageSid) ? $result->smsMessageSid : '';
            $createTime = isset($result->statusCode) ? $result->statusCode : '';
            $endTime = $createTime+5*60;
            // 保存发送短信消息
            if ($resultCode != 0) {
                $i++;
                $this->account_service->saveVerifySms($resultCode = 1, $resultMsgId, $createTime, $content, $to);
            } else {
                // 保存验证码
                $this->account_service->saveVerifyCode($createTime, $endTime, $code);
                $this->account_service->saveVerifySms($resultCode = 2, $resultMsgId, $createTime, $content, $to);
                break;
            }
        }
    }

}