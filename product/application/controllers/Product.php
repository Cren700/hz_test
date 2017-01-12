<?php

/**
 * Product.php
 * Author   : cren
 * Date     : 2016/11/27
 * Time     : 下午11:22
 */
class Product extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/product_service_model', 'product_service');
    }

    /**
     * 查询
     */
    public function query()
    {
        $option = array(
            'Fproduct_id' => $this->input->get('product_id'),
            'Fcategory_id' => $this->input->get('category_id'),
            'Fstore_id' => $this->input->get('store_id'),
            'Fproduct_name' => $this->input->get('product_name'),
            'Fproduct_status' => $this->input->get('product_status'),
            'Fis_del' => $this->input->get('is_del'),
            'Fstore_id' => $this->input->get('store_id'),
            'p' => $this->input->get('p') ? : 1,
            'page_size' => $this->input->get('page_size'),
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
        );
        $res = $this->product_service->query($option);
        echo outputResponse($res);
    }

    /**
     * 获取某产品
     */
    public function getProductByPid()
    {
        $where = array(
            'Fproduct_id'  => $this->input->get('product_id')// 产品id
        );
        $res = $this->product_service->getProductByPid($where);
        echo outputResponse($res);
    }

    /**
     * 添加产品
     */
    public function add()
    {
        $data = array(
            'Fstore_id' => $this->input->post('store_id'),
            'Fproduct_name' => $this->input->post('product_name'),
            'Fproduct_price' => $this->input->post('product_price'),
            'Fproduct_num' => $this->input->post('product_num'),
            'Fcategory_id' => $this->input->post('category_id'),
            'Fdescription' => $this->input->post('description'),
            'Fheight_amount' => $this->input->post('height_amount'),
            'Fscope_insurance' => $this->input->post('scope_insurance'),
            'Fscope_age' => $this->input->post('scope_age'),
            'Fobservation_period' => $this->input->post('observation_period'),
            'Fcontent' => $this->input->post('content'),
            'Frule_title' => $this->input->post('rule_title'), // 计划规则 标题
            'Frule_description' => $this->input->post('rule_description'), // 计划规则 描述
            'Fprocess_title' => $this->input->post('process_title'), // 申请流程 标题
            'Fprocess_description' => $this->input->post('process_description'), // 申请流程 描述
            'Fquestion' => $this->input->post('question'),// 常见问题
            'Fanswer' => $this->input->post('answer'),// 常见问题
            'Fpledge_title' => $this->input->post('pledge_title'), // 公约
            'Fpledge_content' => $this->input->post('pledge_content'), // 公约
            'Fcreate_time'  => time(),
            'Fupdate_time'  => time(),
        );
        $res = $this->product_service->add($data);
        echo outputResponse($res);
    }

    /**
     * 更新分类
     */
    public function update()
    {
        $where = array('Fproduct_id' => $this->input->post('product_id'));
        $data = array(
            'Fstore_id' => $this->input->post('store_id'),
            'Fproduct_name' => $this->input->post('product_name'),
            'Fproduct_price' => $this->input->post('product_price'),
            'Fproduct_num' => $this->input->post('product_num'),
            'Fcategory_id' => $this->input->post('category_id'),
            'Fdescription' => $this->input->post('description'),
            'Fcoverimage' => $this->input->post('coverimage'),
            'Fheight_amount' => $this->input->post('height_amount'),
            'Fscope_insurance' => $this->input->post('scope_insurance'),
            'Fscope_age' => $this->input->post('scope_age'),
            'Fobservation_period' => $this->input->post('observation_period'),
            'Fcontent' => $this->input->post('content'),
            'Frule_title' => $this->input->post('rule_title'), // 计划规则 标题
            'Frule_description' => $this->input->post('rule_description'), // 计划规则 描述
            'Fprocess_title' => $this->input->post('process_title'), // 申请流程 标题
            'Fprocess_description' => $this->input->post('process_description'), // 申请流程 描述
            'Fquestion' => $this->input->post('question'),// 常见问题
            'Fanswer' => $this->input->post('answer'),// 常见问题
            'Fpledge_title' => $this->input->post('pledge_title'), // 公约
            'Fpledge_content' => $this->input->post('pledge_content'), // 公约
            'Fupdate_time'  => time(),
        );
        $res = $this->product_service->update($where, $data);
        echo outputResponse($res);
    }

    /**
     * 删除分类
     */
    public function del()
    {
        $where = array('Fproduct_id' => $this->input->get('id'));
        $res = $this->product_service->del($where);
        echo outputResponse($res);
    }

    /**
     * 更新状态
     */
    public function changeStatus()
    {
        $data = array(
            'Fproduct_status' => $this->input->post('status'),
            'Fis_del' => $this->input->post('is_del')
        );
        $where = array(
            'Fproduct_id'   => $this->input->post('pid')
        );
        $res = $this->product_service->changeStatus($data, $where);
        echo outputResponse($res);
    }

    /**
     * 收藏
     */
    public function collect()
    {
        $option = array(
            'Fuser_id' => $this->input->get('user_id'),
            'Fproduct_id' => $this->input->get('product_id')
        );
        $res = $this->product_service->collect($option);
        echo outputResponse($res);
    }

    /**
     * 收藏列表
     */
    public function queryCollect()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'Fproduct_id'   => $this->input->get('product_id'),
            'Fuser_id'   => $this->input->get('user_id'),
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
        );
        $res = $this->product_service->queryCollect($option);
        echo outputResponse($res);
    }

    /**
     * 我的收藏
     */
    public function getCollectListByUid()
    {
        $option = array('Fuser_id' => $this->input->get('user_id'));
        $res = $this->product_service->getCollectListByUid($option);
        echo outputResponse($res);
    }

    /**
     * 搜索
     */
    public function search()
    {
        $option = array('keyword' => $this->input->get('keyword'));
        $res = $this->product_service->search($option);
        echo outputResponse($res);
    }
}