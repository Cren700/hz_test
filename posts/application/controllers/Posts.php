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
            'p' => $this->input->get('p'),
            'page_size' => $this->input->get('page_size'),
            'Fpost_category_id' => $this->input->get('post_category_id'),
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
            'Fpost_title' => $this->input->get('post_title'),
            'Fpost_author' => $this->input->get('post_author'),
            'Fpost_category_id' => $this->input->get('post_category_id'),
            'Fpost_status' => $this->input->get('post_status'),
            'Fis_del' => $this->input->get('is_del'),
            'p' => $this->input->get('p'),
            'page_size' => $this->input->get('page_size'),
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
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
     * @param $option
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
}