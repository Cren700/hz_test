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

    /**
     * 评论列表
     */
    public function commentList($option)
    {
        return $this->myCurl('posts', 'getCommentListByUid', $option);
    }
}