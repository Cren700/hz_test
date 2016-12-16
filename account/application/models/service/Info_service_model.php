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
        }

        if (!empty($option['min_date'])) {
            $where['u.Fcreate_time >= '] = strtotime($option['min_date']);
        }

        if (!empty($option['max_date'])) {
            $where['u.Fcreate_time <= '] = strtotime($option['max_date'])+23*3600+3599;
        }

        if ($option['Fuser_id'] === '0' || !empty($option['Fstatus'])) {
            $like['u.Fuser_id'] = $option['Fuser_id'];
        }
        $page = $option['p'] ? : 1;
        $page_size = $option['page_size'];

        $res['data']['count'] = $this->info_dao->userCounts($where, $like);
        $res['data']['list'] = $this->info_dao->userList($where, $like, $page, $page_size);

        return $res;
    }
}