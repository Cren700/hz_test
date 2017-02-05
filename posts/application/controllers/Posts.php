<?php

/**
 * Posts.php
 * Author   : cren
 * Date     : 2016/11/27
 * Time     : 下午11:22
 */
class Posts extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/posts_service_model', 'posts_service');
    }

    /**
     * 根据分类获取posts
     */
    public function postsListByCate()
    {
        $option = array(
            'p' => $this->input->get('p', true),
            'page_size' => $this->input->get('page_size', true),
            'Fpost_category_id' => $this->input->get('post_category_id', true),
        );
        $res = $this->posts_service->postsListByCate($option);
        echo outputResponse($res);
    }

    /**
     * 查询
     */
    public function query()
    {
        $option = array(
            'Fpost_title' => $this->input->get('post_title', true),
            'Fpost_author' => $this->input->get('post_author', true),
            'Fpost_category_id' => $this->input->get('post_category_id', true),
            'Fpost_status' => $this->input->get('post_status', true),
            'Fis_del' => (int)$this->input->get('is_del', true),
            'Fuser_type' => (int)$this->input->get('user_type', true),
            'Fuser_id' => (int)$this->input->get('user_id', true),
            'p' => $this->input->get('p', true),
            'page_size' => $this->input->get('page_size', true),
            'min_date' => $this->input->get('min_date', true),
            'max_date' => $this->input->get('max_date', true),
        );
        $res = $this->posts_service->query($option);
        echo outputResponse($res);
    }

    /**
     * 获取某资讯
     */
    public function getPostsByPid()
    {
        $where = array(
            'Fid'  => $this->input->get('id')// 资讯id
        );
        $res = $this->posts_service->getPostsByPid($where);
        echo outputResponse($res);
    }

    /**
     * 添加资讯
     */
    public function add()
    {
        $data = array(
            'Fuser_id' => $this->input->post('user_id'),
            'Fuser_type' => $this->input->post('user_type'),
            'Fpost_title' => $this->input->post('post_title'),
            'Fpost_author' => $this->input->post('post_author'),
            'Fpost_category_id' => $this->input->post('category_id'),
            'Fpost_content' => $this->input->post('post_content'),
            'Fpost_excerpt' => $this->input->post('post_excerpt'),// 摘要
            'Fpost_keyword' => $this->input->post('post_keyword'),// 关键词
            'Fpost_coverimage' => $this->input->post('post_coverimage'),
            'Fcomment_status' => $this->input->post('comment_status') ? 1 : 0,//是否评论
            'Fpost_content' => $this->input->post('post_content'),
            'Fremark' => $this->input->post('remark'),
            'Fcreate_time'  => time(),
            'Fupdate_time'  => time(),
        );
        $res = $this->posts_service->add($data);
        echo outputResponse($res);
    }

    /**
     * 更新资讯
     */
    public function update()
    {
        $where = array('Fid' => $this->input->post('id'));
        $data = array(
            'Fuser_id' => $this->input->post('user_id'),
            'Fuser_type' => $this->input->post('user_type'),
            'Fpost_title' => $this->input->post('post_title'),
            'Fpost_author' => $this->input->post('post_author'),
            'Fpost_category_id' => $this->input->post('category_id'),
            'Fpost_content' => $this->input->post('post_content'),
            'Fpost_excerpt' => $this->input->post('post_excerpt'),// 摘要
            'Fpost_keyword' => $this->input->post('post_keyword'),// 关键词
            'Fpost_coverimage' => $this->input->post('post_coverimage'),
            'Fcomment_status' => $this->input->post('comment_status') ? 1 : 0,//是否评论
            'Fpost_content' => $this->input->post('post_content'),
            'Fremark' => $this->input->post('remark'),
            'Fupdate_time'  => time(),
        );
        $res = $this->posts_service->update($where, $data);
        echo outputResponse($res);
    }

    /**
     * 删除资讯
     */
    public function del()
    {
        $where = array('Fid' => $this->input->get('pid'));
        $res = $this->posts_service->del($where);
        echo outputResponse($res);
    }

    /**
     * 更新状态
     */
    public function changeStatus()
    {
        $data = array(
            'Fpost_status' => $this->input->post('status'),
            'Fis_del' => $this->input->post('is_del')
        );
        $where = array(
            'Fid'   => $this->input->post('pid')
        );
        $res = $this->posts_service->changeStatus($data, $where);
        echo outputResponse($res);
    }

    /**
     * 相关新闻
     */
    public function relatedPosts()
    {
        $data = array(
            'Fid' => $this->input->get('id'),
            'Fpost_category_id' => $this->input->get('post_category_id'),
            'Fpost_keyword' => $this->input->get('post_keyword')
        );
        $res = $this->posts_service->relatedPosts($data);
        echo outputResponse($res);
    }

    /**
     * 提交评论
     */
    public function submitComment()
    {
        $data = array(
            'Fcomment_post_id' => $this->input->post('post_id', true),
            'Fcomment_author_id' => $this->input->post('author_id', true),
            'Fcomment_author_name' => $this->input->post('author_name', true),
            'Fcomment_author_ip' => $this->input->post('author_ip', true),
            'Fcomment_date' => time(),
            'Fcomment_content' => $this->input->post('content')
        );
        $res = $this->posts_service->submitComment($data);
        echo outputResponse($res);
    }

    /**
     * 产品评论列表
     */
    public function getCommentListByPid()
    {
        $option = array(
            'Fcomment_post_id' => $this->input->get('post_id', true)
        );
        $res = $this->posts_service->getCommentListByPid($option);
        echo outputResponse($res);
    }

    /**
     * 关注数量
     */
    public function getPraiseCountByPid()
    {
        $option = array(
            'Fpraise_post_id' => $this->input->get('post_id', true)
        );
        $res = $this->posts_service->getPraiseCountByPid($option);
        echo outputResponse($res);
    }

    /**
     * 是否关注
     */
    public function getIsPraise()
    {
        $option = array(
            'Fpraise_post_id' => $this->input->get('post_id', true),
            'Fuser_id' => $this->input->get('user_id', true)
        );
        $res = $this->posts_service->getIsPraise($option);
        echo outputResponse($res);
    }

    /**
     * 关注操作
     */
    public function doPraise()
    {
        $option = array(
            'Fpraise_post_id' => $this->input->get('post_id', true),
            'Fuser_id' => $this->input->get('user_id', true)
        );
        $res = $this->posts_service->doPraise($option);
        echo outputResponse($res);
    }

    /**
     * 评论列表
     */
    public function queryComment()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'Fcomment_post_id'   => $this->input->get('post_id', true),
            'Fcomment_author_name'   => $this->input->get('author_name', true),
            'Fcomment_approved' => $this->input->get('comment_approved', true),
            'min_date' => $this->input->get('min_date', true),
            'max_date' => $this->input->get('max_date', true),
        );
        $res = $this->posts_service->queryComment($option);
        echo outputResponse($res);
    }

    /**
     * 更新评论状态
     */
    public function statusComment()
    {
        $data = array(
            'Fcomment_approved' => $this->input->post('status', true),
        );
        $where = array(
            'Fcomment_id' => $this->input->post('comment_id', true),
        );
        $res = $this->posts_service->statusComment($data, $where);
        echo outputResponse($res);
    }

    /**
     * 删除评论
     */
    public function delComment()
    {
        $where = array(
            'Fcomment_id' => $this->input->post('comment_id', true),
        );
        $res = $this->posts_service->delComment($where);
        echo outputResponse($res);
    }

    /**
     * 评论列表
     */
    public function queryPraise()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'Fpraise_post_id'   => $this->input->get('post_id', true),
            'Fuser_id'   => $this->input->get('user_id', true),
        );
        $res = $this->posts_service->queryPraise($option);
        echo outputResponse($res);
    }

    /**
     * 我的关注
     */
    public function getPraiseListByUid()
    {
        $option = array('Fuser_id' => $this->input->get('user_id', true));
        $res = $this->posts_service->getPraiseListByUid($option);
        echo outputResponse($res);
    }

    /**
     * 搜索
     */
    public function search()
    {
        $option = array('keyword' => $this->input->get('keyword', true));
        $res = $this->posts_service->search($option);
        echo outputResponse($res);
    }

    public function getCommentListByUid()
    {
        $option = array('Fcomment_author_name' => $this->input->get('user_id', true));
        $res = $this->posts_service->getCommentListByUid($option);
        echo outputResponse($res);
    }
    
    public function userDelComment()
    {
        $option = array(
            'Fcomment_id' => $this->input->post('comment_id', true),
            'Fcomment_author_id' => $this->input->post('author_id', true)
        );
        $res = $this->posts_service->userDelComment($option);
        echo outputResponse($res);
    }


    /**
     * 添加专题
     */
    public function addTheme()
    {
        $data = array(
            'Fuser_id' => $this->input->post('user_id', true),
            'Ftheme_content' => $this->input->post('theme_content', true),
            'Ftheme_title' => $this->input->post('theme_title', true),
            'Ftheme_excerpt' => $this->input->post('theme_excerpt', true),
            'Ftheme_coverimage' => $this->input->post('theme_coverimage', true),
            'Fbanner_path' => $this->input->post('banner_path', true),
            'Fcreate_time'  => time(),
            'Fupdate_time'  => time(),
        );
        $res = $this->posts_service->addTheme($data);
        echo outputResponse($res);
    }

    /**
     * 更新资讯
     */
    public function updateTheme()
    {
        $where = array('Fid' => $this->input->post('id', true));

        $data = array(
            'Ftheme_content' => $this->input->post('theme_content', true),
            'Ftheme_title' => $this->input->post('theme_title', true),
            'Ftheme_excerpt' => $this->input->post('theme_excerpt', true),
            'Ftheme_coverimage' => $this->input->post('theme_coverimage', true),
            'Fbanner_path' => $this->input->post('banner_path', true),
            'Fupdate_time'  => time(),
        );

        $res = $this->posts_service->updateTheme($where, $data);
        echo outputResponse($res);
    }

    /**
     * 获取某专题
     */
    public function getThemeByPid()
    {
        $where = array(
            'Fid'  => $this->input->get('id', true)// 专题id
        );
        $res = $this->posts_service->getThemeByPid($where);
        echo outputResponse($res);
    }

    /**
     * 获取某专题资讯列表
     */
    public function getPostsThemeByPid()
    {
        $where = array(
            'Fid'  => $this->input->get('id', true)// 专题id
        );
        $res = $this->posts_service->getPostsThemeByPid($where);
        echo outputResponse($res);
    }

    /**
     * 查询
     */
    public function queryThemes()
    {
        $option = array(
            'p' => $this->input->get('p'),
            'page_size' => $this->input->get('page_size', true),
        );
        $res = $this->posts_service->queryThemes($option);
        echo outputResponse($res);
    }

    /**
     * 删除资讯
     */
    public function delTheme()
    {
        $where = array('Fid' => $this->input->get('id', true));
        $res = $this->posts_service->delTheme($where);
        echo outputResponse($res);
    }

    /**
     * 更新状态
     */
    public function changeThemeStatus()
    {
        $data = array(
            'Ftheme_status' => $this->input->post('status', true),
        );
        $where = array(
            'Fid'   => $this->input->post('id')
        );
        $res = $this->posts_service->changeThemeStatus($data, $where);
        echo outputResponse($res);
    }

    public function addThemePost()
    {
        $where = array(
            'Fid' => $this->input->post('id')
        );
        $data = array('Fpost_id' => $this->input->post('post_id', true));
        $res = $this->posts_service->addThemePost($data, $where);
        echo outputResponse($res);
    }

    public function getThemeList()
    {
        $where = array('Ftheme_status' => $this->input->get('theme_status', true));
        $res = $this->posts_service->getThemeList($where);
        echo outputResponse($res);
    }

    public function saveEvent()
    {
        $option = array(
            'Fpartners_id' => $this->input->post('partners_id', true),
            'Fpartners_name' => $this->input->post('partners_name', true),
            'Fnum' => $this->input->post('num'),
        );
        $res = $this->posts_service->saveEvent($option);
        echo outputResponse($res);
    }

    /**
     * 查询
     */
    public function queryEvents()
    {
        $option = array(
            'p' => $this->input->get('p', true),
            'page_size' => $this->input->get('page_size', true),
        );
        $res = $this->posts_service->queryEvents($option);
        echo outputResponse($res);
    }

    /**
     * 删除行业信息
     */
    public function delEvent()
    {
        $where = array('Fid' => $this->input->get('id', true));
        $res = $this->posts_service->delEvent($where);
        echo outputResponse($res);
    }

    public function modifyEvent()
    {
        $where = array('Fid' => $this->input->post('id', true));
        $data = array(
            'Fnum' => $this->input->post('num'),
        );
        $res = $this->posts_service->modifyEvent($where, $data);
        echo outputResponse($res);
    }

    public function hasPostsPower()
    {
        $option = array(
            'Fid' => $this->input->get('id', true),
            'Fuser_id' => $this->input->get('user_id', true),
            'Fuser_type' => $this->input->get('user_type', true)
        );
        $res = $this->posts_service->hasPostsPower($option);
        echo outputResponse($res);
    }
}