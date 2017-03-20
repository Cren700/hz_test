<?php

class Medium extends BaseControllor
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/posts_service_model', 'post_service');

        $this->hasMediumPower();
        // 目录结构
        $menu = $this->getMediumMenu() ? : array();
        $this->smarty->assign('menu', $menu);
    }

    public function index()
    {
        $cate = $this->post_service->getCate();
        $cssArr = array('admin/datepicker.css');
        $jsArr = array(
            'admin/plugin/bootstrap-datepicker.js',
            'admin/posts/index.js'
        );
        $this->smarty->assign('cate', isset($cate['data']) ? $cate['data'] : array());
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('admin/posts/index.tpl');
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
            'user_type' => 2,
            'user_id'  => $this->_uid,
        );
        $cate = $this->post_service->getCate();
        $cate = isset($cate['data']['list']) ? $cate['data']['list'] : array();
        $tmp = array();
        foreach ($cate as $c) {
            $tmp[$c['Fpost_category_id']] = $c['Fcategory_name'];
        }
        $posts = $this->post_service->query($option);
        $this->smarty->assign('cate', $tmp);
        $this->smarty->assign('info', $posts['data']);
        $this->smarty->assign('page', $this->page($posts['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('admin/posts/list.tpl');
    }

    public function get()
    {
        $data = array(
            'product_id' => $this->input->get('id')
        );
        $res = $this->post_service->getPost($data);
        echo json_encode_data($res);
    }

    public function add()
    {

        $cate = $this->post_service->getCate();
        $jsArr = array(
            'admin/plugin/jquery.placeholder.min.js',
            'admin/plugin/jquery.validate.js',
            'admin/uploadify/jquery.uploadify.min.js',
            'admin/posts/detail.js',
            'admin/ueditor/ueditor.config.js',
            'admin/ueditor/ueditor.all.min.js',
            'admin/ueditor/lang/zh-cn/zh-cn.js'
        );
        $cssArr = array('admin/uploadify.css');
        $this->smarty->assign('is_new', 1);
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        // 目录结构
        $menu = $this->getMediumMenu() ? : array();
        $this->smarty->assign('menu', $menu);
        $this->smarty->display('admin/posts/detail.tpl');
    }

    public function detail($pid = null){
        $data = array(
            'id' => $pid ? : $this->input->get('pid')
        );

        $posts = $this->post_service->getPost($data);
        if (empty($posts['data'])) {
            $this->jump404();
        }
        $cate = $this->post_service->getCate();
        $jsArr = array(
            'admin/plugin/jquery.placeholder.min.js',
            'admin/plugin/jquery.validate.js',
            'admin/uploadify/jquery.uploadify.min.js',
            'admin/posts/detail.js',
            'admin/ueditor/ueditor.config.js',
            'admin/ueditor/ueditor.all.min.js',
            'admin/ueditor/lang/zh-cn/zh-cn.js'
        );
        $cssArr = array('uploadify.css');
        $this->smarty->assign('is_new', 0);
        $this->smarty->assign('cate', isset($cate['data']) ? $cate['data'] : array());
        $this->smarty->assign('posts', $posts['data']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('admin/posts/detail.tpl');
    }

    public function save()
    {
        $data = array(
            'is_new' => $this->input->post('is_new'),
            'id' => $this->input->post('id'),
            'user_id' => $this->input->post('user_id') ? : $this->_uid,
            'user_type' => 2,
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
        $res = $this->post_service->save($data);
        echo json_encode_data($res);
    }

    public function status()
    {
        $data = array(
            'status'    => $this->input->post('status'),
            'is_del'    => $this->input->post('is_del'),
            'pid'       => $this->input->post('pid'),
        );
        $has = $this->hasPostsPower($data['pid']);
        if ($has['code'] == 0) {
            $res = $this->post_service->status($data);
            echo json_encode_data($res);
        } else {
            echo json_encode_data($has);
        }
    }

    // 判断是否具有发布权限, 通过认证且为媒体用户
    private function hasMediumPower()
    {
        $has = $this->post_service->hasMediumPower();
        if ($has['code'] != 0) {
            $this->jump404($has['msg']);
            exit();
        }
    }

    // 判断是否具有文章权限
    private function hasPostsPower($post_id)
    {
        $has = $this->post_service->hasPostsPower($post_id);
        return $has;
    }
}