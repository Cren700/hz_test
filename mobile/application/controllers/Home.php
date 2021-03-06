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
        $cssArr = array('bootstrap.min.css');
        $jsArr = array('home_index.js');
        $this->smarty->assign('cate_id', $cate_id);
        $this->smarty->assign('cate', $cateList);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('home/index.tpl');
    }

    public function getPostsList()
    {
        $cate = $this->posts_service->getCate(); // 资讯分类
        $cateList = array();
        if (isset($cate['data']['list'])) {
            $cateList = $cate['data']['list'];
        }
        if($cate['code'] == 0 && count($cateList)) {
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

    // 推荐引导页
    public function recommendPage()
    {
        $cssArr = array('swiper.min.css');
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('info/recommendPage.tpl');
    }


}