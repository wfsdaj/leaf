<?php

app()->setNamespace("App\Controllers");

app()->get("/", "HomeController@index");

app()->get("/login",    "Auth\LoginController@showLoginForm");
app()->get("/register", "Auth\RegisterController@showRegistrationForm");

app()->post("/login",    "Auth\LoginController@login");
app()->post("/register", "Auth\RegisterController@store");

app()->get("/user/home", "UserController@home");

app()->set404(function () {
    response()->page("./views/errors/404.view.php", 404);
});

// 资源路由
app()->resource("/posts", "PostsController");