<?php
/**
 * action.php
 * Author   : cren
 * Date     : 2017/2/6
 * Time     : 下午6:34
 */

$config = array(
    array(
        'name' => '用户管理',
        'type' => 1,
        'sub' => array(
            array('name' => '会员列表', 'url' => 'user/member'),
            array('name' => '管理员列表', 'url' => 'user/admin'),
            array('name' => '媒体会员列表', 'url' => 'user/medium'),
            array('name' => '商户列表', 'url' => 'user/merchant'),
            array('name' => '黑名单列表', 'url' => 'user/blacklist'),
            array('name' => '权限管理', 'url' => 'user/power'),
            array('name' => '角色管理', 'url' => 'user/role'),
        )
    ),
    array(
        'name' => '商品管理',
        'type' => 2,
        'sub' => array(
            array('name' => '商品列表', 'url' => 'product/index'),
            array('name' => '添加商品', 'url' => 'product/add'),
            array('name' => '商品分类', 'url' => 'product/cate'),
            array('name' => '商品审核', 'url' => 'product/verify'),
            array('name' => '商品回收站', 'url' => 'product/recycle'),
            array('name' => '收藏 列表', 'url' => 'product/collect'),
        )
    ),
    array(
        'name' => '订单管理',
        'type' => 3,
        'sub' => array(
            array('name' => '支付列表', 'url' => 'order/index'),
            array('name' => '提现列表', 'url' => 'order/tixian'),
            array('name' => '理赔列表', 'url' => 'order/claims'),
        )
    ),
    array(
        'name' => '资讯管理',
        'type' => 4,
        'sub' => array(
            array('name' => '资讯列表', 'url' => 'order/index'),
            array('name' => '资讯发布', 'url' => 'order/tixian'),
            array('name' => '资讯分类', 'url' => 'order/claims'),
            array('name' => '专题', 'url' => 'order/claims'),
            array('name' => '评论审核', 'url' => 'order/claims'),
            array('name' => '行业动态', 'url' => 'order/claims'),
            array('name' => '关注列表', 'url' => 'order/claims'),
        )
    ),
    array(
        'name' => '财务管理',
        'type' => 5,
        'sub' => array(
            array('name' => '账户列表', 'url' => 'finance/account'),
            array('name' => '订单统计', 'url' => 'finance/orderstat'),
            array('name' => '销售排行', 'url' => 'finance/salestat'),
            array('name' => '支付渠道', 'url' => 'finance/paytype'),
        )
    ),
    array(
        'name' => '广告推广管理',
        'type' => 6,
        'sub' => array(
            array('name' => '广告列表', 'url' => 'promo/index'),
            array('name' => '广告类型列表', 'url' => 'promo/cateList'),
            array('name' => '推荐设置', 'url' => 'promo/set'),
        )
    ),
);