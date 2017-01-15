<?php

/**
 * Pay.php
 * Author   : cren
 * Date     : 2017/1/1
 * Time     : 下午11:56
 */
class Pay extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * wxPay 微信支付接口
     * @param $id 订单ID
     * @author lyne
     */
    public function wxPay($id = 1){
        require_once (APPPATH.'libraries/Wxpay/log.php');
        //初始化日志
        $logHandler= new CLogFileHandler(APPPATH."libraries/Wxpay/logs/".date('Y-m-d').'.log');
        Log::Init($logHandler, 15);

        // 查预先生成的订单信息
//        $this->load->model('order_model');
//        $o = $this->order_model->getMyOrderDetails($id);

        $o = array(
            'goods_name' => '商品名称',
            'id' => 'attach1234',
            'order_code' => 'order_id+order_name',
            'order_amount' => 0.01,
            'goods_id' => 'product_id'

        );
        // 调用微信扫码支付接口配置信息
        $this->load->config('wxpay_config');
        $wxconfig['appid']=$this->config->item('appid');
        $wxconfig['mch_id']=$this->config->item('mch_id');
        $wxconfig['apikey']=$this->config->item('apikey');
        $wxconfig['appsecret']=$this->config->item('appsecret');
        $wxconfig['sslcertPath']=$this->config->item('sslcertPath');
        $wxconfig['sslkeyPath']=$this->config->item('sslkeyPath');
        //由于此类库构造函数需要传参，我们初始化类库就传参数给他吧
        $this->load->library('CI_Wechatpay',$wxconfig);

        $param['body']=$o['goods_name']; //"商品名称（自行看文档具体填什么）";
        $param['attach']=$o['id']; // "我有个参数要传我就穿了个id过来，这里不要有空格避免出错";
        $param['detail']=$o['order_code'];  //"我填了商品名称加订单号";
        $param['out_trade_no']=$o['order_code']; //"商户订单号";
        $param['total_fee']=$o['order_amount']*100; //"金额，记得乘以100，微信支付单位默认分";//如$total_fee*100
        $param["spbill_create_ip"] =$_SERVER['REMOTE_ADDR'];//客户端IP地址
        $param["time_start"] = date("YmdHis");//请求开始时间
        $param["time_expire"] = date("YmdHis", time() + 600);//请求超时时间 10分钟
//        $param["goods_tag"] = urldecode('运费：') . $o['postage']; //商品标签，自行填写
        $param["notify_url"] = "http://".$_SERVER['HTTP_HOST']."/wxnotify/"; //自行定义异步通知url
        $param["trade_type"] = "NATIVE";//扫码支付模式二
        $param["product_id"] = $o['goods_id']; //正好有产品id就传了个，看文档说自己定义
        //调用统一下单API接口
        $result=$this->ci_wechatpay->unifiedOrder($param);//这里可以加日志输出，
        // 写入日志
        log::debug(json_encode($result));
        //成功（return_code和result_code都为SUCCESS）就会返回含有带支付二维码链接的数据
        $data=array();
        if (isset($result["code_url"]) && !empty($result["code_url"])) {//二维码图片链接
            $data['wxurl'] = $result["code_url"];
            //这里传递商户订单号到扫码视图，是因为我想做跳转，根据商户号去查询订单是否支付成功，如果成功了就跳转，定时轮询微信服务器（这个谁有好的方法可以分享给我啊，表示感谢啦）
            $data['orderno'] = $param['out_trade_no'];
            // 写入日志

            $this->smarty->assign('time_expire',strtotime($param["time_expire"])); //订单失效时间
            $this->smarty->assign('order_no',$data['orderno']);
            $this->smarty->assign('wxurl',urlencode($data['wxurl'])); // 获取到的二维码地址
            $this->smarty->display('wxpay/index.html');
        }

    }

    public function textPay()
    {

        require_once (APPPATH.'libraries/Wxpay/TestPay.php');
        $config['appid'] = 'wx426b3015555a46be';

        $config['mch_id'] = '1900009851';

        $config['apikey'] = '8934e7d15453e97507ef794cf7b0519d';
        //1.统一下单方法
        $wechatAppPay = new wechatAppPay('wx426b3015555a46be', '1900009851', $notify_url = 'www.huzhu.web.com/mobile', '8934e7d15453e97507ef794cf7b0519d');
        $params['body'] = '商品描述';                       //商品描述
        $params['out_trade_no'] = 'O20160617021323-001';    //自定义的订单号
        $params['total_fee'] = '100';                       //订单金额 只能为整数 单位为分
        $params['trade_type'] = 'APP';                      //交易类型 JSAPI | NATIVE | APP | WAP
        $result = $wechatAppPay->unifiedOrder( $params );
        print_r($result); // result中就是返回的各种信息信息，成功的情况下也包含很重要的prepay_id
        //2.创建APP端预支付参数
        /** @var TYPE_NAME $result */
        $data = @$wechatAppPay->getAppPayParams( $result['prepay_id'] );
        // 根据上行取得的支付参数请求支付即可
        print_r($data);
    }

}