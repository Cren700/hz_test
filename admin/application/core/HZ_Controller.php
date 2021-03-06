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
    public $_powerUrl = array();
    public function __construct(){
        parent::__construct();
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

        $seoArr = array('keywords' => '互助之家', 'description' => '互助之家', 'title' => '互助之家');
        $this->smarty->assign('seo', $seoArr);

        $this->smarty->assign('cssArr', array());
        $this->smarty->assign('jsArr', array());

        $this->_uid = $this->session->userdata('a_uid');
        $this->_user_id = $this->session->userdata('a_username');
        $this->_user_type = $this->session->userdata('a_user_type');
        $this->_powerUrl = $this->session->userdata('powerUrl') ? : array();

        $this->smarty->assign('username', $this->_user_id);
        $this->smarty->assign('uid', $this->_uid);
        // 目录结构
        $menu = $this->getMenu() ? : array();
        $this->smarty->assign('menu', $menu);
    }

    public function jump($url)
    {
        header("Location: {$url}", true, 302);
        exit();
    }

    public function jump404($msg ='')
    {
        $this->jump(getBaseUrl('/404.html?msg='.$msg));
        exit();
    }

    /**
     * 分页
     * @param $rows
     * @param int $p
     * @param int $pageSize
     * @param string $url
     * @return mixed
     */
    public function page($rows, $p = 1, $pageSize = 10, $url = '')
    {
        $this->load->library('pagination');
        $config['base_url'] = $url;
        $config['total_rows'] = $rows;
        $config['per_page'] = $pageSize;
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['prev_link'] = '&lt;';
        $config['next_link'] = '&gt;';
        $config['cur_page'] = $p; // 当前页数

        $config['use_page_numbers'] = TRUE;

        //把结果包在ul标签里
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        //自定义数字
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        //当前页
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a><li>';
        //前一页
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        //后一页
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '<li>';

        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }

    /**
     * 后台目录
     * @return array
     */
    public function getMenu()
    {
        // 目录结构
        $menu = array(
            array(
                'selected'  => '0',
                'show'      => '0',
                'name'      => '用户管理',
                'flagName'  => 'user',
                'icon'      => 'icon-th',
                'sub'       => array(
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '会员列表',
                        'flagName'  => 'member',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '媒体列表',
                        'flagName'  => 'medium',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '商户列表',
                        'flagName'  => 'merchant',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '管理员列表',
                        'flagName'  => 'admin',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '角色管理',
                        'flagName'  => 'role',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '黑名单列表',
                        'flagName'  => 'blacklist',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '反馈列表',
                        'flagName'  => 'freeback',
                    )
                )
            ),
            array(
                'selected'  => '0',
                'show'      => '0',
                'name'      => '商品管理',
                'flagName'  => 'product',
                'icon'      => 'icon-bar-chart',
                'sub'       => array(
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '商品列表',
                        'flagName'  => 'index',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '添加商品',
                        'flagName'  => 'add',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '商品分类',
                        'flagName'  => 'cate',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '商品审核',
                        'flagName'  => 'verify',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '商品评论',
                        'flagName'  => 'comment',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '商品回收站',
                        'flagName'  => 'recycle',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '收藏列表',
                        'flagName'  => 'collect',
                    )
                )
            ),
            array(
                'selected'  => '0',
                'show'      => '0',
                'name'      => '订单管理',
                'flagName'  => 'order',
                'icon'      => 'icon-trophy',
                'sub'       => array(
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '支付列表',
                        'flagName'  => 'index',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '提现列表',
                        'flagName'  => 'tixian',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '理赔列表',
                        'flagName'  => 'claims',
                    )
                )
            ),
            array(
                'selected'  => '0',
                'show'      => '0',
                'name'      => '资讯管理',
                'flagName'  => 'posts',
                'icon'      => 'icon-bar-chart',
                'sub'       => array(
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '资讯列表',
                        'flagName'  => 'index',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '资讯发布',
                        'flagName'  => 'add'
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '资讯分类',
                        'flagName'  => 'cate'
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '专题',
                        'flagName'  => 'theme',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '评论审核',
                        'flagName'  => 'comment',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '行业动态',
                        'flagName'  => 'events',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '关注列表',
                        'flagName'  => 'praise',
                    )
                )
            ),
            array(
                'selected'  => '0',
                'show'      => '0',
                'name'      => '财务管理',
                'flagName'  => 'finance',
                'icon'      => 'icon-trophy',
                'sub'       => array(
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '账户列表',
                        'flagName'  => 'account',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '订单统计',
                        'flagName'  => 'orderstat'
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '销售排行',
                        'flagName'  => 'salestat',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '支付渠道',
                        'flagName'  => 'paytype',
                    )
                )
            ),
            array(
                'selected'  => '0',
                'show'      => '0',
                'name'      => '广告推广管理',
                'flagName'  => 'promo',
                'icon'      => 'icon-tasks',
                'sub'       => array(
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '广告列表',
                        'flagName'  => 'index',
                    ),
//                    array(
//                        'selected'  => '0',
//                        'name'      => '添加广告',
//                        'flagName'  => 'add'
//                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '广告类型列表',
                        'flagName'  => 'cateList'
                    ),
//                    array(
//                        'selected'  => '0',
//                        'name'      => '添加广告类型',
//                        'flagName'  => 'cateAdd'
//                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '推荐设置',
                        'flagName'  => 'set',
                    ),
                    array(
                        'selected'  => '0',
                        'show'      => '0',
                        'name'      => '侧栏图片管理',
                        'flagName'  => 'image',
                    ),
                )
            ),
            array(
                'selected'  => '0',
                'show'      => '0',
                'name'      => '配置',
                'flagName'  => 'conf',
                'icon'      => 'icon-info-sign',
                'sub'       => array(
                    array(
                        'show'      => '0',
                        'selected'  => '0',
                        'name'      => '公司信息',
                        'flagName'  => 'index'
                    ),
//                    array(
//                        'selected'  => '0',
//                        'name'      => '短信设置',
//                        'flagName'  => 'msg',
//                    )
                )
            ),
        );

        $rsegments = $this->uri->rsegments;
        $cont = $rsegments[1];
        $method = $rsegments[2];

        $powerUrl = $this->_powerUrl;

        foreach ($menu as &$m) {
            if (strtolower($cont) ===$m['flagName']) {
                $m['selected'] = 1;
                foreach ($m['sub'] as &$s) {
                    if (strtolower($method) === $s['flagName']) {
                        $s['selected'] = 1;
                    }
                }
            }
            foreach ($m['sub'] as &$s) {
                if (in_array($m['flagName'].'/'.$s['flagName'], $powerUrl)) {
                    $s['show'] = 1;
                }
            }
        }
        return $menu;
    }
}

class BaseControllor extends HZ_Controller{
    public function __construct(){
        parent::__construct();
//        $this->hasPower();// 判断访问权限
        if(empty($this->_uid)){
            $uri = rawurlencode($_SERVER['REQUEST_URI']);
            $this->jump(getBaseUrl('/login?url='.$uri));
            exit();
        }
    }


}