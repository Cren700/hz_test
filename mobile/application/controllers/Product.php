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
//        p($res);
        $cssArr = array(
            'bootstrap.min.css',
            'swiper.min.css',
            'font-awesome.css'
        );
        if ($res['code'] !== 0) {
            $this->jump404();
        }
        $jsArr = array(
            'product_detail.js',
            'swiper.min.js',
            'jquery.min.js'
        );
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
        $cssArr = array('bootstrap.min.css');
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('info', $data);
        $this->smarty->assign('keyword', $this->input->get('keyword'));
        $this->smarty->display('product/search.tpl');
    }

    /**
     * 提交评论
     */
    public function submitComment()
    {
        $data = array(
            'comment_pro_id' => 57,//$this->input->post('pro_id', true),
            'comment_uid' => 6,//$this->input->post('uid', true),
            'comment_user_name' => 'user001',//$this->input->post('user_name', true),
            'comment_ip' => get_client_ip(),
            'comment_content' => '12341234',//$this->input->post('content', true),
            'start1' => (int)$this->input->post('start1', true) ? : 5,
            'start2' => (int)$this->input->post('start2', true) ? : 5,
            'start3' => (int)$this->input->post('start3', true) ? : 5,
            'start4' => (int)$this->input->post('start4', true) ? : 5,
        );
        $res = $this->product_service->submitComment($data);
        echo outputResponse($res);
        die;
        $has = $this->product_service->hasCommentPower($this->input->post('pro_id', true), $this->_user_id);
        if ($has) {
            $data = array(
                'comment_pro_id' => $this->input->post('pro_id', true),
                'comment_uid' => $this->input->post('uid', true),
                'comment_user_name' => $this->input->post('user_name', true),
                'comment_ip' => get_client_ip(),
                'comment_content' => $this->input->post('content', true),
                'start1' => (int)$this->input->post('start1', true) ? : 5,
                'start2' => (int)$this->input->post('start2', true) ? : 5,
                'start3' => (int)$this->input->post('start3', true) ? : 5,
                'start4' => (int)$this->input->post('start4', true) ? : 5,
            );
            $res = $this->product_service->submitComment($data);
            echo outputResponse($res);
        } else {
            echo array('code' => -1, 'msg' => '你没有购买过该产品,不能评论');
        }
    }

    /**
     * 删除评论
     */
//    public function delComment()
//    {
//        $where = array(
//            'Fcomment_id' => $this->input->post('comment_id', true),
//        );
//        $res = $this->product_service->delComment($where);
//        echo outputResponse($res);
//    }

    public function calClaimsTotal()
    {
        $where =array('product_id' => 41);
        $res = $this->product_service->calClaimsTotal($where);
        echo outputResponse($res);
    }
}