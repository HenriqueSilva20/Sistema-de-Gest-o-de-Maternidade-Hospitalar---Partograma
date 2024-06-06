<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\failed_login_attempts;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\models\User;
use Carbon\Carbon;

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

    public function authenticated(Request $request)
    {
        // Autenticar o usuário
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            // Se o login for bem-sucedido, limpe os registros de tentativas de login malsucedidas
            $user = User::findOrFail(Auth::user()->id);
            //$user->login_attempts = 0;
            //$user->save();

            // Redirecionar o usuário com base em seu nível de acesso
            if ($user->acesso == '1') {

                return redirect('sgmh/painel/home');

            } elseif (in_array($user->acesso, ['2', '3', '0'])) {
                return redirect('sgmh/painel/home');// Redirecionar para a rota raiz
            } else {
                return redirect('sgmh/painel/home');// Redirecionar para a rota raiz
            }
        } else {

            //dd($request);

            // Registrar a tentativa de login malsucedida
            $user = failed_login_attempts::where('ip_address', $request->ip())->get();
            if ($user && $user->attempt_count >= 5 && $user->last_attempt_at->diffInHours(now()) < 3) {
                if ($request->routeIs('plataforma.login')) {
                    return redirect('/plataforma/vaysoft/entrar')->with('login.exced.error', 1);
                } else {
                    return redirect('/login')->with('login.exced.error', 1);
                }
            } else {
                dd($request);
                if (!$user) {
                    $user = new failed_login_attempts();
                    $user->ip_address = $request->ip();
                }
                $user->user_id = null; // Usuário não autenticado
                $user->attempt_count++;
                $user->last_attempt_at = now();
                $user->save();

                return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                    'login' => "Email ou senha inválidos",
                ]);
            }
        }
    }


}
