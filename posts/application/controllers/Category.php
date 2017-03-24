<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends BaseController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('service/category_service_model', 'cate_service');
	}

    /**
     * 分类列表
     */
	public function lists()
    {
        $option = array(
            'Fstatus' => $this->input->get('status'),
            'Fis_special' => $this->input->get('is_special'),
        );
        $res = $this->cate_service->lists($option);
        echo outputResponse($res);
    }

    /**
     * 获取分类
     */
    public function getCategory()
    {
        $where = array(
            'Fpost_category_id'  => $this->input->get('category_id')
        );
        $res = $this->cate_service->getCategory($where);
        echo outputResponse($res);
    }

    /**
     * 添加分类
     */
    public function add()
    {
        $data = array();
        $data['Fcategory_name'] = $this->input->post('category_name');
        $data['Fremark'] = $this->input->post('remark');
        $data['Fis_special'] = $this->input->post('is_special'); //是否为专栏分类
        $data['Fpriority'] = $this->input->post('priority');
        $data['Fstatus'] = 0; //状态0:禁用，1启用
        $data['Fcreate_time'] = time();
        $data['Fupdate_time'] = time();
        $res = $this->cate_service->add($data);
        echo outputResponse($res);
    }

    /**
     * 更新分类
     */
    public function update()
    {
        $data = array(
            'Fcategory_name' => $this->input->post('category_name'),
            'Fis_special' => $this->input->post('is_special'), //是否为专栏分类
            'Fremark' => $this->input->post('remark'),
            'Fpriority' => $this->input->post('priority'),
            'Fupdate_time' => time(),
        );
        $where = array('Fpost_category_id' => $this->input->post('category_id'));
        $res = $this->cate_service->update($where, $data);
        echo outputResponse($res);
    }

    /**
     * 删除分类
     */
    public function del()
    {
        $where = array('Fpost_category_id' => $this->input->get('id'));
        $res = $this->cate_service->del($where);
        echo outputResponse($res);
    }

    /**
     * 更新分类状态
     */
    public function cateStatus()
    {
        $data = array(
            'Fstatus' => $this->input->post('status'),
        );
        $where = array(
            'Fpost_category_id'   => $this->input->post('id')
        );
        $res = $this->cate_service->update($where, $data);
        echo outputResponse($res);
    }

}
