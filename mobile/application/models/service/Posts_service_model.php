<?php

/**
 * Posts_service_model.php
 * Author   : cren
 * Date     : 2016/12/18
 * Time     : 下午9:20
 */
class Posts_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCate($is_special = 0)
    {
        return $this->myCurl('posts', 'category', array('status' => '1', 'is_special' => $is_special));
    }
    
    public function getPostsList($option)
    {
        return $this->myCurl('posts', 'postsListByCate', $option, false);
    }

    public function getPost($option)
    {
        return $this->myCurl('posts', 'getPostsByPid', $option);
    }

    /**
     * 相关信息
     * @param $posts
     * @return mixed
     */
    public function relatedPosts($posts)
    {
        $option = array(
            'id' => $posts['Fid'],
            'post_category_id' => $posts['Fpost_category_id'],
            'post_keyword' => $posts['Fpost_keyword']
        );
        return $this->myCurl('posts', 'relatedPosts', $option, false);
    }

    public function submitComment($option)
    {
        return $this->myCurl('posts', 'submitComment', $option, true);
    }

    public function getCommentListByPid($pid)
    {
        $where = array('post_id' => $pid);
        $res = $this->myCurl('posts', 'getCommentListByPid', $where);
        if (isset($res['data']['list'])) {
            foreach ($res['data']['list'] as &$r) {
                if (!$r['Fcomment_name']) {
                    $r['Fcomment_name'] = substr($r['Fcomment_author_name'], 0,2).'**'.substr($r['Fcomment_author_name'], -2);
                }
            }
        }
        return $res;
    }

    public function getPraiseCountByPid($pid)
    {
        $where = array('post_id' => $pid);
        return $this->myCurl('posts', 'getPraiseCountByPid', $where);
    }

    public function getIsPraise($pid)
    {
        $where = array('post_id' => $pid, 'user_id' => $this->_user_id);
        return $this->myCurl('posts', 'getIsPraise', $where);
    }

    public function doPraise($option)
    {
        $where = array('post_id' => $option['post_id'], 'user_id' => $this->_user_id);
        return $this->myCurl('posts', 'doPraise', $where);
    }

    public function search($where)
    {
        return $this->myCurl('posts', 'search', $where);
    }

    public function getPromoRandom()
    {
        return $this->myCurl('promo', 'getPromoRandom', array());
    }
}