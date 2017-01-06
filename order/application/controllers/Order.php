<?php

/**
 * Order.php
 * Author   : cren
 * Date     : 2016/12/26
 * Time     : 下午11:31
 */
class Order extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/order_service_model', 'order_service');
    }

    public function createByPid()
    {
        $option = array(
            'Fproduct_id' => $this->input->post('product_id', true),
            'Fuser_id' => $this->input->post('user_id', true),
            'Fproduct_num' => $this->input->post('product_num',true) ? : 1
        );
        $res = $this->order_service->createByPid($option);
        echo outputResponse($res);
    }

    public function createByCid()
    {
        $option = array('Fid' => $this->input->post('id', true), 'Fuser_id' => $this->input->post('user_id', true));
        $res = $this->order_service->createByCid($option);
        echo outputResponse($res);
    }

    public function del()
    {

    }

    /**
     * 用户订单列表
     */
    public function getOderListByUid()
    {
        $option = array(
            'Fuser_id' => $this->input->get('user_id')
        );
        $res = $this->order_service->getOderListByUid($option);
        echo outputResponse($res);
    }

    //通过购物车获取数据
    public function previewByCid()
    {
        $option = array(
            'Fuser_id' => $this->input->get('user_id', TRUE),
            'Fid' => $this->input->get('id', TRUE)
        );
        $res = $this->order_service->previewByCid($option);
        echo outputResponse($res);
    }

    /**
     * 通过购物车获取数据
     */
    public function previewByPid()
    {
        $option = array(
            'Fproduct_id' => $this->input->get('product_id', TRUE)
        );
        $res = $this->order_service->previewByPid($option);
        echo outputResponse($res);
    }

    /**
     * 后台查询
     */
    public function query()
    {
        $option = array(
            'p' => $this->input->get('p', true) ? : 1 ,
            'page_size' => $this->input->get('n', true) ? : 10,
            'min_date' => $this->input->get('min_date', true),
            'max_date' => $this->input->get('max_date', true),
            'Forder_no' => $this->input->get('order_no', true),
            'Fproduct_id' => $this->input->get('product_id', true),
            'Fuser_id' => $this->input->get('user_id', true),
            'Fstore_id'  => $this->input->get('store_id', true),// 商户ID
            'Forder_status' => $this->input->get('order_status', true),
        );
        $res = $this->order_service->query($option);
        echo outputResponse($res);
    }

    public function orderStatus()
    {
        $option = array(
            'Forder_status' => $this->input->post('order_status', true),
            'Forder_no' => $this->input->post('order_no', true),
        );
        $res = $this->order_service->orderStatus($option);
        echo outputResponse($res);

    }

    /**
     * 后台提现查询
     */
    public function queryTxOrders()
    {
        $option = array(
            'p' => $this->input->get('p', true) ? : 1 ,
            'page_size' => $this->input->get('n', true) ? : 10,
            'min_date' => $this->input->get('min_date', true),
            'max_date' => $this->input->get('max_date', true),
            'Forder_no' => $this->input->get('order_no', true),
            'Fuser_id' => $this->input->get('user_id', true),
            'Forder_status' => $this->input->get('order_status', true),
        );
        $res = $this->order_service->queryTxOrders($option);
        echo outputResponse($res);
    }

    public function txOrderStatus()
    {
        $option = array(
            'Forder_status' => $this->input->post('order_status', true),
            'Forder_no' => $this->input->post('order_no', true),
        );
        $res = $this->order_service->txOrderStatus($option);
        echo outputResponse($res);
    }

    /**
     * 理赔查询
     */
    public function queryClaim()
    {
        $option = array(
            'p' => $this->input->get('p', true) ? : 1 ,
            'page_size' => $this->input->get('page_size', true) ? : 10,
            'min_date' => $this->input->get('min_date', true),
            'max_date' => $this->input->get('max_date', true),
            'Forder_no' => $this->input->get('order_no', true),
            'Fuser_id' => $this->input->get('user_id', true),
            'Fstatus' => $this->input->get('status', true),
        );
        $res = $this->order_service->queryClaim($option);
        echo outputResponse($res);
    }

    public function claimOrderStatus()
    {
        $option = array(
            'Fstatus' => $this->input->post('status', true),
            'Fid' => $this->input->post('id', true),
        );
        $res = $this->order_service->claimOrderStatus($option);
        echo outputResponse($res);
    }

    // 订单统计
    public function querySaleStat()
    {
        $option = array(
            'p' => $this->input->get('p', true) ? : 1 ,
            'page_size' => $this->input->get('page_size', true) ? : 20,
            'min_date' => $this->input->get('min_date', true),
            'max_date' => $this->input->get('max_date', true),
        );
        $res = $this->order_service->querySaleStat($option);
        echo outputResponse($res);
    }
}