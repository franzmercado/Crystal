<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register',[
            'custom_js'  => 'register'
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
      $rules = array(
        'Email' => 'required|max:30|unique:users,email',
         'Firstname' => 'required|max:30',
         'Middlename' => 'max:30',
         'Lastname' => 'required|max:30',
         'Gender' => 'required',
         'Birthday' => 'required',
         'MobileNumber' => 'required',
         'Password' => 'required'
      );
      $error = Validator::make($request->all(), $rules);

      if ($error->fails()) {
        return response()->json(['errors' => $error->errors()->all()]);
      }

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);
        //
        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());
        return 1;
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
