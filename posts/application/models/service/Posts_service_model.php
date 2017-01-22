<?php

/**
 * Posts_service_model.php
 * Author   : cren
 * Date     : 2016/11/28
 * Time     : 下午11:39
 */
class Posts_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/posts_dao_model', 'posts_dao');
    }
    
    public function query($option)
    {
        $res = array('code' => 0);
        $like = array();
        $where = array();

        if (!empty($option['Fpost_category_id'])) {
            $where['Fpost_category_id'] = $option['Fpost_category_id'];
        }

        if ($option['Fpost_status'] === '0' || !empty($option['Fpost_status'])) {
            $where['Fpost_status'] = $option['Fpost_status'];
        }

        if (!empty($option['min_date'])) {
            $where['Fcreate_time >= '] = strtotime($option['min_date']);
        }

        if (!empty($option['max_date'])) {
            $where['Fcreate_time <= '] = strtotime($option['max_date'])+23*3600+3599;
        }

        if ($option['Fis_del'] === '0' || !empty($option['Fis_del'])) {
            $where['Fis_del'] = $option['Fis_del'];
        }
        // like
        if ($option['Fpost_title'] === '0' || !empty($option['Fpost_title'])) {
            $like['Fpost_title'] = $option['Fpost_title'];
        }

        if ($option['Fpost_author'] === '0' || !empty($option['Fpost_author'])) {
            $like['Fpost_author'] = $option['Fpost_author'];
        }
        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'] ? : 10;
        $res['data']['count'] = $this->posts_dao->postsNum($where, $like);
        $res['data']['list'] = $this->posts_dao->postsList($where, $like, $page, $page_size);

        return $res;
    }

    public function postsListByCate($option)
    {
        $res = array('code' => 0);
        $where = $option['Fpost_category_id'];
        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'] ? : 10;
        $res['data']['count'] = $this->posts_dao->postsNumByCate($where);
        $res['data']['list'] = $this->posts_dao->postsListByCate($where, $page, $page_size);
        return $res;
    }

    public function add($data)
    {
        $ret = array('code' => 0);
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Fpost_title'],
                'rules' => 'required|min_length[10]|max_length[200]',
                'field' => '文章标题'
            ),
            array(
                'value' => $data['Fuser_id'],
                'rules' => 'required',
                'field' => '发布者'
            ),
            array(
                'value' => $data['Fpost_author'],
                'rules' => 'required',
                'field' => '文章作者'
            ),
            array(
                'value' => $data['Fpost_category_id'],
                'rules' => 'required',
                'field' => '文章分类'
            ),
            array(
                'value' => $data['Fpost_content'],
                'rules' => 'required',
                'field' => '文章内容'
            )
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }
        $res = $this->posts_dao->add($data);
        if (!$res) {
            $ret['code'] = 'system_error_2'; //操作出错
        }
        return $ret;
    }

    public function getPostsByPid($where)
    {
        $ret = array('code' => 0);
        $res = $this->posts_dao->getPostsByPid($where);
        $ret['data'] = $res;
        return $ret;
    }

    public function update($where, $data)
    {
        $ret = array('code' => 0);
        if (!isset($where['Fid']) && empty($where['Fid'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
            return $ret;
        }
        $product = $this->posts_dao->getPostsByPid($where);
        if (empty($product)) {
            $ret['code'] = 'posts_error_2'; // 不存在
            return $ret;
        }
        $validationConfig = array(
            array(
                'value' => $data['Fuser_id'],
                'rules' => 'required',
                'field' => '发布者'
            ),
            array(
                'value' => $data['Fpost_author'],
                'rules' => 'required',
                'field' => '文章作者'
            ),
            array(
                'value' => $data['Fpost_content'],
                'rules' => 'required',
                'field' => '文章内容'
            ),
            array(
                'value' => $data['Fpost_category_id'],
                'rules' => 'required',
                'field' => '文章分类'
            ),
            array(
                'value' => $data['Fpost_title'],
                'rules' => 'required|min_length[10]|max_length[200]',
                'field' => '文章标题'
            )
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }

        $res = $this->posts_dao->update($where, $data);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'product_error_5';
        }
    }

    public function del($where)
    {
        $ret = array('code' => 0);
        if (!isset($where['Fproduct_id']) && empty($where['Fproduct_id'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
            return $ret;
        }
        $product = $this->posts_dao->getPostsByPid($where);
        if (empty($product)) {
            $ret['code'] = 'posts_error_2'; // 不存在
            return $ret;
        }
        $res = $this->posts_dao->del($where);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'product_error_4';
        }
    }

    public function changeStatus($data, $where)
    {
        $ret = array('code' => 0);
        if (!isset($data['Fproduct_status']) && empty($data['Fproduct_status'])) {
            unset($data['Fproduct_status']);
        }
        if (!isset($data['Fis_del']) && empty($data['Fis_del'])) {
            unset($data['Fis_del']);
        }
        if (empty($data) || empty($where)) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $product = $this->posts_dao->getPostsByPid($where);
        if (empty($product)) {
            $ret['code'] = 'posts_error_2'; // 不存在
            return $ret;
        }
        $data['Fupdate_time'] = time();
        $res = $this->posts_dao->changeStatus($data, $where);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'posts_error_9';
        }
    }

    public function relatedPosts($option)
    {
        $ret = array('code' => 0);
        $where = ' Fpost_status = 3 AND Fpost_category_id = ' . $option['Fpost_category_id'];
        $keyword = explode('、', $option['Fpost_keyword']);
        foreach($keyword as $k) {
            $where .= ' OR Fpost_keyword like "%'. $k .'%"';
        }
        $where_not_in = ' Fid != ' .$option['Fid'];
        $res = $this->posts_dao->relatedPosts($where, $where_not_in);
        $ret['data'] = $res;
        return $ret;
    }

    /**
     * 提交评论
     * @param $data
     * @return array
     */
    public function submitComment($data)
    {
        $ret = array('code' => 0);
        if (empty($data['Fcomment_post_id']) || empty($data['Fcomment_author_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $res = $this->posts_dao->submitComment($data);
        if ($res) {
            $ret['data'] = $data;
        } else {
            $ret['code'] = 'posts_error_10';
        }
        return $ret;
    }

    /**
     * 获取评论列表
     * @param $option
     * @return array
     */
    public function getCommentListByPid($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fcomment_post_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $option['Fcomment_approved'] = 1; // 通过审核
        $res = $this->posts_dao->getCommentListByPid($option);
        foreach ($res as &$re) {
            $user = $this->myCurl('account', 'getInfo', array('id' => $re['Fcomment_author_id']));
            $re['Fcomment_authro_image'] = isset($user['data']['Fimage_path']) ? $user['data']['Fimage_path'] : '';
        }
        $ret['data'] = $res;
        return $ret;

    }

    public function getPraiseCountByPid($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fpraise_post_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $res = $this->posts_dao->getPraiseCountByPid($option);
        $ret['count'] = $res;
        return $ret;
    }

    public function getIsPraise($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fpraise_post_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $res = $this->posts_dao->getIsPraise($option);
        $ret['count'] = $res;
        return $ret;
    }

    public function doPraise($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fpraise_post_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $is_praise = $this->posts_dao->getIsPraise($option);
        if (!$is_praise) {
            // 添加
            $this->posts_dao->addPraise($option);
            $ret['status'] = 1;
        } else {
            // 删除
            $this->posts_dao->delPraise($option);
            $ret['status'] = 0;
        }
        return $ret;
    }

    /**
     * 评论列表
     * @param $option
     * @return array
     */
    public function queryComment($option)
    {
        $res = array('code' => 0);
        $like = array();
        $where = array();

        if (!empty($option['Fcomment_post_id'])) {
            $where['Fcomment_post_id'] = $option['Fcomment_post_id'];
        }

        if ($option['Fcomment_approved'] === '0' || !empty($option['Fcomment_approved'])) {
            $where['Fcomment_approved'] = $option['Fcomment_approved'];
        }

        if (!empty($option['min_date'])) {
            $where['Fcomment_date >= '] = strtotime($option['min_date']);
        }

        if (!empty($option['max_date'])) {
            $where['Fcomment_date <= '] = strtotime($option['max_date'])+23*3600+3599;
        }

        // like
        if (!empty($option['Fcomment_author_name'])) {
            $like['Fcomment_author_name'] = $option['Fcomment_author_name'];
        }

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'] ? : 10;
        $res['data']['count'] = $this->posts_dao->postsCommentNum($where, $like);
        $commentList = $this->posts_dao->postsCommentList($where, $like, $page, $page_size);
        $res['data']['list'] = $commentList;
        return $res;
    }

    public function statusComment($data, $where)
    {
        $ret = array('code' => 0);
        if (empty($where['Fcomment_id']) || ($data['Fcomment_approved'] !== '0' && empty($data['Fcomment_approved']))) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $res = $this->posts_dao->statusComment($data, $where);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'posts_error_9';
        }
    }

    public function delComment($where)
    {
        $ret = array('code' => 0);
        if (empty($where['Fcomment_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $res = $this->posts_dao->delComment($where);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'posts_error_12';
        }
    }

    /**
     * 关注列表
     * @param $option
     * @return array
     */
    public function queryPraise($option)
    {
        $res = array('code' => 0);
        $like = array();
        $where = array();

        if (!empty($option['Fpraise_post_id'])) {
            $where['Fpraise_post_id'] = $option['Fpraise_post_id'];
        }
        // like
        if (!empty($option['Fuser_id'])) {
            $like['pp.Fuser_id'] = $option['Fuser_id'];
        }

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'] ? : 10;
        $res['data']['count'] = $this->posts_dao->postsPraiseNum($where, $like);
        $praiseList = $this->posts_dao->postsPraiseList($where, $like, $page, $page_size);
        $res['data']['list'] = $praiseList;
        return $res;
    }

    /**
     * 我的关注
     */
    public function getPraiseListByUid($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fuser_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $where = array('p.Fuser_id' => $option['Fuser_id']);
        $res = $this->posts_dao->getPraiseListByUid($where);
        $ret['data'] = $res;
        return $ret;
    }

    public function getCommentListByUid($option){
        $ret = array('code' => 0);
        if (empty($option['Fcomment_author_name'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $where = array('c.Fcomment_author_name' => $option['Fcomment_author_name']);
        $res = $this->posts_dao->getCommentListByUid($where);
        $ret['data'] = $res;
        return $ret;
    }

    public function userDelComment($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fcomment_id']) || empty($option['Fcomment_author_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $this->posts_dao->userDelComment($option);
        return $ret;
    }

    /**
     * 搜索
     * @param $option
     * @return array
     */
    public function search($option)
    {
        $ret = array('code' => 0);
        if (empty($option['keyword'])) {
            $ret['code'] = 'posts_error_14'; // 暂无数据
            return $ret;
        }

        $where1 = 'Fpost_keyword like "%'.$option['keyword'].'%" AND Fpost_status = 3';
        $where2 = 'Fpost_title like "%'.$option['keyword'].'%" AND Fpost_status = 3';

        $res = $this->posts_dao->search($where1, $where2);
        if (!$res) {
            $ret['code'] = 'posts_error_14';
        } else {
            $ret['data'] = $res;
        }
        return $ret;
    }

    //********************------专题--------*****************//

    public function addTheme($data)
    {
        $ret = array('code' => 0);
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Ftheme_title'],
                'rules' => 'required|min_length[10]|max_length[200]',
                'field' => '专题标题'
            ),
            array(
                'value' => $data['Fuser_id'],
                'rules' => 'required',
                'field' => '发布者'
            )
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }
        $res = $this->posts_dao->addTheme($data);
        if (!$res) {
            $ret['code'] = 'system_error_2'; //操作出错
        }
        return $ret;
    }

    public function updateTheme($where, $data)
    {
        $ret = array('code' => 0);
        if (!isset($where['Fid']) && empty($where['Fid'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
            return $ret;
        }
        $theme = $this->posts_dao->getThemeByPid($where);
        if (empty($theme)) {
            $ret['code'] = 'posts_error_2'; // 不存在
            return $ret;
        }
        $validationConfig = array(
            array(
                'value' => $data['Ftheme_title'],
                'rules' => 'required|min_length[10]|max_length[200]',
                'field' => '文章标题'
            )
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }

        $res = $this->posts_dao->updateTheme($where, $data);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'product_error_5';
        }
    }

    public function delTheme($where)
    {
        $ret = array('code' => 0);
        if (!isset($where['Fid']) && empty($where['Fid'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
            return $ret;
        }
        $theme = $this->posts_dao->getThemeByPid($where);
        if (empty($theme)) {
            $ret['code'] = 'posts_error_2'; // 不存在
            return $ret;
        }
        $res = $this->posts_dao->delTheme($where);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'product_error_4';
        }
    }

    public function queryThemes($option)
    {
        $res = array('code' => 0);

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'] ? : 10;
        $res['data']['count'] = $this->posts_dao->themeNum();
        $res['data']['list'] = $this->posts_dao->themeList($page, $page_size);

        return $res;
    }

    public function changeThemeStatus($data, $where)
    {
        $ret = array('code' => 0);
        if (empty($data) || empty($where)) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $theme = $this->posts_dao->getThemeByPid($where);
        if (empty($theme)) {
            $ret['code'] = 'posts_error_2'; // 不存在
            return $ret;
        }
        $data['Fupdate_time'] = time();
        $res = $this->posts_dao->changeThemeStatus($data, $where);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'posts_error_9';
        }
    }

    public function getThemeByPid($where)
    {
        $ret = array('code' => 0);
        $res = $this->posts_dao->getThemeByPid($where);
        $ret['data'] = $res;
        return $ret;
    }

    public function getPostsThemeByPid($where)
    {
        $ret = array('code' => 0);
        $postList = array();
        $res = $this->posts_dao->getThemeByPid($where);
        if(isset($res['Fpost_id']) && !empty($res['Fpost_id'])) {
            $posts = explode(',', $res['Fpost_id']);
            $postList = $this->posts_dao->getPostsByPids($posts);
        }
        $ret['data'] = $res;
        $ret['postList'] = $postList;
        return $ret;
    }

    public function addThemePost($data, $where)
    {
        $ret = array('code' => 0);
        if (empty($data) || empty($where)) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $theme = $this->posts_dao->getThemeByPid($where);
        if (empty($theme)) {
            $ret['code'] = 'posts_error_2'; // 不存在
            return $ret;
        }
        $data['Fupdate_time'] = time();
        $this->posts_dao->addThemePost($data, $where);
        return $ret;
    }

    public function getThemeList($where)
    {
        $ret = array('code' => 0);
        $theme = $this->posts_dao->getThemeList($where);
        $ret['data'] = $theme;
        return $ret;
    }
}