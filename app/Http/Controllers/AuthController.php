<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/5 0005
 * Time: 11:39
 */

namespace App\Http\Controllers;

use App\Requests\UserAuthRequest;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function jwt(User $user) {
        $payload = [
            'iss' => 'lumen-jwt',
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + config('app.token_expired')
        ];
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    public function authenticate() {
        $this->validators($this->request, UserAuthRequest::rules(), UserAuthRequest::messages());
        $user = User::where('email', $this->request->input('email'))->first();
        if (!$user) {
            return $this->error(config('app.user_not_exist.msg'), config('app.user_not_exist.code'));
        }
        if (Hash::check($this->request->input('password'), $user->password)) {
            return $this->success([
                'token' => $this->jwt($user)
            ]);
        }

        return $this->error(config('app.user_not_exist.msg'), config('app.user_not_exist.code'));
    }

}