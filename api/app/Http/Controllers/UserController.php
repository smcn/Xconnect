<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
	
class UserController extends Controller
{
    public function authenticate(Request $request){
		$credentials = $request->only('email', 'password');

		try {
			if (! $token = JWTAuth::attempt($credentials) ) {
				return response()->json(['status' => 'Invalid Credentials']);
			}else{
				$payload = JWTAuth::setToken($token)->getPayload();
				if ($payload['active'] !== 1 ) {
					return response()->json(['status' => 'User is passive']);
				}
			}
		} catch (JWTException $e) {
			return response()->json(['status' => 'Could Not Create Token']);
		}

		return response()->json(compact('token'), 200);
	}

	public function register(Request $request){
		$validator = Validator::make($request->all(), [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6',
			'role' => 'required|string|max:255',
		]);

		if($validator->fails()){
				return response()->json($validator->errors()->toJson());
		}

		$user = User::create([
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'password' => Hash::make($request->get('password')),
			'tckimlikno' => $request->get('tckimlikno'),
			'role' => $request->get('role'),
		]);

		//$token = JWTAuth::fromUser($user);

		return response()->json(compact('user'), 201);
	}
	
	public function updateUser(Request $request){
		$validator = Validator::make($request->all(), [
			'id' => 'required|numeric',
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255',
			'password' => 'required|string|min:6',
			'active' => 'required',
		]);

		if($validator->fails()){
				return response()->json($validator->errors()->toJson());
		}

		$user = User::whereId($request->get('id'))
					->update([
				'name' => $request->get('name'),
				'email' => $request->get('email'),
				'password' => Hash::make($request->get('password')),
				'tckimlikno' => $request->get('tckimlikno'),
				'role' => $request->get('role'),
				'active' => $request->get('active'),
				]);
		
		return response()->json(compact('user'), 201);
	}
	
	public function deleteUser(Request $request){
		$validator = Validator::make($request->all(), [
			'id' => 'required|numeric',
		]);

		if($validator->fails()){
				return response()->json($validator->errors()->toJson());
		}

		$user = User::whereId($request->get('id'))->delete();
		
		return response()->json(compact('user'), 201);
	}

	public function getAuthenticatedUser(){

		//$payload = JWTAuth::getPayload();
		return response()->json(compact('user'), 200);
		
	}
	
	public function getAllUser(Request $request){
		
		try {
			
			$users = User::All();

		} catch (Exception $e) {
			
			return response()->json(['Status' => $e]);
		}
			
		return response()->json(compact('users'), 200);
	}
}
