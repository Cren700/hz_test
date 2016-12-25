<?php
/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/7/9
 * Time: 上午1:49
 */

/**
 * 生成验证码接口
 */
function bornValidateCode()
{

}

/**
 * 初始化盐值
 * @return string
 */
function saltCode()
{
    $salt = '';
    $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $len = mt_rand(4, 8);
    for ($i = 0; $i < $len; $i++) {
        $salt .= $str[mt_rand(0, strlen($str) - 1)];
    }
    return $salt;
}

/**
 * 登录密码加密
 * @param int $type 登录类型 0: 管理员 1: 商户
 * @param string $salt 盐值
 * @param string $pwd 密码
 * @return string
 */
function encodePwd($salt, $pwd)
{
    $str = "HZ>@!.";
    return md5(md5($pwd . $str . $salt));
}

/**
 * 操作数据库时转义数据
 * @param $data
 * @return array|string
 */
function dbEscape(&$data)
{
    if (is_array($data)) {
        foreach ($data as $k => &$v) {
            dbEscape($v);
        }
    }
    if (is_string($data)) {
        $data = addslashes($data);
    }
    return $data;
}
/**
 * 去除\',入库前处理的数据
 * @param $data
 * @return mixed
 */
function filterData(&$data)
{
    if(is_array($data)){
        foreach ($data as &$d){
            filterData($d);
        }
    }
    if(is_string($data)){
        $data = stripslashes($data);
    }
    return $data;
}

/**
 * 通过错误信息字段,获取错误码和错误信息
 * @param array $data // $data['code']] 错误信息码 如:validation_error_0 , $data['field'] 添加在错误信息字段 如:用户名
 * @return array
 */
function errorCode($data)
{
    $ci = &get_instance();
    $ci->config->load('error_code', TRUE);
    $error_code = $ci->config->item('error_code');
    isset($error_code[$data['code']]) && isset($data['field']) ? $error_code[$data['code']]['msg'] = $data['field'] . $error_code[$data['code']]['msg'] : '';
    $res = isset($error_code[$data['code']]) ? $error_code[$data['code']] : array('code' => 999999, 'msg' => '未知错误');
    // msg {x} 替换
    if ($res['code'] !== 0 && isset($data['count'])) {
        $res['msg'] = preg_replace('/{([count]+)}/', $data['count'], $res['msg']);
    }
    return $res;
}

/**
 * 输出
 * @param $data
 * @param array $header
 */
function outputResponse($data, $header = array())
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
 * 验证数据
 * @param $data
 * @param $rules
 * @param $field // 添加在错误信息字段 如:用户名
 * @return array
 */
function validationData($data, $rules, $field)
{
    $rulesData = explode('|', $rules);
    foreach ($rulesData as $rule) {
        $res = array();
        $filter = preg_replace('/\[[0-9]*\]/', '', $rule);
        switch ($filter) {
            case 'required':
                if(strlen($data) === 0) {
                    $res['code'] = 'validation_error_5'; // 不能为空
                    $res['field'] = $field;
                }
                break;
            case 'numeric':
                if (!is_numeric($data)) {
                    $res['code'] = 'validation_error_4'; // 必须位数字
                    $res['field'] = $field;
                }
                break;
            case 'price':
                if (!preg_match('/^(0|[1-9][0-9]{0,9})(\.[0-9]{1,2})?$/', $data, $match)){
                    $res['field'] = $field;
                    $res['code'] = 'validation_error_6'; // 必须为价格
                }
                break;
            case 'min_length':
                preg_match('/[0-9]+/', $rule, $match);
                if (strlen($data) < $match[0]) {
                    $res['field'] = $field;
                    $res['code'] = 'validation_error_1'; // 字符数不足
                    $res['count'] = $match[0];
                }
                break;
            case 'max_length':
                preg_match('/[0-9]+/', $rule, $match);
                if (strlen($data) > $match[0]) {
                    $res['code'] = 'validation_error_2'; // 字符数过多
                    $res['field'] = $field;
                    $res['count'] = $match[0];
                }
                break;
            case 'email':
                if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $data, $match)) {
                    $res['field'] = '';
                    $res['code'] = 'validation_error_3'; // 邮箱不正确
                }
                break;
            default:
                echo "No find validation ";die;
                break;
        }
        if (!empty($res)) return $res;
    }
    return $res;
}

