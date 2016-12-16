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
        $this->smarty->assign('cate', $cate['data']);
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
            'category_id' => $this->input->get('category_id'),
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
        $this->smarty->assign('cate', $cate['data']);
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
            'user_id' => $this->_uid,
            'post_title' => $this->input->post('post_title'),
            'post_author' => $this->input->post('post_author'),
            'category_id' => $this->input->post('category_id'),
            'post_excerpt' => $this->input->post('post_excerpt'),// 摘要
            'post_content' => $this->input->post('post_content'),
            'post_coverimage' => $this->input->post('post_coverimage'),
            'comment_status' => $this->input->post('comment_status'),
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

    public function del()
    {
        $data = array(
            'id' => $this->input->get('id')
        );
        $res = $this->posts_service->del($data);
        echo json_encode_data($res);
    }


    /**
     * 产品分类
     */
    public function cate()
    {
        $cate = $this->posts_service->category();
        $this->smarty->assign('cate', $cate['data']);
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
            'remark' => $this->input->post('remark'),
        );
        $res = $this->posts_service->saveCate($data);
        if(!$res['code']) {
            $res['data']['url'] = getBaseUrl('/posts/cate.html');
        }
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
        $this->smarty->assign('cate', $cate['data']);
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
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('posts/recycle.tpl');
    }
}