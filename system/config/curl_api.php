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
            'getUserDetailByFuserId'    => '/account/getUserDetailByFuserId',    // 用户详情
            'saveDetail'             => '/account/saveUserDetail',             // 添加用户详情
            'modifyDetail'          => '/account/modifyDetail',          // 修改用户详情
            'addAdminDetail'        => '/account/addAdminDetail',             // 添加后台用户详情
            'modifyAdminDetail'     => '/account/modifyAdminDetail',          // 修改后台用户详情
            'queryUser'             => '/info/query',                   // 查询用户列表
            'getInfo'               => '/info/getInfo',                 // 查询用户信息
            'changeStatus'          => '/info/changeStatus',            // 修改用户状态
            'queryBlackList'        => '/info/queryBlackList',          // 黑名单列表
            'queryCapitalAccount'   => '/info/queryCapitalAccount',          // 黑名单列表
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
            'changeStatus'          => '/product/changeStatus',          // 更新状态
            'collect'               => '/product/collect',              // 收藏
            'queryCollect'          => '/product/queryCollect',         // 查询收藏列表
            'getCollectListByUid'   => '/product/getCollectListByUid',     // 我的收藏
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
            'cateStatus'            => '/category/cateStatus',          // 更新状态   
            // 资讯
            'queryPosts'            => '/posts/query',                // 列表list
            'getPostsByPid'         => '/posts/getPostsByPid',      // 某个product
            'addPosts'              => '/posts/add',                  // add
            'updatePosts'           => '/posts/update',               // 更新
            'delPosts'              => '/posts/del',                  // 删除
            'changeStatus'          => '/posts/changeStatus',          // 更新状态
            'relatedPosts'          => '/posts/relatedPosts',          // 相关新闻
            'postsListByCate'       => '/posts/postsListByCate',       // 根据分类获取数据
            'submitComment'         => '/posts/submitComment',       // 提交评论
            'getCommentListByPid'   => '/posts/getCommentListByPid',     // 评论列表
            'getPraiseCountByPid'   => '/posts/getPraiseCountByPid',          // 获取关注数量
            'getIsPraise'           => '/posts/getIsPraise',          // 是否关注
            'doPraise'              => '/posts/doPraise',          // 关注操作
            'queryComment'          => '/posts/queryComment',           // 查询评论
            'statusComment'         => '/posts/statusComment',          // 评论状态
            'delComment'            => '/posts/delComment',             // 删除评论
            'queryPraise'           => '/posts/queryPraise',           // 查询关注列表
            'getPraiseListByUid'    => '/posts/getPraiseListByUid',     // 我的关注
        ),
    ),
    'order' => array(
        'host'  => HOST_URL.'/order',
        'api'   => array(
            'join'                  => '/shop/join',                // 加入购物车
            'remove'                => '/shop/remove',              // 移除购物车
            'updateCart'            => '/shop/update',              // 更新购物车
            'getCartList'           => '/shop/getList',             // 购物车列表
            'queryOrders'           => '/order/query',              // 查询订单
            'previewByCid'          => '/order/previewByCid',       // 通过购物车获取数据
            'previewByPid'          => '/order/previewByPid',       // 通过产品获取数据
            'createByCid'           => '/order/createByCid',        // 通过购物车下订单
            'createByPid'           => '/order/createByPid',        // 立即下订单
            'orderStatus'           => '/order/orderStatus',        // 更改订单状态
            'getOrderListByUid'          => '/order/getOderListByUid',   // 查询订单列表
            'queryTxOrders'           => '/order/queryTxOrders',              // 查询提现订单
            'txOrderStatus'           => '/order/txOrderStatus',        // 更改订单状态
            'queryClaim'            => '/order/queryClaim',              // 查询理赔订单
            'claimOrderStatus'      => '/order/claimOrderStatus',        // 更改理赔订单状态
            'queryOrderStat'        => '/order/queryOrderStat',     // 订单统计
            'querySaleStat'         => '/order/querySaleStat',      // 销售统计
        ),
    ),
);