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
    'account_error_0' => array( 'code' => 10000, 'msg' => '用户账号不存在'),                //用户账号不存在
    'account_error_1' => array( 'code' => 10001, 'msg' => '用户账号密码不一致'),            //用户账号密码不一致
    'account_error_2' => array( 'code' => 10002, 'msg' => '用户名已存在'),                 //用户名已存在
    'account_error_3' => array( 'code' => 10003, 'msg' => '添加数据错误'),                 //添加数据错误
    'account_error_4' => array( 'code' => 10004, 'msg' => '请先登录'),                     //未登录
    'account_error_5' => array( 'code' => 10005, 'msg' => '操作出错'),                     //操作出错
    'account_error_6' => array( 'code' => 10006, 'msg' => '不能重复添加用户详情'),                     //不能重复添加用户详情 



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


    // validation 30001 ~ 39999
    'validation_error_1' => array('code' => 30001, 'msg' => '至少为{cuont}位字符'),               // 至少为6位字符
    'validation_error_2' => array('code' => 30002, 'msg' => '至多为{cuont}位字符' ),              // 至多为16位字符
    'validation_error_3' => array('code' => 30003, 'msg' => '邮箱不正确' ),                  // 邮箱不正确
    'validation_error_4' => array('code' => 30004, 'msg' => '必须为数字' ),                  // 必须为数字
    'validation_error_5' => array('code' => 30005, 'msg' => '不能为空' ),                    // 不能为空
    'validation_error_6' => array('code' => 30006, 'msg' => '必须为价格类型（如：10.00）' ),                    // 必须为价格



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
    
);