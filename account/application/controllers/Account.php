<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends BaseController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('service/account_service_model', 'account_service');
	}

	/**
	 * 添加用户接口
     * $user_type 用户类型 默认为4 (1、内部管理用户2、合作商户3、媒体用户4、普通用户)
	 */
	public function add()
	{
        $data = array();
		$data['Fuser_id'] = $this->input->post('user_id');
		$data['Fpasswd'] = $this->input->post('passwd');
		$data['Fuser_type'] = $this->input->post('type') ? : '4';
        $data['Frecommend_uid'] = $this->input->post('recommend_uid');
        $data['Fcreate_time'] = time();
        $data['Fupdate_time']  = time();
        $data['Fstatus'] = 1;
		$res = $this->account_service->addAccount($data, 'user');
		echo outputResponse($res);
	}

    /**
     * 后台添加用户
     */
    public function addAdmin()
    {
        $data = array();
        $data['Fuser_id'] = $this->input->post('user_id');
        $data['Fpasswd'] = $this->input->post('passwd');
        $data['Frole_id'] = $this->input->post('role_id');
        $data['Fuser_type'] = 1; // 用户类型 默认为4 (运营管理用户1， 企业管理用户2)
        $data['Fcreate_time'] = time();
        $data['Fupdate_time']  = time();
        $data['Fstatus'] = 1;
        $data['Flevel'] = 1;
        $data['Fpid'] = 0;
        $res = $this->account_service->addAccount($data, 'admin');
        echo outputResponse($res);
    }


    /**
     * 根据用户ID获取后台用户信息
     */
    public function getAdminInfo()
    {
        $data['Fid'] = $this->input->get('id');
        $res = $this->account_service->getAdminInfo($data);
        echo outputResponse($res);
    }

    /**
     * 登录
     */
    public function login()
    {
        $data['Fuser_id'] = $this->input->post('user_id');
        $data['Fpasswd'] = $this->input->post('passwd');
        $data['Fuser_type'] = $this->input->post('type');
        $res = $this->account_service->login($data);
        echo outputResponse($res);
    }

    /**
     * 登录
     */
    public function loginAdmin()
    {
        $data['Fuser_id'] = $this->input->post('user_id');
        $data['Fpasswd'] = $this->input->post('passwd');
        $res = $this->account_service->loginAdmin($data);
        echo outputResponse($res);
    }

    /**
     * 更新密码
     */
    public function modifyPwd()
    {
        $data['Fuser_id'] = $this->input->post('user_id');
        $data['Fpasswd'] = $this->input->post('passwd');
        $data['new_passwd'] = $this->input->post('new_passwd');
        $res = $this->account_service->modifyPwd($data, 'user');
        echo outputResponse($res);
    }

    /**
     * 更新密码
     */
    public function modifyPwdAdmin()
    {
        $data['Fuser_id'] = $this->input->post('user_id');
        $data['Fpasswd'] = $this->input->post('passwd');
        $data['new_passwd'] = $this->input->post('new_passwd');
        $res = $this->account_service->modifyPwd($data, 'admin');
        echo outputResponse($res);
    }

    /**
     * 用户/后台用户详情
     */
    public function detail()
    {
        $data['Fuser_id'] = $this->input->get('id'); // Fuser_id 是id而不是user_id
        $data['type'] = $this->input->get('type') ? : 'user';
        $res = $this->account_service->detail($data);
        echo outputResponse($res);
    }

    /**
     * 根据用户ID获取用户信息
     */
    public function getUserDetailByFuserId()
    {
        $data['Fuser_id'] = $this->input->get('user_id');
        $res = $this->account_service->getUserDetailByWhere($data);
        echo outputResponse($res);
    }

    /**
     * 根据用户ID获取用户信息
     */
    public function getUserDetailByWhere()
    {
        $data['Fid'] = $this->input->get('id');
        $res = $this->account_service->getUserDetailByWhere($data);
        echo outputResponse($res);
    }

    /**
     * 保存用户详情
     */
    public function saveUserDetail()
    {
        $data = array();
        $data['Fid'] = $this->input->post('id');
        $data['Fnick_name'] = $this->input->post('nick_name');
        $data['Freal_name'] = $this->input->post('real_name');
        $data['Fcert_type'] = $this->input->post('cert_type');
        $data['Fcert_no'] = $this->input->post('cert_no');
        $data['Fsex'] = $this->input->post('sex');
        $data['Femail'] = $this->input->post('email');
        $data['Fphone'] = $this->input->post('phone');
        $data['Fcountry'] = $this->input->post('country');
        $data['Fprovince'] = $this->input->post('province');
        $data['Fcity'] = $this->input->post('city');
        $data['Faddress'] = $this->input->post('address');
        $data['Fatte_status'] = $this->input->post('atte_status') ? : 0;
        $data['Fimage_path'] = $this->input->post('image_path');
        $data['Fannex_path'] = $this->input->post('annex_path');
        $data['Fremark'] = $this->input->post('remark');
        $data['Fupdate_time'] = time();
        $res = $this->account_service->saveUserDetail($data);
        echo outputResponse($res);
    }

    /**
     * 添加后台用户详情
     */
    public function addAdminDetail()
    {
        $data = array();
        $data['Fuser_id'] = $this->_uid;
        $data['Freal_name'] = $this->input->post('real_name');
        $data['Findustry'] = $this->input->post('industry');
        $data['Fcert_type'] = $this->input->post('cert_type');
        $data['Fcert_no'] = $this->input->post('cert_no');
        $data['Flogo_path'] = $this->input->post('logo_path');
        $data['Femail'] = $this->input->post('email');
        $data['Fphone'] = $this->input->post('phone');
        $data['Fcountry'] = $this->input->post('country');
        $data['Faddress'] = $this->input->post('address');
        $data['Fannex_path'] = $this->input->post('annex_path');
        $data['Fremark'] = $this->input->post('remark');
        $data['Fatte_status'] = $this->input->post('atte_status');
        $data['Fcreate_time'] = time();
        $data['Fupdate_time'] = time();

        $res = $this->account_service->addAdminDetail($data);
        echo outputResponse($res);
    }

    /**
     * 修改后台用户详情
     */
    public function modifyAdminDetail()
    {
        $data = array();
        $data['Freal_name'] = $this->input->post('real_name');
        $data['Findustry'] = $this->input->post('industry');
        $data['Fcert_type'] = $this->input->post('cert_type');
        $data['Fcert_no'] = $this->input->post('cert_no');
        $data['Fimage_path'] = $this->input->post('image_path');
        $data['Femail'] = $this->input->post('email');
        $data['Fphone'] = $this->input->post('phone');
        $data['Fcountry'] = $this->input->post('country');
        $data['Faddress'] = $this->input->post('address');
        $data['Fannex_path'] = $this->input->post('annex_path');
        $data['Fremark'] = $this->input->post('remark');
        $data['Fatte_status'] = $this->input->post('atte_status');
        $data['Fupdate_time'] = time();
        $where = array('Fuser_id' => $this->_uid);
        $res = $this->account_service->modifyAdminDetail($where, $data);
        echo outputResponse($res);
    }

    /**
     * 第三方登录处理,返回用户信息
     */
    public function oauthLogin()
    {
        $option = array(
            'Fuser_id' => $this->input->post('user_id', true),
            'Fnick_name' => $this->input->post('nickname', true),
            'Fimage_path' => $this->input->post('imgurl', true),
            'Flog_type' => $this->input->post('log_type', true),
            'Fuser_type' => $this->input->post('type', true),
            'Frecommend_uid' => $this->input->post('recommend_uid', true)
        );
        $res = $this->account_service->oauthLogin($option);
        echo outputResponse($res);
    }

    /**
     * 获取商家名称
     */
    public function getStoreName()
    {
        // type 0:后台admin表,1:前台用户user表
        $option = array('Fid' => $this->input->get('id'), 'type' => $this->input->get('type'));
        $res = $this->account_service->getStoreName($option);
        echo outputResponse($res);
    }

    public function getAccountTotalInfo()
    {
        // type 0:后台admin表,1:前台用户user表
        $option = array('Fid' => $this->input->get('id'), 'type' => $this->input->get('type'));
        $res = $this->account_service->getAccountTotalInfo($option);
        echo outputResponse($res);
    }

    /**
     * 保存发送验证码sms
     */
    public function saveVerifySms()
    {
        $option = array(
            'Fbuss_type' => $this->input->post('buss_type', true), // 短信验证
            'Fsms_id' => $this->input->post('sms_id', true), // smsid
            'Fsms_content' => $this->input->post('sms_content', true),
            'Fmobile_no' => $this->input->post('mobile_no', true),
            'Fstatus' => $this->input->post('status', true),
            'Fret_msg' => $this->input->post('ret_msg', true),
            'Fcreate_time' => $this->input->post('create_time', true)
        );
        $res = $this->account_service->saveVerifySms($option);
        echo outputResponse($res);
    }

    // 保存手机验证码
    public function saveVerifyCode()
    {
        $option = array(
            'Fverifycode' => $this->input->post('verifycode', true),
            'Fbegin_time' => $this->input->post('begin_time', true),
            'Fend_time' => $this->input->post('end_time', true),
            'Fstatus' => $this->input->post('status', true),
        );
        $this->account_service->saveVerifyCode($option);
    }

    // 保存头像信息
    public function modifyHdImg()
    {
        $option = array(
            'Fuser_id' => $this->input->post('user_id', true),
            'Fimage_path' => $this->input->post('image_path', true),
        );
        $this->account_service->modifyHdImg($option);
    }

    // 手机验证码登录
    public function loginPhone()
    {
        $option = array(
            'Fuser_id' => $this->input->post('user_id', true),
            'Fverifycode' => $this->input->post('code', true),
            'Fuser_type' => $this->input->post('type', true),
            'Frecommend_uid' => $this->input->post('recommend_uid', true),
            'Flog_type' => 3 // 手机登录
        );
        $res = $this->account_service->checkVerifyCode($option['Fverifycode']);
        if ($res['code'] === 0) {
            $res = $this->account_service->loginPhone($option);
        }
        echo outputResponse($res);
    }

    public function hasMediumPower()
    {
        $option = array(
            'Fid' => $this->input->get('id'),
            'Fuser_id' => $this->input->get('id')
        );
        $res = $this->account_service->hasMediumPower($option);
        echo outputResponse($res);
    }

    public function hasStorePower()
    {
        $option = array(
            'Fid' => $this->input->get('id'),
            'Fuser_id' => $this->input->get('id')
        );
        $res = $this->account_service->hasStorePower($option);
        echo outputResponse($res);
    }

    public function adminAction()
    {
        $res = $this->account_service->adminAction();
        echo outputResponse($res);
    }

    public function role()
    {
        $res = $this->account_service->role();
        echo outputResponse($res);
    }
    
    public function addRole()
    {
        $option = array(
            'Frole_name' => (string)$this->input->post('role_name'),
            'Fdesc' => (string)$this->input->post('desc'),
            'Faction_ids' => (string)$this->input->post('action_ids'),
        );
        $res = $this->account_service->addRole($option);
        echo outputResponse($res);
    }

    public function delRole()
    {
        $option = array(
            'Frole_id' => $this->input->post('id'),
        );
        $res = $this->account_service->delRole($option);
        echo outputResponse($res);
    }

    public function saveRole()
    {
        $where = array(
            'Frole_id' => $this->input->post('role_id')
        );
        $option = array(
            'Frole_name' => (string)$this->input->post('role_name'),
            'Fdesc' => (string)$this->input->post('desc'),
            'Faction_ids' => (string)$this->input->post('action_ids'),
        );
        $res = $this->account_service->saveRole($where, $option);
        echo outputResponse($res);
    }
    
    public function getRole()
    {
        $where = array('Frole_id' => $this->input->get('id'));

        $res = $this->account_service->getRole($where);
        echo outputResponse($res);
    }

    public function getRoleCount()
    {
        $res = $this->account_service->getRoleCount();
        echo outputResponse($res);
    }
    
    public function adminList()
    {
        $option = array(
            'Fuser_id' => $this->input->get('user_id'),// 用户名
            'p' => $this->input->get('p') ? : 1,
            'page_size' => $this->input->get('page_size'),
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
        );
        $res = $this->account_service->adminList($option);
        echo outputResponse($res);
    }

    public function changeAdminStatus()
    {
        $option = array(
            'Fid' => intval($this->input->get('id', true)),
            'Fstatus' => $this->input->get('status', true),
        );
        $res = $this->account_service->changeAdminStatus($option);
        echo outputResponse($res);
    }

    public function updateAdminPwd()
    {
        $where =array(
            'Fid' => $this->input->post('id', true),
        );
        $data = array(
            'Fpasswd' => $this->input->post('passwd', true)
        );
        $res = $this->account_service->updateAdminPwd($where, $data);
        echo json_encode_data($res);
    }

    public function updateAdminRole()
    {
        $where =array(
            'Fid' => $this->input->post('id', true),
        );
        $data = array(
            'Frole_id' => $this->input->post('role_id', true)
        );
        $res = $this->account_service->updateAdminRole($where, $data);
        echo json_encode_data($res);
    }

    public function powerUrl()
    {
        $where = array('Frole_id' => $this->input->get('role_id'));
        $res = $this->account_service->powerUrl($where);
        echo outputResponse($res);
    }

}
