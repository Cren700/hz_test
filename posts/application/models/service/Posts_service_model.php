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
        $where = array(
            'Fid !=' => $option['Fid'],
            'Fpost_status' => 3,
            'Fpost_category_id' => $option['Fpost_category_id'],
        );
        $like = array();
        $keyword = explode('、', $option['Fpost_keyword']);
        foreach($keyword as $k) {
            $like[] = array('Fpost_keyword' => $k);
        }
        $res = $this->posts_dao->relatedPosts($like, $where);
        $ret['data'] = $res;
        return $ret;

    }

}