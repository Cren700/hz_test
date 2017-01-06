<?php
class Promo_dao_model extends HZ_Model {

	private $_promo_table = 't_adv_prom';//广告表
	private $p = null;//广告库

	public function __construct() {
		parent::__construct();
		$this->p = $this->load->database('promo_db',true);
	}

	public function add($data) {
        dbEscape($data);
		return $this->p->insert($this->_promo_table,$data);
	}

	public function getPromoInfoById($where) {
        dbEscape($where);
		$query = $this->p->get_where($this->_promo_table,$where);
		$res = $query->row_array();
        return filterData($res);
	}

	public function save($where, $data)
    {
        return $this->p->update($this->_promo_table, $data, $where);
    }

    public function promoNum($where,$like) {//获取某个广告
        dbEscape($where);
        dbEscape($like);
        $this->p->select('count(*) as num');
        $this->p->from($this->_promo_table);
        $this->p->where($where);
        $this->p->like($like);
        $count = $this->p->count_all_results();
        return $count;
    }

    public function changeStatus($data, $where)
    {
        dbEscape($data);
        dbEscape($where);
        return $this->p->update($this->_promo_table, $data, $where);
    }

    //查询获取到所有的广告
    public function promoList($where,$like,$page,$page_size) {
        dbEscape($where);
        dbEscape($like);
        $this->p->select('*');
        $this->p->from($this->_promo_table);
        $this->p->where($where);
        $this->p->like($like);
        $this->p->limit($page_size, $page_size * ($page - 1));//第一页显示10条
        $this->p->order_by('Flevel ASC, Factive_id DESC');
        $query = $this->p->get();
        $res = $query->result_array();
        return filterData($res);
    }

    public function del($where) {
        dbEscape($where);
        return $this->p->delete($this->_promo_table,$where);
    }
}