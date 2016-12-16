<?php
/**
 * Created by PhpStorm.
 * User: cren
 * Date: 16/11/26
 * Time: 上午1:07
 */

define('ENVIRONMENT', 'development');
define("HOST_URL", $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']);

switch (ENVIRONMENT)
{
    case 'development':
    case 'testing':
        ini_set("display_errors","on");
        error_reporting(E_ALL ^ E_DEPRECATED);
        break;
    case 'production':
        ini_set('display_errors', 0);
        if (version_compare(PHP_VERSION, '5.3', '>='))
        {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        }
        else
        {
            error_reporting(mb_encoding_aliases(encoding) & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
        break;

    default:
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}