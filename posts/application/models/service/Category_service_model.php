<?php

/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/7/9
 * Time: 上午11:16
 */
class Category_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/category_dao_model', 'cate_dao');
    }
    
    public function lists($option)
    {
        $ret = array('code' => 0);
        $where = array();
        if ($option['Fstatus'] == '0' || !empty($option['Fstatus'])) {
            $where['Fstatus'] = $option['Fstatus'];
        }
        if ($option['Fis_special'] == '0' || !empty($option['Fis_special'])) {
            $where['Fis_special'] = $option['Fis_special'];
        }
        $res = $this->cate_dao->lists($where);
        $ret['data'] = $res;
        return $ret;
    }

    public function getCategory($where)
    {
        $ret = array('code' => 0);
        $res = $this->cate_dao->getCategory($where);
        $ret['data'] = $res;
        return $ret;
    }

    public function add($data)
    {
        $ret = array('code' => 0);
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Fcategory_name'],
                'rules' => 'required',
                'field' => '分类名称'
            ),
            array(
                'value' => $data['Fremark'],
                'rules' => 'required',
                'field' => '分类说明'
            ),
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }
        $res = $this->cate_dao->add($data);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'posts_error_4';
        }
    }

    public function update($where, $data)
    {
        $ret = array('code' => 0);
        if (!isset($where['Fpost_category_id']) && empty($where['Fpost_category_id'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
            return $ret;
        }
        $cate = $this->cate_dao->getCateInfoByCateId($where['Fpost_category_id']);
        if (empty($cate)) {
            $ret['code'] = 'posts_error_2'; // 不存在
            return $ret;
        }
        $res = $this->cate_dao->update($where, $data);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'posts_error_5';
        }
    }

    public function del($where)
    {
        $ret = array('code' => 0);
        if (!isset($where['Fpost_category_id']) && empty($where['Fpost_category_id'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
            return $ret;
        }
        $cate = $this->cate_dao->getCateInfoByCateId($where['Fpost_category_id']);
        if (empty($cate)) {
            $ret['code'] = 'posts_error_2'; // 不存在
            return $ret;
        }
        $res = $this->cate_dao->del($where);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'posts_error_4';
        }
    }
}