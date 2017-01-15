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
		$data['Fuser_type'] = $this->input->post('user_type') ? : '4';
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

//        $data['Fuser_id'] = 'admin';
//        $data['Fpasswd'] = '123456';
//        $data['Fnick_name'] = 'aadmin';
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
     * 登录
     */
    public function login()
    {
        $data['Fuser_id'] = $this->input->post('user_id');
        $data['Fpasswd'] = $this->input->post('passwd');
        $res = $this->account_service->login($data, 'user');
        echo outputResponse($res);
    }

    /**
     * 登录
     */
    public function loginAdmin()
    {
        $data['Fuser_id'] = $this->input->post('user_id');
        $data['Fpasswd'] = $this->input->post('passwd');
        $res = $this->account_service->login($data, 'admin');
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
        $res = $this->account_service->getUserDetailByFuserId($data);
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
        $data['Flogo_path'] = $this->input->post('logo_path');
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
            'Flog_type' => $this->input->post('log_type', true)
        );
        $res = $this->account_service->oauthLogin($option);
        echo outputResponse($res);
    }

    /**
     * 获取商家名称
     */
    public function getStoreName()
    {
        // type 0:后台,1:商户
        $option = array('Fid' => $this->input->get('id'), 'type' => $this->input->get('type'));
        $res = $this->account_service->getStoreName($option);
        echo outputResponse($res);
    }
}
