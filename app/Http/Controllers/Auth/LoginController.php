<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:web')->except('logout');
        $this->middleware('guest:dosen')->except('logout');
        $this->middleware('guest:pegawai')->except('logout');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
  
        $this->validate($request, [
            'nip' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->nip, FILTER_VALIDATE_EMAIL) ? 'email' : 'nip';
        if(auth()->guard('dosen')->attempt(array($fieldType => $input['nip'], 'password' => $input['password'])))
        {
            return redirect()->route('base');
        }elseif(auth()->guard('pegawai')->attempt(array($fieldType => $input['nip'], 'password' => $input['password'])))
        {
            return redirect()->route('base');
        }else{
            return redirect()->route('login')
                ->withInput()->with('error','NIP/Email atau Password salah.');
        }

          
    }
    // public function login(Request $request)
    // {   
    //     $input = $request->all();
  
    //     $this->validate($request, [
    //         'nip' => 'required',
    //         'password' => 'required',
    //     ]);
  
    //     $fieldType = filter_var($request->nip, FILTER_VALIDATE_EMAIL) ? 'email' : 'nip';
    //     if(auth()->attempt(array($fieldType => $input['nip'], 'password' => $input['password'])))
    //     {
    //         return redirect()->route('base');
    //     }else{
    //         return redirect()->route('login')
    //             ->withInput()->with('error','NIP/Email atau Password salah.');
    //     }
          
    // }
}
