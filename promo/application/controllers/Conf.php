<?php

class Conf extends HZ_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('service/conf_service_model','conf_service');
    }

    public function queryConf()
    {
        $res = $this->conf_service->queryConf();
        echo outputResponse($res);
    }

    public function getConfById() {
        $where = array(
            'Fid' => $this->input->get('id')
        );
        $res = $this->conf_service->getConfById($where);
        echo outputResponse($res);
    }

    //添加分类
    public function addConf() {
        $data = array();
        //接收添加的数据
        $data['Ftypename'] = $this->input->post('typename');
        $data['Fcontent'] = $this->input->post('content');
        $data['Fcreate_time'] = time();
        $data['Fupdate_time'] = time();
        $res = $this->conf_service->addConf($data);
        echo outputResponse($res);//输出
    }

    //更新分类
    public function updateConf() {
        $data['Ftypename'] = $this->input->post('typename');
        $data['Fcontent'] = $this->input->post('content');
        $data['Fupdate_time'] = time();
        $where = array('Fid' => $this->input->post('id'));//接收指定id
        $res = $this->conf_service->updateConf($where,$data);
        echo outputResponse($res);
    }

    //删除分类
    public function delConf() {
        $where = array('Fid' => $this->input->get('id'));
        $res = $this->conf_service->delConf($where);
        echo outputResponse($res);
    }
}