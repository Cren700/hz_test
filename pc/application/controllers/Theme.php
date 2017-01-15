<?php

/**
 * Theme.php
 * Author   : cren
 * Date     : 2016/12/21
 * Time     : 下午9:27
 */
class Theme extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/theme_service_model', 'theme_service');
        $this->smarty->assign('model', 'theme');
    }

    public function index()
    {
        $cate_id = $this->input->get('id');
        $cssArr = array('bootstrap.min.css');
        $jsArr = array('theme_index.js');
        $this->smarty->assign('cate_id', $cate_id);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('theme/index.tpl');
    }

    public function getPostsList()
    {
        $cate = $this->theme_service->getCate(); // 资讯分类
        if($cate['code'] == 0 && count($cate['data']['list'])) {
            $cate = array_column($cate['data']['list'], 'Fpost_category_id');
        }
        $option = array(
            'post_category_id' => intval($this->input->get('post_category_id')) ? : $cate,
            'post_status' => 3, // 已发布
            'p' => $this->input->get('p') ? : 1,
            'page_size' => $this->input->get('page_size') ? : 10,
        );
        $posts = $this->theme_service->getPostsList($option); // 获取资讯信息
        $postsList = array();
        if (isset($posts['data']['list'])) {
            $postsList = $posts['data']['list'];
        }
        $this->smarty->assign('list', $postsList);
        $this->smarty->display('theme/list.tpl');
    }

}