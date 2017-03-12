<?php

/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/7/9
 * Time: 上午1:34
 */
class HZ_Controller extends CI_Controller
{
    protected $_uid = null;
    protected $_user_id = null;
    protected $_user_type = null;
    protected $_log_type = null;
    protected $_recommend_uid = null;

    public function __construct(){
        parent::__construct();

//        $this->filterPostAndGet();
        $this->load->library("session");
        //Smarty

        require_once ROOT_PATH.'/system/third_party/smarty/Smarty.class.php';

        //创建一个smarty类的对象$smarty
        $this->smarty = new Smarty();

        //设置所有模板文件存放目录
        $this->smarty->template_dir = 'application/views';
        //设置所有编译过的模板文件的存放目录
        $this->smarty->compile_dir = 'application/cache/compiles/';
        //设置存放smarty缓存文件的目录
        $this->smarty->cache_dir = 'application/cache/caches/';
        //设置模板中所有特殊配置文件的存放目录
        $this->smarty->config_dir = 'application/third_party/smarty/configs/';

        //开启smarty缓存模板功能
        $this->smarty->caching = 0;

        //设置模板缓存有效时间段的长度为1天
        // $this->marty->cache_lifetime = 60 * 60 * 24;

        //设置模板语言中的左结束符，默认为“{”
        $this->smarty->left_delimiter = '<{';

        //设置模板语言中的右结束符，默认为“}”
        $this->smarty->right_delimiter = '}>';

        $seoArr = array(
            'keywords' => '互助之家、互助、互助计划、互助保障、互保、相互保险、重疾、意外、大病、E互助、蚂蚁互助、蚂蚁互保、壁虎互助、夸克联盟、17互助、抗癌公社、众托帮、互助客、互助家、互助网、互助买房、互助停车、互助社、水滴互助、校友互助、医互助、钉钉互助、一起帮',
            'description' => '互助之家是国内首家专注网络互助的行业门户网站，以资讯报道、互助产品、互助社区三大核心板块，为用户提供全方位的互助资讯、优质项目推荐和行业交流社区。互助之家愿与国内互助平台及广大用户携手，规范行业发展，营造一个透明、规范、安全的网络互助环境。',
            'title' => '互助之家-找互助计划，上互助之家');
        $this->smarty->assign('seo', $seoArr);

        $this->smarty->assign('cssArr', array());
        $this->smarty->assign('jsArr', array());

        $this->_uid = $this->session->userdata('m_uid');
        $this->_user_id = $this->session->userdata('m_username');
        $this->_user_type = $this->session->userdata('m_type');
        $this->_log_type = $this->session->userdata('m_log_type');
        $this->smarty->assign('username', $this->_user_id);
        $this->smarty->assign('uid', $this->_uid);
        $this->smarty->assign('user_type', $this->_user_type);
        $this->smarty->assign('log_type', $this->_log_type);

        // 是否存在推荐者
        $this->_recommend_uid = base64_decode($this->input->get('_re'));
        if (!$this->_uid && is_numeric($this->_recommend_uid)) {
            $this->session->set_userdata(array('_re' => $this->_recommend_uid));
        }
    }

    public function jump($url)
    {
        header("Location: {$url}", true, 302);
        exit();
    }

    public function jump404($msg ='', $code = '')
    {
        $url = '/404.html?msg='.$msg;
        if ($code) {
            $url .= '&_c='.$code;
        }
        $this->jump(getBaseUrl($url));
        exit();
    }

    public function is_login()
    {
        if(empty($this->_uid)){
            if (IS_AJAX) {
                echo json_encode_data(array( 'code' => 10004, 'msg' => '请先登录'));
                die;
            } else {
                $uri = rawurlencode($_SERVER['REQUEST_URI']);
                $this->jump(getBaseUrl('/account?url='.$uri));
                exit();
            }
        }
    }
}

class BaseControllor extends HZ_Controller{
    public function __construct(){
        parent::__construct();
        if(empty($this->_uid)){
            if (IS_AJAX) {
                echo json_encode_data(array( 'code' => 10004, 'msg' => '请先登录'));die;
            } else {
                $uri = rawurlencode($_SERVER['REQUEST_URI']);
                $this->jump(getBaseUrl('/account.html?url='.$uri));
                exit();
            }

        }
    }


}