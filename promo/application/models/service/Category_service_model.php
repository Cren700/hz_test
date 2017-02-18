<?php

class Category_service_model extends HZ_Model {
	public function __construct() {
		parent::__construct();
		$this->load->model('dao/category_dao_model','cata_dao');
	}

	public function cateList() {
		$res = $this->cata_dao->cateList();
		$ret = array('code' => 0);		
		$ret['data'] = $res;
		return $ret;
	}

	//传输
	public function cateGet($where) {
		$ret = array('code'=>0);
		$res = $this->cata_dao->cateGet($where);
		$ret['data'] = $res;
		return $ret;
	}

	//验证添加的数据
	public function cateSave($data) {
		$ret = array('code' => 0);
		//数据验证
		$validationConfig = array(
			array(
				'value' => $data['Fcategory_name'],
				'rules' => 'required',
				'filed' => '分类名称'
			),
			array(
				'value' => $data['Fremark'],
				'rules' => 'required',
				'filed' => '分类描述'
			),
		);
		//循环判断数据
		foreach($validationConfig as $v) {
			$resValidation = validationData($v['value'],$v['rules'],$v['filed']);
			if(!empty($resValidation)) {
				return $resValidation;//返回数据
			}
		}
		$res = $this->cata_dao->cateSave($data);
		if($res) {
			return $ret;
		} else {
			return $ret['code'] = 'promo_error_4';
		}
	}

	public function cateUpdate($where,$data) {
		$ret = array('code' => 0);//code为状态码，0为无错误,默认正确通过
		if(!isset($where['Fcategory_id']) && empty($where['Fcategory_id'])) {
			$ret['code'] = 'system_error_2';
			return $ret;
		}
		$cat = $this->cata_dao->getCateInfoByCateId($where['Fcategory_id']);
		if(empty($cat)) {
			$ret['code'] = 'promo_error_2';//不存在
			return $ret;
		}
		$cate = $this->cata_dao->cateUpdate($where,$data);
		if($cate) {
			return $ret;
		} else {
			$ret['code'] = 'promo_error_5';
			return $ret;
		}
	}

	//删除分类
	public function cateDel($where) {
		$ret = array('code' => 0);
		if(!isset($where['Fcategory_id']) && empty($where['Fcategory_id'])) {
			$ret['code'] = 'system_error_2';
			return $ret;
		}
		$cat = $this->cata_dao->getCateInfoByCateId($where['Fcategory_id']);
		if(empty($cat)) {
			$ret['code'] = 'promo_error_2';
			return $ret;
		}
		$cate = $this->cata_dao->cateDel($where['Fcategory_id']);
		if($cate) {
			return $ret;
		} else {
			return $ret['code'] = 'promo_error_6';
		}
	}
}