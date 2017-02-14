<?php

/**
 * Info_service_model.php
 * Author   : cren
 * Date     : 2017/1/2
 * Time     : 下午5:30
 */
class Info_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 订单列表
     */
    public function orderList($option)
    {
        return $this->myCurl('order', 'getOrderListByUid', $option);
    }

    /**
     * 关注资讯列表
     */
    public function praiseList($option)
    {
        return $this->myCurl('posts', 'getPraiseListByUid', $option);
    }

    /**
     * 收藏产品列表
     */
    public function collectList($option)
    {
        return $this->myCurl('product', 'getCollectListByUid', $option);
    }

    public function doPraise($option)
    {
        $where = array('post_id' => $option['post_id'], 'user_id' => $this->_user_id);
        return $this->myCurl('posts', 'doPraise', $where);
    }

    /**
     * 评论列表
     */
    public function commentList($option)
    {
        return $this->myCurl('posts', 'getCommentListByUid', $option);
    }

    public function mediumQuery($data)
    {
        return $this->myCurl('posts', 'queryPosts', $data, false);
    }

    public function storeProductQuery($data)
    {
        return $this->myCurl('product', 'queryProduct', $data, false);
    }

    public function storeOrderQuery($data)
    {
        return $this->myCurl('order', 'queryOrders', $data, false);
    }

}