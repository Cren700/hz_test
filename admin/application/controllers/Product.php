<?php

/**
 * product.php
 * Author   : cren
 * Date     : 2016/11/27
 * Time     : 下午4:01
 */
class Product extends BaseControllor
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service/product_service_model', 'product_service');
    }

    public function index()
    {
        $cate = $this->product_service->category();
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'product/product.js'
        );
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('product/index.tpl');
    }
    
    public function query()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'product_name'   => $this->input->get('product_name'),
            'category_id' => $this->input->get('category_id'),
            'product_status' => $this->input->get('status'),
            'store_id'  => $this->input->get('store_id'),
            'is_del' => $this->input->get('is_del'),
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
        );
        $cate = $this->product_service->category();
        $cate = isset($cate['data']['list']) ? $cate['data']['list'] : array();
        $tmp = array();
        foreach ($cate as $c) {
            $tmp[$c['Fcategory_id']] = $c['Fcategory_name'];
        }
        $product = $this->product_service->query($option);
        $this->smarty->assign('cate', $tmp);
        $this->smarty->assign('info', $product['data']);
        $this->smarty->assign('page', $this->page($product['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('product/list.tpl');
    }

    public function get()
    {
        $data = array(
            'product_id' => $this->input->get('id')
        );
        $res = $this->product_service->getProductByPid($data);
        echo json_encode_data($res);
    }

    public function add()
    {
        $cate = $this->product_service->category();
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'product/detail.js',
            'ueditor/ueditor.config.js',
            'ueditor/ueditor.all.js',
            'ueditor/lang/zh-cn/zh-cn.js',
        );
        $this->smarty->assign('is_new', 1);
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('product/detail.tpl');
    }

    public function detail($pid = null){
        $data = array(
            'product_id' => $pid ? : $this->input->get('pid')
        );

        $product = $this->product_service->getProductByPid($data);
        if (empty($product['data'])) {
            $this->jump404();
        }
//        p($product);
        $cate = $this->product_service->category();
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'uploadify/jquery.uploadify.min.js',
            'product/detail.js',
            'ueditor/ueditor.config.js',
            'ueditor/ueditor.all.js',
            'ueditor/lang/zh-cn/zh-cn.js',
        );
        $cssArr = array('uploadify.css');
        $this->smarty->assign('is_new', 0);
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('product', $product['data']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('product/detail.tpl');
    }


    public function save()
    {
        $data = array(
            'is_new' => $this->input->post('is_new'),
            'product_id' => $this->input->post('product_id'),
            'store_id' => $this->_uid,
            'product_name' => $this->input->post('product_name'),
            'product_num' => $this->input->post('product_num'),
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

        );
        $res = $this->product_service->save($data);
        echo json_encode_data($res);
    }

    public function status()
    {
        $data = array(
            'status'    => $this->input->post('status'),
            'is_del'    => $this->input->post('is_del'),
            'pid'       => $this->input->post('pid'),
        );
        $res = $this->product_service->status($data);
        echo json_encode_data($res);
    }

    public function del()
    {
        $data = array(
            'id' => $this->input->get('id')
        );
        $res = $this->product_service->del($data);
        echo json_encode_data($res);
    }

    /**
     * 产品分类
     */
    public function cate()
    {
        $cate = $this->product_service->category();
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->display('product/cateList.tpl');
    }

    public function addCate()
    {
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'product/cate.js'
        );
        $this->smarty->assign('is_new', 1);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('product/cate_detail.tpl');
    }

    public function getCate($id = '')
    {
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'product/cate.js'
        );
        $data = array(
            'category_id' => $id ? $id : $this->input->get('id')
        );
        !$data['category_id'] ? $this->jump404():'';
        $cate = $this->product_service->getCategory($data);
        empty($cate['data']) ? $this->jump404() : '';
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('is_new', 0);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('product/cate_detail.tpl');
    }

    public function saveCate()
    {
        $data = array(
            'is_new' => $this->input->post('is_new'),
            'category_id' => $this->input->post('category_id'),
            'category_name' => $this->input->post('category_name'),
            'remark' => $this->input->post('remark'),
        );
        $res = $this->product_service->saveCate($data);
        if(!$res['code']) {
            $res['data']['url'] = getBaseUrl('/product/cate.html');
        }
        echo json_encode_data($res);
    }

    public function delCate()
    {
        $data = array(
            'id' => $this->input->get('id')
        );
        $res = $this->product_service->delCate($data);
        echo json_encode_data($res);
    }

    /**
     * 产品审核列表 即状态为status = 1
     */
    public function verify()
    {
        $cate = $this->product_service->category();
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'product/product.js'
        );
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('product/verify.tpl');
    }
    
    /**
     * 产品已删除 即is_del = 1
     */
    public function recycle()
    {
        $cate = $this->product_service->category();
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'product/product.js'
        );
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->display('product/recycle.tpl');
    }

}