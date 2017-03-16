<?php
class Promo_service_model extends HZ_Model {
	public function __construct() {
		parent::__construct();
		$this->load->model('dao/promo_dao_model','promo_dao');
	}

	//验证提交的广告数据
	public function add($data) {
		$ret = array('code' => 0);//命令码
		//验证数据
		$validationConfig = array(
			array(
				'value' => $data['Factive_name'],
				'rule'  => 'required',
				'field' => '广告名称'
			),
			array(
				'value' => $data['Fcategory_id'],
				'rule'  => 'required',
				'field' => '广告类型'
			),
			array(
				'value' => $data['Fimage_path'],
				'rule'  => 'required',
				'field' => '图片路径'
			),
			array(
				'value' => $data['Factive_url'],
				'rule'  => 'required',
				'field' => '地址'
			),
			array(
				'value' => $data['Fvendor'],
				'rule'  => 'required',
				'field' => '投放厂商'
			),
			array(
				'value' => $data['Flevel'],
				'rule'  => 'required',
				'field' => '广告优先级'
			),
		);

		foreach ($validationConfig as $v) {
			$resValidation = validationData($v['value'],$v['rule'],$v['field']);
			if(!empty($resValidation)) {
				return $resValidation;
			}
		}
		$res = $this->promo_dao->add($data);
		if (!$res) {
			$ret['code'] = 'system_error_2';
		}
		return $ret;
	}

	public function save($where,$data) {
		$ret = array('code' => 0);
		if(!isset($where['Factive_id']) && empty($where['Factive_id'])) {
			$ret['code'] = 'system_error_2';
			return $ret;
		}
		$promo = $this->promo_dao->getPromoInfoById($where);
		if(empty($promo)) {
			$ret['code'] = 'promo_error_2';
			return $ret;
		}
		$res = $this->promo_dao->save($where,$data);
		if($res) {
			return $ret;
		} else {
			return $ret['code'] = 'promo_error_5';
		}
	}

	public function changeStatus($data, $where)
	{
		$ret = array('code' => 0);
		if (empty($data) || empty($where)) {
			$ret['code'] = 'system_error_2'; // 无信息
			return $ret;
		}
		$product = $this->promo_dao->getPromoInfoById($where);
		if (empty($product)) {
			$ret['code'] = 'posts_error_2'; // 不存在
			return $ret;
		}
		$res = $this->promo_dao->changeStatus($data, $where);
		if ($res) {
			return $ret;
		} else {
			return $ret['code'] = 'posts_error_7';
		}
	}

	//查询广告
    public function query($option) {
        $res = array('code' => 0);
        $where = array();
        $like = array();

        if(!empty($option['Fcategory_id'])) {
        	$where['Fcategory_id'] = $option['Fcategory_id'];
        }

        if(!empty($option['Factive_name'])) {
        	$like['Factive_name'] = $option['Factive_name'];
        }

        if(!empty($option['Fstatus']) || $option['Fstatus'] === '0') {
        	$where['Fstatus'] = $option['Fstatus'];
        }

		if (!empty($option['min_date'])) {
			$where['Fcreate_time >= '] = strtotime($option['min_date']);
		}

		if (!empty($option['max_date'])) {
			$where['Fcreate_time <= '] = strtotime($option['max_date'])+23*3600+3599;
		}

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'];

        $res['data']['count'] = $this->promo_dao->promoNum($where, $like);
        $res['data']['list']  = $this->promo_dao->promoList($where,$like,$page,$page_size);
        return $res;
    }

    public function getPromoById($where) {
        $ret = array('code' => 0);
        $res = $this->promo_dao->getPromoInfoById($where);
        $ret['data'] = $res;
        return $ret;
    }

