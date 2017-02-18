<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends BaseController {
	public function __construct() {
		parent::__construct();
		$this->load->model('service/category_service_model','cate_service');
	}

	//分类列表
	public function cateList() {
		$res = $this->cate_service->cateList();
		echo outputResponse($res);
	}

	//获取分类
	public function cateGet() {
		$where = array(
			'Fcategory_id' => $this->input->get('category_id')
		);
		$res = $this->cate_service->cateGet($where);
		echo outputResponse($res);//输出
	}

	//添加分类
	public function cateSave() {
		//声明空数组
		$data = array();
		//接收添加的数据
		$data['Fcategory_name'] = $this->input->post('category_name');
		$data['Fremark'] = $this->input->post('remark');
		$res = $this->cate_service->cateSave($data);
		echo outputResponse($res);//输出
	}

	//更新分类
	public function cateUpdate() {
		$data = array(
			'Fcategory_name' => $this->input->post('category_name'),
			'Fremark'		 => $this->input->post('remark')
		);
		$where = array('Fcategory_id' => $this->input->post('category_id'));//接收指定id
		$res = $this->cate_service->cateUpdate($where,$data);
		echo outputResponse($res);
	}

	//删除分类
	public function cateDel() {
		$where = array('Fcategory_id' => $this->input->get('id'));
		$res = $this->cate_service->cateDel($where);
		echo outputResponse($res);//输出状态提示跟数据
	}
}
