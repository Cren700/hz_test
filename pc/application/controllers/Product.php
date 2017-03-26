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
        $this->smarty->assign('model', 'product');
    }

    public function index()
    {
        $cate_id = $this->input->get('id');
        $cate = $this->product_service->getCate();
        $cateData = array();
        if ($cate['code']===0) {
            $cateData = isset($cate['data']['list']) ? $cate['data']['list'] : array();
        }
        $collectList = null; // 收藏产品
        if ($this->_user_id) {
            $option = array(
                'user_id' => $this->_user_id
            );
            $collect = $this->product_service->collectList($option);
            if (isset($collect['data'])) {
                $pid = array_column($collect['data']['list'], 'Fproduct_id');
                $collectList = join(',', $pid);
            }
        }
        $jsArr = array('product_index.js');
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('collect', $collectList);
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
            'page_size' => $this->input->get('page_size') ? : 10,
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

    public function search()
    {
        $option = array('keyword' => $this->input->get('keyword'));
        $data = $this->product_service->search($option);
//        p($data);
        $jsArr = array('search.js');
        $cssArr = array('bootstrap.min.css');
        $collectList = null; // 收藏产品
        if ($this->_user_id) {
            $option = array(
                'user_id' => $this->_user_id
            );
            $collect = $this->product_service->collectList($option);
            if (isset($collect['data'])) {
                $pid = array_column($collect['data']['list'], 'Fproduct_id');
                $collectList = join(',', $pid);
            }
        }
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('collect', $collectList);
        $this->smarty->assign('type', 'product');
        $this->smarty->assign('info', $data);
        $this->smarty->assign('keyword', $this->input->get('keyword'));
        $this->smarty->display('product/search.tpl');
    }
}