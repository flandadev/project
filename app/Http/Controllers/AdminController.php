<?php

namespace App\Http\Controllers;

use App\{Customer, Event, User, Ticket};

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\PasswordReset;
use App\Mail\PasswordConfirmation;


use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // use Event;

    public function __construct()
    {
        $this->users = User::all()->count();

        $noAuth = [
            'login',
            'authenticate',
            'forgot',
            'showForgot',
            'showReset',
            'reset',
            'checkReset'
        ];

        $this->middleware('auth', ['except' => $noAuth]);
        $this->middleware('guest', ['only' => ['login', 'authenticate', 'forgot', 'showForgot', 'showReset', 'reset', 'checkReset']]);
    }

    public function index()
    {
        return view('admin.index');
    }


    public function login()
    {
				if (!$this->users) {
					return redirect()->guest('/admin/users/create');
				}

        return view('admin.login');
    }

    /**
     * @param Request $request
     */
    public function authenticate(Request $request)
    {
        $user = User::where('username', $request->username)->get();

        if (!$user) {
            session()->flash('errors', ['password' => false, 'username' => true]);
            session()->flash('warn', 'Invalid Username');
            return redirect()->back()->withInput();
        } elseif (count($user)) {
            $login = Auth::attempt(request(['username', 'password']));

            if ($login) {
                return redirect('admin');
            }

            session()->flash('warn', 'INVALID PASSWORD');
            session()->flash('errors', ['password' => true, 'username' => false]);
            return redirect()->back()->withInput();
        }

        session()->flash('errors', ['password' => true, 'username' => true]);
        return redirect()->back()->withInput();
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->back();
    }

    public function create()
    {
        return view('admin.register');
    }

    public function forgot(Request $request) {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            \Mail::to($user)->send(new PasswordReset($user));
            session()->flash('message', 'Password confirmation sent.');
            return redirect()->back();
        }

        session('warn', 'User not found. Check your email');
        return redirect()->back()->withInput();
    }


    public function showForgot() {
        return view('admin.forgot');
    }

    public function checkReset(Request $request, $encr) {
        $mail = $request->mail;
        $salted = sha1($mail . env('APP_SALT'));

        if ($salted == $encr) {
            $user = User::where('email', $mail)->first();

            session()->flash('user', $user);

            return redirect('/admin/reset');
        }

        return 'INVALID';
    }

    public function showReset() {
        if ( session('user') ) {
            return view('admin.reset')->with('user', session('user'));
        }

        return redirect()->back();
    }

    public function reset(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ]);


        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = $request->password;
        $user->save();

        \Mail::to($user)->send(new PasswordConfirmation(compact('user')));

        auth()->logout();

        return redirect('admin/login')->with('username', $user->username);
    }
}
