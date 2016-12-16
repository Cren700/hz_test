<?php

/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/11/29
 * Time: 上午1:34
 */
class HZ_Controller extends CI_Controller
{
    protected $_appChannel = null;
    protected $_token = null;
    protected $_uid = null;
    protected $_user_id = null;

    public function __construct(){
        parent::__construct();
        // 渠道 1:www 2:mobile 3:op 4:api
        $this->_appChannel = $this->input->server('HTTP_X_APP_CHANNEL');
        $this->_token = $this->input->server('HTTP_X_TOKEN');
        $this->_uid = $this->input->server('HTTP_X_UID');
        $this->_user_id = $this->input->server('HTTP_X_USER_ID');

        // 检验是否从渠道过来
//        !empty($this->appChannel) ? '' : $this->outputResponse(array('code' => 'system_error_1'));// 不合法途径

        $this->filterPostAndGet();
    }

    /**
     * 输出
     * @param $data
     * @param array $header
     */
    protected function outputResponse($data, $header = array())
    {
        if(isset($data['code']) and $data['code'])
        {
            $data = errorCode($data);
        }
        if(isset($data['data']) && is_array($data['data']) && isset($data['data'][0]))
        {
            $data['data'] = array('list' => $data['data']);
        }
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        // 设置HTTP响应头信息
        $headerDefault = array(
            'Content-Type'      => 'application/json; charset=UTF-8'
        );
        $header = array_merge($header, $headerDefault);
        foreach($header as $k => $v)
        {
            header("{$k}: {$v}");
        }
        exit($data);
    }

    /**
     * 格式化post和get数据
     */
    private function filterPostAndGet(){
        isset($_POST) and $_POST and $_POST = $this->filterInputData($_POST);
        isset($_GET) and $_GET and $_GET = $this->filterInputData($_GET);
    }

    /**
     * 格式化输入信息 (不对string数据进行addslashes,会影响数据的完整性)
     * @param $data
     * @return string
     */
    private function filterInputData($data){
        if (is_array($data)) {
            foreach ($data as &$v){
                $v =  $this->filterInputData($v);
            }
        }
        elseif(is_string($data)){
            $data = trim($data);
        }
        elseif(is_numeric($data)){
            $data = intval($data);
        }
        return $data;
    }

}

class BaseController extends HZ_Controller{

    public function __construct()
    {
        parent::__construct();
        // 需要验证登陆的接口
        $this->load->config('login_uri');
        $loginUri = $this->config->item('uri');
        // 当前uri
        $uri = strtolower(trim($this->input->server('REQUEST_URI'), '/'));
        $uri = explode('?', $uri);
        $uri = $uri[0];

        if(in_array($uri, $loginUri)) {
            $this->_uid || $this->outputResponse(array('code' => 'account_error_4'));// 未登录
        }
    }
}