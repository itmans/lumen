<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/5 0005
 * Time: 15:13
 */

namespace App\Http\Middleware;


use App\Http\Controllers\Controller;
use App\Models\User;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class JwtMiddleware extends Controller
{
    public function handle(Request $request, \Closure $next, $guard = null) {

        $token = $request->get('token');

        if (!$token) {
            return $this->error(config('app.token_error.msg'), config('app.token_error.code'));
        }

        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch(ExpiredException $e) {
            return $this->error(config('app.token_error.msg'), config('app.token_error.code'));
        } catch(\Exception $e) {
            return $this->error(config('app.token_error.msg'), config('app.token_error.code'));
        }

        $user = User::find($credentials->sub);
        $request->auth = $user;
        return $next($request);
    }
}