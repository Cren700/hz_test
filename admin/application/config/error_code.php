<?php
/**
 * error_code.php
 * Author   : cren
 * Date     : 16/7/10
 * Time     : 上午12:23
 */
$base_filename = basename(__FILE__);
$config_filename = ROOT_PATH . "/system/config/" . "/{$base_filename}";

if (is_file($config_filename)) {
    include $config_filename;
}