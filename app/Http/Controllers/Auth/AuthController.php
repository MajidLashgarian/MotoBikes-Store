<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/';

    protected $redirectAfterLogout = '/';

    protected $loginPath = '/admin/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'permission'=> 1
        ]);
    }

    /**
     * Check database if there is an admin user then show login page view
     * othwewise show register page
     *
     * @param Request $request request data which call this function
     * @return 404 error
     */
    public function canRegister(\Illuminate\Http\Request $request)
    {
        $allAdminUser = User::all()->where('permission' , 1);
        //if there is a request for view
        if($request->isMethod('get'))
        {

            if($allAdminUser->count() >  0 )
            {
                return $this->getLogin(); //show Login View
            }
            else{
                return $this->getRegister();
            }
        }else if($request->isMethod('post')){ //This request sent from form register

            if($allAdminUser->count() >  0 )
            {
                App::abort(404);
            }
            else{
                return $this->postRegister($request);
            }
        }
        App::abort(404);
    }



}
