<?php

/**
 * Shop.php
 * Author   : cren
 * Date     : 2016/12/26
 * Time     : 下午7:31
 */
class Shop extends BaseControllor
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/shop_service_model', 'shop_service');
    }

    // 购物车页面
    public function index()
    {
        $res = $this->shop_service->getList();
        $jsArr = array('shop_index.js','remset.js');
        $cssArr = array('reset.css');
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('info', $res['data']);
        $this->smarty->display('shop/index.tpl');
    }

    // 加入购物车
    public function join()
    {
        $pid = $this->input->get('pid', true);
        $res = $this->shop_service->join($pid);

        echo json_encode_data($res);
    }

    // 移除购物车
    public function remove()
    {
        $id = $this->input->get('id', true);
        $res = $this->shop_service->remove($id);
        echo json_encode_data($res);
    }

    // 关注
    public function collect()
    {
        $pid = $this->input->get('pid');
        $res = $this->shop_service->collect($pid);

        echo json_encode_data($res);
    }
}