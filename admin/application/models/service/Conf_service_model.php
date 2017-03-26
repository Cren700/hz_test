<?php

/**
 * Order_service_model.php
 * Author   : cren
 * Date     : 2016/12/27
 * Time     : 下午10:57
 */
class Conf_service_model extends HZ_Model
{
    private $_api = 'conf';
    public function __construct()
    {
        parent::__construct();
    }

    public function query()
    {
        return $this->myCurl($this->_api, 'queryConf', array(), false);
    }

    public function getConfById($data)
    {
        return $this->myCurl($this->_api, 'getConfById', $data, false);
    }

    public function save($data)
    {
        $is_new = $data['is_new'];
        unset($data['is_new']);
        if ($is_new) {
            $res = $this->myCurl($this->_api, 'addConf', $data, true);
        } else {
            $res = $this->myCurl($this->_api, 'updateConf', $data, true);
        }
        if ($res['code'] === 0) {
            $res['data']['url'] = getBaseUrl('/conf.html');
        }
        return $res;
    }

    public function del($data)
    {
        return $this->myCurl($this->_api, 'delConf', $data, false);
    }

}