<?php
class Promo extends HZ_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('service/promo_service_model','promo_service');
    }
    public function index() {
        $cate = $this->promo_service->category();//获取分类
        $cssArr = array('datepicker.css');//引入css插件
        $jsArr =  array(
            'plugin/bootstrap-datepicker.js',
            'promo/promo.js'
        );
        $this->smarty->assign('cate',$cate['data']);
        $this->smarty->assign('cssArr',$cssArr);
        $this->smarty->assign('jsArr',$jsArr);
        $this->smarty->display('promo/index.tpl');
    }

    //添加广告
    public function add() {
        $cssArr = array('uploadify.css');
        $cate = $this->promo_service->category();
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'uploadify/jquery.uploadify.min.js',
            'promo/detail.js'
        );
        $this->smarty->assign('is_new',1);
        $this->smarty->assign('cate',$cate['data']);
        $this->smarty->assign('jsArr',$jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('promo/detail.tpl');
    }

    //保存广告
    public function save() {
        $data = array(
            'is_new'      => $this->input->post('is_new'),
            'active_id'   => $this->input->post('active_id'),
            'active_name' => $this->input->post('active_name'),
            'category_id' => $this->input->post('category_id'),
            'image_path'  => $this->input->post('image_path'),
            'active_url'  => $this->input->post('active_url'),
            'vendor'      => $this->input->post('vendor'),
            'level'       => $this->input->post('level')? : 1,// 最低
            'create_time' => time()
        );
        $res = $this->promo_service->save($data);
        echo json_encode_data($res);
    }

    //查询所有广告
    public function query() {
        $option = array(
            'p'           => $this->input->get('p') ? : 1,//分页第1页
            'page_size'   => $this->input->get('n') ? : 10,//每页显示10条
            'active_name' => $this->input->get('active_name') ? : '',
            'category_id' => $this->input->get('category_id') ? : '',
            'status'       => $this->input->get('status') ? : '',
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
        );
        $promo = $this->promo_service->query($option);
        $cate = $this->promo_service->category();//获取分类
        $cate = isset($cate['data']['list']) ? $cate['data']['list'] : array();
        $arr = array();
        foreach ($cate as $v) {
            $arr[$v['Fcategory_id']] = $v['Fcategory_name'];
        }
        $this->smarty->assign('cate',$arr);
        $this->smarty->assign('info',$promo['data']);
        $this->smarty->assign('page',$this->page($promo['data']['count'],$option['p'],$option['page_size'],''));
        $this->smarty->display('promo/list.tpl');
    }

    public function get() {
        $data = array(
            'active_id' => $this->input->get('id')
        );
        $res = $this->promo_service->getPromoById($data);
        echo json_encode_data($res);
    }

    public function detail($pid = null){
        $data = array(
            'active_id' => $pid ? : $this->input->get('pid')
        );
        $cssArr = array('uploadify.css');

        $promo = $this->promo_service->getPromoById($data);
        if (empty($promo['data'])) {
            $this->jump404();
        }
        $cate = $this->promo_service->category();
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'uploadify/jquery.uploadify.min.js',
            'promo/detail.js'
        );
        $this->smarty->assign('is_new', 0);
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('promo', $promo['data']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('promo/detail.tpl');
    }

    public function status() {
        $data = array(
            'status'    => $this->input->post('status'),
            'pid'       => $this->input->post('pid'),
        );
        $res = $this->promo_service->status($data);
        echo json_encode_data($res);
    }

    public function del()
    {
        $data = array( 'id' => $this->input->get('id'));
        $res = $this->promo_service->del($data);
        echo json_encode_data($res);
    }

    public function batchDelPromo()
    {
        $option = array(
            'ids' => $this->input->post('ids')
        );
        $res = $this->promo_service->batchDelPromo($option);
        echo json_encode_data($res);
    }

    public function verify() {
        $cate = $this->promo_service->category();
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'promo/promo.js'
        );
        $this->smarty->assign('cate',$cate['data']);
        $this->smarty->assign('cssArr',$cssArr);
        $this->smarty->assign('jsArr',$jsArr);
        $this->smarty->display('promo/verify.tpl');
    }

    //广告类型列表
    public function cateList() {
        $cate = $this->promo_service->category();
        $this->smarty->assign('cate',$cate['data']);
        $this->smarty->display('promo/cateList.tpl');
    }

    //展示广告类型
    public function cateAdd() {
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'promo/cate.js'
        );
        $this->smarty->assign('is_new',1);
        $this->smarty->assign('jsArr',$jsArr);
        $this->smarty->display('promo/cate_detail.tpl');
    }

    //获取分类
    public function cateGet($id = '') {
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'promo/cate.js'
        );
        $data = array(
            'category_id' => $id ? $id : $this->input->get('id')
        );
        !$data['category_id'] ? $this->jump404() : '';
        $cate = $this->promo_service->cateGet($data);
        empty($cate['data']) ? $this->jump404() : '';
        $this->smarty->assign('is_new',0);
        $this->smarty->assign('jsArr',$jsArr);
        $this->smarty->assign('cate',$cate['data']);
        $this->smarty->display('promo/cate_detail.tpl');
    }

    //保存分类
    public function cateSave() {
        //接收数据并存于数组
        $data = array(
            'is_new' => $this->input->post('is_new'),
            'category_id' =>$this->input->post('category_id'),
            'category_name' => $this->input->post('category_name'),
            'remark' => $this->input->post('remark')
        );
        //调用模型的保存方法
        $res = $this->promo_service->cateSave($data);
        //判断
        if(!$res['code']) {
            $res['data']['url'] = getBaseUrl('/promo/cateList.html');
        }
        echo json_encode_data($res);
    }

    //删除类型
    public function cateDel() {
        $data = array('id' => $this->input->get('id'));
        $res = $this->promo_service->cateDel($data);
        echo json_encode_data($res);//json格式输出数据
    }

    /**
     * 推广规则
     * 每种类型只能有一个规则
     */
    public function set()
    {
        $jsArr = array(
            'promo/rule.js'
        );
        $info = $this->promo_service->getPromoRule();
        $this->smarty->assign('jsArr',$jsArr);
        $this->smarty->assign('info',$info['data']);
        $this->smarty->display('promo/set.tpl');
    }

    /**
     * 修改状态
     */
    public function ruleStatus()
    {
        $option = array(
            'status' => $this->input->get('status'),
            'rule_id' => $this->input->get('id')
        );
        $res = $this->promo_service->ruleStatus($option);
        echo json_encode_data($res);
    }

    public function ruleDetail($rule_id)
    {
        $rule_id = $rule_id ? :$this->input->get('id');
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'promo/addRule.js'
        );
        $info = $this->promo_service->getRuleById($rule_id);
        if (empty($info['data'])) {
            $info->jump404();
        }
        $this->smarty->assign('is_new',0);
        $this->smarty->assign('jsArr',$jsArr);
        $this->smarty->assign('info', $info['data']);
        $this->smarty->display('promo/promoRule.tpl');
    }

    /**
     * 添加规则
     */
    public function addPromoRule()
    {
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'promo/addRule.js'
        );
        $this->smarty->assign('is_new',1);
        $this->smarty->assign('jsArr',$jsArr);
        $this->smarty->display('promo/promoRule.tpl');
    }

    //保存推广规则
    public function savePromoRule() {
        $data = array(
            'is_new'      => $this->input->post('is_new'),
            'rule_id'   => $this->input->post('rule_id'),
            'share_type'   => $this->input->post('share_type'),
            'amount' => $this->input->post('amount'),
            'integral' => $this->input->post('integral'),
        );
        $res = $this->promo_service->savePromoRule($data);//判断
        if(!$res['code']) {
            $res['data']['url'] = getBaseUrl('/promo/set.html');
        }
        echo json_encode_data($res);
    }
}