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
            'Fstore_type' => $this->input->post('store_type'),
            'Fproduct_name' => $this->input->post('product_name'),
            'Fproduct_price' => $this->input->post('product_price'),
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
            'Fplan_tk_title' => $this->input->post('plan_tk_title'), // 计划条款
            'Fplan_tk_content' => $this->input->post('plan_tk_content'), // 计划条款
            'Fdemand_title' => $this->input->post('demand_title'), // 健康要求
            'Fdemand_content' => $this->input->post('demand_content'), // 健康要求
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
            'Fstore_type' => $this->input->post('store_type'),
            'Fproduct_name' => $this->input->post('product_name'),
            'Fproduct_price' => $this->input->post('product_price'),
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
            'Fplan_tk_title' => $this->input->post('plan_tk_title'), // 计划条款
            'Fplan_tk_content' => $this->input->post('plan_tk_content'), // 计划条款
            'Fdemand_title' => $this->input->post('demand_title'), // 健康要求
            'Fdemand_content' => $this->input->post('demand_content'), // 健康要求
            'Fupdate_time'  => time(),
        );
        $res = $this->product_service->update($where, $data);
        echo outputResponse($res);
    }

    /**
     * 更新产品的加入数量和案例数量
     */
    public function updateProductCnt()
    {
        $where = array(
            'Fproduct_id' => $this->input->post('Fproduct_id')
        );
        $data = array(
            'Fturnover' => $this->input->post('Fturnover'),
            'Fclaims_num' => $this->input->post('Fclaims_num')
        );
        $res = $this->product_service->updateProductCnt($where, $data);
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

    public function batchDelProduct()
    {
        $ids = $this->input->post('ids', true);
        $res = $this->product_service->batchDelProduct($ids);
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

    public function hasProductPower()
    {
        $option = array(
            'Fproduct_id' => $this->input->get('id', true),
            'Fstore_id' => $this->input->get('user_id', true),
            'Fstore_type' => $this->input->get('user_type', true)
        );
        $res = $this->product_service->hasProductPower($option);
        echo outputResponse($res);
    }

    /**
     * 提交评论
     */
    public function submitComment()
    {
        $data = array(
            'Fcomment_pro_id' => $this->input->post('comment_pro_id', true),
            'Fcomment_uid' => $this->input->post('comment_uid', true),
            'Fcomment_user_name' => $this->input->post('comment_user_name', true),
            'Fcomment_ip' => $this->input->post('comment_ip', true),
            'Fcomment_date' => time(),
            'Fcomment_content' => $this->input->post('comment_content'),
            'Fcomment_approved' => 1, // 默认通过审核
            'Fstart1' => $this->input->post('start1', true),
            'Fstart2' => $this->input->post('start2', true),
            'Fstart3' => $this->input->post('start3', true),
            'Fstart4' => $this->input->post('start4', true),
        );
        $res = $this->product_service->submitComment($data);
        echo outputResponse($res);
    }

    /**
     * 产品评论列表
     */
    public function getCommentListByPid()
    {
        $option = array(
            'Fcomment_pro_id' => $this->input->get('product_id', true)
        );
        $res = $this->product_service->getCommentListByPid($option);
        echo outputResponse($res);
    }

    /**
     * 评论列表
     */
    public function queryComment()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'Fcomment_pro_id'   => $this->input->get('pro_id', true),
            'Fcomment_user_name'   => $this->input->get('user_name', true),
            'Fcomment_approved' => $this->input->get('comment_approved', true),
            'min_date' => $this->input->get('min_date', true),
            'max_date' => $this->input->get('max_date', true),
        );
        $res = $this->product_service->queryComment($option);
        echo outputResponse($res);
    }

    /**
     * 更新评论状态
     */
    public function statusComment()
    {
        $data = array(
            'Fcomment_approved' => $this->input->post('status', true),
        );
        $where = array(
            'Fcomment_id' => $this->input->post('comment_id', true),
        );
        $res = $this->product_service->statusComment($data, $where);
        echo outputResponse($res);
    }

    /**
     * 删除评论
     */
    public function delComment()
    {
        $where = array(
            'Fcomment_id' => $this->input->post('comment_id', true),
        );
        $res = $this->product_service->delComment($where);
        echo outputResponse($res);
    }

    public function batchDelComment()
    {
        $ids = $this->input->post('ids', true);
        $res = $this->product_service->batchDelComment($ids);
        echo outputResponse($res);
    }

    public function maybeLike()
    {
        $option = array(
            'Fproduct_id' => $this->input->get('product_id')
        );
        $res = $this->product_service->maybeLike($option);
        echo outputResponse($res);
    }

    public function getStoreProduct()
    {
        $option = array(
            'Fstore_id' => $this->input->get('store_id'),
            'Fstore_type' => $this->input->get('type'),
            'p' => $this->input->get('p') ? : 1,
            'page_size' => $this->input->get('page_size'),
            'Fproduct_status' => 2
        );
        $res = $this->product_service->query($option);
        echo outputResponse($res);
    }

}