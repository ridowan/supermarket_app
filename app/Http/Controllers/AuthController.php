<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

	public function login(Request $request)
	{
		//validate incoming request 
		$this->validate($request, [
			'email' => 'required|string',
			'password' => 'required|string',
		]);

		$credentials = $request->only(['email', 'password']);

		if (! $token = Auth::attempt($credentials)) {			
			return response()->json(['status'=>'fail','message' => 'Unauthorized'], 401);
		}

		//return $this->respondWithToken($token);
		// Auth::user()->id;
		return response()->json([
			'status' 		=> 'succes',
			'data' => [
				'token'			=> $token,
				'token_type'	=> 'bearer',
				'expire_in'		=> Auth::factory()->getTTL() * 60
			],
		], 200);
	}

}