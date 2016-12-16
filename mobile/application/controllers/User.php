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
        $this->load->model('service/user_service_model');
    }

    public function index()
    {
        $res = $this->user_service_model->detail();
        echo json_encode_data($res);
    }

    /**
     * 修改密码
     */
    public function modifyPwd()
    {

    }

    public function handleModifyPwd()
    {
        $data['passwd'] = '123456';
        $data['new_passwd'] = '654321';
        $data['user_id'] = $this->_user_id;
        $res = $this->user_service_model->modifyPwd($data);
        echo json_encode_data($res);

    }

    public function save()
    {
        $data = array();

//        $data['is_new'] = $this->input->post('is_new'); // 是否添加
//        $data['Fnick_name'] = $this->input->post('nick_name');
//        $data['Freal_name'] = $this->input->post('real_name');
//        $data['Fcert_no'] = $this->input->post('identity_no');
//        $data['Fimage_path'] = $this->input->post('image_path');
//        $data['Femail'] = $this->input->post('email');
//        $data['Fphone'] = $this->input->post('phone');
//        $data['Fcountry'] = $this->input->post('country');
//        $data['Fprovince'] = $this->input->post('province');
//        $data['Fcity'] = $this->input->post('city');
//        $data['Faddress'] = $this->input->post('address');
//        $data['Fcert_status'] = $this->input->post('cert_status');
//        $data['Fremark'] = $this->input->post('remark');
        $data['is_new'] = 0;
        $data['nick_name'] = 'nick1';
        $data['real_name'] = 'Cren';
        $data['identity_no'] = '441111112222222222';
        $res = $this->user_service_model->save($data);
        echo json_encode_data($res);
    }
}