<?php

/**
 * Conf.php
 * Author   : cren
 * Date     : 2016/12/27
 * Time     : 下午10:28
 */
class Conf extends BaseControllor
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/conf_service_model', 'conf_service');
    }

    public function index()
    {
        $jsArr = array(
            'config/index.js',
        );
        $this->smarty->assign('jsArr',$jsArr);
        $res = $this->conf_service->query();
        $this->smarty->assign('info', $res['data']);
        $this->smarty->display('config/index.tpl');
    }

    public function add()
    {
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'config/detail.js',
            'ueditor/ueditor.config.js',
            'ueditor/ueditor.all.min.js',
            'ueditor/lang/zh-cn/zh-cn.js'
        );
        $cssArr = array('uploadify.css');
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('is_new',1);
        $this->smarty->assign('jsArr',$jsArr);
        $this->smarty->display('config/detail.tpl');
    }

    public function edit()
    {
        $data = array(
            'id' => $this->input->get('id')
        );

        $info = $this->conf_service->getConfById($data);
        if (empty($info['data'])) {
            $this->jump404();
        }
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'config/detail.js',
            'ueditor/ueditor.config.js',
            'ueditor/ueditor.all.min.js',
            'ueditor/lang/zh-cn/zh-cn.js'
        );
        $cssArr = array('uploadify.css');
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('is_new', 0);
        $this->smarty->assign('info', $info['data']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('config/detail.tpl');

    }

    public function save()
    {
        $data = array(
            'is_new'      => $this->input->post('is_new'),
            'typename'    => $this->input->post('typename'),
            'id'          => $this->input->post('id'),
            'content'     => $this->input->post('content'),
        );
        $res = $this->conf_service->save($data);
        echo json_encode_data($res);
    }

    public function del()
    {
        $data = array(
            'id' => $this->input->post('id'),
        );
        $res = $this->conf_service->del($data);
        echo json_encode_data($res);
    }

}
