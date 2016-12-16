<?php

/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/7/9
 * Time: 上午1:34
 */
class MY_Controller extends CI_Controller
{
    public function __construct(){
        parent::__construct();
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
        return $data;
    }

}

class BaseControllor extends MY_Controller{
    public function __construct(){
        parent::__construct();
    }


}