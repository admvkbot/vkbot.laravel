<?php

    if (!defined('ROOT')) define('ROOT', dirname(__DIR__));
    if (!defined('CONF')) define('CONF', ROOT . '/config');

    if (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $host = $_SERVER['HTTP_HOST'];
        //$referer = $_SERVER['HTTP_REFERER'];
        $useragent = $_SERVER['HTTP_USER_AGENT'];
    } else {
        $ip = '192.169.1.7';
        $host = "localhost";
        $referer = "https://google.com";
        $useragent = "Mozilla referer";
    }
    $allowed_hosts = 'http://localhost:8000/index.php';

    $app_path = preg_replace("#[^/]+$#", "", $allowed_hosts);
    $app_path = preg_replace("/public/", "", $app_path);

    if (!defined('PATH')) define('PATH', $app_path);
    if (!defined('ADMIN')) define('ADMIN', PATH . 'admin/index');

    //dd($allowed_hosts);
