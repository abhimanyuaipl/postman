<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Validator;
use App\Http\Resources\ProductResources;
use Illuminate\Http\Request;
// use App\Models\Product;
use App\Models\User;
// use Laravel\passport\Passport;
// use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){
        $validator=$request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required',
            'c_password'=>'required|same:password',
        ]);
     
        $validator['password']=bcrypt($request->passowrd);
         $user=User::create($validator);
         $accessToken=$user->createToken('authToken')->accessToken;
         return response(['user '=>$user,'access_token'=>$accessToken]);

}



    public function login(Request $request){
            $logindata=$request->validate([
                'email'=>'required|email',
                'password'=>'required'
            ]);
          

       
        if(!Auth::attempt($logindata)){
            return response(['message'=>'please check your email and password']);
        }else{
            $user = $request->user();
            $accessToken=$user->createToken('authToken')->accessToken;
                 return response(['user '=>Auth::user(),'access_token'=>$accessToken]);
            // return response(['message' => 'Successfully logged in']);
        }
        
        

    }
    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response(['message' => 'Successfully logged out']);
            
        
    }   
    
     
}
