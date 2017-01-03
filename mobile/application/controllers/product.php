<?php

/**
 * product.php
 * Author   : cren
 * Date     : 2016/11/27
 * Time     : 下午4:01
 */
class Product extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/product_service_model', 'product_service');
    }

    public function index()
    {
        $cate_id = $this->input->get('id');
        $cate = $this->product_service->getCate();
        $cateData = array();
        if ($cate['code']===0) {
            $cateData = $cate['data']['list'];
        }
        $jsArr = array('product_index.js');
        $cssArr = array('bootstrap.min.css');
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cate', $cateData);
        $this->smarty->assign('cate_id', $cate_id);
        $this->smarty->display('product/index.tpl');
    }

    public function detail($id)
    {
        $id = $id ? : $this->input->get('id');
        $res = $this->product_service->detail($id);
        $cssArr = array(
            'bootstrap.min.css',
            'swiper.min.css',
            'font-awesome.css'
        );
        if ($res['code'] !== 0) {
            $this->jump404();
        }
        $jsArr = array('product_detail.js');
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('info', $res['data']);
        $this->smarty->display('product/detail.tpl');
    }

    public function getProductList()
    {
        $option = array(
            'category_id' => intval($this->input->get('category_id')) ? : '',
            'product_status' => array(2,4), // 已发布/已完成
            'p' => $this->input->get('p') ? : 1,
            'page_size' => 3//$this->input->get('page_size'),
        );
        $res = $this->product_service->getProductList($option);
        $this->smarty->assign('info', $res['data']);
        $this->smarty->display('product/list.tpl');
    }

    public function collect()
    {
        $option = array(
            'product_id' => $this->input->get('product_id'),
            'user_id' => $this->_user_id
        );
        $res = $this->product_service->collect($option);
        echo json_encode_data($res);

    }
}