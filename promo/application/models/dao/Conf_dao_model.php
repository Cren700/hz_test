<?php
class Conf_dao_model extends HZ_Model {

	private $_config_table = 't_config';
	private $common = null; //数据库

	public function __construct() {
		parent::__construct();
		$this->common = $this->load->database('common',true);
	}

	public function queryConf() {
		$query = $this->common->get_where($this->_config_table);
		return $query->result_array();//所有
	}

	//获取单条信息
	public function getConfById($where) {
		$query = $this->common->get_where($this->_config_table, $where);
		return $query->row_array();
	}

	//添加
	public function addConf($data) {
		$res = $this->common->insert($this->_config_table, $data);
		return $res;
	}

	//更新
	public function updateConf($where, $data) {
		return $this->common->update($this->_config_table, $data, $where);
	}

	//删除
	public function delConf($where) {
		return $this->common->delete($this->_config_table, $where);
	}
}