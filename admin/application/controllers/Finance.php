<?php

/**
 * Finance.php
 * Author   : cren
 * Date     : 2017/1/4
 * Time     : 下午8:34
 */
class Finance extends BaseControllor
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/finance_service_model', 'finance_service');
    }

    /**
     * 个人账户
     */
    public function account()
    {
        $jsArr = array(
            'finance/account.js'
        );
        $cate = array('2' => '合作商户', '4' => '普通用户');
        $this->smarty->assign('cate', $cate);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('finance/account.tpl');
    }

    public function queryAccount()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'user_type' => $this->input->get('user_type'),
            'user_id' => $this->input->get('user_id'),
        );
        $info = $this->finance_service->queryAccount($option);
        $this->smarty->assign('page', $this->page($info['data']['count'], $option['p'], $option['page_size'], ''));
        $this->smarty->assign('info', $info['data']);
        $this->smarty->display('finance/accountList.tpl');
    }

    /**
     * 订单统计
     */
    public function orderStat()
    {
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'finance/orderStat.js'
        );
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('finance/orderStat.tpl');
    }

    public function queryOrderStat()
    {
        $option = array('date' => $this->input->get('date') ? : date('Y-m-d', time()));
        $info = $this->finance_service->queryOrderStat($option);
        $this->smarty->assign('info', $info['data']);
        $this->smarty->display('finance/orderStatContent.tpl');
    }

    /**
     * 销售排行
     */
    public function saleStat()
    {
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'finance/saleStat.js'
        );
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('finance/saleStat.tpl');
    }

    public function querySaleStat()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('page_size') ? : 10,
            'min_date' => $this->input->get('min_date', true),
            'max_date' => $this->input->get('max_date', true),
        );
        $info = $this->finance_service->querySaleStat($option);
        $this->smarty->assign('page', $this->page($info['data']['count'], $option['p'], $option['page_size'], ''));
        $this->smarty->assign('info', $info['data']);
        $this->smarty->display('finance/saleStatList.tpl');
    }

    public function payType()
    {
        $this->smarty->display('finance/paytype.tpl');
    }


}