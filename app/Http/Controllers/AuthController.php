<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function _contruct(){
        $this->middleware('auth:api',['except'=>['login','register']]);
    }

    public function index(){
        return view('auth.login');
    }
    /**
     * User Register.
     */
    //public function register(Request $request){
    //    $validator = Validator::make($request -> all(), [
    //        'member_name' => 'required',
    //        'id_binusian' => 'required',
    //        'major' => 'required',
    //        'address' => 'required',
    //        'phone_number' => 'required',
    //        'email' => 'required|email',
    //        'password' => 'required|same:confirm_password',
    //        'confirm_password' => 'required|same:password',
    //        'pts' => 'required',
    //    ]);
    //    if ($validator -> fails()){
    //        return response() -> json(
    //            $validator -> errors(), 422
    //        );
    //    }

    //    $input = $request -> all();
    //    $input['password'] = bcrypt($request -> password);
    //    unset($input['confirm_password']);
    //    $member = Member::create($input);

    //    return response() -> json([
    //        'data' => $member
    //    ]);
    //}

//
//        $validator = Validator::make($request->all(),[
//            'name' => 'required',
//            'email' => 'required|string|email|unique:users',
//            'password' => 'required|string|confirmed|min:6'
//        ]);
//       if($validator->fails()){
//            return response() -> json($validator -> errors() -> toJson(),400);
//        }
//        $user = User::create(array_merge(
//            $validator -> validated(),
//            ['password' => bcrypt($request -> password)]
//        ));
//        return response() -> json([
//            'message' => 'Successfully Registered',
//            'user' => $user
//        ],201);
//    }

    /**
     * ADMIN Login.
     */
    public function login(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = request(['email', 'password']);
        
        if(auth() -> attempt($credentials)){
            $token = Auth::guard('api')->attempt($credentials);
            return response()->json([
                'success' => true,
                'message' => 'Login Successful',
                'token' => $token
            ]);    
        }

        return response()->json([
            'success'=> false,
            'message' => 'Email or password wrong'
        ]);

        //$validator = Validator::make($request->all(),[
        //    'email' => 'required|email',
        //    'password' => 'required|string|min:6'
        //]);
        //if($validator->fails()){
        //    return response() -> json($validator -> errors(),422);
        //}
        //if(auth() -> attempt($validator -> validated())){
        //    Auth::guard('api')->attempt($validator -> validated());
        //    return redirect('/dashboard');
        //}
        //return response() -> json(['error' => 'Unauthorized'],401);
    }

    /**
     * USER Login
     */

    public function login_member(){
        return view ('auth.login_member');
    }

    public function login_member_action(Request $request){
        $validator = Validator::make($request -> all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator -> fails()){
            Session::flash('errors', $validator->errors());
            return redirect('/login_member');
        }

        $credentials = $request -> only('email', 'password');
        $member = Member::where('email',$request -> email) -> first();

        if($member){
            if(Auth::guard('webmember') -> attempt($credentials)){
                $request -> session() -> regenerate();
                return redirect('/');
            }else{
                Session::flash('failed', 'Invalid E-mail or Password');
                return redirect('/login_member');
            }

        } else{
            Session::flash('failed', 'Invalid E-mail or Password');
            return redirect('/login_member');
        }

    }

    /**
     * USER Register
     */
    public function register_member(){
        return view ('auth.register_member');
    }

    public function register_member_action(Request $request){
        $validator = Validator::make($request -> all(), [
            'member_name' => 'required',
            'id_binusian' => 'required',
            'major' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required | email',
            'pts' => 'required | max:50',
            'password' => 'required | same:confirm_password',
            'confirm_password' => 'required | same:password',

        ]);
        if ($validator -> fails()){
            Session::flash('errors', $validator->errors());
            return redirect('/register_member');
        }

        $input = $request -> all();
        $input['password'] = Hash::make($request -> password);
        unset($input['confirm_password']);
        $member = Member::create($input);

        Session::flash('success', 'Successfully Registered');
        return redirect('/login_member');
    }

    /**
     * Create Login Token.
     */
    public function createNewToken($token){
        return response() -> json([
            'access_token'=> $token,
            'token_type' => 'bearer',
            'expires_in' => auth() -> factory() -> getTTL()*60,
            'user' => auth() -> user()
        ]);
    }

    /**
     * Show LOGGED IN User Profile.
     */
    public function profile(){
        return response() -> json(auth() -> user());
    }
    /**
     * Logout.
     */
    public function logout(){
        Session::flush();

        return redirect('/login');
    }

    public function logout_member(){
        Auth::guard('webmember') -> logout();

        Session::flush();
        return redirect('/');
    }
}
