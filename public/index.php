<?php

/**
 * 项目入口文件
 * 更新时间: 2022/2/24 22:49
 */

header('Content-Type: text/html; charset=utf-8');
header("Referrer-Policy: no-referrer-when-downgrade");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: SAMEORIGIN");

require __DIR__ . "/../vendor/autoload.php";

define('ROOT_PATH', __DIR__ . '/../');
define('APP_PATH', ROOT_PATH . 'app/');

// 加载自定义的助手函数
require ROOT_PATH . 'app/helpers.php';
// 加载路由
require ROOT_PATH . 'routes/web.php';
// 加载配置
require ROOT_PATH . 'app/config.php';

app()->run();
