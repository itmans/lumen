<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/5 0005
 * Time: 11:01
 */

class Helpers
{
    public static function bcrypt($value, $options = []) {

        return app('hash')->make($value, $options);

    }


}
