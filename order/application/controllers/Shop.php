<?php

/**
 * Shop.php
 * Author   : cren
 * Date     : 2016/12/26
 * Time     : 下午8:21
 */
class Shop extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/shop_service_model', 'shop_service');
    }

    public function join()
    {
        $option = array(
            'Fproduct_id' => $this->input->post('product_id'),
            'Fuser_id' => $this->_user_id,
            'Fproduct_num' => $this->input->post('product_num') ? : 1,
        );
        $res = $this->shop_service->join($option);
        echo outputResponse($res);
    }

    public function remove()
    {
        $option = array(
            'Fid' => $this->input->get('id'),
            'Fuser_id' => $this->_user_id,
        );
        $res = $this->shop_service->remove($option);
        echo outputResponse($res);
    }

    public function update()
    {
        $where = array(
            'Fid' => $this->input->post('id'),
            'Fuser_id' => $this->input->post('user_id'),
        );
        $data = array(
            'Fproduct_num' => (int)$this->input->post('count') ? : 1
        );
        $res = $this->shop_service->update($where, $data);
        echo outputResponse($res);
    }

    public function getList()
    {
        $option = array(
            'Fuser_id' => $this->_user_id
        );
        $res = $this->shop_service->getList($option);
        echo outputResponse($res);
    }
}