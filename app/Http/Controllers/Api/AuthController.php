<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Auth\SessionGuard;

class AuthController extends Controller
{
    public function dashboard(){
        $user = User::all();
        return response()->json($user,200);
    }

      public function CustomerDashboard(){
        $user = Customer::all();
        return response()->json($user,200);
    }


    public function shopDashboard(){
        $user = Shop::all();
        return response()->json($user,200);
    }


    public function create(Request $request){

        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('AuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function createCustomer(Request $request){

        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('AuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function createShop(Request $request){

        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = Shop::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('AuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function login(Request $request){

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->guard('web')->attempt($data)) {
            $token = auth()->guard('api')->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }  
    
    
    public function customerLogin(Request $request){

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->guard('customer')->attempt($data)) {
            $token = auth()->guard('customer')->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }  


    public function shopLogin(Request $request){

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->guard('shop')->attempt($data)) {
            $token = auth()->guard('shop')->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }  
}
