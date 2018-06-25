<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/6 0006
 * Time: 14:32
 */

namespace App\Requests;



class UserAuthRequest
{

    /**
     * @return array
     */
    public static function rules() {

        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    /**
     * @return array
     */
    public static function messages() {
        return [
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式错误',
            'password.required' => '密码不能为空'
        ];
    }


}