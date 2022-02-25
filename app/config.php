<?php

/**
 * 在实例化时定义设置
 * 就是将关联数组传递到构造函数中
 */
app()->config([
    // 开启调试模式
    'debug' => true,
    // 设置时区
    'timezone' => 'Asia/Shanghai',
    // 模板路径
    'views.path' => __DIR__ . '/../views/',
    // 开启日志
    'log.enabled' => true,
    // 日志路径
    "log.dir" => "./logs/",
    // 开启维护模式
    // 'app.down' => true,
]);

// 连接数据库
db()->connect('localhost', 'mini', 'root', 'root');

/**
 * 认证模块配置
 */
auth()->config([
    // 数据库用户表，默认 users
    'DB_TABLE' => 'users',
    // 使用 session 支持
    'USE_SESSION' => true,
    // 不自动更新时间戳
    'USE_TIMESTAMPS' => false,
    'LOGIN_PARAMS_ERROR' => "用户名或密码错误!",
    'LOGIN_PASSWORD_ERROR' => "用户名或密码错误!",
    // 设置登录路径。默认值为 /auth/login
    'GUARD_LOGIN' => '/login',
    // 设置登录路径。默认值为 /auth/register
    'GUARD_REGISTER' => '/register',
    // 登录成功后跳转的网址
    'GUARD_HOME' => '/user/home',
    // 设置退出路径。默认值为 /auth/logout
    'GUARD_LOGOUT' => '/logout',
]);

// 定义一些常量
define('VIEWS_PATH', app()->config('views.path'));