function get_client_ip($type = 0)
{
    $type = $type ? 1 : 0;
    static $ip = NULL;
    if ($ip !== NULL)
    {
        return $ip[$type];
    }

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos = array_search('unknown', $arr);
        if (false !== $pos)
            unset($arr[$pos]);
        $ip = trim($arr[0]);
    }
    else if (isset($_SERVER['REMOTE_ADDR']))
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    else if (isset($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }

    // IP地址合法验证
    $long = sprintf("%u", ip2long($ip));
    $ip = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

function json_encode_data($data, $format = JSON_UNESCAPED_UNICODE)
{
    return json_encode($data, $format);
}

function p($data) {
    exit(json_encode_data($data));
}

// 创建目录文件夹
function _mkdir($path)
{
    if (!$path) {
        return false;
    }
    if ( !file_exists($path)) {
        if (!file_exists(dirname($path))){
            _mkdir(dirname($path));
        }
        mkdir($path, 0777, true);
    }
}

/**
 * 上传文件
 * @param string $type
 * @return array
 */
function doUpload($type)
{
    $fileTypes = array(
        'img' => array('jpg','jpeg','gif','png'), // 图片
        'file' => array('doc', 'xlsx', 'xls', 'ppt', 'zip', 'rar'), // 文档
    );
    if (!empty($_FILES)) {
        $file = $_FILES['file_name']; // print_r($_FILES);中的索引词
        if ($file['error'] == 0) {
            $tempFile = $file['tmp_name'];   // 临时文件
            $targetPath = getSaveFilePath($type);    // 上传路径
            _mkdir($targetPath);
            $filename = md5(uniqid(mt_rand()).$file['name']) . '.'.pathinfo($file['name'])['extension'];// 修改文件名字
            $targetFile = rtrim($targetPath, '/') . '/' . $filename;
            $relativePath = rtrim(setFileRelaPath($type), '/') . '/' . $filename;
            // 需要检验的数据
            $fileType = $type ? $fileTypes[$type] : array_merge($fileTypes['img'], $fileTypes['file']); // File extensions
            $fileParts = pathinfo($file['name']);
            $fileSize = 1*1024*1024; // 1M

            if ($file['size'] > $fileSize) {
                $data = array('code' => 1, 'msg' => '上传内容大小为:'. $fileSize / 1024 / 1024 . 'M');
            } elseif (in_array($fileParts['extension'], $fileType)) {
                move_uploaded_file($tempFile, $targetFile);
                $data = array('code' => 0, 'file_data' => $relativePath);
            } else {
                $data = array('code' => 2, 'msg' => '上传类型出错,必须为:'.join(',', $fileType));
            }
        } else {
            $data = array('code' => $file['error'], 'msg' => '上传出错');
        }
    }
    return $data;
}

// 获取URL
function getBaseUrl($uri = '')
{
    return APP_NAME . '' . $uri;
}

function baseCssUrl($uri){
    return getBaseUrl('/static/css/' . $uri);
}

function baseJsUrl($uri){
    return getBaseUrl('/static/js/' . $uri);
}

function baseImgUrl($uri){
    return getBaseUrl('/static/img/' . $uri);
}

/**
 * 图片保存地址
 * @param string $type
 * @return string
 */
function getSaveFilePath($type = 'img')
{
    $type = $type . '/';
    return $_SERVER['DOCUMENT_ROOT'] . '/files/'. $type .date('Ym', time());
}

/**
 * 设置图片的相对地址
 * @param string $type
 * @return string
 */
function setFileRelaPath($type = 'img')
{
    $type = $type . '/';
    return HOST_URL . '/files/'. $type .date('Ym', time());
}

/**
 * 获取图片的完整地址
 * @param string $path
 * @return string
 */
function getFilePath($path)
{
    return ROOT_PATH . $path;
}