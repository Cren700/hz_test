<?php
/**
 * 需要验证登录才能调用的接口
 * login_uri.php
 * Author   : cren
 * Date     : 2016/11/25
 * Time     : 下午10:14
 */

$config = array(
    'uri' => array(
        'account/add',       
        'account/login',     
        'account/modifyPwd', 
        'account/addAdmin',  
        'account/loginAdmin',
        'account/modifyPwdAdm',
        'account/detail',    
        'account/saveUserDetail',   
        'account/modifyDetail',
        'account/addAdminDetail',     
        'account/modifyAdminDetail',  
        'info/query',         
        'info/getInfo',       
        'info/changeStatus',  
        'info/queryBlackList',

        'category/add',                 // add
        'category/update',              // 更新
        'category/del',                 // 删除
        'product/add',                  // add
        'product/update',               // 更新
        'product/del',                  // 删除
        'product/changeStatus',          // 更新状态

        'category/add',                 // add
        'category/update',              // 更新
        'category/del',                 // 删除
        'category/cateStatus',          // 更新状态     
        'posts/add',                  // add
        'posts/update',               // 更新
        'posts/del',                  // 删除
        'posts/changeStatus',          // 更新状态
        'posts/submitComment',       // 提交评论
        'posts/getIsPraise',          // 是否关注
        'posts/doPraise',          // 关注操作
        'posts/statusComment',          // 评论状态
        'posts/delComment',             // 删除评论

        'shop/join',                // 加入购物车
        'shop/remove',              // 移除购物车
        'shop/update',              // 更新购物车
        'shop/getList',             // 购物车列表
        'order/query',              // 查询订单
        'order/previewByCid',       // 通过购物车获取数据
        'order/previewByPid',       // 通过产品获取数据
        'order/createByCid',        // 通过购物车下订单
        'order/createByPid',        // 立即下订单
        'order/orderStatus',        // 更改订单状态
    )

);