<?php

namespace App\Models;

class User
{
    public function all()
    {
        return db()->select("users", "username, email, created_at")->fetchAll();
    }

    public function profile($id)
    {
        return db()->select("users", "username, email, created_at")->find($id);
    }
}