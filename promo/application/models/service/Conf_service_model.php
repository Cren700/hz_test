<?php
class Conf_service_model extends HZ_Model {
	public function __construct() {
		parent::__construct();
		$this->load->model('dao/conf_dao_model','conf_dao');
	}

    public function queryConf()
    {
        $res = array('code' => 0);
        $res['data'] = $this->conf_dao->queryConf();
        return $res;
    }


    //传输
    public function getConfById($where) {
        $ret = array('code'=>0);
        $res = $this->conf_dao->getConfById($where);
        $ret['data'] = $res;
        return $ret;
    }

    //验证添加的数据
    public function addConf($data) {
        $ret = array('code' => 0);
        $res = $this->conf_dao->addConf($data);
        if($res) {
            return $ret;
        } else {
            return $ret['code'] = 'system_error_2';
        }
    }

    public function updateConf($where,$data) {
        $ret = array('code' => 0);//code为状态码，0为无错误,默认正确通过
        if(!isset($where['Fid']) && empty($where['id'])) {
            $ret['code'] = 'system_error_2';
            return $ret;
        }
        $cat = $this->conf_dao->getConfById($where);
        if(empty($cat)) {
            $ret['code'] = 'system_error_2';//不存在
            return $ret;
        }
        $cate = $this->conf_dao->updateConf($where,$data);
        if($cate) {
            return $ret;
        } else {
            $ret['code'] = 'promo_error_5';
            return $ret;
        }
    }

    //删除分类
    public function delConf($where) {
        $ret = array('code' => 0);
        if(!isset($where['Fid']) && empty($where['id'])) {
            $ret['code'] = 'system_error_2';
            return $ret;
        }
        $cat = $this->conf_dao->getConfById($where);
        if(empty($cat)) {
            $ret['code'] = 'system_error_2';
            return $ret;
        }
        $cate = $this->conf_dao->delConf($where);
        if($cate) {
            return $ret;
        } else {
            return $ret['code'] = 'promo_error_6';
        }
    }
}