<?php

/**
 * Info_service_model.php
 * Author   : cren
 * Date     : 2016/12/12
 * Time     : 下午10:13
 */
class Info_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/info_dao_model', 'info_dao');
        $this->load->model('dao/account_dao_model', 'account_dao');
    }

    public function query($option)
    {
        $res = array('code' => 0);
        $where = $like = array();

        if ($option['Fuser_type'] === '0' || !empty($option['Fuser_type'])) {
            $where['u.Fuser_type'] = $option['Fuser_type'];
        }

        if ($option['Fstatus'] === '0' || !empty($option['Fstatus'])) {
            $where['u.Fstatus'] = $option['Fstatus'];
        } else {
            $where['u.Fstatus'] = 1;
        }

        if (!empty($option['min_date'])) {
            $where['u.Fcreate_time >= '] = strtotime($option['min_date']);
        }

        if (!empty($option['max_date'])) {
            $where['u.Fcreate_time <= '] = strtotime($option['max_date'])+23*3600+3599;
        }

        if ($option['Fuser_id'] === '0' || !empty($option['Fuser_id'])) {
            $like['u.Fuser_id'] = $option['Fuser_id'];
        }
        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'];
        $where['Fis_blackuser'] = 0;

        $res['data']['count'] = $this->info_dao->userCounts($where, $like);
        $res['data']['list'] = $this->info_dao->userList($where, $like, $page, $page_size);

        return $res;
    }

    public function getInfo($option)
    {
        $res = array('code' => 0);
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $option['Fid'],
                'rules' => 'required',
                'field' => '用户ID'
            )
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }

        $data = $this->info_dao->getInfo($option);

        if (!empty($data)) {
            $res['data'] = $data;
        }

        return $res;
    }

    public function changeStatus($option)
    {
        $res = array('code' => 0);
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $option['Fid'],
                'rules' => 'required',
                'field' => '用户ID'
            )
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }
        if ($option['Fstatus'] === '0' || $option['Fstatus'] === '1') {
            // update status
            $where = array('Fid' => $option['Fid']);
            $data = array('Fstatus' => $option['Fstatus']);
            $rt = $this->info_dao->changeUserStatus($where, $data);
            if (!$rt) {
                $res['code'] = 'account_error_5'; // error
            }
        }
        if ($option['Fis_blackuser'] === '0' || $option['Fis_blackuser'] === '1') {
            // update blackuser
            $where = array('Fid' => $option['Fid']);
            $data = array('Fis_blackuser' => $option['Fis_blackuser']);
            $rt = $this->info_dao->changeUserStatus($where, $data);
            $user = $this->account_dao->getInfoByOp($where);
            $blackUserData = array('Fid' => $option['Fid'], 'Fuser_type' => $user['Fuser_type'], 'Freason' => '', 'Fcreate_time' => time());
            $check = $this->info_dao->getBlackUsrByUid(array('Fid' => $option['Fid']));
            if (empty($check)) {
                $this->info_dao->addBlackUser($blackUserData);
            }
            if (!$rt) {
                $res['code'] = 'account_error_5'; // error
            }
        }
        if ($option['Fatte_status'] === '0' || $option['Fatte_status'] === '1') {
            // update atte_status
            $where = array('Fuser_id' => $option['Fid']);
            $data = array('Fatte_status' => $option['Fatte_status']);
            $has_detail = $this->account_dao->getDetailByOp($where);
            if ($has_detail) {
                $rt = $this->info_dao->changeUserAtteStatus($where, $data);
            } else {
                $data['Fuser_id'] = $option['Fid'];
                $data['Fcreate_time'] = time();
                $data['Fupdate_time'] = time();
                $rt = $this->account_dao->addDetail($data);
            }
            if (!$rt) {
                $res['code'] = 'account_error_5'; // error
            }
        }
        return $res;
    }

    public function queryBlackList($option)
    {
        $res = array('code' => 0);
        $where = $like = array();

        if ($option['Fuser_type'] === '0' || !empty($option['Fuser_type'])) {
            $where['u.Fuser_type'] = $option['Fuser_type'];
        }
        
        if (!empty($option['min_date'])) {
            $where['u.Fcreate_time >= '] = strtotime($option['min_date']);
        }

        if (!empty($option['max_date'])) {
            $where['u.Fcreate_time <= '] = strtotime($option['max_date'])+23*3600+3599;
        }

        if ($option['Fuser_id'] === '0' || !empty($option['Fuser_id'])) {
            $like['u.Fuser_id'] = $option['Fuser_id'];
        }


//        if ($option['Fstatus'] === '0' || !empty($option['Fstatus'])) {
//            $where['u.Fstatus'] = $option['Fstatus'];
//        } else {
            $where['u.Fstatus'] = 1;
//        }

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'];
        $where['Fis_blackuser'] = 1;

        $res['data']['count'] = $this->info_dao->blackUserCounts($where, $like);
        $res['data']['list'] = $this->info_dao->blackUserList($where, $like, $page, $page_size);

        return $res;
    }

    public function queryCapitalAccount($option)
    {
        $res = array('code' => 0);
        $where = $like = array();
        $where['u.Fstatus'] = 1; // 使用中

        if ($option['Fuser_type'] === '0' || !empty($option['Fuser_type'])) {
            $where['u.Fuser_type'] = $option['Fuser_type'];
        }

        if ($option['Fuser_id'] === '0' || !empty($option['Fuser_id'])) {
            $like['a.Fuser_id'] = $option['Fuser_id'];
        }

        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'];

        $res['data']['count'] = $this->info_dao->capitalAccountCounts($where, $like);
        $res['data']['list'] = $this->info_dao->capitalAccountList($where, $like, $page, $page_size);

        return $res;
    }

    public function userCenter($option)
    {
        $ret = array('code' => 0);

        $ret['data'] = $this->info_dao->getUserCenter($option);

        return $ret;
    }

    public function modifyAccountInfo($data)
    {
        $ret = array('code' => 0);
        $where = array(
            'Fuser_id' => $data['Fuser_id'],
            'Fuser_type' => $data['Fuser_type']
        );
        $ret['data'] = $this->info_dao->getUserCenter($where);
        // 已经存在
        if ($ret['data']) {
            $_d = array(
                'Famount' => $data['Famount'],
                'Fintegral' => $data['Fintegral'],
            );
            $this->info_dao->updateCenterCnt($where, $_d);
        } else {
            $this->info_dao->addCenterInfo($data);
        }
        return $ret;
    }

}