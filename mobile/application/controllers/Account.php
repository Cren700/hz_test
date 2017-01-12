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
     * 登录页
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
     * @param string $uid
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

}