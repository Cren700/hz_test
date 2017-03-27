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
            'product_name'   => $this->input->get('product_name', true),
            'category_id' => $this->input->get('category_id', true),
            'product_status' => $this->input->get('status', true),
            'store_id'  => $this->_user_type == 1 ? '' : $this->_uid,
            'is_del' => $this->input->get('is_del', true),
            'min_date' => $this->input->get('min_date', true),
            'max_date' => $this->input->get('max_date', true),
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
            'ueditor/ueditor.all.min.js',
            'ueditor/lang/zh-cn/zh-cn.js',
            'uploadify/jquery.uploadify.min.js',
        );
        $cssArr = array('uploadify.css');
        $this->smarty->assign('is_new', 1);
        $this->smarty->assign('cate', $cate['data']);
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('product/detail.tpl');
    }

    public function detail($pid = null){
        $data = array(
            'product_id' => $pid ? : $this->input->get('pid')
        );

        $product = $this->product_service->getProductByPid($data);
//        p($product);
        if (empty($product['data'])) {
            $this->jump404();
        }
        $cate = $this->product_service->category();
        $jsArr = array(
            'plugin/jquery.placeholder.min.js',
            'plugin/jquery.validate.js',
            'uploadify/jquery.uploadify.min.js',
            'product/detail.js',
            'ueditor/ueditor.config.js',
            'ueditor/ueditor.all.min.js',
            'ueditor/lang/zh-cn/zh-cn.js',
        );
        $cssArr = array('uploadify.css');
        $do = $this->input->get('_d') == 1 ? 1 : 0 ;
        $this->smarty->assign('do', $do);
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
            'store_type' => 0, //后台类型为0
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

    public function batchDelProduct()
    {
        $option = array(
            'ids' => $this->input->post('ids')
        );
        $res = $this->product_service->batchDelProduct($option);
        echo json_encode_data($res);
    }

    /**
     * 产品分类
     */
    public function cate()
    {
        $cate_count = $this->product_service->getProCateCount();
        $cate_count = isset($cate_count['data']['list']) ? $cate_count['data']['list'] : array();
        $tmp_cate_count = array();
        foreach($cate_count as $l) {
            $tmp_cate_count[$l['Fcategory_id']] = $l['cnt'];
        }
        $cate = $this->product_service->category();
        $jsArr = array('product/cateStatus.js');
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cate_count', $tmp_cate_count);
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
        $do = $this->input->get('_d') == 1 ? 1 : 0 ;
        $this->smarty->assign('do', $do);
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

    public function collect()
    {
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'product/collect.js'
        );
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('product/collect.tpl');
    }

    public function queryCollect()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'product_id'   => $this->input->get('product_id'),
            'user_id'   => $this->input->get('user_id'),
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
        );
        $collect = $this->product_service->queryCollect($option);
        $this->smarty->assign('info', $collect['data']);
        $this->smarty->assign('page', $this->page($collect['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('product/collectList.tpl');
    }

    /**
     * 评论列表页
     */
    public function comment()
    {
        $cate = $this->product_service->category();
        $cssArr = array('datepicker.css');
        $jsArr = array(
            'plugin/bootstrap-datepicker.js',
            'product/comment.js'
        );
        $this->smarty->assign('cate', isset($cate['data'])) ? $cate['data'] : array();
        $this->smarty->assign('jsArr', $jsArr);
        $this->smarty->assign('cssArr', $cssArr);
        $this->smarty->display('product/comment.tpl');
    }

    public function queryComment()
    {
        $option = array(
            'p' => $this->input->get('p') ? : 1 ,
            'page_size' => $this->input->get('n') ? : 10,
            'pro_id'   => $this->input->get('pro_id'),
            'user_name'   => $this->input->get('author_name'),
            'comment_approved' => $this->input->get('comment_approved'),
            'min_date' => $this->input->get('min_date'),
            'max_date' => $this->input->get('max_date'),
        );
        $comment = $this->product_service->queryComment($option);
        $this->smarty->assign('info', $comment['data']);
        $this->smarty->assign('page', $this->page($comment['data']['count'], $option['p'], $option['page_size'], ''));
        echo $this->smarty->display('product/commentList.tpl');
    }

    /**
     * 评论状态
     */
    public function statusComment()
    {
        $data = array(
            'status'    => $this->input->post('status'),
            'comment_id'       => $this->input->post('comment_id'),
        );
        $res = $this->product_service->statusComment($data);
        echo json_encode_data($res);
    }

    /**
     * 删除评论
     */
    public function delComment()
    {
        $data = array(
            'comment_id' => $this->input->post('comment_id')
        );
        $res = $this->product_service->delComment($data);
        echo json_encode_data($res);
    }

    public function batchDelComment()
    {
        $option = array(
            'ids' => $this->input->post('ids')
        );
        $res = $this->product_service->batchDelComment($option);
        echo json_encode_data($res);
    }

    /**
     * 审核不通过添加备注信息
     */
    public function notApproved()
    {
        $data = array(
            'product_id' => $this->input->post('id'),
            'remark' => $this->input->post('remark'),
        );
        $res = $this->product_service->notApproved($data);
        echo json_encode_data($res);
    }

}