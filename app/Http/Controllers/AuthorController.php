<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/5 0005
 * Time: 9:35
 */
namespace App\Http\Controllers;


use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function showAllAuthors() {
        return $this->success(Author::all());
    }

    public function showOneAuthor($id) {
        return $this->success(Author::find($id));
    }

    public function create(Request $request) {
        $author = Author::create($request->all());
        return $this->success($author);
    }
}