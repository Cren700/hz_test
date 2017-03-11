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
        $option = array(
            'user_id' => $this->input->post('user_id'),
            'passwd' => $this->input->post('passwd'),
            'type' => $this->input->post('type'),
        );
        $uri = $this->input->post('uri');
        $res = $this->account_service_model->login($option);
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
        $option = array(
            'user_id' => $this->input->post('user_id'),
            'passwd' => $this->input->post('passwd'),
            'type' => $this->input->post('type'),
        );
        $res = $this->account_service_model->add($option);
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
        $this->is_login();
        $info = $this->user_service_model->detail();
        $jsArr = array(
            'jquery.placeholder.min.js',
            'jquery.validate.js',
            'uploadify/jquery.uploadify.min.js',
            'account_modify.js'
        );
        $cssArr = array('uploadify.css');
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
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
        echo json_encode_data($res);
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

    public function modifyHdImg()
    {
        $option  = array(
            'image_path' => $this->input->get('hdImg'),
            'user_id' => $this->_uid
        );
        $res = $this->account_service_model->modifyHdImg($option);
        echo json_encode_data($res);


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
        $type = $this->input->get('type');
        $this->config->load('wx_conf');
        $state  = md5(uniqid(rand(), TRUE));
        $this->session->set_userdata(array('wx_state' => $state));
        $appid = $this->config->item('appid');
        $bakUrl = urlencode($this->config->item('log_bak_url') . '/'.$type);

        $this->smarty->assign('appid', $appid);
        $this->smarty->assign('state', $state);
        $this->smarty->assign('backUrl', $bakUrl);
        $this->smarty->display('account/logwx.tpl');
    }

    public function wxLogBak($type = 4)
    {
        if($_GET['state']!=$_SESSION["wx_state"]){
            $this->jump404();
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
        $res =  curl_exec($ch);
        curl_close($ch);

        //解析json
        $user_obj = json_decode($res,true);

//        $type = $this->input->get('type');
        $ret = $this->account_service_model->oauthLogin($user_obj['openid'], $user_obj['nickname'], $user_obj['headimgurl'], $log_type=1, $type);
        if ($ret['code'] == 0) {
            $this->jump($ret['data']['url']);
        } else {
            $this->jump404();
        }
    }
    
    public function testWX()
    {
        $this->smarty->display('account/test.tpl');
    }
    

    public function phonePage()
    {
        $jsArr = array('account_phone.js');
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('account/phonePage.tpl');
    }

    /**
     * 密码登录接口
     */
    public function doPhoneLogin()
    {
        $option = array(
            'user_id' => $this->input->post('user_id'),
            'code' => $this->input->post('code'),
            'type' => $this->input->post('type'),
        );
        $res = $this->account_service_model->loginPhone($option);
        echo json_encode_data($res);
    }

    public function sendSms()
    {
        $ret = array('code' => 0);
        $this->config->load('sms');
        $login_con = $this->config->item('login');
        $code = mt_rand(100000, 999999);
        $param = array('name' => '用户', 'code' => (string)$code);
        $phone = $this->input->get('phone');
        $content = $login_con['msg'];
        $content = preg_replace('/{name}/', $param['name'], $content);
        $content = preg_replace('/{code}/', $param['code'], $content);
        $resValidation = validationData($phone, 'phone');
        if (!empty($resValidation)) {
            return outputResponse($resValidation);
        }

        for($i = 0; $i<3;){
            // 保存短信消息
            $resultObj = sms($login_con['appkey'], $login_con['secretKey'], $login_con['signName'], $login_con['tempCode'], $phone, $param);
//var_dump($result);
            $result = (array)$resultObj;
            $resultCode = 0;
            $resultMsg = '发送成功';
            $resultMsgId = null;
            $createTime = time();
            $endTime = $createTime+30*60;
            if (isset($result['code'])) {
                $resultCode = $result['code'];
                $resultMsg = $result['sub_msg'];
            }
            $resultMsgId = $result['request_id'];

            // 保存发送短信消息
            if ($resultCode != 0) {
                $i++;
                $this->account_service_model->saveVerifySms($status = 0, $resultMsgId, $createTime, $content, $phone, $resultMsg);
                sleep(5);
                $ret['code'] = 1;  // 不成功
                $ret['msg'] = '出错了,请您稍后再试!';
            } else {
                // 保存验证码
                $this->account_service_model->saveVerifyCode($createTime, $endTime, $code);
                $this->account_service_model->saveVerifySms($status = 1, $resultMsgId, $createTime, $content, $phone, $resultMsg);
                break; // 跳出循环
            }
        }
        echo json_encode_data($ret);
    }

}