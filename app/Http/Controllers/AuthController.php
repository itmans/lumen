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
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    private $request;
    private $expired; //过期时间

    public function __construct(UserAuthRequest $request)
    {
        $this->request = $request;
    }

    /**
     * payload
     * @param User $user
     * @return string
     */
    protected function jwt(User $user) {
        $this->expired = time() + config('app.token_expired');
        $payload = [
            'iss' => 'lumen-jwt',
            'sub' => $user->id,
            'iat' => time(),
            'exp' => $this->expired
        ];
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    /**
     * 授权
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate() {
        $user = User::where('email', $this->request->input('email'))->first();
        if (!$user) {
            return $this->error(config('app.user_not_exist.msg'), config('app.user_not_exist.code'));
        }
        if (Hash::check($this->request->input('password'), $user->password)) {
            return $this->success([
                'token' => $this->jwt($user),
                'expired' => $this->expired
            ]);
        }

        return $this->error(config('app.user_not_exist.msg'), config('app.user_not_exist.code'));
    }

}