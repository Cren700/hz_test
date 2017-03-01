<?php

/**
 * Product.php
 * Author   : cren
 * Date     : 2016/11/28
 * Time     : 下午11:39
 */
class Product_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/product_dao_model', 'product_dao');
    }
    
    public function query($option)
    {
        $res = array('code' => 0);
        $where = array('Fis_del' => '0');
        $where_in = $like = array();

        if (isset($option['Fproduct_id']) && ($option['Fproduct_id'] === '0' || !empty($option['Fproduct_id']))) {
            $where['Fproduct_id'] = $option['Fproduct_id'];
        }

        if (isset($option['Fcategory_id']) && ($option['Fcategory_id'] === '0' || !empty($option['Fcategory_id']))) {
            $where['Fcategory_id'] = $option['Fcategory_id'];
        }

        if (isset($option['Fstore_id']) && ($option['Fstore_id'] === '0' || !empty($option['Fstore_id']))) {
            $where['Fstore_id'] = $option['Fstore_id'];
        }

        if (isset($option['Fstore_type']) && ($option['Fstore_type'] === '0' || !empty($option['Fstore_type']))) {
            $where['Fstore_type'] = $option['Fstore_type'];
        }

        if (isset($option['Fproduct_status']) && ($option['Fproduct_status'] === '0' || !empty($option['Fproduct_status']))) {
            $where_in = $option['Fproduct_status'];
        }

        if (isset($option['Fis_del']) && ($option['Fis_del'] === '0' || !empty($option['Fis_del']))) {
            $where['Fis_del'] = $option['Fis_del'];
        }

        if (isset($option['min_date']) && (!empty($option['min_date']))) {
            $where['Fcreate_time >= '] = strtotime($option['min_date']);
        }

        if (isset($option['max_date']) && (!empty($option['max_date']))) {
            $where['Fcreate_time <= '] = strtotime($option['max_date'])+23*3600+3599;
        }

        if (isset($option['Fproduct_name']) && ($option['Fproduct_name'] === '0' || !empty($option['Fproduct_name']))) {
            $like['Fproduct_name'] = $option['Fproduct_name'];
        }

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'];
        $res['data']['count'] = $this->product_dao->productNum($where, $like, $where_in);
        $product_list = $this->product_dao->productList($where, $like, $where_in, $page, $page_size);
        foreach ($product_list as &$list) {
            $user_info = $this->myCurl('account', 'getStoreName', array('id' => $list['Fstore_id'], 'type' => $list['Fstore_type']), false);
            $list['Fstore_name'] = isset($user_info['data']['Fuser_id']) ? $user_info['data']['Fuser_id'] : '';
        }
        $res['data']['list'] = $product_list;

        return $res;
    }

    public function add($data)
    {
        $ret = array('code' => 0);
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Fstore_id'],
                'rules' => 'required',
                'field' => '操作者'
            ),
            array(
                'value' => $data['Fproduct_name'],
                'rules' => 'required',
                'field' => '产品名称'
            ),
            array(
                'value' => $data['Fcategory_id'],
                'rules' => 'required',
                'field' => '产品分类'
            ),
            array(
                'value' => $data['Fproduct_price'],
                'rules' => 'required|price',
                'field' => '产品价格'
            ),
            array(
                'value' => $data['Fcoverimage'],
                'rules' => 'required',
                'field' => '产品封面'
            ),
            array(
                'value' => $data['Fheight_amount'],
                'rules' => 'required',
                'field' => '最高额度'
            ),
            array(
                'value' => $data['Fscope_insurance'],
                'rules' => 'required',
                'field' => '保障范围'
            ),
            array(
                'value' => $data['Fscope_age'],
                'rules' => 'required',
                'field' => '年龄范围'
            ),
            array(
                'value' => $data['Fobservation_period'],
                'rules' => 'required',
                'field' => '观察期'
            )
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }
        $product = array(
            'Fstore_id' => $data['Fstore_id'],
            'Fstore_type' => $data['Fstore_type'],
            'Fproduct_name' => $data['Fproduct_name'],
            'Fproduct_price' => $data['Fproduct_price'],
            'Fcoverimage' => $data['Fcoverimage'],
            'Fcategory_id' => $data['Fcategory_id'],
            'Fdescription' => $data['Fdescription'],
            'Fcreate_time' => time(),
            'Fupdate_time' => time(),
        );
        $res = $this->product_dao->add($product);
        if (!$res) {
            $ret['code'] = 'system_error_2'; //操作出错
        } else {
            $plan_rule = array();
            $process = array();
            $q_a = array();
            $pledge = array();
            $plan_tk = array();
            $demand = array();
            // 规则
            foreach ($data['Frule_title'] as $k => &$r) {
                if (empty($r) && empty($data['Frule_description'][$k])) {
                    unset($r);
                    unset($data['Frule_description'][$k]);
                } else {
                    $plan_rule[] = array('title' => $r, 'desc' => $data['Frule_description'][$k]);
                }
            }
            // 申请流程
            foreach ($data['Fprocess_title'] as $k => &$r) {
                if (empty($r) && empty($data['Fprocess_description'][$k])) {
                    unset($r);
                    unset($data['Fprocess_description'][$k]);
                } else {
                    $process[] = array('title' => $r, 'desc' => $data['Fprocess_description'][$k]);
                }
            }
            // 常见问题
            foreach ($data['Fquestion'] as $k => &$r) {
                if (empty($r) && empty($data['Fanswer'][$k])) {
                    unset($r);
                    unset($data['Fanswer'][$k]);
                } else {
                    $q_a[] = array('title' => $r, 'desc' => $data['Fanswer'][$k]);
                }
            }
            // 公约内容
            foreach ($data['Fpledge_title'] as $k => &$r) {
                if (empty($r) && empty($data['Fpledge_content'][$k])) {
                    unset($r);
                    unset($data['Fpledge_content'][$k]);
                } else {
                    $pledge[] = array('title' => $r, 'desc' => $data['Fpledge_content'][$k]);
                }
            }
            // 计划条款
            foreach ($data['Fplan_tk_title'] as $k => &$r) {
                if (empty($r) && empty($data['Fplan_tk_content'][$k])) {
                    unset($r);
                    unset($data['Fplan_tk_content'][$k]);
                } else {
                    $plan_tk[] = array('title' => $r, 'desc' => $data['Fplan_tk_content'][$k]);
                }
            }
            // 健康要求
            foreach ($data['Fdemand_title'] as $k => &$r) {
                if (empty($r) && empty($data['Fdemand_content'][$k])) {
                    unset($r);
                    unset($data['Fdemand_content'][$k]);
                } else {
                    $demand[] = array('title' => $r, 'desc' => $data['Fdemand_content'][$k]);
                }
            }

            $product_detail = array(
                'Fproduct_id' => $res,
                'Fheight_amount' => $data['Fheight_amount'],
                'Fscope_insurance' => $data['Fscope_insurance'],
                'Fscope_age' => $data['Fscope_age'],
                'Fobservation_period' => $data['Fobservation_period'],
                'Fcontent' => $data['Fcontent'],
                'Fplan_rule' => json_encode_data($plan_rule),
                'Fapplication_process' => json_encode_data($process),
                'Fq_a' => json_encode_data($q_a),
                'Fjoint_pledge' => json_encode_data($pledge),
                'Fplan_tk' => json_encode_data($plan_tk),
                'Fdemand' => json_encode_data($demand),
            );
            $this->product_dao->addDetail($product_detail);
        }
        return $ret;
    }

    public function update($where, $data)
    {
        $ret = array('code' => 0);
        if (!isset($where['Fproduct_id']) && empty($where['Fproduct_id'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
            return $ret;
        }
        $product = $this->product_dao->getProductInfoByFId($where);
        if (empty($product)) {
            $ret['code'] = 'product_error_2'; // 不存在
            return $ret;
        }
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Fstore_id'],
                'rules' => 'required',
                'field' => '操作者'
            ),
            array(
                'value' => $data['Fproduct_name'],
                'rules' => 'required',
                'field' => '产品名称'
            ),
            array(
                'value' => $data['Fcategory_id'],
                'rules' => 'required',
                'field' => '产品分类'
            ),
            array(
                'value' => $data['Fproduct_price'],
                'rules' => 'required|price',
                'field' => '产品价格'
            ),
            array(
                'value' => $data['Fcoverimage'],
                'rules' => 'required',
                'field' => '产品封面'
            ),
            array(
                'value' => $data['Fheight_amount'],
                'rules' => 'required',
                'field' => '最高额度'
            ),
            array(
                'value' => $data['Fscope_insurance'],
                'rules' => 'required',
                'field' => '保障范围'
            ),
            array(
                'value' => $data['Fscope_age'],
                'rules' => 'required',
                'field' => '年龄范围'
            ),
            array(
                'value' => $data['Fobservation_period'],
                'rules' => 'required',
                'field' => '观察期'
            )
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }
        $product = array(
            'Fstore_id' => $data['Fstore_id'],
            'Fstore_type' => $data['Fstore_type'],
            'Fproduct_name' => $data['Fproduct_name'],
            'Fproduct_price' => $data['Fproduct_price'],
            'Fcategory_id' => $data['Fcategory_id'],
            'Fdescription' => $data['Fdescription'],
            'Fcoverimage' => $data['Fcoverimage'],
            'Fupdate_time' => time(),
        );
        $res = $this->product_dao->update($where, $product);
        if (!$res) {
            $ret['code'] = 'system_error_2'; //操作出错
        } else {
            $plan_rule = array();
            $process = array();
            $q_a = array();
            $pledge = array();
            $plan_tk = array();
            $demand = array();
            // 规则
            foreach ($data['Frule_title'] as $k => &$r) {
                if (empty($r) && empty($data['Frule_description'][$k])) {
                    unset($r);
                    unset($data['Frule_description'][$k]);
                } else {
                    $plan_rule[] = array('title' => $r, 'desc' => $data['Frule_description'][$k]);
                }
            }
            // 申请流程
            foreach ($data['Fprocess_title'] as $k => &$r) {
                if (empty($r) && empty($data['Fprocess_description'][$k])) {
                    unset($r);
                    unset($data['Fprocess_description'][$k]);
                } else {
                    $process[] = array('title' => $r, 'desc' => $data['Fprocess_description'][$k]);
                }
            }
            // 常见问题
            foreach ($data['Fquestion'] as $k => &$r) {
                if (empty($r) && empty($data['Fanswer'][$k])) {
                    unset($r);
                    unset($data['Fanswer'][$k]);
                } else {
                    $q_a[] = array('title' => $r, 'desc' => $data['Fanswer'][$k]);
                }
            }
            // 公约内容
            foreach ($data['Fpledge_title'] as $k => &$r) {
                if (empty($r) && empty($data['Fpledge_content'][$k])) {
                    unset($r);
                    unset($data['Fpledge_content'][$k]);
                } else {
                    $pledge[] = array('title' => $r, 'desc' => $data['Fpledge_content'][$k]);
                }
            }
            // 计划条款
            foreach ($data['Fplan_tk_title'] as $k => &$r) {
                if (empty($r) && empty($data['Fplan_tk_content'][$k])) {
                    unset($r);
                    unset($data['Fplan_tk_content'][$k]);
                } else {
                    $plan_tk[] = array('title' => $r, 'desc' => $data['Fplan_tk_content'][$k]);
                }
            }
            // 健康要求
            foreach ($data['Fdemand_title'] as $k => &$r) {
                if (empty($r) && empty($data['Fdemand_content'][$k])) {
                    unset($r);
                    unset($data['Fdemand_content'][$k]);
                } else {
                    $demand[] = array('title' => $r, 'desc' => $data['Fdemand_content'][$k]);
                }
            }

            $product_detail = array(
                'Fheight_amount' => $data['Fheight_amount'],
                'Fscope_insurance' => $data['Fscope_insurance'],
                'Fscope_age' => $data['Fscope_age'],
                'Fobservation_period' => $data['Fobservation_period'],
                'Fcontent' => $data['Fcontent'],
                'Fplan_rule' => json_encode_data($plan_rule),
                'Fapplication_process' => json_encode_data($process),
                'Fq_a' => json_encode_data($q_a),
                'Fjoint_pledge' => json_encode_data($pledge),
                'Fplan_tk' => json_encode_data($plan_tk),
                'Fdemand' => json_encode_data($demand),
            );
            $res = $this->product_dao->updateDetail($where, $product_detail);
        }
        if ($res) {
            return $ret;
        } else {
            $ret['code'] = 'product_error_5';
            return $ret;
        }
    }

    public function updateProductCnt($where, $data)
    {
        $ret = array('code' => 0);
        $this->product_dao->updateProductCnt($where, $data);
        return $ret;
    }

    public function getProductByPid($where)
    {
        $ret = array('code' => 0);
        $product = $this->product_dao->getProductInfoByFId($where);
        if (empty($product)) {
            $ret['code'] = 'product_error_2'; // 不存在
            return $ret;
        }
        $product_detail = $this->product_dao->getProductDetailByFId($where) ? : array();
        if (!empty($product_detail)) {
            $product_detail['Fplan_rule'] = isset($product_detail['Fplan_rule']) && !empty($product_detail['Fplan_rule']) ? json_decode($product_detail['Fplan_rule']) : '';
            $product_detail['Fapplication_process'] = isset($product_detail['Fapplication_process']) && !empty($product_detail['Fapplication_process']) ? json_decode($product_detail['Fapplication_process']) : '';
            $product_detail['Fq_a'] = isset($product_detail['Fq_a']) && !empty($product_detail['Fq_a']) ? json_decode($product_detail['Fq_a']) : '';
            $product_detail['Fjoint_pledge'] = isset($product_detail['Fjoint_pledge']) && !empty($product_detail['Fjoint_pledge']) ? json_decode($product_detail['Fjoint_pledge']) : '';
            $product_detail['Fplan_tk'] = isset($product_detail['Fplan_tk']) && !empty($product_detail['Fplan_tk']) ? json_decode($product_detail['Fplan_tk']) : '';
            $product_detail['Fdemand'] = isset($product_detail['Fdemand']) && !empty($product_detail['Fdemand']) ? json_decode($product_detail['Fdemand']) : '';
        }
        $res = array_merge($product, $product_detail);
        $ret['data'] = $res;

        // 是否已经收藏
        $where_collect = array(
            'Fuser_id' => $this->_user_id,
            'Fproduct_id' => $where['Fproduct_id']
        );
        $is_collect = $this->product_dao->is_collect($where_collect);
        if ($is_collect) {
            $ret['data']['is_collect'] = 1;
        } else {
            $ret['data']['is_collect'] = 0;
        }
        return $ret;
    }

    public function del($where)
    {
        $ret = array('code' => 0);
        if (!isset($where['Fproduct_id']) && empty($where['Fproduct_id'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
            return $ret;
        }
        $product = $this->product_dao->getProductInfoByFId($where);
        if (empty($product)) {
            $ret['code'] = 'product_error_2'; // 不存在
            return $ret;
        }
        $res = $this->product_dao->del($where);
        if ($res) {
            return $ret;
        } else {
            $ret['code'] = 'product_error_4';
            return $ret;
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
        $product = $this->product_dao->getProductInfoByFId($where);
        if (empty($product)) {
            $ret['code'] = 'product_error_2'; // 不存在
            return $ret;
        }
        $data['Fupdate_time'] = time();
        $res = $this->product_dao->changeStatus($data, $where);
        if ($res) {
            return $ret;
        } else {
            $ret['code'] = 'product_error_9';
            return $ret;
        }
    }

    public function collect($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fuser_id']) || empty($option['Fproduct_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        // 是否已经收藏
        $is_collect = $this->product_dao->is_collect($option);
        if ($is_collect) {
            $where = array('Fproduct_id' => $option['Fproduct_id']);
            $this->product_dao->cancelCollect($where);
        } else {
            $option['Fcreate_time'] = time();
            $res = $this->product_dao->collect($option);
            if (!$res) {
                $ret['code'] = 'product_error_9';
                return $ret;
            }
        }
        return $ret;
    }

    /**
     * 关注列表
     * @param $option
     * @return array
     */
    public function queryCollect($option)
    {
        $res = array('code' => 0);
        $like = array();
        $where = array();

        if (!empty($option['Fproduct_id'])) {
            $where['f.Fproduct_id'] = $option['Fproduct_id'];
        }
        if (!empty($option['min_date'])) {
            $where['f.Fcreate_time >= '] = strtotime($option['min_date']);
        }
        if (!empty($option['max_date'])) {
            $where['f.Fcreate_time <= '] = strtotime($option['max_date'])+23*3600+3599;
        }
        // like
        if (!empty($option['Fuser_id'])) {
            $like['f.Fuser_id'] = $option['Fuser_id'];
        }

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'] ? : 10;
        $res['data']['count'] = $this->product_dao->postsCollectNum($where, $like);
        $collectList = $this->product_dao->postsCollectList($where, $like, $page, $page_size);
        $res['data']['list'] = $collectList;
        return $res;
    }

    /**
     * 我的收藏
     * @param $option
     * @return array
     */
    public function getCollectListByUid($option)
    {
        $ret = array('code' => 0);
        if (empty($option['Fuser_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $res = $this->product_dao->getCollectListByUid($option);
        if (!$res) {
            $ret['code'] = 'product_error_11';
        } else {
            $ret['data'] = $res;
        }
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
            $ret['code'] = 'product_error_12'; // 暂无数据
            return $ret;
        }

        $where = 'Fproduct_name like "%'.$option['keyword'].'%" AND Fproduct_status = 2 AND Fis_del = 0';

        $res = $this->product_dao->search($where);
        if (!$res) {
            $ret['code'] = 'product_error_12';
        } else {
            $ret['data'] = $res;
        }
        return $ret;
    }

    public function hasProductPower($option)
    {
        $ret = array('code' => 0);
        $res = $this->product_dao->hasProductPower($option);
        if (!$res) {
            $ret['code'] = 'product_error_13';
        }
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
        if (empty($data['Fcomment_pro_id']) || empty($data['Fcomment_uid'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $res = $this->product_dao->submitComment($data);
        if ($res) {
            $ret['data'] = $data;
            // 修改订单评论标志
            $this->myCurl('order', 'updateOrderCommentFlag', array('product_id' => $data['Fcomment_pro_id'], 'user_id' => $data['Fcomment_user_name']), true);
        } else {
            $ret['code'] = 'posts_error_10'; // 评论失败
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
        if (empty($option['Fcomment_pro_id'])) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $option['Fcomment_approved'] = 1; // 通过审核
        $res = $this->product_dao->getCommentListByPid($option);
        foreach ($res as &$re) {
            $user = $this->myCurl('account', 'getInfo', array('id' => $re['Fcomment_uid']));
            $re['Fcomment_name'] = isset($user['data']['Fnick_name']) ? $user['data']['Fnick_name'] : '';
            $re['Fcomment_authro_image'] = isset($user['data']['Fimage_path']) ? $user['data']['Fimage_path'] : '';
        }
        $ret['data'] = $res;
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

        if (!empty($option['Fcomment_pro_id'])) {
            $where['Fcomment_pro_id'] = $option['Fcomment_pro_id'];
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
        if (!empty($option['Fcomment_user_name'])) {
            $like['Fcomment_user_name'] = $option['Fcomment_user_name'];
        }

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'] ? : 10;
        $res['data']['count'] = $this->product_dao->proCommentNum($where, $like);
        $commentList = $this->product_dao->proCommentList($where, $like, $page, $page_size);
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
        $res = $this->product_dao->statusComment($data, $where);
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
        $res = $this->product_dao->delComment($where);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'posts_error_12';
        }
    }

    public function maybeLike($option)
    {
        $ret = array('code' => 0);
        $res = $this->product_dao->maybeLike($option);
        if ($res) {
            $ret['data'] = $res;
        } else {
            return $ret['code'] = 'posts_error_12';
        }
        return $ret;
    }
}