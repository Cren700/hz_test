<?php

/**
 * User.php
 * Author   : cren
 * Date     : 2016/11/27
 * Time     : 下午6:24
 */
class User extends BaseControllor
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/user_service_model', 'user_service');
    }

    public function index()
    {
        $res = $this->user_service->self();
        echo json_encode_data($res);
    }

    /**
     * 查看个人信息
     */
    public function self()
    {
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'uploadify/jquery.uploadify.min.js',
            'user/detail.js'
        );
        $cssArr = array('uploadify.css');
        $user = $this->user_service->self();
        if (empty($user)){
            $data = array();
            $is_new = 1;
        } else {
            $data = $user['data'];
            $is_new = 0;
        }
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('user', $data);
        $this->smarty->assign('is_new', $is_new);
        $this->smarty->display('user/detail.tpl');
    }

    /**
     * 保存后台用户详情
     */
    public function save()
    {
        $data = array();
        $data['is_new'] = $this->input->post('is_new'); // 是否添加
        $data['real_name'] = $this->input->post('real_name');
        $data['industry'] = $this->input->post('industry');
        $data['cert_type'] = $this->input->post('cert_type');
        $data['cert_no'] = $this->input->post('cert_no');
        $data['logo_path'] = $this->input->post('logo_path');
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');
        $data['country'] = $this->input->post('country');
        $data['address'] = $this->input->post('address');
        $data['annex_path'] = $this->input->post('annex_path');
        $data['remark'] = $this->input->post('remark');
        $data['atte_status'] = $this->input->post('atte_status');
        $res = $this->user_service->save($data);
        echo json_encode_data($res);
    }

    /**
     * 查询
     */
    public function query()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'user_type' => $this->input->get('user_type'),
            'user_id' => $this->input->get('user_id'),
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
            'status' => $this->input->get('status')
        );
        $user = $this->user_service->query($option);
        $this->smarty->assign('info', $user['data']);
        $this->smarty->assign('page', $this->page($user['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('user/list.tpl');
    }

    /**
     * 用户列表
     */
    public function member()
    {
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'user/query.js',
        );
        $this->smarty->assign('user_type', 4); // 用户
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('user/member.tpl');
    }

    /**
     * 媒体用户列表
     */
    public function medium()
    {
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'user/query.js'
        );
        $this->smarty->assign('user_type', 3); // 媒体
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('user/medium.tpl');
    }

    /**
     * 商户用户列表
     */
    public function merchant()
    {
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'user/query.js'
        );
        $this->smarty->assign('user_type', 2); // 商户
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('user/merchant.tpl');
    }

    public function addUser()
    {
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'passwd' => $this->input->post('passwd'),
            'user_type' => $this->input->post('user_type'),
        );
        $res = $this->user_service->addUser($data);
        echo json_encode_data($res);
    }

    /**
     * 查看用户信息
     * @param string $uid
     */
    public function info($uid)
    {
        $uid = $uid ? : $this->input->get('id');
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'uploadify/jquery.uploadify.min.js',
            'user/info.js'
        );
        $cssArr = array('uploadify.css');
        $option = array(
            'id' => $uid
        );
        !$uid ? $this->jump404():'';
        $info = $this->user_service->getInfo($option);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('user', $info['data']);
        $this->smarty->display('user/info.tpl');
    }

    /**
     * 保存用户信息
     */
    public function saveInfo()
    {
        $option = $this->input->post();//提交的数据
        $res = $this->user_service->saveInfo($option);
        echo json_encode_data($res);
    }

    /**
     * 修改状态(认证、使用)
     */
    public function changeStatus()
    {
        $option = array(
            'status' => $this->input->get('status'),
            'atte_status' => $this->input->get('atte_status'),
            'is_blackuser' => $this->input->get('is_blackuser'),
            'id' => $this->input->get('id')
        );
        $res = $this->user_service->changeStatus($option);
        echo json_encode_data($res);
    }

    /**
     * 黑名单页面
     */
    public function blacklist()
    {
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'user/blacklist.js'
        );
        $cate = array('1'=> '内部管理用户', '2' => '合作商户', '3' => '媒体用户', '4' => '普通用户');
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('cate', $cate);
        $this->smarty->display('user/blacklist.tpl');
    }

    /**
     * 黑名单列表
     */
    public function queryBlackList()
    {
        $cate = array('1'=> '内部管理用户', '2' => '合作商户', '3' => '媒体用户', '4' => '普通用户');
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'user_type' => $this->input->get('user_type'),
            'user_id' => $this->input->get('user_id'),
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
        );
        $user = $this->user_service->queryBlackList($option);
        $this->smarty->assign('info', $user['data']);
        $this->smarty->assign('cate', $cate);
        $this->smarty->assign('page', $this->page($user['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('user/bu_list.tpl');

    }

}