<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use App\Record;

///class JwtMiddleware
///{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    ///public function handle($request, Closure $next)
    ///{
        ///return $next($request);
    ///}
///}
class JwtMiddleware extends BaseMiddleware
{
	
	public function handle($request, Closure $next)
	{
		try {
			$action = $request->route()->getAction();
			$response = $next($request);
			if (! $user = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['status' => 'User not found']);
			}else if($user->role !== $action['role']){
				return response()->json(['status' => 'Unauthorized']); 
			}else{ 
				if($user->role !== 'admin'){
					Record::create(
						[
							'user_id' => $user['id'],
							'service' => $action['role'],
							'ip' => $request->ip(),
							'request' => $request->path(),
							'response' => json_encode($response->original),
						]);
				}
				return $response;//$next($request);
			}

		} catch (Exception $e) {
			if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
				return response()->json(['status' => 'Token is Invalid']);
			}else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
				return response()->json(['status' => 'Token is Expired']);
			}else if ($e instanceof \Tymon\JWTAuth\Exceptions\JWTException){
				return response()->json(['status' => 'Authorization Token not found']);
			}else{
				return response()->json(['status' => 'Record table write error'.$e]);
			}
		}
	
	}
	
}