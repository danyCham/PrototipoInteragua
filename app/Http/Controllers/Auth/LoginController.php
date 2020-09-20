<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use App\Models\GestionUsuario;

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
    }

    public function redirectToProvider($driver)
    {
        $drivers = ['google'];

        if(in_array($driver, $drivers)){
            return Socialite::driver($driver)->redirect();
        }else{
            return redirect()->route('login')->with('info', $driver . ' no es una aplicación valida para poder loguearse');
        }

        
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $driver)
    {

        if($request->get('error')){
            return redirect()->route('login');
        }

        $userSocialite = Socialite::driver($driver)->user();
       // dd($userSocialite);
        
        $usuario = User::where('social_id', $userSocialite->getId())
                                        ->where('social_name', $driver)->first();

        if(!$usuario){

            $usuario = User::create([
                'nombre' => $userSocialite->getName(),
                'email'=> $userSocialite->getEmail(),
                'id_rol' => '2',
                'social_id' => $userSocialite->getId(),
                'social_name' => $driver,
                'imagen'  => $userSocialite->getAvatar(),
            ]);

        }

        auth()->login($usuario);

        return redirect()->route('home');
    }
}