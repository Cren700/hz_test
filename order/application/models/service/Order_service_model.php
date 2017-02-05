<?php

/**
 * Order_service_model.php
 * Author   : cren
 * Date     : 2016/12/26
 * Time     : 下午11:39
 */
class Order_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/order_dao_model', 'order_dao');
    }

    /**
     * 通过产品直接下单
     * @param $option
     * @return array
     */
    public function createByPid($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fuser_id']) || empty($option['Fproduct_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $where = array('Fproduct_id' => $option['Fproduct_id']);
        $product = $this->order_dao->getProductByPid($where);
        if (!$product) {
            $ret['code'] = 'system_error_2'; // 获取数据出错
            return $ret;
        }
        // 认证用户才能下单
        $user = $this->myCurl('account', 'getUserDetailByFuserId', array('user_id' => $option['Fuser_id']));
        if ($user['code'] != 0) {
            $ret['code'] = $user['code'];
            return $ret;
        }
        $user = $this->myCurl('account', 'detail', array('id' => $user['data']['Fid']));
        if ($user['code'] != 0) {
            $ret['code'] = $user['code'];
            return $ret;
        }
        // 认证为1
        if ($user['data']['Fatte_status'] != 1) {
            $ret['code'] = 'order_error_7';
            return $ret;
        }
        // 判断库存
        if( $option['Fproduct_num'] > $product['Fproduct_num']) {
            $ret['code'] = 'order_error_3'; // 库存不足
            return $ret;
        }
        $data = array(
            'Forder_no' => createOrderSn(),
            'Fuser_id' => $option['Fuser_id'],
            'Fproduct_id' => $product['Fproduct_id'],
            'Fproduct_name' => $product['Fproduct_name'],
            'Fproduct_num' => $option['Fproduct_num'],
            'Fproduct_price' => $product['Fproduct_price'],
            'Fproduct_tol_amt' => sprintf("%.2f", $product['Fproduct_price'] * $option['Fproduct_num']),
            'Fstore_id' => $product['Fstore_id'],
            'Fstore_type' => $product['Fstore_type'],
            'Forder_type' => 1, //订单类型 1：购买 2：
            'Forder_status' => 1, //订单状态 1:初始订单 2:取消订单 3:支付成功 4:内部处理失败 5:渠道支付失败
            'Fcreate_time' => time(),
            'Fupdate_time' => time()
        );
        $res = $this->order_dao->create($data);
        if (!$res) {
            $ret['code'] = 'order_error_2';
            return $ret;
        } else {
            // 成功生成订单
            // 删除购物车,并扣减库存
            $this->load->model('dao/shop_dao_model');
            $this->shop_dao_model->remove($option);
            $where = array('Fproduct_id' => $product['Fproduct_id']);
            $this->order_dao->updateProductNum($where, $option['Fproduct_num']);
            $ret['data'] = $data;
        }
        return $ret;
    }

    /**
     * 通过购物车下单
     * @param $option
     * @return array
     */
    public function createByCid($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fuser_id']) || empty($option['Fid'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $where = array('Fid' => $option['Fid'], 'Fuser_id' => $option['Fuser_id']);
        $cartInfo = $this->order_dao->getCartInfo($where);
        if (!$cartInfo) {
            $ret['code'] = 'system_error_2'; // 获取数据出错
            return $ret;
        }
        $where = array('Fproduct_id' => $cartInfo['Fproduct_id']);
        $product = $this->order_dao->getProductByPid($where);
        if (!$product) {
            $ret['code'] = 'system_error_2'; // 获取数据出错
            return $ret;
        }
        // 认证用户才能下单
        $user = $this->myCurl('account', 'getUserDetailByFuserId', array('user_id' => $option['Fuser_id']));
        if ($user['code'] != 0) {
            $ret['code'] = $user['code'];
            return $ret;
        }
        $user = $this->myCurl('account', 'detail', array('id' => $user['data']['Fid']));
        if ($user['code'] != 0) {
            $ret['code'] = $user['code'];
            return $ret;
        }
        // 认证为1
        if ($user['data']['Fatte_status'] != 1) {
            $ret['code'] = 'order_error_7';
            return $ret;
        }
        // 判断库存
        if( $cartInfo['Fproduct_num'] > $product['Fproduct_num']) {
            $ret['code'] = 'order_error_3'; // 库存不足
            return $ret;
        }
        $data = array(
            'Forder_no' => createOrderSn(),
            'Fuser_id' => $option['Fuser_id'],
            'Fproduct_id' => $product['Fproduct_id'],
            'Fproduct_name' => $product['Fproduct_name'],
            'Fproduct_num' => $cartInfo['Fproduct_num'],
            'Fproduct_price' => $product['Fproduct_price'],
            'Fproduct_tol_amt' => sprintf("%.2f", $product['Fproduct_price'] * $cartInfo['Fproduct_num']),
            'Fstore_id' => $product['Fstore_id'],
            'Fstore_type' => $product['Fstore_type'],
            'Forder_type' => 1, //订单类型 1：购买 2：
            'Forder_status' => 1, //订单状态 1:初始订单 2:取消订单 3:支付成功 4:内部处理失败 5:渠道支付失败
            'Fcreate_time' => time(),
            'Fupdate_time' => time()
        );
        $res = $this->order_dao->create($data);
        if (!$res) {
            $ret['code'] = 'order_error_2';
            return $ret;
        } else {
            // 成功生成订单
            // 删除购物车,并扣减库存
            $this->load->model('dao/shop_dao_model');
            $this->shop_dao_model->remove($option);
            $where = array('Fproduct_id' => $product['Fproduct_id']);
            $this->order_dao->updateProductNum($where, $cartInfo['Fproduct_num']);
            $ret['data'] = $data;
        }
        return $ret;
    }

    /**
     * 后台查询
     */
    public function query($option)
    {
        $res = array('code' => 0);
        $like = array();
        $where = array();

        if ($option['Forder_status'] === '0' || !empty($option['Forder_status'])) {
            $where['Forder_status'] = $option['Forder_status'];
        }

        if ($option['Fproduct_id'] === '0' || !empty($option['Fproduct_id'])) {
            $where['Fproduct_id'] = $option['Fproduct_id'];
        }

        if (!empty($option['Fstore_id'])) {
            $where['Fstore_id'] = $option['Fstore_id'];
        }

        if (!empty($option['Fstore_type'])) {
            $where['Fstore_type'] = $option['Fstore_type'];
        }

        if (!empty($option['min_date'])) {
            $where['Fcreate_time >= '] = strtotime($option['min_date']);
        }

        if (!empty($option['max_date'])) {
            $where['Fcreate_time <= '] = strtotime($option['max_date'])+23*3600+3599;
        }

        // like
        if ($option['Forder_no'] === '0' || !empty($option['Forder_no'])) {
            $like['Forder_no'] = $option['Forder_no'];
        }
        if ($option['Fuser_id'] === '0' || !empty($option['Fuser_id'])) {
            $like['Fuser_id'] = $option['Fuser_id'];
        }

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'] ? : 10;
        $res['data']['count'] = $this->order_dao->orderNum($where, $like);
        $orderList = $this->order_dao->orderList($where, $like, $page, $page_size);
        foreach ($orderList as &$l)
        {
            $user_info = $this->myCurl('account', 'getStoreName', array('id' => $l['Fstore_id'], 'type' => $l['Fstore_type']), false);
            $l['Fstore_name'] = isset($user_info['data']['Fuser_id']) ? $user_info['data']['Fuser_id'] : '';
        }
        $res['data']['list'] = $orderList;
        return $res;
    }

    public function orderStatus($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Forder_status']) || empty($option['Forder_no'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $where = array('Forder_no' => $option['Forder_no']);
        $data = array('Forder_status' => $option['Forder_status'], 'Fupdate_time' => time());
        $res = $this->order_dao->orderStatus($where, $data);
        if (!$res) {
            $ret['code'] = 'order_error_5';
        }
        return $ret;
    }

    /**
     * 后台提现查询
     */
    public function queryTxOrders($option)
    {
        $res = array('code' => 0);
        $like = array();
        $where = array();

        if ($option['Forder_status'] === '0' || !empty($option['Forder_status'])) {
            $where['Forder_status'] = $option['Forder_status'];
        }

        if (!empty($option['min_date'])) {
            $where['Fcreate_time >= '] = strtotime($option['min_date']);
        }

        if (!empty($option['max_date'])) {
            $where['Fcreate_time <= '] = strtotime($option['max_date'])+23*3600+3599;
        }

        // like
        if ($option['Forder_no'] === '0' || !empty($option['Forder_no'])) {
            $like['Forder_no'] = $option['Forder_no'];
        }

        if ($option['Fuser_id'] === '0' || !empty($option['Fuser_id'])) {
            $like['Fuser_id'] = $option['Fuser_id'];
        }

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'] ? : 10;
        $res['data']['count'] = $this->order_dao->txOrderNum($where, $like);
        $orderList = $this->order_dao->txOrderList($where, $like, $page, $page_size);
        $res['data']['list'] = $orderList;
        return $res;
    }

    public function txOrderStatus($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Forder_status']) || empty($option['Forder_no'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $where = array('Forder_no' => $option['Forder_no']);
        $data = array('Forder_status' => $option['Forder_status'], 'Fupdate_time' => time());
        $res = $this->order_dao->txOrderStatus($where, $data);
        if (!$res) {
            $ret['code'] = 'order_error_5';
        }
        return $ret;
    }

    // 通过购物车预下单数据
    public function previewByCid($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fuser_id']) || empty($option['Fid'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $cartInfo = $this->order_dao->getCartInfo($option);
        if(empty($cartInfo)) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $where = array('Fproduct_id' => $cartInfo['Fproduct_id']);
        $product = $this->order_dao->getProductByPid($where);
        $data = array(
            'FcartInfo' => $cartInfo,
            'Fproduct' => $product
        );
        $ret['data'] = $data;

        return $ret;
    }
    
    public function saveClaims($option)
    {
        $ret = array('code' => 0);
        $order_no = $option['Forder_no'];

        $order_data = $this->order_dao->getOrderByNo(array('Forder_no' => $order_no));

        if (!$order_data) {
            $ret['code'] = 'order_error_8';
            return $ret;
        }

        // 是否理赔中
        $where = array('Fuser_id' => $option['Fuser_id'], 'Forder_no' => $option['Forder_no']);
        $claims_data = $this->order_dao->checkClaims($where);
        if ($claims_data) {
            $ret['code'] = 'order_error_10';
            return $ret;
        }

        $option['Fstore_id'] = $order_data['Fstore_id'];
        $option['Fstore_type'] = $order_data['Fstore_type'];
        $option['Fproduct_id'] = $order_data['Fproduct_id'];

        $res = $this->order_dao->saveClaims($option);
        if (!$res) {
            $ret['code'] = 'order_error_9';
        }
        // 更改order的理赔状态
        $where = array('Forder_no' => $option['Forder_no']);
        $data = array('Fclaims_status' => 1);
        $this->order_dao->updateOrderClaimsStatus($where, $data);
        return $ret;
    }

    public function claimsDetail($where)
    {
        $ret = array('code' => 0);
        $claims_data = $this->order_dao->checkClaims($where);
        if (!$claims_data) {
            $ret['code'] = 'order_error_10';
            return $ret;
        }
        $ret['data'] = $claims_data;
        return $ret;
    }

    /**
     * 后台提现查询
     */
    public function queryClaims($option)
    {
        $res = array('code' => 0);
        $like = array();
        $where = array();

        if ($option['Fstatus'] === '0' || !empty($option['Fstatus'])) {
            $where['Fstatus'] = $option['Fstatus'];
        }

        if (!empty($option['min_date'])) {
            $where['Fcreate_time >= '] = strtotime($option['min_date']);
        }

        if (!empty($option['max_date'])) {
            $where['Fcreate_time <= '] = strtotime($option['max_date'])+23*3600+3599;
        }

        // like
        if ($option['Forder_no'] === '0' || !empty($option['Forder_no'])) {
            $like['Forder_no'] = $option['Forder_no'];
        }

        if ($option['Fuser_id'] === '0' || !empty($option['Fuser_id'])) {
            $like['Fuser_id'] = $option['Fuser_id'];
        }

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'] ? : 10;
        $res['data']['count'] = $this->order_dao->claimOrderNum($where, $like);
        $orderList = $this->order_dao->claimOrderList($where, $like, $page, $page_size);
        foreach ($orderList as &$l)
        {
            $user_info = $this->myCurl('account', 'getStoreName', array('id' => $l['Fstore_id'], 'type' => $l['Fstore_type']), false);
            $l['Fstore_name'] = isset($user_info['data']['Fuser_id']) ? $user_info['data']['Fuser_id'] : '';
        }
        $res['data']['list'] = $orderList;
        return $res;
    }

    public function claimOrderStatus($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fstatus']) || empty($option['Fid'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $where = array('Fid' => $option['Fid']);
        $data = array('Fstatus' => $option['Fstatus']);
        $res = $this->order_dao->claimOrderStatus($where, $data);
        if (!$res) {
            $ret['code'] = 'order_error_5';
        }
        return $ret;
    }

    /**
     * 通过购物车预下单数据
     * @param $option
     * @return array
     */
    public function previewByPid($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fproduct_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $where = array('Fproduct_id' => $option['Fproduct_id']);
        $product = $this->order_dao->getProductByPid($where);
        if(empty($product)) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $data = array(
            'Fproduct' => $product
        );
        $ret['data'] = $data;

        return $ret;
    }

    /**
     * 用户订单列表
     */
    public function getOderListByUid($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fuser_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $orderList = $this->order_dao->getOderListByUid(array('o.Fuser_id' => $option['Fuser_id']));
        foreach ($orderList as &$list) {
            $product = $this->myCurl('product', 'getProductByPid', array('product_id' => $list['Fproduct_id']));
            $list['Fcoverimage'] = $product['data']['Fcoverimage'];
            $list['Fdescription'] = $product['data']['Fdescription'];
        }
        if (!$orderList) {
            $ret['code'] = 'order_error_6';
        } else {
            $ret['data'] = $orderList;
        }
        return $ret;
    }

    /**
     * 后台销售统计查询
     * @param $option
     * @return mixed
     */
    public function querySaleStat($option)
    {
        $res = array('code' => 0);
        $where = array('Forder_status' => 3); // 支付成功

        if (!empty($option['min_date'])) {
            $where['Fcreate_time >= '] = strtotime($option['min_date']);
        }

        if (!empty($option['max_date'])) {
            $where['Fcreate_time <= '] = strtotime($option['max_date'])+23*3600+3599;
        }

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'] ? : 10;
        $res['data']['count'] = $this->order_dao->querySaleStatNum($where);
        $orderList = $this->order_dao->querySaleStatList($where, $page, $page_size);
        foreach ($orderList as &$list) {
            $product = $this->myCurl('product', 'getProductByPid', array('product_id' => $list['Fproduct_id']));
            $list['Fproduct_name'] = $product['data']['Fproduct_name'];
        }
        $res['data']['list'] = $orderList;
        return $res;
    }

    public function orderDetail($where)
    {
        $ret = array('code' => 0);
        $order_data = $this->order_dao->getOrderByNo($where);
        if (!$order_data) {
            $ret['code'] = 'order_error_8';
            return $ret;
        }
        $product = $this->myCurl('product', 'getProductByPid', array('product_id' => $order_data['Fproduct_id']));
        $order_data['Fcoverimage'] = $product['data']['Fcoverimage'];
        $order_data['Fdescription'] = $product['data']['Fdescription'];
        $ret['data'] = $order_data;
        return $ret;
    }

    public function getClaimsDetailByFid($option)
    {
        $ret = array('code' => 0);
        if (!$option['Fid']) {
            $ret['code'] = 'order_error_11';
            return $ret;
        }
        $claims_data = $this->order_dao->getClaimsDetailByFid($option);
        if (!$claims_data) {
            $ret['code'] = 'order_error_11';
            return $ret;
        }
        $ret['data'] = $claims_data;
        return $ret;
    }

    public function updateClaims($option)
    {
        $ret = array('code' => 0);
        if (!$option['Fid']) {
            $ret['code'] = 'order_error_11';
            return $ret;
        }
        $where = array('Fid' => $option['Fid']);
        unset($option['Fid']);
        $res = $this->order_dao->updateClaims($where, $option);
        if (!$res) {
            $ret['code'] = 'order_error_12';
        }
        return $ret;

    }


}