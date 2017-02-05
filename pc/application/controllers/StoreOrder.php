<?php
/**
 * StoreOrder.php
 * Author   : cren
 * Date     : 2017/2/5
 * Time     : 下午4:25
 */

class StoreOrder extends BaseControllor
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/storeorder_service_model', 'storeorder_service');
        // 目录结构
        $menu = $this->getStoreMenu() ? : array();
        $this->smarty->assign('menu', $menu);
    }

    public function index()
    {
        $cssArr = array('admin/datepicker.css');
        $jsArr = array(
            'admin/plugin/bootstrap-datepicker.js',
            'admin/order/index.js'
        );
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('admin/order/index.tpl');
    }

    public function query()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'min_date' => $this->input->get('min_date', true),
            'max_date' => $this->input->get('max_date', true),
            'order_no' => $this->input->get('order_no', true),
            'product_id' => $this->input->get('product_id', true),
            'user_id' => $this->input->get('user_id', true),
            'store_id'  => $this->_uid,// 商户ID
            'store_type' => 1,// 商户类型为1
            'order_status' => $this->input->get('order_status', true),
        );
        $order = $this->storeorder_service->query($option);
        $this->smarty->assign('info', $order['data']);
        $this->smarty->assign('page', $this->page($order['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('admin/order/list.tpl');
    }

    public function orderStatus()
    {
        $option = array(
            'order_status' => $this->input->post('status', true),
            'order_no' => $this->input->post('order_no', true),
        );
        $res = $this->storeorder_service->orderStatus($option);
        echo json_encode_data($res);
    }
}