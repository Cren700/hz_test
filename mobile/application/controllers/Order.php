<?php

/**
 * Order.php
 * Author   : cren
 * Date     : 2016/12/29
 * Time     : 上午12:08
 */
class Order extends BaseControllor
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/order_service_model', 'order_service');
    }

    /**
     * 订单详情
     */
    public function detail()
    {
        $option = array(
            'order_no' => $this->input->get('order_no'),
            'user_id' => $this->_user_id
        );
        $res = $this->order_service->orderDetail($option);
        if ($res['code']!=0){
            $this->jump404($res['msg']);
        }
        $this->smarty->assign('info', $res['data']);
        $this->smarty->display('order/detail.tpl');


    }

    // 预下单页面
    public function preview()
    {
        $cid = $this->input->get('cid', true);
        $res = $this->order_service->previewByCid($cid);
        if ($res['code']!=0){
            $this->jump404($res['msg']);
        }

        $this->smarty->assign('info', $res['data']);
        $this->smarty->display('order/preview.tpl');
    }

    // 预下单页面
    public function insPreview()
    {
        $pid = $this->input->get('pid', true);
        $res = $this->order_service->previewByPid($pid);
        if ($res['code']!=0){
            $this->jump404($res['msg']);
        }
        $this->smarty->assign('info', $res['data']);
        $this->smarty->display('order/insPreview.tpl');
    }

    /**
     * 通过购物车下单页面
     */
    public function create()
    {
        $id = $this->input->get('id', true);
        $res = $this->order_service->create($id);
        if($res['code'] === 0) {
            $this->jump(getBaseUrl('/pay/wxpay.html?out_trade_no='.$res['data']['Forder_no']));
        } else {
            $this->jump404($res['msg'], $res['code']);
        }
    }
    
    /**
     * 立即购买
     */
    public function insCreate()
    {
        $id = $this->input->get('id', true);
        $res = $this->order_service->insCreate($id);
        if($res['code'] === 0) {
            $this->jump(getBaseUrl('/pay/wxpay.html?out_trade_no='.$res['data']['Forder_no']));
        } else {
            $this->jump404($res['msg'], $res['code']);
        }
    }

    /**
     * 理赔页面
     */
    public function claims()
    {
        $option = array(
            'order_no' => $this->input->get('id'),
        );
        $jsArr = array(
            'jquery.Huploadify.js',
            'order_claims.js'
        );
        $cssArr = array('Huploadify.css');
        $this->smarty->assign('is_new', 1);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('Forder_no', $option['order_no']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('order/claims.tpl');
    }

    /**
     * 保存用户信息
     */
    public function saveClaims()
    {
        $option = $this->input->post();//提交的数据
        $option['user_id'] = $this->_user_id;
        $res = $this->order_service->saveClaims($option);
        if ($res['code'] != 0) {
            $this->jump404($res['msg']);
        } else {
            $url = getBaseUrl('/info/planList.html');
            $this->jump($url);
        }
    }

    public function claimsDetail()
    {
        $option = array(
            'order_no' => $this->input->get('id'),
            'user_id' => $this->_user_id
        );
        $jsArr = array(
            'jquery.Huploadify.js',
            'order_claims.js'
        );
        $cssArr = array('Huploadify.css');
        $res = $this->order_service->claimsDetail($option);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('Forder_no', $option['order_no']);
        $this->smarty->assign('claims', isset($res['data']) ? $res['data'] : array());
        $this->smarty->display('order/claims.tpl');
    }

    /**
     * 更新用户信息
     */
    public function updateClaims()
    {
        $option = $this->input->post();//提交的数据
        $res = $this->order_service->updateClaims($option);
        if ($res['code'] != 0) {
            $this->jump404($res['msg']);
        } else {
            $url = getBaseUrl('/info/planList.html');
            $this->jump($url);
        }
    }

}