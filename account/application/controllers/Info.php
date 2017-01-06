<?php

/**
 * Info.php
 * Author   : cren
 * Date     : 2016/12/12
 * Time     : 下午10:04
 */
class Info extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/info_service_model', 'info_service');
    }

    /**
     * 查询
     */
    public function query()
    {
        $option = array(
            'Fuser_type' => $this->input->get('user_type'),
            'Fstatus' => $this->input->get('status'),
            'Fuser_id' => $this->input->get('user_id'),// 用户名
            'p' => $this->input->get('p') ? : 1,
            'page_size' => $this->input->get('page_size'),
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
        );
        $res = $this->info_service->query($option);
        echo outputResponse($res);
    }

    public function getInfo()
    {
        $option =array(
            'Fid' => $this->input->get('id'),
        );
        $res = $this->info_service->getInfo($option);
        echo outputResponse($res);
    }

    public function changeStatus()
    {
        $option = array(
            'Fid' => intval($this->input->get('id')),
            'Fstatus' => $this->input->get('status'),
            'Fatte_status' => $this->input->get('atte_status'),
            'Fis_blackuser' => $this->input->get('is_blackuser'),
        );
        $res = $this->info_service->changeStatus($option);
        echo outputResponse($res);
    }

    /**
     * 查询黑名单
     */
    public function queryBlackList()
    {
        $option = array(
            'Fuser_type' => $this->input->get('user_type'),
            'Fuser_id' => $this->input->get('user_id'),// 用户名
            'p' => $this->input->get('p') ? : 1,
            'page_size' => $this->input->get('page_size'),
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
        );
        $res = $this->info_service->queryBlackList($option);
        echo outputResponse($res);
    }

    /**
     * 查询个人账户
     */
    public function queryCapitalAccount()
    {
        $option = array(
            'Fuser_type' => $this->input->get('user_type'),
            'Fuser_id' => $this->input->get('user_id'),// 用户名
            'p' => $this->input->get('p') ? : 1,
            'page_size' => $this->input->get('page_size'),
        );
        $res = $this->info_service->queryCapitalAccount($option);
        echo outputResponse($res);
    }

}