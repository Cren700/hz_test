<?php

/**
 * Post_service_model.php
 * Author   : cren
 * Date     : 2016/12/10
 * Time     : 下午12:02
 */
class Posts_service_model extends HZ_Model
{
    private $_api = 'posts';
    public function __construct()
    {
        parent::__construct();
    }

    public function query($data)
    {
        return $this->myCurl($this->_api, 'queryPosts', $data, false);
    }

    public function getPostsByPid($data)
    {
        return $this->myCurl($this->_api, 'getPostsByPid', $data, false);
    }

    public function status($data)
    {
        return $this->myCurl($this->_api, 'changeStatus', $data, true);
    }

    public function save($data)
    {
        $is_new = $data['is_new'];
        unset($data['is_new']);
        if ($is_new) {
            $res = $this->myCurl($this->_api, 'addPosts', $data, true);
        } else {
            $res = $this->myCurl($this->_api, 'updatePosts', $data, true);
        }
        if ($res['code'] === 0) {
            $res['data']['url'] = getBaseUrl('/posts.html');
        }
        return $res;
    }

    public function del($data)
    {
        return $this->myCurl($this->_api, 'delPosts', $data, false);
    }

    public function batchDelPosts($option)
    {
        return $this->myCurl($this->_api, 'batchDelPosts', $option, true);
    }

    public function category()
    {
        return $this->myCurl($this->_api, 'category', array());
    }

    public function getPostsCateCount()
    {
        return $this->myCurl($this->_api, 'getPostsCateCount', array());
    }

    public function getCategory($data)
    {
        return $this->myCurl($this->_api, 'getCategory', $data, false);
    }

    public function saveCate($data)
    {
        $is_new = $data['is_new'];
        unset($data['is_new']);
        if ($is_new) {
            return $this->myCurl($this->_api, 'addCategory', $data, true);
        } else {
            return $this->myCurl($this->_api, 'updateCategory', $data, true);
        }
    }

    public function cateStatus($data)
    {
        return $this->myCurl($this->_api, 'cateStatus', $data, true);
    }

    public function cateDel($data)
    {
        return $this->myCurl($this->_api, 'delCategory', $data, false);
    }

    // 获取评论列表
    public function queryComment($data)
    {
        return $this->myCurl($this->_api, 'queryComment', $data, false);
    }

    public function statusComment($data)
    {
        return $this->myCurl($this->_api, 'statusComment', $data, true);
    }

    public function delComment($data)
    {
        return $this->myCurl($this->_api, 'delComment', $data, true);
    }

    public function batchDelComment($option)
    {
        return $this->myCurl($this->_api, 'batchDelComment', $option, true);
    }

    // 获取关注列表
    public function queryPraise($data)
    {
        return $this->myCurl($this->_api, 'queryPraise', $data, false);
    }

    public function queryThemes($data)
    {
        return $this->myCurl($this->_api, 'queryThemes', $data, false);
    }

    public function statusTheme($data)
    {
        return $this->myCurl($this->_api, 'changeThemeStatus', $data, true);
    }

    public function saveTheme($data)
    {
        $is_new = $data['is_new'];
        unset($data['is_new']);
        if ($is_new) {
            $res = $this->myCurl($this->_api, 'addTheme', $data, true);
        } else {
            $res = $this->myCurl($this->_api, 'updateTheme', $data, true);
        }
        if ($res['code'] === 0) {
            $res['data']['url'] = getBaseUrl('/posts/theme.html');
        }
        return $res;
    }

    public function delTheme($data)
    {
        return $this->myCurl($this->_api, 'delTheme', $data, false);
    }

    public function batchDelThemes($option)
    {
        return $this->myCurl($this->_api, 'batchDelThemes', $option, true);
    }

    public function getThemeByPid($data)
    {
        return $this->myCurl($this->_api, 'getThemeByPid', $data, false);
    }

    public function getPostsThemeByPid($data)
    {
        return $this->myCurl($this->_api, 'getPostsThemeByPid', $data, false);
    }

    public function addThemePost($option)
    {
        return $this->myCurl($this->_api, 'addThemePost', $option, true);
    }

    public function saveEvent($option)
    {
        $res = $this->myCurl($this->_api, 'saveEvent', $option, true);
        if ($res['code'] === 0) {
            $res['data']['url'] = getBaseUrl('/posts/events.html');
        }
        return $res;
    }

    public function queryEvents($data)
    {
        return $this->myCurl($this->_api, 'queryEvents', $data, false);
    }

    public function delEvent($data)
    {
        return $this->myCurl($this->_api, 'delEvent', $data, false);
    }

    public function modifyEvent($option)
    {
        return $this->myCurl($this->_api, 'modifyEvent', $option, true);
    }

    public function notApproved($option)
    {
        return $this->myCurl($this->_api, 'notApproved', $option, true);
    }
}