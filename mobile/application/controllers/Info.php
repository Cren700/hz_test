<?php

/**
 * Info.php
 * Author   : cren
 * Date     : 2017/1/2
 * Time     : 下午5:24
 */
class Info extends BaseControllor
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/info_service_model', 'info_service');
    }

    public function index()
    {
        $this->smarty->display('info/index.tpl');
    }

    /**
     * 订单列表
     */
    public function orderList()
    {
        $option = array(
            'user_id' => $this->_user_id
        );
        $orderList = $this->info_service->orderList($option);
        if (!isset($orderList['data']) || empty($orderList['data']) ){
            // 没有数据
            $this->jump404();
        }
        $this->smarty->assign('info', $orderList['data']);
        $this->smarty->display('info/orderList.tpl');
    }

    /**
     * 关注资讯列表
     */
    public function praiseList()
    {
        $option = array(
            'user_id' => $this->_user_id
        );
        $praiseList = $this->info_service->praiseList($option);
        if (!isset($praiseList['data']) || empty($praiseList['data']) ){
            // 没有数据
            $this->jump404();
        }
        $this->smarty->assign('info', $praiseList['data']);
        $this->smarty->display('info/praiseList.tpl');
    }

    /**
     * 收藏产品列表
     */
    public function collectList()
    {
        $option = array(
            'user_id' => $this->_user_id
        );
        $collectList = $this->info_service->collectList($option);
//        p($collectList);
        if (!isset($collectList['data']) || empty($collectList['data']) ){
            // 没有数据
            $this->jump404();
        }
        $this->smarty->assign('info', $collectList['data']);
        $this->smarty->display('info/collectList.tpl');
    }
}