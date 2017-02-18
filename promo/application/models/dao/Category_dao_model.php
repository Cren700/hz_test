<?php
class Category_dao_model extends HZ_Model {

	private $_cate_table = 't_category';
	private $p = null;//广告库

	public function __construct() {
		parent::__construct();
		$this->p = $this->load->database('promo_db',true);
	}

	//展示获取类型数据
	public function cateList() {
		$query = $this->p->get_where($this->_cate_table);
		return $query->result_array();//所有
	}

	//获取
	public function cateGet($where) {
		$query = $this->p->get_where($this->_cate_table,$where);
		return $query->row_array();//单条
	}

	//添加
	public function cateSave($data) {
		$res = $this->p->insert($this->_cate_table,$data);
		return $res;
	}

	//获取单条信息
	public function getCateInfoByCateId($cate_id) {
		$where = array('Fcategory_id' => $cate_id);
		$query = $this->p->get_where($this->_cate_table,$where);
		return $query->row_array();
	}

	//更新
	public function cateUpdate($where,$data) {
		return $this->p->update($this->_cate_table,$data,$where);
	}

	//删除
	public function cateDel($cate_id) {
		return $this->p->delete($this->_cate_table,$cate_id);
	}
}