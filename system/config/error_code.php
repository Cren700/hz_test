<?php
/**
 * error_code.php
 * Author   : cren
 * Date     : 16/7/10
 * Time     : 上午12:23
 */

$config = array(

    // system 1 ~ 9999
    'system_error_1' => array( 'code' => 1, 'msg' => '非法访问途径'),                //非法访问途径
    'system_error_2' => array( 'code' => 2, 'msg' => '操作出错'),                     //操作出错

    // account 10000 ~ 19999
    'account_error_0' => array( 'code' => 10000, 'msg' => '用户账号不存在或已禁用'),                //用户账号不存在
    'account_error_1' => array( 'code' => 10001, 'msg' => '用户账号密码不一致'),            //用户账号密码不一致
    'account_error_2' => array( 'code' => 10002, 'msg' => '用户名已存在'),                 //用户名已存在
    'account_error_3' => array( 'code' => 10003, 'msg' => '添加数据错误'),                 //添加数据错误
    'account_error_4' => array( 'code' => 10004, 'msg' => '请先登录'),                     //未登录
    'account_error_5' => array( 'code' => 10005, 'msg' => '操作出错'),                     //操作出错
    'account_error_6' => array( 'code' => 10006, 'msg' => '不能重复添加用户详情'),                     //不能重复添加用户详情 
    'account_error_7' => array( 'code' => 10007, 'msg' => '请输入验证码'),                     //请输入验证码 
    'account_error_8' => array( 'code' => 10008, 'msg' => '验证码不正确或已经过期'),                     //验证码不正确或已经过期 
    'account_error_9' => array( 'code' => 10009, 'msg' => '您不是媒体用户或者验证未通过'),                     //您不是媒体用户或者验证未通过 
    'account_error_10' => array( 'code' => 10010, 'msg' => '您不是商户类型或者验证未通过'),                     //您不是商户类型或者验证未通过 
    'account_error_11' => array( 'code' => 10011, 'msg' => '修改用户密码出错'),                     //修改用户密码出错 
    'account_error_12' => array( 'code' => 10012, 'msg' => '修改用户角色出错'),                     //修改用户角色出错 



    // product 20000 ~ 29999
    'product_error_1' => array( 'code' => 20001, 'msg' => '添加产品错误'),                 //添加产品数据错误
    'product_error_2' => array( 'code' => 20002, 'msg' => '获取数据出错'),                 // 获取产品数据出错
    'product_error_3' => array( 'code' => 20003, 'msg' => '产品分类已经存在'),                 // 产品分类已经存在
    'product_error_4' => array( 'code' => 20004, 'msg' => '添加产品分类出错'),                 // 添加产品分类出错
    'product_error_5' => array( 'code' => 20005, 'msg' => '更新产品分类出错'),                 // 更新产品分类出错
    'product_error_6' => array( 'code' => 20006, 'msg' => '产品详情已经存在'),                 // 产品详情已经存在
    'product_error_7' => array( 'code' => 20007, 'msg' => '添加产品详情出错'),                 // 添加产品详情出错
    'product_error_8' => array( 'code' => 20008, 'msg' => '更新产品详情出错'),                 // 更新产品详情出错
    'product_error_9' => array( 'code' => 20009, 'msg' => '更新产品状态出错'),                 // 更新产品状态出错
    'product_error_10' => array( 'code' => 20010, 'msg' => '产品已经收藏咯'),                 // 产品已经收藏咯
    'product_error_11' => array( 'code' => 20011, 'msg' => '我的收藏信息出错'),                 // 我的收藏信息出错
    'product_error_12' => array( 'code' => 20012, 'msg' => '很抱歉，暂无数据，请换个条件试试！'),                // 搜索暂无数据
    'product_error_13' => array( 'code' => 20013, 'msg' => '没有该文章的权限！'),                // 没有该文章的权限
    'product_error_14' => array( 'code' => 20014, 'msg' => '评论出错'),                 // 评论出错
    'product_error_15' => array( 'code' => 20015, 'msg' => '删除评论出错'),                // 删除评论出错



    // validation 30001 ~ 39999
    'validation_error_1' => array('code' => 30001, 'msg' => '至少为{cuont}位字符'),               // 至少为6位字符
    'validation_error_2' => array('code' => 30002, 'msg' => '至多为{cuont}位字符' ),              // 至多为16位字符
    'validation_error_3' => array('code' => 30003, 'msg' => '邮箱不正确' ),                  // 邮箱不正确
    'validation_error_4' => array('code' => 30004, 'msg' => '必须为数字' ),                  // 必须为数字
    'validation_error_5' => array('code' => 30005, 'msg' => '不能为空' ),                    // 不能为空
    'validation_error_6' => array('code' => 30006, 'msg' => '必须为价格类型（如：10.00）' ),                    // 必须为价格
    'validation_error_7' => array('code' => 30007, 'msg' => '必须为电话号码' ),                    // 必须为电话号码



    // posts 40000 ~ 49999
    'posts_error_1' => array( 'code' => 40001, 'msg' => '添加资讯错误'),                 //添加资讯数据错误
    'posts_error_2' => array( 'code' => 40002, 'msg' => '获取数据出错'),                 // 获取资讯数据出错
    'posts_error_3' => array( 'code' => 40003, 'msg' => '资讯分类已经存在'),                 // 资讯分类已经存在
    'posts_error_4' => array( 'code' => 40004, 'msg' => '添加资讯分类出错'),                 // 添加资讯分类出错
    'posts_error_5' => array( 'code' => 40005, 'msg' => '更新资讯分类出错'),                 // 更新资讯分类出错
    'posts_error_6' => array( 'code' => 40006, 'msg' => '资讯详情已经存在'),                 // 资讯详情已经存在
    'posts_error_7' => array( 'code' => 40007, 'msg' => '添加资讯详情出错'),                 // 添加资讯详情出错
    'posts_error_8' => array( 'code' => 40008, 'msg' => '更新资讯详情出错'),                 // 更新资讯详情出错
    'posts_error_9' => array( 'code' => 40009, 'msg' => '更新资讯状态出错'),                 // 更新资讯状态出错
    'posts_error_10' => array( 'code' => 40010, 'msg' => '评论出错'),                 // 评论出错
    'posts_error_11' => array( 'code' => 40011, 'msg' => '获取评论列表出错'),                // 获取评论列表出错
    'posts_error_12' => array( 'code' => 40012, 'msg' => '删除评论出错'),                // 删除评论出错
    'posts_error_13' => array( 'code' => 40013, 'msg' => '我的关注信息出错'),                // 我的关注信息出错
    'posts_error_14' => array( 'code' => 40014, 'msg' => '很抱歉，暂无数据，请换个条件试试！'),                // 搜索暂无数据
    'posts_error_15' => array( 'code' => 40015, 'msg' => '我的评论信息出错'),                // 我的评论信息出错
    'posts_error_16' => array( 'code' => 40016, 'msg' => '删除行业出错'),                // 删除行业出错
    'posts_error_17' => array( 'code' => 40017, 'msg' => '修改行业出错'),                // 修改行业出错
    'posts_error_18' => array( 'code' => 40018, 'msg' => '没有该文章的权限'),                // 没有该文章的权限

    
    // order 50000 ~ 59999
    'order_error_1' => array( 'code' => 50001, 'msg' => '已经在购物车中'),                 // 已经在购物车中
    'order_error_2' => array( 'code' => 50002, 'msg' => '保存订单出错'),  //保存订单出错 
    'order_error_3' => array( 'code' => 50003, 'msg' => '获取购物车失败'), //获取购物车失败 
    'order_error_4' => array( 'code' => 50004, 'msg' => 'oh,库存不足了'), //库存不足 
    'order_error_5' => array( 'code' => 50005, 'msg' => '更改状态失败'), //更改状态失败 
    'order_error_6' => array( 'code' => 50006, 'msg' => '获取订单列表失败'), //获取订单列表失败 
    'order_error_7' => array( 'code' => 50007, 'msg' => '未通过认证'),                // 未通过认证
    'order_error_8' => array( 'code' => 50008, 'msg' => '没有该订单信息'),                // 没有该订单信息
    'order_error_9' => array( 'code' => 50009, 'msg' => '保存理赔订单出错'),                // 保存理赔订单出错
    'order_error_10' => array( 'code' => 50010, 'msg' => '理赔已经处理中，请稍等'),                // 已经理赔处理中，请稍等
    'order_error_11' => array( 'code' => 50011, 'msg' => '理赔单获取失败'),                // 理赔单获取失败
    'order_error_12' => array( 'code' => 50012, 'msg' => '理赔单更新失败'),                // 理赔单更新失败
    'order_error_13' => array( 'code' => 50013, 'msg' => '您已经购买过该产品了，请勿重新购买！'),


    // promo 60000 ~ 69999
    'promo_error_1' => array( 'code' => 60001, 'msg' => '添加广告出错'),
    'promo_error_2' => array( 'code' => 60002, 'msg' => '获取数据出错'),
    'promo_error_3' => array( 'code' => 60003, 'msg' => '广告分类已经存在'),
    'promo_error_4' => array( 'code' => 60004, 'msg' => '添加广告分类出错'),
    'promo_error_5' => array( 'code' => 60005, 'msg' => '更新广告分类出错'),
    'promo_error_6' => array( 'code' => 60006, 'msg' => '删除广告分类出错'),
    'promo_error_7' => array( 'code' => 60007, 'msg' => '更新广告状态出错'),                 // 更新广告状态出错
    'promo_error_8' => array( 'code' => 60008, 'msg' => '更新推广规则出错'),                 // 更新推广规则出错
    'promo_error_9' => array( 'code' => 60009, 'msg' => '推广类型已经存在，不能添加相同的推广类型'),                 // 推广类型已经存在，不能添加相同的推广类型
);