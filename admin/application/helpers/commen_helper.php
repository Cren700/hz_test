<?php
/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/7/9
 * Time: 下午5:19
 */

$base_filename = basename(__FILE__);
$config_file = ROOT_PATH . '/system/helpers/' . $base_filename;

if(is_file($config_file)) {
    include $config_file;
}