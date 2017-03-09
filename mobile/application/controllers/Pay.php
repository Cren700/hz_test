<?php

/**
 * Pay.php
 * Author   : cren
 * Date     : 2017/1/1
 * Time     : 下午11:56
 */
class Pay extends HZ_Controller
{
    private $resHandler = null;
    private $reqHandler = null;
    private $pay = null;
    private $cfg = null;

    public function __construct()
    {
        parent::__construct();
        require APPPATH . 'third_party/wxpay/Utils.class.php';
        require APPPATH . 'third_party/wxpay/wxpay_config.php';
        require APPPATH . 'third_party/wxpay/RequestHandler.class.php';
        require APPPATH . 'third_party/wxpay/ClientResponseHandler.class.php';
        require APPPATH . 'third_party/wxpay/PayHttpClient.class.php';
        $this->Request();
    }

    public function Request(){
        $this->resHandler = new ClientResponseHandler();
        $this->reqHandler = new RequestHandler();
        $this->pay = new PayHttpClient();
        $this->cfg = new Config();

        $this->reqHandler->setGateUrl($this->cfg->C('url'));
        $this->reqHandler->setKey($this->cfg->C('key'));
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

    /**
     * 提交订单信息
     */
    public function testPay()
    {
        $post = array(
            'out_trade_no' => 'trade_no_111111',
            'sub_openid' => 'sub_openid_111111',
            'body'  => '商品描述',
            'total_fee' => 1,
            'mch_create_ip' => '127.0.0.1',
        );
//        $this->reqHandler->setReqParams($_POST,array('method'));
        $this->reqHandler->setReqParams($post,array('method'));
        $this->reqHandler->setParameter('service','pay.weixin.jspay');//接口类型：pay.weixin.jspay
        $this->reqHandler->setParameter('mch_id',$this->cfg->C('mchId'));//必填项，商户号，由威富通分配
        $this->reqHandler->setParameter('version',$this->cfg->C('version'));

        //通知地址，必填项，接收威富通通知的URL，需给绝对路径，255字符内格式如:http://wap.tenpay.com/tenpay.asp
        //$notify_url = 'http://'.$_SERVER['HTTP_HOST'];
        //$this->reqHandler->setParameter('notify_url',$notify_url.'/payInterface/request.php?method=callback');
        $this->reqHandler->setParameter('notify_url','http://hztest.imhuzhu.com/mobile/pay/payBack.html');//
        $this->reqHandler->setParameter('callback_url','http://www.swiftpass.cn');
        $this->reqHandler->setParameter('nonce_str',mt_rand(time(),time()+rand()));//随机字符串，必填项，不长于 32 位
        $this->reqHandler->createSign();//创建签名

        $data = Utils::toXml($this->reqHandler->getAllParameters());

        $this->pay->setReqContent($this->reqHandler->getGateURL(),$data);

        if($this->pay->call()){
            $this->resHandler->setContent($this->pay->getResContent());
            $this->resHandler->setKey($this->reqHandler->getKey());
            if($this->resHandler->isTenpaySign()){
                //当返回状态与业务结果都为0时才返回支付二维码，其它结果请查看接口文档
                if($this->resHandler->getParameter('status') == 0 && $this->resHandler->getParameter('result_code') == 0){
                    echo json_encode(array('token_id'=>$this->resHandler->getParameter('token_id')));
                    exit();
                }else{
                    echo json_encode(array('status'=>500,'msg'=>'Error Code:'.$this->resHandler->getParameter('err_code').' Error Message:'.$this->resHandler->getParameter('err_msg')));
                    exit();
                }
            }
            echo json_encode(array('status'=>500,'msg'=>'Error Code:'.$this->resHandler->getParameter('status').' Error Message:'.$this->resHandler->getParameter('message')));
        }else{
            echo json_encode(array('status'=>500,'msg'=>'Response Code:'.$this->pay->getResponseCode().' Error Info:'.$this->pay->getErrInfo()));
        }
    }

    public function payBack(){
        $xml = file_get_contents('php://input');
        $this->resHandler->setContent($xml);
        //var_dump($this->resHandler->setContent($xml));
        $this->resHandler->setKey($this->cfg->C('key'));
        if($this->resHandler->isTenpaySign()){
            if($this->resHandler->getParameter('status') == 0 && $this->resHandler->getParameter('result_code') == 0){
                //echo $this->resHandler->getParameter('status');
                // 11;
                //更改订单状态
                ob_clean();//清理缓冲区
                Utils::dataRecodes('接口回调收到通知参数',$this->resHandler->getAllParameters());
                echo 'success';
                exit();
            }else{
                echo 'failure';
                exit();
            }
        }else{
            echo 'failure';
        }
    }

}