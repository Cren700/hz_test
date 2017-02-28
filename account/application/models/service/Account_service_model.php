<?php

/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/7/9
 * Time: 上午11:16
 */
class Account_service_model extends HZ_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/account_dao_model');
    }

    /**
     * 注册
     * @param $data
     * @param $type 'admin':为后台登录
     * @return array
     */
    public function addAccount($data, $type)
    {
        $ret = array('code' => 0);
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Fuser_id'],
                'rules' => 'required|min_length[4]|max_length[16]',
                'field' => '用户名'
            ),
            array(
                'value' => $data['Fpasswd'],
                'rules' => 'required|min_length[6]|max_length[16]',
                'field' => '密码'
            ),
            array(
                'value' => $data['Fuser_type'],
                'rules' => 'required',
                'field' => '用户类型'
            ),
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }

        $hasUserid = $this->account_dao_model->getInfoByOp(array('Fuser_id' => $data['Fuser_id']), $type);
        if( $hasUserid ) {
            return array('code' => 'account_error_2'); // 用户名已存在
        }
        $salt = saltCode();
        $data['Fsalt'] = $salt;
        $data['Fpasswd'] = encodePwd($salt, $data['Fpasswd']);
        $uid = $this->account_dao_model->addAccount($data, $type);
        if ( $uid ){
            if ($type == 'user') {
                $ret['data'] = $this->account_dao_model->getUserBaseInfoByFid(array('Fid' => $uid));
            }
            return $ret;
        } else {
            return $ret['code'] = 'account_error_3';
        }
    }

    /**
     * 登录
     * @param $data
     * @param $type 'admin':为后台登录
     * @return array
     */
    public function login($data, $type)
    {
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Fuser_id'],
                'rules' => 'required|min_length[4]|max_length[16]',
                'field' => '用户名'
            ),
            array(
                'value' => $data['Fpasswd'],
                'rules' => 'required|min_length[6]|max_length[16]',
                'field' => '密码'
            ),
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }
        $info = $this->account_dao_model->getInfoByOp(array('Fuser_id' => $data['Fuser_id'], 'Fstatus' => 1), $type);
        if (!$info) return array('code' => 'account_error_0'); // 账户不存在
        $pwdCode = encodePwd($info['Fsalt'], $data['Fpasswd']);
        if ($info['Fpasswd'] !== $pwdCode) {
            return array('code' => 'account_error_1');         // 账户密码不一致
        } else {
            $detail = $this->account_dao_model->getDetailByOp(array('Fuser_id' => $info['Fid']), $type);
            $resData = array('uid' => $info['Fid'], 'username' => $info['Fuser_id'], 'user_type' => $info['Fuser_type'], 'image_path' => isset($detail['Fimage_path']) ? $detail['Fimage_path'] : '');
            $type == 'admin' ? $resData['role_id'] = $info['Frole_id'] : '';
            return array('code' => 0, 'data' => $resData);
        }
    }

    /**
     * 修改密码
     * @param $data
     * @param $type 'admin':为后台登录
     * @return array
     */
    public function modifyPwd($data, $type){
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Fpasswd'],
                'rules' => 'required|min_length[6]|max_length[16]',
                'field' => '密码'
            ),
            array(
                'value' => $data['new_passwd'],
                'rules' => 'required|min_length[6]|max_length[16]',
                'field' => '新密码'
            ),
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }
        $info = $this->account_dao_model->getInfoByOp(array('Fuser_id' => $data['Fuser_id']), $type);
        if (!$info) return array('code' => 'account_error_0'); // 账户不存在
        $pwdCode = encodePwd($info['Fsalt'], $data['Fpasswd']);
        if ($info['Fpasswd'] !== $pwdCode) {
            $ret = array('code' => 'account_error_1');         // 账户密码不一致
        } else {
            $where = array('Fuser_id' => $data['Fuser_id']);
            $salt = saltCode();
            $passwd = encodePwd($salt, $data['new_passwd']);
            $tmp = array('Fpasswd' => $passwd, 'Fsalt' => $salt, 'Fupdate_time' => time());
            unset($data);
            $res = $this->account_dao_model->modifyPwd($where, $tmp, $type);
            if ($res) {
                $ret = array('code' => 0);
            } else {
                $ret = array('code' => 'system_error_2');
            }
        }
        return $ret;
    }

    /**
     * 用户详情
     * @param $data
     * @return array
     */
    public function detail($data)
    {
        $ret = array('code' => 0);
        if (empty($data['Fuser_id'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
        } else {
            $res = $this->account_dao_model->getDetailByOp(array('Fuser_id' => $data['Fuser_id']), $data['type']);
            $ret['data'] = $res;
        }
        return $ret;
    }

    public function getUserDetailByWhere($data)
    {
        $ret = array('code' => 0);
        if (empty($data['Fuser_id']) && empty($data['Fid'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
        } else {
            $res = $this->account_dao_model->getUserDetailByWhere($data);
            $ret['data'] = $res;
        }
        return $ret;
    }

    public function getAdminInfo($data)
    {
        $ret = array('code' => 0);
        if (empty($data['Fid'])) {
            $ret['code'] = 'system_error_2'; // 操作出错
        } else {
            $res = $this->account_dao_model->getAdminInfo(array('Fid' => $data['Fid']));
            $ret['data'] = $res;
        }
        return $ret;
    }

    /**
     * 保存用户详情
     * @param $data
     * @return array
     */
    public function saveUserDetail($data)
    {
        $ret = array('code' => 0);
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Fid'],
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

        $user = $this->account_dao_model->getInfoByOp(array('Fid' => $data['Fid']));
        if (empty($user)) {
            $ret['code'] = 'account_error_0'; // 不存在用户该用户
            return $ret;
        }
        $is_new = true;//新添加
        $where = array();
        $user2 = $this->account_dao_model->getDetailByOp(array('Fuser_id' => $user['Fid']));
        if (!empty($user2)) {
            $is_new = false;
            $where['Fuser_id'] = $user['Fid'];
        } else {
            $data['Fcreate_time'] = time();
            $data['Fuser_id'] = $user['Fid'];
        }
        unset($data['Fid']);
        $res = $is_new ? $this->account_dao_model->addDetail($data) : $this->account_dao_model->modifyDetail($where, $data);
        if (!$res) {
            $ret['code'] = 'account_error_3';
        }
        return $ret;
    }

    /**
     * 添加后台用户详情
     * @param $data
     * @return array
     */
    public function addAdminDetail($data)
    {
        $ret = array('code' => 0);
        // 数据验证
        $validationConfig = array(
            array(
                'value' => $data['Fuser_id'],
                'rules' => 'required',
                'field' => '用户名'
            )
        );
        foreach ($validationConfig as $v) {
            $resValidation = validationData($v['value'], $v['rules'], $v['field']);
            if (!empty($resValidation)) {
                return $resValidation;
            }
        }
        $user = $this->account_dao_model->getInfoByOp(array('Fid' =>$this->_uid), 'admin');
        if (!empty($user)) {
            $ret['code'] = 'account_error_6'; // 已经存在用户详情
            return $ret;
        }

        $res = $this->account_dao_model->addAdminDetail($data);
        if (!$res) {
            $ret['code'] = 'account_error_3';
        }
        return $ret;
    }

    /**
     * 修改用户详情
     * @param $where
     * @param $data
     * @return array|string
     */
    public function modifyAdminDetail($where, $data)
    {
        $ret = array('code' => 0);
        // 数据验证
        if (!$where['Fuser_id']) {
            return $ret['code'] = 'account_error_5';
        }
        $res = $this->account_dao_model->modifyAdminDetail($where, $data);
        if (!$res) {
            $ret['code'] = 'account_error_3';
        }
        return $ret;
    }

    /**
     * 第三方登录处理,返回用户信息
     * @param $option
     * @return array
     */
    public function oauthLogin($option)
    {
        $ret = array('code' => 0);
        $where = array(
            'Fuser_id' => $option['Fuser_id'],
            'Flog_type' => $option['Flog_type']
        );
        $res = $this->account_dao_model->getInfoByOp($where);
        if (!$res) {
            // 没有用户则添加用户
            $data_base = array(
                'Fuser_id' => $option['Fuser_id'],
                'Flog_type' => $option['Flog_type'],
                'Frecommend_uid' => $option['Frecommend_uid'],
                'Fuser_type' => 4, // 普通用户
                'Fcreate_time' => time(),
                'Fupdate_time' => time(),
            );
            $uid = $this->account_dao_model->addAccount($data_base);
            $data_detail = array(
                'Fuser_id' => $uid,
                'Fnick_name' => $option['Fnick_name'],
                'Fimage_path' => $option['Fimage_path']
            );
            $this->account_dao_model->addDetail($data_detail);
            $ret['data'] = $this->account_dao_model->getInfoByOp($where);
        } else {
            $ret['data'] = $res;
        }
        return $ret;
    }

    public function loginPhone($option)
    {
        $ret = array('code' => 0);
        $where = array(
            'Fuser_id' => $option['Fuser_id'],
            'Flog_type' => $option['Flog_type']
        );
        $res = $this->account_dao_model->getInfoByOp($where);
        if (!$res) {
            // 没有用户则添加用户
            $data_base = array(
                'Fuser_id' => $option['Fuser_id'],
                'Flog_type' => $option['Flog_type'],
                'Frecommend_uid' => $option['Frecommend_uid'],
                'Fuser_type' => 4, // 普通用户
                'Fcreate_time' => time(),
                'Fupdate_time' => time(),
            );
            $uid = $this->account_dao_model->addAccount($data_base);
            $res_detail = array(
                'Fid' => $uid,
                'Fuser_id' => $option['Fuser_id'],
                'Fuser_type' => 4,
                'Fimage_path' => ''
            );
            $ret['data'] = $res_detail;
        } else {
            $detail = $this->account_dao_model->getDetailByOp(array('Fuser_id' => $res['Fid']));
            $ret['data'] = $res;
            $ret['data']['Fimage_path'] = $detail['Fimage_path'];
        }
        return $ret;
    }
    
    public function getStoreName($option)
    {
        $ret = array('code' => 0);
        $type = $option['type'] == 0 ? 'admin' : 'user';
        unset($option['type']);
        $res = $this->account_dao_model->getInfoByOp($option, $type);
        if ($res) {
            $ret['data'] = $res;
        }
        return $ret;
    }

    public function saveVerifySms($option)
    {
        $ret = array('code' => 0);
        $this->account_dao_model->saveVerifySms($option);
        return $ret;
    }

    public function saveVerifyCode($option)
    {
        $ret = array('code' => 0);
        $this->account_dao_model->saveVerifyCode($option);
        return $ret;
    }

    public function modifyHdImg($option)
    {
        $ret = array('code' => 0);
        if (!$option['Fuser_id']) {
            $ret['code'] = 'account_error_4';
            return $ret;
        }
        $where = array('Fuser_id' => $option['Fuser_id']);
        $data = array('Fimage_path' => $option['Fimage_path']);
        $this->account_dao_model->modifyHdImg($data, $where);
        return $ret;
    }

    public function checkVerifyCode($Fverifycode)
    {
        $ret = array('code' => 0);
        if(!$Fverifycode) {
            $ret['code'] = 'account_error_7';
            return $ret;
        }
        $where = array(
            'Fverifycode' => $Fverifycode,
            'Fstatus' => 1,
            'Fend_time > ' => time()
        );
        $res = $this->account_dao_model->checkVerifyCode($where);
        if (empty($res)) {
            $ret['code'] = 'account_error_8';
            return $ret;
        }
        return $ret;
    }

    public function hasMediumPower($option)
    {

        $ret = array('code' => 0);
        $res = $this->account_dao_model->hasMediumPower($option);
        if (empty($res)) {
            $ret['code'] = 'account_error_9';
            return $ret;
        }
        return $ret;
    }

    public function hasStorePower($option)
    {
        $ret = array('code' => 0);
        $res = $this->account_dao_model->hasStorePower($option);
        if (empty($res)) {
            $ret['code'] = 'account_error_10';
            return $ret;
        }
        return $ret;
    }

    public function adminAction()
    {
        $ret = array('code' => 0);
        $res = $this->account_dao_model->adminAction();
        $ret['data'] = $res;
        return $ret;
    }

    public function role()
    {
        $ret = array('code' => 0);
        $res = $this->account_dao_model->role();
        foreach ($res as &$r){
            $ids = explode(',', $r['Faction_ids']) ? : '0';
            $actions = $this->account_dao_model->getActions($ids);
            $r['Faction_name'] = join(',', array_column($actions, 'Faction_name'));
        }
        $ret['data'] = $res;
        return $ret;
    }

    public function addRole($option)
    {
        $ret = array('code' => 0);
        $this->account_dao_model->addRole($option);
        return $ret;
    }

    public function saveRole($where, $option)
    {
        $ret = array('code' => 0);
        $this->account_dao_model->saveRole($where, $option);
        return $ret;
    }

    public function getRole($where)
    {
        $ret = array('code' => 0);
        $ret['data'] = $this->account_dao_model->getRole($where);
        return $ret;
    }

    public function adminList($option)
    {
        $res = array('code' => 0);
        $where = $like = array();


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

        $res['data']['count'] = $this->account_dao_model->adminCounts($where, $like);
        $res['data']['list'] = $this->account_dao_model->adminList($where, $like, $page, $page_size);

        return $res;
    }

    public function changeAdminStatus($option)
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
            $rt = $this->account_dao_model->updateAdmin($where, $data);
            if (!$rt) {
                $res['code'] = 'account_error_5'; // error
            }
        }
        return $res;
    }

    public function updateAdminPwd($where, $data)
    {
        $res = array('code' => 0);
        $salt = saltCode();
        $data['Fsalt'] = $salt;
        $data['Fpasswd'] = encodePwd($salt, $data['Fpasswd']);
        $ret = $this->account_dao_model->updateAdmin($where, $data);
        if (!$ret) {
            $res['code'] = 'account_error_11'; // error
        }
        return $res;
    }

    public function updateAdminRole($where, $data)
    {
        $res = array('code' => 0);
        $ret = $this->account_dao_model->updateAdmin($where, $data);
        if (!$ret) {
            $res['code'] = 'account_error_12'; // error
        }
        return $res;
    }

    public function powerUrl($where)
    {
        $ret = array('code' => 0);
        $ret['data'] = $this->account_dao_model->powerUrl($where);
        return $ret;
    }

}