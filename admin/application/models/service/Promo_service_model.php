<?php
class Promo_service_model extends HZ_Model {
    private $_api = 'promo';

    //加载父类
    public function __construct() {
        parent::__construct();
    }

    //保存广告
    public function save($data) {
        $is_new = $data['is_new'];
        unset($data['is_new']);
        if($is_new) {
            $res = $this->myCurl($this->_api,'promoAdd',$data,true);
        } else {
            $res = $this->myCurl($this->_api,'promoSave',$data,true);
        }
        if($res['code'] === 0) {
            $res['data']['url'] = getBaseUrl('/promo.html');//???
        }
        return $res;
    }

    //查询广告
    public function query($option) {
        return $this->myCurl($this->_api,'promoQuery',$option,false);
    }

    public function getPromoById($data) {
        return $this->myCurl($this->_api,'getPromoById',$data,false);
    }

    public function status($data) {
        return $this->myCurl($this->_api, 'changeStatus', $data, true);
    }

    public function del($data)
    {
        return $this->myCurl($this->_api, 'promoDel', $data, false);
    }

    //连接curl获取分类
    public function category() {
        return $this->myCurl($this->_api, 'category',array());
    }

    //获取分类
    public function cateGet($data) {
        return $this->myCurl($this->_api,'cateGet',$data,false);
    }

    //保存分类
    public function cateSave($data) {
        //接收隐藏域新分类
        $is_new = $data['is_new'];
        //释放变量
        unset($data['is_new']);
        //判断分类是否存在
        if($is_new) {
            return $this->myCurl($this->_api,'cateSave', $data, true);//true为post接收
        } else {
            return $this->myCurl($this->_api,'cateUpdate', $data, true);
        }
    }

    //删除类型
    public function cateDel($data) {
        //CURL链接调用模块删除方法
        return $this->myCurl($this->_api,'cateDel',$data,false);
    }
}