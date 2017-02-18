<?php
$base_filename = basename(__FILE__);
$config_filename = ROOT_PATH . "/system/config/" . "/{$base_filename}";

if(is_file($config_filename)) {
    include $config_filename;
}