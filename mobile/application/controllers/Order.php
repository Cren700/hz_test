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
    
    public function index()
    {
        
    }

    // 预下单页面
    public function preview()
    {
        $cid = $this->input->get('cid', true);
        $res = $this->order_service->previewByCid($cid);
        if ($res['code']!=0){
            $cssArr = array(
                'bootstrap.min.css',
                'swiper.min.css',
                'font-awesome.css'
            );
            $msg = $res['msg'];
            $this->smarty->assign('msg', $msg);
            $this->smarty->assign('cssArr', $cssArr);
            $this->smarty->display('errors/page.tpl');
            die;
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
            // 没有数据
            $this->jump404();
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
        p($res);
        $this->smarty->assign('info', $res);
        $this->smarty->display('order/pay.tpl');
    }
    
    /**
     * 立即购买
     */
    public function insCreate()
    {
        $id = $this->input->get('id', true);
        $res = $this->order_service->insCreate($id);
        p($res);
        $this->smarty->assign('info', $res);
        $this->smarty->display('order/pay.tpl');
    }
    

}