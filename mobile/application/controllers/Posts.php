<?php

/**
 * Posts.php
 * Author   : cren
 * Date     : 2016/12/18
 * Time     : 下午10:15
 */
class Posts extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/posts_service_model', 'post_service');
    }

    public function index()
    {
        $option = array(
            'id' => $this->input->get('id')
        );
        $posts = $this->post_service->getPost($option);
        $relatedPosts = $this->post_service->relatedPosts($posts['data']);
        $jsArr = array(
            'post_detail.js'
        );
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('info', $posts['data']);
        $this->smarty->assign('related', $relatedPosts['data']);
        $this->smarty->display('posts/detail.tpl');
    }
}