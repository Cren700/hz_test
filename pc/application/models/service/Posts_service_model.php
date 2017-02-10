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

    public function getCate()
    {
        return $this->myCurl('posts', 'category', array('status' => '1'));
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
        return $this->myCurl('posts', 'getCommentListByPid', $where);
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

    public function delComment($option)
    {
        return $this->myCurl('posts', 'userDelComment', $option, true);
    }

    public function search($where)
    {
        return $this->myCurl('posts', 'search', $where);
    }

    public function queryEvents($data)
    {
        return $this->myCurl('posts', 'queryEvents', $data, false);
    }

    public function save($data)
    {
        $is_new = $data['is_new'];
        unset($data['is_new']);
        if ($is_new) {
            $res = $this->myCurl('posts', 'addPosts', $data, true);
        } else {
            $res = $this->myCurl('posts', 'updatePosts', $data, true);
        }
        if ($res['code'] === 0) {
            $res['data']['url'] = getBaseUrl('/medium.html');
        }
        return $res;
    }

    public function query($data)
    {
        return $this->myCurl('posts', 'queryPosts', $data, false);
    }

    public function status($data)
    {
        return $this->myCurl('posts', 'changeStatus', $data, true);
    }

    public function del($data)
    {
        return $this->myCurl('posts', 'delPosts', $data, false);
    }

    public function hasMediumPower()
    {
        $option = array('id' => $this->_uid);
        return $this->myCurl('account', 'hasMediumPower', $option, false);
    }

    public function hasPostsPower($pid)
    {
        $option = array(
            'id' => $pid,
            'user_id' => $this->_uid,
            'user_type' => 2
        );
        return $this->myCurl('posts', 'hasPostsPower', $option, false);
    }
    
    public function getBanners()
    {
        return $this->myCurl('posts', 'getBanners', array(), false);
    }

    public function getThreeNews()
    {
        return $this->myCurl('posts', 'getThreeNews', array(), false);
    }

}