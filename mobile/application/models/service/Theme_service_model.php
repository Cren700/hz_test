<?php

/**
 * Theme_service_model.php
 * Author   : cren
 * Date     : 2016/12/18
 * Time     : 下午9:20
 */
class Theme_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCate($is_special = 1)
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

    public function getThemeList()
    {
        $option = array('theme_status' => 1);
        return $this->myCurl('posts', 'getThemeList', $option, false);
    }

    public function getPostsThemeByPid($data)
    {
        return $this->myCurl('posts', 'getPostsThemeByPid', $data, false);
    }
}