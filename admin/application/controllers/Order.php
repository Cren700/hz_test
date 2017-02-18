<?php

/**
 * Order.php
 * Author   : cren
 * Date     : 2016/12/27
 * Time     : 下午10:28
 */
class Order extends BaseControllor
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/order_service_model', 'order_service');
    }

    public function index()
    {
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'order/index.js'
        );
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('order/index.tpl');
    }

    public function query()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'min_date' => $this->input->get('min_date', true),
            'max_date' => $this->input->get('max_date', true),
            'order_no' => $this->input->get('order_no', true),
            'product_id' => $this->input->get('product_id', true),
            'user_id' => $this->input->get('user_id', true),
            'store_id'  => $this->_user_type == 1 ? '' : $this->_uid,// 商户ID
            'order_status' => $this->input->get('order_status', true),
        );
        $order = $this->order_service->query($option);
        $this->smarty->assign('info', $order['data']);
        $this->smarty->assign('page', $this->page($order['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('order/list.tpl');
    }
    
    public function orderStatus()
    {
        $option = array(
            'order_status' => $this->input->post('status', true),
            'order_no' => $this->input->post('order_no', true),
        );
        $res = $this->order_service->orderStatus($option);
        echo json_encode_data($res);
    }

    /**
 * 提现
 */
    public function tixian()
    {
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'order/tixian.js'
        );
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('order/tixian.tpl');
    }

    public function queryTixian()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'min_date' => $this->input->get('min_date', true),
            'max_date' => $this->input->get('max_date', true),
            'order_no' => $this->input->get('order_no', true),
            'user_id' => $this->input->get('user_id', true),
            'order_status' => $this->input->get('order_status', true),
        );
        $order = $this->order_service->queryTixian($option);
        $this->smarty->assign('info', $order['data']);
        $this->smarty->assign('page', $this->page($order['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('order/tixianList.tpl');
    }
    public function txOrderStatus()
    {
        $option = array(
            'order_status' => $this->input->post('status', true),
            'order_no' => $this->input->post('order_no', true),
        );
        $res = $this->order_service->txOrderStatus($option);
        echo json_encode_data($res);
    }

    /**
     * 理赔列表
     */
    public function claims()
    {
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'order/claim.js'
        );
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('order/claim.tpl');
    }

    public function queryClaims()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'min_date' => $this->input->get('min_date', true),
            'max_date' => $this->input->get('max_date', true),
            'order_no' => $this->input->get('order_no', true),
            'user_id' => $this->input->get('user_id', true),
            'status' => $this->input->get('status', true),
        );
        $order = $this->order_service->queryClaims($option);
        $this->smarty->assign('info', $order['data']);
        $this->smarty->assign('page', $this->page($order['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('order/claimList.tpl');
    }
    
    public function claimsDetail()
    {
        $option =array(
            'id' => $this->input->get('id')
        );

        $jsArr = array(
            'plugin/jquery.validate.js',
            'plugin/jquery.placeholder.min.js',
            'order/claimsDetail.js',
            'uploadify/jquery.uploadify.min.js',
        );
        $cssArr = array('uploadify.css');
        $info = $this->order_service->claimsDetail($option);
        if ($info['code']) {
            $this->jump404($info['msg']);
        }
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('claims', isset($info['data']) ? $info['data'] : array());
        $this->smarty->display('order/claimsDetail.tpl');
    }
    
    public function claimOrderStatus()
    {
        $option = array(
            'status' => $this->input->post('status', true),
            'id' => $this->input->post('id', true),
        );
        $res = $this->order_service->claimOrderStatus($option);
        echo json_encode_data($res);
    }

    /**
     * 更新理赔信息
     */
    public function updateClaims()
    {
        $option = $this->input->post();//提交的数据
        $res = $this->order_service->updateClaims($option);
//        p($res);
        if ($res['code'] != 0) {
            $this->jump404($res['msg']);
        } else {
            $url = getBaseUrl('/order/claims.html');
            $this->jump($url);
        }
    }
}
