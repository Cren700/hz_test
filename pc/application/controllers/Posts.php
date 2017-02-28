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
        $this->smarty->assign('model', 'posts');
    }

    public function index()
    {
        $option = array(
            'id' => $this->input->get('id')
        );
        $posts = $this->post_service->getPost($option);
        if (!isset($posts['data']) || empty($posts['data']) ){
            // 没有数据
            $this->jump404();
        }
        $seoArr = array(
            'keywords' => $posts['data']['Fpost_keyword'],
            'title' => $posts['data']['Fpost_title'],
            'description' => ''
        );
        $this->smarty->assign('seo', $seoArr);
        $relatedPosts = $this->post_service->relatedPosts($posts['data']); // 相关新闻
        $comment = $this->post_service->getCommentListByPid($option['id']); // 获取评论信息
        $praise = $this->post_service->getPraiseCountByPid($option['id']); // 关注数量
        $is_Praise = $this->post_service->getIsPraise($option['id']); // 是否关注
        $jsArr = array(
            'post_detail.js',
            'share.js',
            'slider.js'
        );
        $cssArr = array
        (
            'weixin.css'
        );
        $this->smarty->assign('id', $option['id']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('info', $posts['data']);
        $this->smarty->assign('comment', $comment);
        $this->smarty->assign('praise', $praise);
        $this->smarty->assign('is_Praise', $is_Praise);
        $this->smarty->assign('related', $relatedPosts['data']);
        $this->smarty->display('posts/detail.tpl');
    }

    public function submitComment()
    {
        $this->is_login();
        $option = array(
            'content' => $this->input->post('content'),
            'post_id' => $this->input->post('post_id'),
            'author_id' => $this->_uid,
            'author_name' => $this->_user_id,
            'author_ip' => get_client_ip(),
        );
        $res = $this->post_service->submitComment($option);
        echo json_encode_data($res);
    }
    
    public function doPraise()
    {
        $this->is_login();
        $option = array(
            'post_id' => $this->input->post('post_id'),
        );
        $res = $this->post_service->doPraise($option);
        echo json_encode_data($res);
    }

    public function search()
    {
        $option = array('keyword' => $this->input->get('keyword'));
        $data = $this->post_service->search($option);
//        p($data);
        $jsArr = array('search.js');
        $cssArr = array('bootstrap.min.css');
        $this->smarty->assign('type', 'posts');
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('info', $data);
        $this->smarty->assign('keyword', $this->input->get('keyword'));
        $this->smarty->display('posts/search.tpl');
    }

    public function delComment()
    {
        $option = array(
            'comment_id' => $this->input->post('comment_id'),
            'author_id' => $this->_uid
        );
        $res = $this->post_service->delComment($option);
        echo json_encode_data($res);
    }

    public function code($url)
    {
        qrcode(urldecode($url));
    }
        
}