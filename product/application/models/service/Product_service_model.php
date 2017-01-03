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

        if ($option['Fproduct_id'] === '0' || !empty($option['Fproduct_id'])) {
            $where['Fproduct_id'] = $option['Fproduct_id'];
        }

        if ($option['Fcategory_id'] === '0' || !empty($option['Fcategory_id'])) {
            $where['Fcategory_id'] = $option['Fcategory_id'];
        }

        if ($option['Fstore_id'] === '0' || !empty($option['Fstore_id'])) {
            $where['Fstore_id'] = $option['Fstore_id'];
        }

        if ($option['Fproduct_status'] === '0' || !empty($option['Fproduct_status'])) {
            $where_in = $option['Fproduct_status'];
        }

        if ($option['Fis_del'] === '0' || !empty($option['Fis_del'])) {
            $where['Fis_del'] = $option['Fis_del'];
        }

        if (!empty($option['min_date'])) {
            $where['Fcreate_time >= '] = strtotime($option['min_date']);
        }

        if (!empty($option['max_date'])) {
            $where['Fcreate_time <= '] = strtotime($option['max_date'])+23*3600+3599;
        }

        if ($option['Fproduct_name'] === '0' || !empty($option['Fproduct_name'])) {
            $like['Fproduct_name'] = $option['Fproduct_name'];
        }

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'];
        $res['data']['count'] = $this->product_dao->productNum($where, $like, $where_in);
        $res['data']['list'] = $this->product_dao->productList($where, $like, $where_in, $page, $page_size);

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
                'value' => $data['Fproduct_num'],
                'rules' => 'required',
                'field' => '产品库存'
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
            'Fproduct_name' => $data['Fproduct_name'],
            'Fproduct_price' => $data['Fproduct_price'],
            'Fproduct_num' => $data['Fproduct_num'],
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
            // 规则
            foreach ($data['Frule_title'] as $k => &$r) {
                if (empty($r) && empty($data['Frule_description'][$k])) {
                    unset($r);
                    unset($data['Frule_description'][$k]);
                }
                $plan_rule[] = array('title' => $r, 'desc' => $data['Frule_description'][$k]);
            }
            // 申请流程
            foreach ($data['Fprocess_title'] as $k => &$r) {
                if (empty($r) && empty($data['Fprocess_description'][$k])) {
                    unset($r);
                    unset($data['Fprocess_description'][$k]);
                }
                $process[] = array('title' => $r, 'desc' => $data['Fprocess_description'][$k]);
            }
            // 常见问题
            foreach ($data['Fquestion'] as $k => &$r) {
                if (empty($r) && empty($data['Fanswer'][$k])) {
                    unset($r);
                    unset($data['Fanswer'][$k]);
                }
                $q_a[] = array('title' => $r, 'desc' => $data['Fanswer'][$k]);
            }
            // 公约内容
            foreach ($data['Fpledge_title'] as $k => &$r) {
                if (empty($r) && empty($data['Fpledge_content'][$k])) {
                    unset($r);
                    unset($data['Fpledge_content'][$k]);
                }
                $pledge[] = array('title' => $r, 'desc' => $data['Fpledge_content'][$k]);
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
            );
            $this->product_dao->addDetail($product_detail);
        }
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
                'value' => $data['Fproduct_num'],
                'rules' => 'required',
                'field' => '产品库存'
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
            'Fproduct_name' => $data['Fproduct_name'],
            'Fproduct_price' => $data['Fproduct_price'],
            'Fproduct_num' => $data['Fproduct_num'],
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

}