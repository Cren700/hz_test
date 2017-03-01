<?php

/**
 * Product_service_model.php
 * Author   : cren
 * Date     : 2016/12/25
 * Time     : 下午1:08
 */
class Product_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCate()
    {
        return $this->myCurl('product', 'category', array());
    }

    public function detail($id)
    {
        $where = array('product_id' => $id);
        $comment_flag = FALSE;
        $res = $this->myCurl('product', 'getProductByPid', $where);
        if ($res['code'] === 0) {
            if ($this->_user_id) {
                $comment_flag = $this->hasCommentPower($id, $this->_user_id);
            }
            // 商家信息
            $store_info = $this->myCurl('account', 'getAccountTotalInfo', array('id' => $res['data']['Fstore_id'], 'type' => $res['data']['Fstore_type']));
            $res['data']['store_info'] = $store_info['data'];
            // 计算数量
            $products= $this->getStoreProduct(array('store_id' => $res['data']['Fstore_id'], 'type' => $res['data']['Fstore_type']));
            $res['data']['productsCount'] = $products['data']['count'];
            // 猜你喜欢
            $like_pro = $this->myCurl('product', 'maybeLike', array('product_id' => $res['data']['Fproduct_id']));
            isset($res['data']) ? $res['data']['comment_flag'] = $comment_flag : '';
            $res['data']['maybeLike'] = isset($like_pro['data']['list']) ? $like_pro['data']['list'] : array();
            // 评论列表
            $commentList = $this->getProComment(array('product_id' => $res['data']['Fproduct_id']));
            $res['data']['commentList'] = isset($commentList['data']['list']) ? $commentList['data']['list'] : array();
            $res['data']['commentAve'] = $commentList['data']['ave'];
            // 理赔金额
            $claims = $this->myCurl('order', 'calClaimsTotal', array('product_id' => $res['data']['Fproduct_id']));
            $res['data']['claimsTotal'] = $claims['code'] === 0 ? $claims['data'] : 0;
        }
        return $res;
    }

    public function hasCommentPower($product_id, $user_id)
    {
        return $this->myCurl('order', 'hasCommentPower', array('product_id'=> $product_id, 'user_id' => $user_id))['data'] ? true : false;
    }

    public function getProductList($option)
    {
        return $this->myCurl('product', 'queryProduct', $option);
    }

    public function getProComment($option){
        $res = $this->myCurl('product', 'getCommentListByPid', $option);
        $total = $start1 = $start2 = $start3 = $start4 = 0;
        if ($res['code'] === 0) {
            // 计算平均分,总平均分
            if (isset($res['data']['list']) && $res['data']['list']) {
                $count = count($res['data']['list']);
                foreach ($res['data']['list'] as $list) {
                    $total += $list['Fstart1'] + $list['Fstart2'] + $list['Fstart3'] + $list['Fstart4'];
                    $start1 += $list['Fstart1'];
                    $start2 += $list['Fstart2'];
                    $start3 += $list['Fstart3'];
                    $start4 += $list['Fstart4'];
                }
                $total = sprintf('%.1f', $total / ($count * 4));
                $start1 = sprintf('%.1f', $start1 / $count);
                $start2 = sprintf('%.1f', $start2 / $count);
                $start3 = sprintf('%.1f', $start3 / $count);
                $start4 = sprintf('%.1f', $start4 / $count);
            }
        }
        $ave = array(
            'total' => $total,
            'start1' => $start1,
            'start2' => $start2,
            'start3' => $start3,
            'start4' => $start4,
        );
        $res['data']['ave'] = $ave;
        return $res;
    }

    public function search($where)
    {
        return $this->myCurl('product', 'search', $where);
    }

    public function submitComment($option)
    {
        return $this->myCurl('product', 'submitComment', $option, true);
    }

    public function getStoreProduct($option)
    {
        return $this->myCurl('product', 'getStoreProduct', $option);
    }

}