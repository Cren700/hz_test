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
        $this->load->model('service/posts_service_model', 'post_service');
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
        $this->smarty->assign('praiseInfo', $praiseList['data']);
        $this->smarty->display('info/praiseList.tpl');
    }

    public function doPraise()
    {
        $option = array(
            'post_id' => $this->input->post('post_id'),
        );
        $res = $this->info_service->doPraise($option);
        echo json_encode_data($res);
    }


    /**
     * 收藏文章列表
     */
    public function commentList()
    {
        $option = array(
            'user_id' => $this->_user_id
        );
        $commentList = $this->info_service->commentList($option);
        $this->smarty->assign('commentInfo', $commentList['data']);
        $this->smarty->display('info/commentList.tpl');
    }
    
    /**
     * 媒体文章列表
     */
    public function medium()
    {
        $jsArr = array('medium.js');
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('info/medium.tpl');
    }

    public function mediumQuery()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'user_type' => 2,
            'user_id'  => $this->_uid,
        );
        $cate = $this->post_service->getCate();
        $cate = isset($cate['data']['list']) ? $cate['data']['list'] : array();
        $tmp = array();
        foreach ($cate as $c) {
            $tmp[$c['Fpost_category_id']] = $c['Fcategory_name'];
        }
        $posts = $this->info_service->mediumQuery($option);
        $this->smarty->assign('cate', $tmp);
        $this->smarty->assign('info', $posts['data']);
        echo $this->smarty->display('info/mediumList.tpl');
    }

}