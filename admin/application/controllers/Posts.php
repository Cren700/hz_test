<?php

/**
 * Post.php
 * Author   : cren
 * Date     : 2016/12/10
 * Time     : 上午11:42
 */
class Posts extends BaseControllor
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/posts_service_model', 'posts_service');
    }

    public function index()
    {
        $cate = $this->posts_service->category();
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'posts/index.js'
        );
        $this->smarty->assign('cate', isset($cate['data']) ? $cate['data'] : array());
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('posts/index.tpl');
    }

    public function query()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'post_title'   => $this->input->get('post_title'),
            'post_author'   => $this->input->get('post_author'),
            'post_category_id' => $this->input->get('category_id'),
            'post_status' => $this->input->get('post_status'),
            'is_del' => $this->input->get('is_del'),
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
            'store_id'  => $this->input->get('store_id') ? : $this->_uid,
        );
        $cate = $this->posts_service->category();
        $cate = isset($cate['data']['list']) ? $cate['data']['list'] : array();
        $tmp = array();
        foreach ($cate as $c) {
            $tmp[$c['Fpost_category_id']] = $c['Fcategory_name'];
        }
        $posts = $this->posts_service->query($option);
        $this->smarty->assign('cate', $tmp);
        $this->smarty->assign('info', $posts['data']);
        $this->smarty->assign('page', $this->page($posts['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('posts/list.tpl');
    }

    public function get()
    {
        $data = array(
            'product_id' => $this->input->get('id')
        );
        $res = $this->posts_service->getPostsByPid($data);
        echo json_encode_data($res);
    }

    public function add()
    {
        $cate = $this->posts_service->category();
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'uploadify/jquery.uploadify.min.js',
            'posts/detail.js',
            'ueditor/ueditor.config.js',
            'ueditor/ueditor.all.js',
            'ueditor/lang/zh-cn/zh-cn.js'
        );
        $cssArr = array('uploadify.css');
        $this->smarty->assign('is_new', 1);
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('posts/detail.tpl');
    }

    public function detail($pid = null){
        $data = array(
            'id' => $pid ? : $this->input->get('pid')
        );

        $posts = $this->posts_service->getPostsByPid($data);
        if (empty($posts['data'])) {
            $this->jump404();
        }
        $cate = $this->posts_service->category();
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'uploadify/jquery.uploadify.min.js',
            'posts/detail.js',
            'ueditor/ueditor.config.js',
            'ueditor/ueditor.all.js',
            'ueditor/lang/zh-cn/zh-cn.js'
        );
        $cssArr = array('uploadify.css');
        $this->smarty->assign('is_new', 0);
        $this->smarty->assign('cate', isset($cate['data']) ? $cate['data'] : array());
        $this->smarty->assign('posts', $posts['data']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('posts/detail.tpl');
    }

    public function save()
    {
        $data = array(
            'is_new' => $this->input->post('is_new'),
            'id' => $this->input->post('id'),
            'user_id' => $this->input->post('user_id') ? : $this->_uid,
            'user_type' => 1,
            'post_title' => $this->input->post('post_title'),
            'post_author' => $this->input->post('post_author'),
            'category_id' => $this->input->post('category_id'),
            'post_excerpt' => $this->input->post('post_excerpt'),// 摘要
            'post_keyword' => $this->input->post('post_keyword'),// 关键词
            'post_content' => $this->input->post('post_content'),
            'post_coverimage' => $this->input->post('post_coverimage'),
            'comment_status' => $this->input->post('comment_status'),
            'remark' => $this->input->post('remark')
        );
        $res = $this->posts_service->save($data);
        echo json_encode_data($res);
    }

    public function status()
    {
        $data = array(
            'status'    => $this->input->post('status'),
            'is_del'    => $this->input->post('is_del'),
            'pid'       => $this->input->post('pid'),
        );
        $res = $this->posts_service->status($data);
        echo json_encode_data($res);
    }

    /**
     * 产品分类
     */
    public function cate()
    {
        $cate = $this->posts_service->category();
        $jsArr = array('posts/cateStatus.js');
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cate', isset($cate['data']) ? $cate['data'] : array());
        $this->smarty->display('posts/cateList.tpl');
    }

    public function addCate()
    {
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'posts/cate.js'
        );
        $this->smarty->assign('is_new', 1);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('posts/cate_detail.tpl');
    }

    public function getCate($id = '')
    {
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'posts/cate.js'
        );
        $data = array(
            'category_id' => $id ? $id : $this->input->get('id')
        );
        !$data['category_id'] ? $this->jump404():'';
        $cate = $this->posts_service->getCategory($data);
        empty($cate['data']) ? $this->jump404() : '';
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('is_new', 0);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('posts/cate_detail.tpl');
    }

    public function saveCate()
    {
        $data = array(
            'is_new' => $this->input->post('is_new'),
            'category_id' => $this->input->post('category_id'),
            'category_name' => $this->input->post('category_name'),
            'is_special' => $this->input->post('is_special'),
            'remark' => $this->input->post('remark'),
        );
        $res = $this->posts_service->saveCate($data);
        if(!$res['code']) {
            $res['data']['url'] = getBaseUrl('/posts/cate.html');
        }
        echo json_encode_data($res);
    }

    /**
     * 修改状态(认证、使用)
     */
    public function cateStatus()
    {
        $option = array(
            'status' => $this->input->get('status'),
            'id' => $this->input->get('id')
        );
        $res = $this->posts_service->cateStatus($option);
        echo json_encode_data($res);
    }

    /**
     * 产品审核列表 即状态为status = 1
     */
    public function verify()
    {
        $cate = $this->posts_service->index();
        $jsArr = array(
            'product/product.js'
        );
        $this->smarty->assign('cate', isset($cate['data'])) ? $cate['data'] : array();
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('posts/verify.tpl');
    }

    /**
     * 产品已删除 即is_del = 1
     */
    public function recycle()
    {
        $cate = $this->posts_service->index();
        $jsArr = array(
            'product/product.js'
        );
        $this->smarty->assign('cate', isset($cate['data'])) ? $cate['data'] : array();
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('posts/recycle.tpl');
    }

    /**
     * 评论列表页
     */
    public function comment()
    {
        $cate = $this->posts_service->category();
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'posts/comment.js'
        );
        $this->smarty->assign('cate', isset($cate['data'])) ? $cate['data'] : array();
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('posts/comment.tpl');
    }

    public function queryComment()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'post_id'   => $this->input->get('post_id'),
            'author_name'   => $this->input->get('author_name'),
            'comment_approved' => $this->input->get('comment_approved'),
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
        );
        $comment = $this->posts_service->queryComment($option);
        $this->smarty->assign('info', $comment['data']);
        $this->smarty->assign('page', $this->page($comment['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('posts/commentList.tpl');
    }

    /**
     * 评论状态
     */
    public function statusComment()
    {
        $data = array(
            'status'    => $this->input->post('status'),
            'comment_id'       => $this->input->post('comment_id'),
        );
        $res = $this->posts_service->statusComment($data);
        echo json_encode_data($res);
    }

    /**
     * 删除评论
     */
    public function delComment()
    {
        $data = array(
            'comment_id' => $this->input->post('comment_id')
        );
        $res = $this->posts_service->delComment($data);
        echo json_encode_data($res);
    }

    public function praise()
    {
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'posts/praise.js'
        );
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('posts/praise.tpl');
    }

    public function queryPraise()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'post_id'   => $this->input->get('post_id'),
            'user_id'   => $this->input->get('user_id'),
        );
        $praise = $this->posts_service->queryPraise($option);
        $this->smarty->assign('info', $praise['data']);
        $this->smarty->assign('page', $this->page($praise['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('posts/praiseList.tpl');
    }

    //********************------专题--------*****************//
    public function theme()
    {
        $jsArr = array(
            'posts/theme.js'
        );
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('posts/theme.tpl');
    }

    public function queryThemes()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
        );
        $theme = $this->posts_service->queryThemes($option);
        $this->smarty->assign('info', $theme['data']);
        $this->smarty->assign('page', $this->page($theme['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('posts/themeList.tpl');
    }

    public function addTheme()
    {
        $cate = $this->posts_service->category();
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'uploadify/jquery.uploadify.min.js',
            'posts/detailTheme.js',
        );
        $cssArr = array('uploadify.css');
        $this->smarty->assign('is_new', 1);
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('posts/detailTheme.tpl');
    }

    public function detailTheme($pid = null){
        $data = array(
            'id' => $pid ? : $this->input->get('pid')
        );

        $theme = $this->posts_service->getThemeByPid($data);
        if (empty($theme['data'])) {
            $this->jump404();
        }
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'uploadify/jquery.uploadify.min.js',
            'posts/detailTheme.js',
        );
        $cssArr = array('uploadify.css');
        $this->smarty->assign('is_new', 0);
        $this->smarty->assign('theme', $theme['data']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('posts/detailTheme.tpl');
    }

    public function saveTheme()
    {
        $data = array(
            'is_new' => $this->input->post('is_new'),
            'id' => $this->input->post('id'),
            'user_id' => $this->_uid,
            'theme_title' => $this->input->post('theme_title'),
            'theme_excerpt' => $this->input->post('theme_excerpt'),
            'url' => $this->input->post('url'),
            'murl' => $this->input->post('murl'),
            'theme_coverimage' => $this->input->post('theme_coverimage'),
            'banner_path' => $this->input->post('banner_path'),
        );
        $res = $this->posts_service->saveTheme($data);
        echo json_encode_data($res);
    }

    public function statusTheme()
    {
        $data = array(
            'status'    => $this->input->post('status'),
            'id'       => $this->input->post('id'),
        );
        $res = $this->posts_service->statusTheme($data);
        echo json_encode_data($res);
    }

    public function delTheme()
    {
        $data = array(
            'id' => $this->input->post('id')
        );
        $res = $this->posts_service->delTheme($data);
        echo json_encode_data($res);
    }

    public function postsTheme()
    {
        $data = array(
            'id' => $this->input->get('id')
        );
        $jsArr = array(
            'posts/postsTheme.js'
        );
        $theme = $this->posts_service->getPostsThemeByPid($data);
        if (empty($theme['data'])) {
            $this->jump404();
        }
        $this->smarty->assign('theme', $theme['data']);
        $this->smarty->assign('posts', $theme['postList']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('posts/postsTheme.tpl');
    }

    public function getPostByPid($pid = null)
    {
        $data = array(
            'id' => $pid ?: $this->input->get('pid')
        );

        $theme = $this->posts_service->getPostsByPid($data);
        echo json_encode_data($theme);
    }

    public function addThemePost()
    {
        $post_id = $this->input->get('post_id');
        $post_arr = explode(',', $post_id);
        $post_id = join(',', array_unique($post_arr));
        $option = array(
            'post_id' => $post_id,
            'id' => $this->input->get('id')
        );
        $theme = $this->posts_service->addThemePost($option);
        echo json_encode_data($theme);
    }

    /** ---------------*****行业动态*****------------ */
    /**
     * 行业动态
     */
    public function events()
    {
        $jsArr = array(
            'posts/events.js'
        );
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('posts/events.tpl');
    }

    public function addEvent()
    {
        $jsArr = array(
            'posts/addEvents.js',
        );
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('posts/addEvent.tpl');
    }

    public function saveEvent()
    {
        $option = array(
            'partners_id' => $this->input->post('partners_id'),
            'partners_name' => $this->input->post('partners_name'),
            'num' => $this->input->post('num'),
        );
        $res = $this->posts_service->saveEvent($option);
        echo json_encode_data($res);
    }

    public function modifyEvent()
    {
        $option = array(
            'id' => $this->input->post('id'),
            'num' => $this->input->post('num'),
        );
        $res = $this->posts_service->modifyEvent($option);
        echo json_encode_data($res);
    }

    public function delEvent()
    {
        $data = array(
            'id' => $this->input->post('id')
        );
        $res = $this->posts_service->delEvent($data);
        echo json_encode_data($res);
    }

    public function queryEvents()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
        );
        $events = $this->posts_service->queryEvents($option);
        $this->smarty->assign('info', $events['data']);
        $this->smarty->assign('page', $this->page($events['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('posts/eventList.tpl');
    }

}