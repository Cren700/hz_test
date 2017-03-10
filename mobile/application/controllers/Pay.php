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
        $this->load->model('service/order_service_model', 'order_service');
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
     * 提交订单信息
     */
    public function wxPay()
    {
        $option = array(
            'order_no' => $this->input->get('out_trade_no', true),
            'user_id' => $this->_user_id
        );
        $res = $this->order_service->orderDetail($option);

        if ($res['code'] !== 0) {
            $this->jump404($res['msg']);
            exit();
        }
        if ($res['data']['Forder_status'] === 2) {
            $this->jump404('订单已经取消');
            exit();
        } else if ($res['data']['Forder_status'] === 3){
            $this->jump404('订单已经支付成功');
            exit();
        }
        $resOption = array(
            'out_trade_no' => $res['data']['Forder_no'],
            'body'  =>  $res['data']['Fproduct_name'],
            'total_fee' => (int)$res['data']['Fproduct_tol_amt'] * 100 ? "1" : "1",
            'mch_create_ip' => get_client_ip()
        );

//        $this->reqHandler->setReqParams($_POST,array('method'));
        $this->reqHandler->setReqParams($resOption,array('method'));
        $this->reqHandler->setParameter('service','pay.weixin.jspay');//接口类型：pay.weixin.jspay
        $this->reqHandler->setParameter('mch_id',$this->cfg->C('mchId'));//必填项，商户号，由威富通分配
        $this->reqHandler->setParameter('version',$this->cfg->C('version'));

        //通知地址，必填项，接收威富通通知的URL，需给绝对路径，255字符内格式如:http://wap.tenpay.com/tenpay.asp
        //$notify_url = 'http://'.$_SERVER['HTTP_HOST'];
        //$this->reqHandler->setParameter('notify_url',$notify_url.'/payInterface/request.php?method=callback');
        $this->reqHandler->setParameter('notify_url', getBaseUrl('/pay/payBack.html')); // 接收威富通通知的 URL，需给绝对路径 (支付通知)
        $this->reqHandler->setParameter('callback_url', getBaseUrl('/info/planList.html')); // 支付完成回调页面
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
                    $this->dopay($this->resHandler->getParameter('token_id'));
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

    // 支付通知
    public function payBack(){
        $xml = file_get_contents('php://input');
        file_put_contents("/tmp/TEST_PAY.log", 'payBack/', FILE_APPEND);
        $this->resHandler->setContent($xml);
        $this->resHandler->setKey($this->cfg->C('key'));
        if($this->resHandler->isTenpaySign()){
            if($this->resHandler->getParameter('status') == 0 && $this->resHandler->getParameter('result_code') == 0){

                file_put_contents("/tmp/TEST_PAY.log", 'status:'.$this->resHandler->getParameter('status').'/code:'.$this->resHandler->getParameter('result_code').'/pay_result:'.$this->resHandler->getParameter('pay_result'), FILE_APPEND);
                file_put_contents("/tmp/TEST_PAY.log", 'content:'.json_encode_data($this->resHandler->getAllParameters()), FILE_APPEND);

                // pay_result Int 支付结果:0—成功;其它—失败
                if ($this->resHandler->getParameter('pay_result') === 0) {
                    //更改订单状态
                    $optionOrder = array(
                        'order_status' => 3,
                        'order_no' => $this->resHandler->getParameter('out_trade_no'),
                    );
                }
                $this->order_service->orderStatus($optionOrder);
                // 支付情况
                $optionPay = array(
                    'out_trade_no' => $this->resHandler->getParameter('out_trade_no'),
                    'openid' => $this->resHandler->getParameter('openid'),
                    'trade_type' => $this->resHandler->getParameter('trade_type'),
                    'pay_result' => $this->resHandler->getParameter('pay_result'),
                    'pay_info' => $this->resHandler->getParameter('pay_info'),
                    'transaction_id' => $this->resHandler->getParameter('transaction_id'),
                    'out_transaction_id' => $this->resHandler->getParameter('out_transaction_id'),
                    'total_fee' => $this->resHandler->getParameter('total_fee'),
                    'fee_type' => $this->resHandler->getParameter('fee_type'),
                    'bank_type' => $this->resHandler->getParameter('bank_type'),
                    'bank_billno' => $this->resHandler->getParameter('bank_billno'),
                    'time_end' => $this->resHandler->getParameter('time_end'),
                );
                $this->order_service->payInfo($optionPay);
                ob_clean();//清理缓冲区
                Utils::dataRecodes('接口回调收到通知参数',$this->resHandler->getAllParameters());
                echo 'success'; // 处理成功，威富通系统收到此结果后不再进行后续通知
                exit();
            }else{
                echo 'failure'; // 处理不成功，威富通收到此结果或者没有收到任何结果，系统通过补单机制
                exit();
            }
        }else{
            echo 'failure';
        }
    }

    // 跳至支付页面
    public function dopay($token_id)
    {
        $url = "https://pay.swiftpass.cn/pay/jspay?token_id=".$token_id."&showwxtitle=1";
        header("Location: {$url}", true, 302);
        exit();
    }

}