<?php
/**
 * curl_api.php
 * Author   : cren
 * Date     : 16/7/15
 * Time     : 下午11:08
 */

$config = array(
    'account' => array(
        'host'  => HOST_URL.'/account',
        'api'   => array(
            'addAccount'            => '/account/add',                   // 添加账号
            'login'                 => '/account/login',                 // 用户登录
            'modifyPwd'             => '/account/modifyPwd',             // 修改密码
            'addAccountAdmin'       => '/account/addAdmin',              // 添加账号
            'loginAdmin'            => '/account/loginAdmin',            // 用户登录
            'modifyPwdAdmin'        => '/account/modifyPwdAdmin',        // 修改密码
            'detail'                => '/account/detail',                // 用户详情
            'addDetail'             => '/account/addDetail',             // 添加用户详情
            'modifyDetail'          => '/account/modifyDetail',          // 修改用户详情
            'addAdminDetail'        => '/account/addAdminDetail',             // 添加后台用户详情
            'modifyAdminDetail'     => '/account/modifyAdminDetail',          // 修改后台用户详情
            'queryUser'             => '/info/query',                   // 查询用户
        ),
    ),
    'product' => array(
        'host'  => HOST_URL.'/product',
        'api'   => array(
            // 分类
            'category'              => '/category/lists',               // 列表list
            'getCategory'           => '/category/getCategory',         // 某个cate
            'addCategory'           => '/category/add',                 // add
            'updateCategory'        => '/category/update',              // 更新
            'delCategory'           => '/category/del',                 // 删除
            // 产品
            'queryProduct'          => '/product/query',                // 列表list
            'getProductByPid'       => '/product/getProductByPid',      // 某个product
            'addProduct'            => '/product/add',                  // add
            'updateProduct'         => '/product/update',               // 更新
            'delProduct'            => '/product/del',                  // 删除
            'changeStatus'          => '/product/changeStatus'          // 更新状态
        ),
    ),
    'posts' => array(
        'host'  => HOST_URL.'/posts',
        'api'   => array(
            // 分类
            'category'              => '/category/lists',               // 列表list
            'getCategory'           => '/category/getCategory',         // 某个cate
            'addCategory'           => '/category/add',                 // add
            'updateCategory'        => '/category/update',              // 更新
            'delCategory'           => '/category/del',                 // 删除
            // 产品
            'queryPosts'          => '/posts/query',                // 列表list
            'getPostsByPid'       => '/posts/getPostsByPid',      // 某个product
            'addPosts'            => '/posts/add',                  // add
            'updatePosts'         => '/posts/update',               // 更新
            'delPosts'            => '/posts/del',                  // 删除
            'changeStatus'        => '/posts/changeStatus'          // 更新状态
        ),
    ),
);