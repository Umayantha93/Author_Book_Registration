<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required| confirmed",
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return response()->json([
            "status" => 1,
            "message" => "Registration Successfull",
        ]);
    }

    public function login(Request $request){

        error_log($request);

        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if(!Auth::attempt($login)){
            return response(['message' => 'invalid login credentials']);
        }

        $token = Auth::user()->createToken('token')->accessToken;

        return response(['user' => Auth::user(), 'access_token' => $token]);
        }

        //profile
        public function profile(){
            return response()->json([
                'status' => true,
                'message' => 'logged into user'
            ]);
        }
    
        //profile
        public function adminProfile(){

            $users = User::select('id','name','email', 'status')->where('is_admin', '!=', 1)->get();

            return response($users);
        }

        //logout
        public function logout(Request $request){
            
            $token = $request->user()->token();

            $token->revoke();
            return response()->json([
                "status" => true,
                "message" => "Author Logged out successfully"
            ]);
        }

        //update author
        public function updateAuthor(Request $request){
            
                $user = User::find($request->id);
                $user->status = !$user->status;        
                
                $user->save();


                return response()->json([
                    "status" => $user->status,
                    "message" => "Author Update is Submitted",
                ]);
        }
    
}
