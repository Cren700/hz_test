<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends BaseControllor {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('service/account_service_model');
	}


	/**
	 * 管理员登录接口
	 */
	public function adminAccountLogin()
	{
		echo "hello world!";
	}

	/**
	 * 添加管理员接口
	 */
	public function addAccount()
	{
		$username = trim($this->input->post('username'));
		$pwd = trim($this->input->post('pwd'));
		$table_type = intval($this->input->post('table_type')); // 0: admin, 1: account
		$role_type = intval($this->input->post('role_type')); // 0:普通管理员 1:超级管理员
		$res = $this->account_service_model->addAccount($username, $pwd, $table_type, $role_type) ;
		echo outPutJsonData($res);
	}


}
