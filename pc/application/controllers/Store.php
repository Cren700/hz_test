<?php
/**
 * Store.php
 * Author   : cren
 * Date     : 2017/2/4
 * Time     : 下午11:46
 */

class Store extends BaseControllor
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/store_service_model');

        self::hasStorePower();
        // 目录结构
        $menu = $this->getStoreMenu() ? : array();
        $this->smarty->assign('menu', $menu);
    }

    public function index()
    {
        $cate = $this->store_service_model->category();
        $cssArr = array('admin/datepicker.css');
        $jsArr = array(
            'admin/plugin/bootstrap-datepicker.js',
            'admin/product/product.js'
        );
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('admin/product/index.tpl');
    }

    public function query()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'product_name'   => $this->input->get('product_name', true),
            'category_id' => $this->input->get('category_id', true),
            'product_status' => $this->input->get('status', true),
            'store_id'  => $this->_user_type == 1 ? '' : $this->_uid,
            'is_del' => $this->input->get('is_del', true),
            'min_date' => $this->input->get('min_date', true),
            'max_date' => $this->input->get('max_date', true),
        );
        $cate = $this->store_service_model->category();
        $cate = isset($cate['data']['list']) ? $cate['data']['list'] : array();
        $tmp = array();
        foreach ($cate as $c) {
            $tmp[$c['Fcategory_id']] = $c['Fcategory_name'];
        }
        $product = $this->store_service_model->query($option);
        $this->smarty->assign('cate', $tmp);
        $this->smarty->assign('info', $product['data']);
        $this->smarty->assign('page', $this->page($product['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('admin/product/list.tpl');
    }

    public function get()
    {
        $data = array(
            'product_id' => $this->input->get('id')
        );
        $res = $this->store_service_model->getProductByPid($data);
        echo json_encode_data($res);
    }

    public function add()
    {
        $cate = $this->store_service_model->category();
        $jsArr = array(
            'admin/plugin/jquery.placeholder.min.js',
            'admin/plugin/jquery.validate.js',
            'admin/product/detail.js',
            'admin/ueditor/ueditor.config.js',
            'admin/ueditor/ueditor.all.js',
            'admin/ueditor/lang/zh-cn/zh-cn.js',
            'admin/uploadify/jquery.uploadify.min.js',
        );
        $cssArr = array('admin/uploadify.css');
        $this->smarty->assign('is_new', 1);
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('admin/product/detail.tpl');
    }

    public function detail($pid = null){
        $data = array(
            'product_id' => $pid ? : $this->input->get('pid')
        );

        $product = $this->store_service_model->getProductByPid($data);
        if (empty($product['data'])) {
            $this->jump404();
        }
//        p($product);
        $cate = $this->store_service_model->category();
        $jsArr = array(
            'admin/plugin/jquery.placeholder.min.js',
            'admin/plugin/jquery.validate.js',
            'admin/uploadify/jquery.uploadify.min.js',
            'admin/product/detail.js',
            'admin/ueditor/ueditor.config.js',
            'admin/ueditor/ueditor.all.js',
            'admin/ueditor/lang/zh-cn/zh-cn.js',
        );
        $cssArr = array('admin/uploadify.css');
        $this->smarty->assign('is_new', 0);
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('product', $product['data']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('admin/product/detail.tpl');
    }

    public function save()
    {
        $data = array(
            'is_new' => $this->input->post('is_new'),
            'product_id' => $this->input->post('product_id'),
            'store_id' => $this->_uid,
            'store_type' => 1, //前台用户
            'product_name' => $this->input->post('product_name'),
            'url' => $this->input->post('url'),
            'product_price' => $this->input->post('product_price'),
            'category_id' => $this->input->post('category_id'),
            'description' => $this->input->post('description'),
            'coverimage' => $this->input->post('coverimage'),
            'height_amount' => $this->input->post('height_amount'),
            'scope_insurance' => $this->input->post('scope_insurance'),
            'scope_age' => $this->input->post('scope_age'),
            'observation_period' => $this->input->post('observation_period'),
            'content' => $this->input->post('content'),
            'rule_title' => $this->input->post('rule_title'), // 计划规则 标题
            'rule_description' => $this->input->post('rule_description'), // 计划规则 描述
            'process_title' => $this->input->post('process_title'), // 申请流程 标题
            'process_description' => $this->input->post('process_description'), // 申请流程 描述
            'question' => $this->input->post('question'),// 常见问题
            'answer' => $this->input->post('answer'),// 常见问题
            'pledge_title' => $this->input->post('pledge_title'), // 公约
            'pledge_content' => $this->input->post('pledge_content'), // 公约
            'plan_tk_title' => $this->input->post('plan_tk_title'), // 计划条款
            'plan_tk_content' => $this->input->post('plan_tk_content'), // 计划条款
            'demand_title' => $this->input->post('demand_title'), // 健康要求
            'demand_content' => $this->input->post('demand_content'), // 健康要求
        );
        $res = $this->store_service_model->save($data);
        echo json_encode_data($res);
    }

    public function status()
    {
        $data = array(
            'status'    => $this->input->post('status'),
            'is_del'    => $this->input->post('is_del'),
            'pid'       => $this->input->post('pid'),
        );

        $has = $this->hasProductPower($data['pid']);
        if ($has['code'] == 0) {
            $res = $this->store_service_model->status($data);
            echo json_encode_data($res);
        } else {
            echo json_encode_data($has);
        }
    }

    // 判断是否具有发布权限, 通过认证且为商户用户
    private function hasStorePower()
    {
        $has = $this->store_service_model->hasStorePower();
        if ($has['code'] != 0) {
            $this->jump404($has['msg']);
            exit();
        }
    }

    // 判断是否具有产品权限
    private function hasProductPower($pid)
    {
        $has = $this->store_service_model->hasProductPower($pid);
        return $has;
    }
}