<?php
class Promo_dao_model extends HZ_Model {

    private $_promo_table = 't_adv_prom';//广告表
    private $_promo_rule = 't_promo_rule';//推广规则表
    private $_expand = 't_expand';//返利信息表
    private $_report = 't_report';//用户反馈表
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
    
    public function getPromoRandom()
    {
        $sql = "select t1.* from {$this->_promo_table} as t1 join (select rand() * (select max(Factive_id) from {$this->_promo_table}) as Factive_id) as t2 on t1.Factive_id >t2.Factive_id where t1.Fstatus=1 limit 1";
        return $this->p->query($sql)->row_array();
    }

    public function getPromoRule()
    {
        $res = $this->p->order_by('Frule_id', 'DESC')->get_where($this->_promo_rule)->result_array();
        return $res;
    }

    public function getRuleByWhere($where)
    {
        dbEscape($where);
        $res = $this->p->get_where($this->_promo_rule, $where)->row_array();
        return $res;
    }

    public function addPromoRule($data) {
        dbEscape($data);
        return $this->p->insert($this->_promo_rule, $data);
    }

    public function savePromoRule($where, $data)
    {
        return $this->p->update($this->_promo_rule, $data, $where);
    }

    public function ruleStatus($where, $data)
    {
        return $this->p->update($this->_promo_rule, $data, $where);
    }

    public function addOrderExpand($data)
    {
        return $this->p->insert($this->_expand, $data);
    }

    public function sendReport($data)
    {
        $_db = $this->load->database('common', true);
        return $_db->insert($this->_report, $data);
    }
}