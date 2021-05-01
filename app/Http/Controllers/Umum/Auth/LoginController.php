<?php


namespace App\Http\Controllers\Umum\Auth;

use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validate;
use Illuminate\Support\Facades\Validator;
use Auth;
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('umum.auth.login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function login(Request $request)
     {
        $input = $request->all();

        $rules = [
            'email' => 'required|exists:users,email|string',
            'password' => 'required|string'
        ];

        $pesan = [
            'email.required' => 'Alamat Email Wajib Diisi!',
            'email.exists' => 'Alamat Email Belum Terdaftar!',
            'password.required' => 'Password Wajib Diisi!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()){
            return response()->json([
                'fail' => true,
                'msg' => 'Terdapat Kesalahan Di Form!',
                'errors' => $validator->errors(),
            ]);
        }else{
            $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            if(auth()->guard('web')->attempt($request->only('email','password')))
            {
                return response()->json([
                    'fail' => false,
                ]);
            }else{
                $gagal['password'] = array('Password salah!');
                return response()->json([
                    'fail' => true,
                    'errors' => $gagal,
                ]);
            }
        }

     }

     public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }

}
