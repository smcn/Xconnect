<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{

	public function addService(Request $request){
		$validator = Validator::make($request->all(), [
			'name' => 'required|string|max:255', //|unique:services',
			'account' => 'required|string|max:255',
			'password' => 'required|string|max:255',
			'description' => 'string|max:255',
		]);

		if($validator->fails()){
				return response()->json($validator->errors()->toJson(), 400);
		}

		$service = Service::create([
			'name' => $request->get('name'),
			'account' => $request->get('account'),
			'password' => $request->get('password'),
			'account2' => $request->get('account2'),
			'password2' => $request->get('password2'),
			'description' => $request->get('description'),
		]);

		return response()->json(compact('service'), 201);
	}
	
	public function updateService(Request $request){
		$validator = Validator::make($request->all(), [
			'id' => 'required|numeric',
			'name' => 'required|string|max:255',
			'account' => 'required|string|max:255',
			'password' => 'required|string|max:255',
			'description' => 'string|max:255',
		]);

		if($validator->fails()){
				return response()->json($validator->errors()->toJson(), 400);
		}

		$service = Service::whereId($request->get('id'))
					->update([
				'name' => $request->get('name'),
				'account' => $request->get('account'),
				'password' => $request->get('password'),
				'account2' => $request->get('account2'),
				'password2' => $request->get('password2'),
				'description' => $request->get('description'),
				]);
		
		return response()->json(compact('service'), 201);
	}
	
	public function deleteService(Request $request){
		$validator = Validator::make($request->all(), [
			'id' => 'required|numeric',
		]);

		if($validator->fails()){
				return response()->json($validator->errors()->toJson(), 400);
		}

		$service = Service::whereId($request->get('id'))->delete();
		
		return response()->json(compact('service'), 201);
	}
	
	public function getAllServices(){
			$services = Service::All();
			return response()->json(compact('services'), 200);
	}
}
