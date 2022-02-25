<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function home()
    {
        $users = (new User())->profile(1);
        dump($users);
        echo app()->template->render("user/home");
    }

    public function profile()
    {
        
    }
}