<?php

namespace App\Controllers\Auth;

use Leaf\Form;

class LoginController
{
    public function showLoginForm()
    {
        echo app()->template->render("user/login");
    }

    public function login()
    {
        $this->ValidateForm();

        $data = request()->get(['username', 'password']);
        $user = auth()->login($data);

        if (!$user) {
            response()->json([
                'status'  => 'error',
                'message' => 'wrong username or password',
            ]);
        }

        // response()->json([
        //     'status'  => 'success',
        //     'message' => '登录成功',
        // ]);

        // return response()->redirect("/user/home");
    }

    public function logout()
    {
        return auth()->logout('/');
    }

    /**
     * 验证提交的表单数据
     *
     * @return void
     */
    private function ValidateForm()
    {
        $validation = Form::validate([
            "username" => "required",
            "password" => "required",
        ]);

        if (!$validation) {
            // 取首条错误
            $first_error = array_values(Form::errors())[0];
            response()->json([
                'status'  => 'error',
                'message' => $first_error,
            ]);
        }
    }
}
