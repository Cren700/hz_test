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

    /**
     * 批量删除广告
     */
    public function batchDelPromo()
    {
        $ids = $this->input->post('ids', true);
        $res = $this->promo_service->batchDelPromo($ids);
        echo outputResponse($res);
    }

    public function getPromoRandom()
    {
        $res = $this->promo_service->getPromoRandom();
        echo outputResponse($res);
    }

    public function getPromoRule()
    {
        $res = $this->promo_service->getPromoRule();
        echo outputResponse($res);
    }

    public function getRuleById()
    {
        $where = array('Frule_id' => $this->input->get('rule_id', TRUE));
        $res = $this->promo_service->getRuleByWhere($where);
        echo outputResponse($res);
    }

    public function getRuleByType()
    {
        $where = array('Fshare_type' => $this->input->get('share_type', TRUE));
        $res = $this->promo_service->getRuleByWhere($where);
        echo outputResponse($res);
    }

    //添加推广规则
    public function addPromoRule() {
        $data = array(
            'Fshare_type' => $this->input->post('share_type',TRUE),
            'Famount' => $this->input->post('amount',TRUE),
            'Fintegral'=> $this->input->post('integral',TRUE),
            'Fcreate_time' => time()
        );
        $res = $this->promo_service->addPromoRule($data);
        echo outputResponse($res);
    }

    //保存推广规则
    public function savePromoRule() {
        $where = array('Frule_id' => $this->input->post('rule_id'));
        $data = array(
            'Fshare_type' => $this->input->post('share_type',TRUE),
            'Famount' => $this->input->post('amount',TRUE),
            'Fintegral'=> $this->input->post('integral',TRUE),
        );
        $res = $this->promo_service->savePromoRule($where,$data);
        echo outputResponse($res);
    }
    
    // 更改状态
    public function ruleStatus()
    {
        $where = array('Frule_id' => $this->input->post('rule_id'));
        $data = array('Fstatus' => $this->input->post('status'));

        $res = $this->promo_service->ruleStatus($where,$data);
        echo outputResponse($res);
    }

    // 添加返利记录
    public function addOrderExpand()
    {
        $data = array(
            'Fuser_id' => $this->input->post('user_id',TRUE),//推荐者ID
            'Famount' => $this->input->post('amount',TRUE),// 返利数额
            'Fmember'=> $this->input->post('member',TRUE),// 注册用户
            'Fmember_time'=> $this->input->post('member_time',TRUE),// 用户注册时间
            'Forder_no'=> $this->input->post('order_no',TRUE),// 订单no
            'Fcreate_time' => time()
        );
        $res = $this->promo_service->addOrderExpand($data);
        echo outputResponse($res);
    }

    // 用户反馈
    public function sendReport()
    {
        $data = array(
            'Ftype' => $this->input->post('type'),
            'Frelation' => $this->input->post('relation'),
            'Fcontent' => $this->input->post('content')
        );
        $res = $this->promo_service->sendReport($data);
        echo outputResponse($res);
    }

    // 反馈信息列表
    public function queryFreeback()
    {
        $option = array(
            'Fstatus' => $this->input->get('status'),
            'p' => $this->input->get('p') ? : 1,
            'page_size' => $this->input->get('page_size'),
        );
        $res = $this->promo_service->queryFreeback($option);
        echo outputResponse($res);
    }

    // 处理反馈状态
    public function freebackStatus()
    {
        $data = array(
            'Fstatus' => $this->input->post('status'),
        );
        $where = array(
            'Fid'   => $this->input->post('id')
        );
        $res = $this->promo_service->freebackStatus($data, $where);
        echo outputResponse($res);
    }

    // 删除反馈状态
    public function delFreeback()
    {
        $where = array('Fid' => $this->input->get('id'));
        $res = $this->promo_service->delFreeback($where);
        echo outputResponse($res);
    }


    //添加广告
    public function imageAdd() {
        $data = array(
            'Fimage_url' => $this->input->post('image_url',TRUE),
            'Furl' => $this->input->post('url',TRUE),
            'Flevel' => $this->input->post('level',TRUE),
            'Fcreate_time' => time()
        );
        $res = $this->promo_service->imageAdd($data);//调用模型验证数据
        echo outputResponse($res);
    }

    //保存
    public function imageSave() {
        $where = array('Fid' => $this->input->post('id'));
        $data = array(
            'Fimage_url' => $this->input->post('image_url',TRUE),
            'Furl' => $this->input->post('url',TRUE),
            'Flevel' => $this->input->post('level',TRUE),
        );
        $res = $this->promo_service->imageSave($where,$data);
        echo outputResponse($res);
    }

    //查询广告
    public function imageQuery() {
        $option = array(
            'p' => $this->input->get('p') ? : 1,
            'page_size' => $this->input->get('page_size'),
        );
        $res = $this->promo_service->imageQuery($option);
        echo outputResponse($res);
    }

    public function getImageById() {
        $where = array(
            'Fid' => $this->input->get('id')
        );
        $res = $this->promo_service->getImageById($where);
        echo outputResponse($res);
    }

    // 更新状态
    public function changeImageStatus() {
        $data = array(
            'Fstatus' => $this->input->post('status'),
        );
        $where = array(
            'Fid'   => $this->input->post('id')
        );
        $res = $this->promo_service->changeImageStatus($data, $where);
        echo outputResponse($res);
    }

    //删除
    public function delImage()
    {
        $where = array('Fid' => $this->input->post('id'));
        $res = $this->promo_service->delImage($where);
        echo outputResponse($res);
    }

    public function getPcImages()
    {
        $res = $this->promo_service->getPcImages();
        echo outputResponse($res);
    }

}