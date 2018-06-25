<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/5 0005
 * Time: 14:00
 */

//code
const TOKEN_ERROR_CODE = 10001;
const USER_NOT_EXIST_CODE = 10002;


//msg
const TOKEN_ERROR_CODE_MSG = "token错误";
const USER_NOT_EXIST_CODE_MSG = "用户不存在";




return [

    'user_not_exist' => [
        'code' => USER_NOT_EXIST_CODE,
        'msg' => USER_NOT_EXIST_CODE_MSG
    ],

    'token_error' => [
        'code' => TOKEN_ERROR_CODE,
        'msg' => TOKEN_ERROR_CODE_MSG
    ],

    'token_expired' => 86400,


];