<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\User;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only'=>[
            'login'
        ]]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:50',
            'role' => 'required'

        ]);

        //Create User First Method

        $user = new User();
        $user->username = Input::get('username');
        $user->email = Input::get('email');
        $user->password = Input::get('password');  // use for store simple password
     // $user->password = app('hash')->make('ada5ac2a5cacas2ca5ac5ac2a5aca2'); // use for encrpt password
        $user->api_token = app('hash')->make('ada5ac2a5cacas2ca5ac5ac2a5aca2');
        $user->role = Input::get('role');
        $user->save();

        //Create User Second Method

        // $user =  User::create([
        //     'username' => $request->input('username'),
        //     'email' => $request->input('email'),
        //     'password' => $request->input('password'),     // use for store simple password
        //     'password' =>  app('hash')->make('password'),  // use for encrpt password
        //     'api_token' => app('hash')->make('ada5ac2a5cacas2ca5ac5ac2a5aca2'),
        // ]);


        return response()->json(['Message'=>'User Created Successfully','Status'=>200]);
    }
    

    public function login()
    {
        return response()->json(['Message'=>'Logged in', 'Status'=>200]);
    }

    public function getUsers()
    {
        // $name = DB::table('users')->where('username','ahsan')->plunk('username');
        $userList = App\User::pluck('username', 'id');
        var_dump($userList);
        // return response()->json(array('status'=>200,'All_Users'=>User::all()));
    }
}