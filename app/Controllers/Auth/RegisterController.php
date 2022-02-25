<?php

namespace App\Controllers\Auth;

use Leaf\Form;

class RegisterController
{
    /**
     * 显示注册表单
     *
     * @return void
     */
    public function showRegistrationForm()
    {
        echo app()->template->render("user/register");
    }

    /**
     * 提交表单，注册用户
     */
    public function store()
    {
        $this->ValidateForm();

        // return response()->json([
        //     'status'  => 'success',
        //     'message' => '注册成功',
        // ]);

        $data = request()->get(['name', 'email', 'password']);
        $data['created_at'] = time();
        $data['password']   = password_hash($data['password'], PASSWORD_DEFAULT);

        // $user = auth()->register($data,
        //     // unique field
        //     [$data['name'], $data['email']]
        // );

        $user = db()->insert('users')
                    ->params($data)
                    ->unique("name", "email")
                    ->execute();

        if (!$user) {
            // 取首条错误
            $first_error = array_values(db()->errors())[0];
            return response()->json([
                'status'  => 'error',
                'message' => $first_error,
            ]);
        }

        response()->json([
            'status'  => 'success',
            'message' => '注册成功',
        ]);
    }

    /**
     * 验证提交的表单数据
     *
     * @return void
     */
    private function ValidateForm()
    {
        if (app()->request()->getMethod() === 'POST') {
            $validation = Form::validate([
                "name"     => ["required", "username", "min:3"],
                "email"    => ["required", "email"],
                "password" => ["required", "min:6"],
            ]);

            if (!$validation) {
                // 取第一条错误
                $first_error = array_values(Form::errors())[0];
                return response()->json([
                    'status'  => 'error',
                    'message' => $first_error,
                ]);
            };
        }
    }
}

