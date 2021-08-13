<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Facades\Gate;
use App\Models\User;

class ProductsController extends Controller
{

	public function index(Request $request){
		if(Gate::denies('read-product')){
			return response()->json([
				'status' 		=> 'failed',
				'data' => [
					'message'	=> 'You\'re unauthorized'
				],
			], 403);
		}
		
		if(Auth::user()->role == 'Supervisor' || Auth::user()->role == 'Cashier'){
			$post = DB::table('products')->select('name','qty')->where('approve',true)->get()->toArray();
			return response()->json([
				'status' 		=> 'succes',
				'data' => $post,
			], 200);
		}
	}

	public function store(Request $request){
		if(Gate::denies('create-product')){
			return response()->json([
				'status' 		=> 'failed',
				'data' => [
					'message'	=> 'You\'re unauthorized'
				],
			], 403);
		}

		foreach ($request->name as $key => $value) {
			$input = array(
				'id_user'	=> Auth::user()->id,
				'name'		=> $request->name[$key],
				'qty'		=> $request->qty[$key]
			);

			DB::table('products')->insert($input);
			
		}

		return response()->json([
			'status' 		=> 'succes',
			'data' => [
					'message'	=> 'Data have done save'
				],
		], 200);
	}

	public function update(Request $request){
		if(Gate::denies('update-product')){
			return response()->json([
				'status' 		=> 'failed',
				'data' => [
					'message'	=> 'You\'re unauthorized'
				],
			], 403);
		}

		foreach ($request->name as $key => $value) {

			DB::table('products')->where('id',$request->id[$key])->update(['name'=> $request->name[$key],'qty'=> $request->qty[$key]]);
		}

		return response()->json([
			'status' 		=> 'succes',
			'data' => [
					'message'	=> 'Data have done save'
				],
		], 200);
	}

	public function approve(Request $request){
		if(Gate::denies('approve-product')){
			return response()->json([
				'status' 		=> 'failed',
				'data' => [
					'message'	=> 'You\'re unauthorized'
				],
			], 403);
		}

		foreach ($request->id as $key => $value) {

			DB::table('products')->where('id',$request->id[$key])->update(['approve'=> $request->approve[$key], 'description'=> $request->description[$key] ]);
		}
	}

	public function reject(Request $request){
		if(Gate::denies('reject-product')){
			return response()->json([
				'status' 		=> 'failed',
				'data' => [
					'message'	=> 'You\'re unauthorized'
				],
			], 403);
		}

		foreach ($request->id as $key => $value) {

			DB::table('products')->where('id',$request->id[$key])->update(['approve'=> $request->approve[$key],'reject'=> $request->approve[$key], 'description'=> $request->description[$key] ]);
		}
	}

}