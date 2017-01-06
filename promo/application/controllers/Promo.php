<?php
class Promo extends HZ_Controller {
	public function __construct() {
		parent::__construct();
        $this->load->model('service/promo_service_model','promo_service');
	}

	//添加广告
	public function add() {
		$data = array(
            'Factive_name' => $this->input->post('active_name',TRUE),
            'Fcategory_id' => $this->input->post('category_id',TRUE),
            'Fimage_path' => $this->input->post('image_path',TRUE),
            'Factive_url' => $this->input->post('active_url',TRUE),
            'Fvendor' => $this->input->post('vendor',TRUE),
            'Flevel' => $this->input->post('level'),
            'Fcreate_time' => time()
		);
        $res = $this->promo_service->add($data);//调用模型验证数据
        echo outputResponse($res);
	}

    //保存
    public function save() {
        $where = array('Factive_id' => $this->input->post('active_id'));
        $data = array(
            'Factive_name' => $this->input->post('active_name',TRUE),
            'Fcategory_id' => $this->input->post('category_id',TRUE),
            'Fimage_path' => $this->input->post('image_path',TRUE),
            'Factive_url' => $this->input->post('active_url',TRUE),
            'Fvendor' => $this->input->post('vendor',TRUE),
            'Flevel' => $this->input->post('level',TRUE),
            'Fcreate_time' => time()
        );
        $res = $this->promo_service->save($where,$data);
        echo outputResponse($res);
    }

    //查询广告
    public function query() {
        $option = array(
            'Fcategory_id' => $this->input->get('category_id'),
            'Factive_name' => $this->input->get('active_name'),
            'Fstatus' => $this->input->get('status'),
            'p' => $this->input->get('p') ? : 1,
            'page_size' => $this->input->get('page_size'),
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
        );
        $res = $this->promo_service->query($option);
        echo outputResponse($res);
    }

    public function getPromoById() {
        $where = array(
            'Factive_id' => $this->input->get('active_id')
        );
        $res = $this->promo_service->getPromoById($where);
        echo outputResponse($res);
    }
  
     // 更新状态  
    public function changeStatus() {
        $data = array(
            'Fstatus' => $this->input->post('status'),
        );
        $where = array(
            'Factive_id'   => $this->input->post('pid')
        );
        $res = $this->promo_service->changeStatus($data, $where);
        echo outputResponse($res);
    }

    //删除
    public function del()
    {
        $where = array('Factive_id' => $this->input->get('id'));
        $res = $this->promo_service->del($where);
        echo outputResponse($res);
    }
}