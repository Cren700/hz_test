<?php

/**
 * Home.php
 * Author   : cren
 * Date     : 2016/12/18
 * Time     : 下午8:50
 */
class Home extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/posts_service_model', 'posts_service');
        $this->smarty->assign('model', 'posts');
    }

    public function index()
    {
        $cate_id = $this->input->get('id');
        $cate = $this->posts_service->getCate(); // 资讯分类
        $cateList = array();
        if (isset($cate['data']['list'])) {
            $cateList = $cate['data']['list'];
        }
        $banner = $this->posts_service->getBanners();
        $threeNews = $this->posts_service->getThreeNews();
        $images = $this->posts_service->getPcImages();
        $jsArr = array('home_index.js', 'slider.js');
        $this->smarty->assign('banner', $banner['data']);
        $this->smarty->assign('images', $images['data']);
        $this->smarty->assign('threeNews', $threeNews['data']);
        $this->smarty->assign('cate_id', $cate_id);
        $this->smarty->assign('cate', $cateList);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('home/index.tpl');
    }

    public function getPostsList()
    {
        $cate = $this->posts_service->getCate(); // 资讯分类
        if($cate['code'] == 0 && count($cate['data']['list'])) {
            $cate = array_column($cate['data']['list'], 'Fpost_category_id');
        }
        $option = array(
            'post_category_id' => intval($this->input->get('post_category_id')) ? : $cate,
            'post_status' => 3, // 已发布
            'p' => $this->input->get('p') ? : 1,
            'page_size' => $this->input->get('page_size') ? : 10,
        );
        $posts = $this->posts_service->getPostsList($option); // 获取资讯信息
        $postsList = array();
        if (isset($posts['data']['list'])) {
            $postsList = $posts['data']['list'];
        }
        $this->smarty->assign('list', $postsList);
        $this->smarty->display('home/list.tpl');
    }

    public function queryEvents()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
        );
        $events = $this->posts_service->queryEvents($option);
        $this->smarty->assign('info', $events['data']);
        $this->smarty->assign('p', $option['p']);
        echo $this->smarty->display('home/eventList.tpl');
    }

    public function sendReport()
    {
        $option = array(
            'relation' => $this->input->post('relation'),
            'content' => $this->input->post('content'),
            'type' => 1, // 需求报道
        );
        $res = $this->posts_service->sendReport($option);
        echo json_encode_data($res);
    }

}