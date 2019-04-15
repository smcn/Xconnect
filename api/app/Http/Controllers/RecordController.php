<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function getAllRecords(Request $request){
		
		try {
			
			$records = Record::orderBy('created_at', 'desc')->limit(100)->get();

		} catch (Exception $e) {
			
			return response()->json(['Status' => $e]);
		}
			
		return response()->json(compact('records'), 200);
	}
	
	public function getUserRecords(Request $request){
		
		try {
			
			$records = Record::where('user_id', $request->route('id'))->orderBy('created_at', 'desc')->limit(100)->get();

		} catch (Exception $e) {
			
			return response()->json(['Status' => $e]);
		}
			
		return response()->json(compact('records'), 200);
	}
	
	public function getServiceRecords(Request $request){
		
		try {
			
			$records = Record::where('service', $request->route('id'))->orderBy('created_at', 'desc')->limit(100)->get();

		} catch (Exception $e) {
			
			return response()->json(['Status' => $e]);
		}
			
		return response()->json(compact('records'), 200);
	}
	
	public function getSearchRecords(Request $request){
		
		try {
			
			$records = Record::where('service', 'like', "%{$request->route('id')}%")
							->orWhere('ip', 'like', "%{$request->route('id')}%")
							->orWhere('request', 'like', "%{$request->route('id')}%")
							->orWhere('response', 'like', "%{$request->route('id')}%")
							->orWhere('created_at', 'like', "%{$request->route('id')}%")
							->orderBy('created_at', 'desc')
							->limit(100)
							->get();

		} catch (Exception $e) {
			
			return response()->json(['Status' => $e]);
		}
			
		return response()->json(compact('records'), 200);
	}
	
}
