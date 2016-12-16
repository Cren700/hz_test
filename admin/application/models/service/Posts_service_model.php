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

    public function category()
    {
        return $this->myCurl($this->_api, 'category', array());
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

    public function delCate($data)
    {
        return $this->myCurl($this->_api, 'delCategory', $data, false);
    }
}