    public function del($where) {
        $ret = array('code' => 0);
        if (!isset($where['Factive_id']) && empty($where['Factive_id'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
            return $ret;
        }
        $promo = $this->promo_dao->getPromoInfoById($where);
        if (empty($promo)) {
            $ret['code'] = 'promo_error_2'; // 不存在
            return $ret;
        }
        $res = $this->promo_dao->del($where);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'promo_error_6';
        }
    }

    public function batchDelPromo($ids)
    {
        $ret = array('code' => 0);
        $res = $this->promo_dao->batchDelPromo($ids);
        if (empty($res)) {
            $ret['code'] = 'system_error_2'; // 操作出错
            return $ret;
        }
        return $ret;
    }

	public function getPromoRandom()
	{
		$ret = array('code' => 0);
		$res = $this->promo_dao->getPromoRandom();
		$ret['data'] = $res;
		return $ret;
	}

    public function getPromoRule()
    {
        $ret = array('code' => 0);
        $res = $this->promo_dao->getPromoRule();
        $ret['data'] = $res;
        return $ret;
    }

    public function getRuleByWhere($where)
    {
        $ret = array('code' => 0);
        $res = $this->promo_dao->getRuleByWhere($where);
        $ret['data'] = $res;
        return $ret;
    }

    public function addPromoRule($data) {
        $ret = array('code' => 0);//命令码
        //验证数据
        $validationConfig = array(
            array(
                'value' => $data['Fshare_type'],
                'rule'  => 'required',
                'field' => '返利类型'
            )
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'],$v['rule'],$v['field']);
            if(!empty($resValidation)) {
                return $resValidation;
            }
        }
        // 判断存在分类
        if($this->promo_dao->getRuleByWhere(array('Fshare_type' => $data['Fshare_type']))){
            $ret['code'] = 'promo_error_9';
            return $ret;
        }
        $res = $this->promo_dao->addPromoRule($data);
        if (!$res) {
            $ret['code'] = 'system_error_2';
        }
        return $ret;
    }

    public function savePromoRule($where,$data) {
        $ret = array('code' => 0);
        //验证数据
        $validationConfig = array(
            array(
                'value' => $data['Fshare_type'],
                'rule'  => 'required',
                'field' => '返利类型'
            )
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'],$v['rule'],$v['field']);
            if(!empty($resValidation)) {
                return $resValidation;
            }
        }

        $res = $this->promo_dao->savePromoRule($where,$data);
        if($res) {
            return $ret;
        } else {
            return $ret['code'] = 'promo_error_8';
        }
    }

    public function ruleStatus($where, $data)
    {
        $ret = array('code' => 0);
        $res = $this->promo_dao->ruleStatus($where, $data);
        if (!$res) {
            $ret['code'] = 'system_error_2';
        }
        return $ret;
    }

    public function addOrderExpand($data)
    {
        $ret = array('code' => 0);
        $res = $this->promo_dao->addOrderExpand($data);
        if (!$res) {
            $ret['code'] = 'system_error_2';
        }
        return $ret;
    }

    public function sendReport($data)
    {
        $ret = array('code' => 0);
        $res = $this->promo_dao->sendReport($data);
        if (!$res) {
            $ret['code'] = 'system_error_2';
        }
        return $ret;
    }

    public function freebackStatus($data, $where)
    {
        $ret = array('code' => 0);
        if (empty($data) || empty($where)) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $res = $this->promo_dao->freebackStatus($data, $where);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'posts_error_7';
        }
    }

    //查询广告
    public function queryFreeback($option) {
        $res = array('code' => 0);
        $where = array();

        if(!empty($option['Fstatus'])) {
            $where['Fstatus'] = $option['Fstatus'];
        }

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'];

        $res['data']['count'] = $this->promo_dao->freebackNum($where);
        $res['data']['list']  = $this->promo_dao->freebackList($where,$page,$page_size);
        return $res;
    }

    public function delFreeback($where) {
        $ret = array('code' => 0);
        if (!isset($where['Fid']) && empty($where['Fid'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
            return $ret;
        }
        $res = $this->promo_dao->delFreeback($where);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'promo_error_6';
        }
    }

    //验证提交的广告数据
    public function imageAdd($data) {
        $ret = array('code' => 0);//命令码
        $res = $this->promo_dao->imageAdd($data);
        if (!$res) {
            $ret['code'] = 'promo_error_10';
        }
        return $ret;
    }

    public function imageSave($where,$data) {
        $ret = array('code' => 0);
        if(!isset($where['Fid']) && empty($where['Fid'])) {
            $ret['code'] = 'system_error_2';
            return $ret;
        }
        $promo = $this->promo_dao->getImageInfoById($where);
        if(empty($promo)) {
            $ret['code'] = 'promo_error_11';
            return $ret;
        }
        $res = $this->promo_dao->imageSave($where,$data);
        if(!$res) {
            return $ret['code'] = 'promo_error_5';
        }
        return $ret;
    }

    public function getImageById($where) {
        $ret = array('code' => 0);
        $res = $this->promo_dao->getImageInfoById($where);
        $ret['data'] = $res;
        return $ret;
    }

    //查询广告
    public function imageQuery($option) {
        $res = array('code' => 0);

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'];

        $res['data']['count'] = $this->promo_dao->imageNum();
        $res['data']['list']  = $this->promo_dao->imageList($page,$page_size);
        return $res;
    }

    public function changeImageStatus($data, $where)
    {
        $ret = array('code' => 0);
        if (empty($data) || empty($where)) {
            $ret['code'] = 'system_error_2'; // 无信息
            return $ret;
        }
        $promo = $this->promo_dao->getImageInfoById($where);
        if(empty($promo)) {
            $ret['code'] = 'promo_error_11';
            return $ret;
        }
        $res = $this->promo_dao->changeImageStatus($data, $where);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'system_error_2';
        }
    }

    public function delImage($where) {
        $ret = array('code' => 0);
        if (!isset($where['Fid']) && empty($where['Fid'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
            return $ret;
        }
        $promo = $this->promo_dao->getImageInfoById($where);
        if (empty($promo)) {
            $ret['code'] = 'promo_error_2'; // 不存在
            return $ret;
        }
        $res = $this->promo_dao->delImage($where);
        if ($res) {
            return $ret;
        } else {
            return $ret['code'] = 'promo_error_11';
        }
    }

    public function getPcImages()
    {
        $ret = array('code' => 0);
        $ret['data'] = $this->promo_dao->getPcImages();
        return $ret;
    }

    public function getPromoCateCount()
    {
        $res = array('code' => 0);
        $res['data'] = $this->promo_dao->getPromoCateCount();
        return $res;
    }
}