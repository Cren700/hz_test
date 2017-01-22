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
        $this->smarty->assign('model', 'info');
    }

    public function index()
    {
        $this->load->model('service/user_service_model');
        $info = $this->user_service_model->detail();
        $this->smarty->assign('user', $info['data']);
        $this->smarty->display('info/index.tpl');
    }

    /**
     * 我的计划
     */
    public function planList()
    {
        $option = array(
            'user_id' => $this->_user_id
        );
        $collectList = $this->info_service->collectList($option);
        $orderList = $this->info_service->orderList($option);
        $jsArr = array('info_plan.js');
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('orderInfo', isset($orderList['data']) ? $orderList['data'] : array());
//        p($collectList);
        $this->smarty->assign('collectList', isset($collectList['data']) ? $collectList['data'] : array());
        $this->smarty->display('info/planList.tpl');
    }

    /**
     * 收藏文章列表
     */
    public function collectList()
    {
        $option = array(
            'user_id' => $this->_user_id
        );
        $praiseList = $this->info_service->praiseList($option);
        if (!isset($praiseList['data']) || empty($praiseList['data']) ){
            // 没有数据
            $this->jump404();
        }
        $this->smarty->assign('praiseInfo', $praiseList['data']);
        $this->smarty->display('info/praiseList.tpl');
    }
}