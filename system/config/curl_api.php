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
            'center'                => '/info/userCenter',         // 用户中心
            'oauthLogin'            => '/account/oauthLogin',           // 第三方登录   
            'getStoreName'          => '/account/getStoreName',         // 获取商家名称    
            'saveVerifySms'         => '/account/saveVerifySms',         // 保存短信sms    
            'saveVerifyCode'        => '/account/saveVerifyCode',        // 保存verifycode    
            'modifyHdImg'           => '/account/modifyHdImg',        // 保存头像    
            'loginPhone'            => '/account/loginPhone',            // 手机登录
            'hasMediumPower'        => '/account/hasMediumPower',        // 查看是否具有媒体权限
            'hasStorePower'         => '/account/hasStorePower',        // 查看是否具有商户权限
            'adminAction'           => '/account/adminAction',          // 管理员操作
            'role'                  => '/account/role',                 // 角色管理
            'addRole'               => '/account/addRole',             // 添加角色
            'saveRole'              => '/account/saveRole',             // 保存角色
            'getRole'               => '/account/getRole',              // 获取角色信息
            'adminList'             => '/account/adminList',             // 管理列表
            'changeAdminStatus'     => '/account/changeAdminStatus',     // 修改管理员状态
            'getAdminInfo'          => '/account/getAdminInfo',          // 管理员信息
            'updateAdminPwd'        => '/account/updateAdminPwd',        // 修改管理员密码
            'updateAdminRole'       => '/account/updateAdminRole',        // 修改管理员角色
            'powerUrl'              => '/account/powerUrl',               // 用户权限目录
            'modifyAccountInfo'     => '/info/modifyAccountInfo',         // 添加账户数据
            'getUserDetailByWhere'  => '/account/getUserDetailByWhere',   // 获取用户信息
            'getAccountTotalInfo'   => '/account/getAccountTotalInfo'    // 用户完整信息
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
            'getProCateCount'       => '/product/getProCateCount',      // 各资讯分类数量
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
            'search'                => '/product/search',                 // 搜索
            'hasProductPower'       => '/product/hasProductPower',         // 是否具有产品权限
            'updateProductCnt'      => '/product/updateProductCnt',     // 更新产品的加入数量和案例数量
            'maybeLike'             => '/product/maybeLike',            // 猜你喜欢
            'getCommentListByPid'   => '/product/getCommentListByPid',  // 获取产品评论信息
            'getStoreProduct'       => '/product/getStoreProduct',      // 商户所有产品
            'submitComment'         => '/product/submitComment',        // 提交评论
            'queryComment'          => '/product/queryComment',           // 查询评论
            'statusComment'         => '/product/statusComment',          // 评论状态
            'delComment'            => '/product/delComment',             // 删除评论
            'batchDelProduct'       => '/product/batchDelProduct',        // 批量删除产品
            'batchDelComment'       => '/product/batchDelComment',        // 批量删除评论
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
            'getPostsCateCount'     => '/posts/getPostsCateCount',      // 各资讯分类数量 
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
            'search'                => '/posts/search',                 // 搜索
            'getCommentListByUid'   => '/posts/getCommentListByUid',    // 个人评论列表
            'userDelComment'        => '/posts/userDelComment',     // 用户删除评论
            'queryThemes'           => '/posts/queryThemes',     // 后台专题
            'addTheme'              => '/posts/addTheme',                  // addTheme
            'updateTheme'           => '/posts/updateTheme',               // 更新Theme
            'delTheme'              => '/posts/delTheme',                  // 删除Theme
            'changeThemeStatus'     => '/posts/changeThemeStatus',          // 更新Theme状态
            'getThemeByPid'         => '/posts/getThemeByPid',          // 获取某个主题
            'getPostsThemeByPid'    => '/posts/getPostsThemeByPid',          // 获取某个主题
            'addThemePost'          => '/posts/addThemePost',          // 添加post_id
            'getThemeList'          => '/posts/getThemeList',          // 前台获取专题列表
            'saveEvent'             => '/posts/saveEvent',              // 行业动态
            'queryEvents'           => '/posts/queryEvents',            // 查询信息
            'delEvent'              => '/posts/delEvent',               // 删除行业信息
            'modifyEvent'           => '/posts/modifyEvent',               // 修改行业信息
            'getBanners'            => '/posts/getBanners',               // 首页banner
            'getThreeNews'          => '/posts/getThreeNews',               // 获取前三条新闻
            'hasPostsPower'         => '/posts/hasPostsPower',          // 文章发布权限
            'batchDelPosts'         => '/posts/batchDelPosts',        // 批量删除资讯
            'batchDelThemes'        => '/posts/batchDelThemes',        // 批量删除资讯
            'batchDelComment'       => '/posts/batchDelComment',        // 批量删除评论
        ),
    ),
    'order' => array(
        'host'  => HOST_URL.'/order',
        'api'   => array(
            'join'                  => '/shop/join',                // 加入购物车
            'remove'                => '/shop/remove',              // 移除购物车
            'updateCart'            => '/shop/update',              // 更新购物车
            'getCartList'           => '/shop/getList',             // 购物车列表

            'orderDetail'           => '/order/orderDetail',        // 订单详情
            'queryOrders'           => '/order/query',              // 查询订单
            'previewByCid'          => '/order/previewByCid',       // 通过购物车获取数据
            'previewByPid'          => '/order/previewByPid',       // 通过产品获取数据
            'createByCid'           => '/order/createByCid',        // 通过购物车下订单
            'createByPid'           => '/order/createByPid',        // 立即下订单
            'orderStatus'           => '/order/orderStatus',        // 更改订单状态
            'getOrderListByUid'          => '/order/getOderListByUid',   // 查询订单列表
            'queryTxOrders'           => '/order/queryTxOrders',              // 查询提现订单
            'txOrderStatus'           => '/order/txOrderStatus',        // 更改订单状态
            'saveClaims'            => '/order/saveClaims',              // 保存理赔订单
            'claimsDetail'          => '/order/claimsDetail',            // 获取理赔订单    
            'queryClaims'            => '/order/queryClaims',              // 查询理赔订单
            'claimOrderStatus'      => '/order/claimOrderStatus',        // 更改理赔订单状态
            'queryOrderStat'        => '/order/queryOrderStat',     // 订单统计
            'querySaleStat'         => '/order/querySaleStat',      // 销售统计
            'getClaimsDetailByFid'           => '/order/getClaimsDetailByFid',        // 获取理赔单
            'updateClaims'          => '/order/updateClaims',       // 更新理赔单
            'hasCommentPower'       => '/order/hasCommentPower',    // 是否具有评论权限
            'calClaimsTotal'        => '/order/calClaimsTotal',     // 计算理赔总额
            'updateOrderCommentFlag' => '/order/updateOrderCommentFlag', // 修改订单评论标志
            'payInfo'               => '/order/payInfo',            // 记录支付数据
        ),
    ),
    //广告模块CURL连接
    'promo' => array(
        'host' => HOST_URL.'/promo',
        'api'  => array(
            'category'               => '/category/cateList',//分类列表
            'cateGet'                => '/category/cateGet',//获取分类
            'cateSave'               => '/category/cateSave',//保存分类
            'cateUpdate'             => '/category/cateUpdate',//更新分类
            'cateDel'                => '/category/cateDel',//删除分类
            'getPromoCateCount'      => '/promo/getPromoCateCount', // 各广告分类数量
            'promoAdd'               => '/promo/add',//添加广告
            'promoSave'              => '/promo/save',//更新广告
            'promoDel'               => '/promo/del',//删除广告
            'promoQuery'             => '/promo/query',//查询广告
            'getPromoById'           => '/promo/getPromoById',//获取单条
            'changeStatus'           => '/promo/changeStatus',//状态更改
            'getPromoRandom'         => '/promo/getPromoRandom', // 随机一条广告
            'getPromoRule'           => '/promo/getPromoRule', // 添加推荐规则
            'addPromoRule'           => '/promo/addPromoRule',//添加推广规则
            'savePromoRule'          => '/promo/savePromoRule',//更新推广规则
            'getPromoRule'           => '/promo/getPromoRule', //获取推广规则
            'getRuleById'            => '/promo/getRuleById', //获取单条推广规则
            'ruleStatus'             => '/promo/ruleStatus', // 更改推广规则状态
            'getRuleByType'          => '/promo/getRuleByType', //根据推荐类型获取数据
            'addOrderExpand'         => '/promo/addOrderExpand', //添加返利记录
            'sendReport'             => '/promo/sendReport',    // 用户反馈信息
            'queryFreeback'          => '/promo/queryFreeback', // 用户反馈列表
            'freebackStatus'         => '/promo/freebackStatus', // 处理反馈状态
            'delFreeback'            => '/promo/delFreeback', // 删除反馈状态
            'batchDelPromo'          => '/promo/batchDelPromo',        // 批量删除广告
            'imageAdd'               => '/promo/imageAdd', //添加首页图片
            'imageSave'              => '/promo/imageSave', //更新首页图片
            'imageQuery'             => '/promo/imageQuery',//查询广告
            'getImageById'           => '/promo/getImageById',//获取单条
            'changeImageStatus'      => '/promo/changeImageStatus', // 更改状态
            'delImage'               => '/promo/delImage', // 删除
            'getPcImages'            => '/promo/getPcImages',// pc首页获取图片
        ),
    ),
);