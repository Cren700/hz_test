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
        $theme = $this->theme_service->getThemeList();
        $this->smarty->assign('cate_id', $cate_id);
        $this->smarty->assign('theme', isset($theme['data']) ? $theme['data'] : array());
        $this->smarty->display('theme/index.tpl');
    }

    public function jhtTheme()
    {
        $data = array(
            'id' => $this->input->get('pid')
        );
        $theme = $this->theme_service->getPostsThemeByPid($data);
        $cssArr = array('bootstrap.min.css');
        $jsArr = array('bootstrap.min.js');
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('theme', $theme);
        $this->smarty->display('theme/jhtTheme.tpl');
    }



}