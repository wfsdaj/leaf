<?php

/**
 * 大部分虚拟主机无法指定 public 为根目录
 * 使用该文件允许我们从项目的根目录运行应用程序
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

require_once __DIR__ . '/public/index.php';