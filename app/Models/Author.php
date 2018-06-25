<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/5 0005
 * Time: 9:26
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name', 'email', 'github', 'latest_article_published'
    ];

    protected $hidden = [];

}