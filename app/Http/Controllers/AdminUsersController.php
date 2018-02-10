<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use App\User;
use App\Mail\PasswordReset;
use \App\Mail\Notification as Notify;

class AdminUsersController extends Controller
{
    function __construct()
    {
			$users = User::all()->count();
			$noAuth = [];

			if (!$users) {
				$noAuth[] = 'store';
				$noAuth[] = 'create';
			}

			$this->middleware('auth', ['except' => $noAuth]);
    }

    public function index() {
        $admins = User::all();
        return view('admin.users', compact('admins'));
    }

    public function store(Request $request) {
        // Validate the input
        request()->validate([
            'email' => 'required|email',
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ]);

        // Count users
        $count = count(User::where(request(['username', 'email']))->get());

        // If not exists
        if ($count == 0) {
            // Create it
            $admin = User::create(request(['username', 'email', 'password', 'first_name', 'last_name']));

            // Sign In
            auth()->login($admin);

            // \Mail::send($admin)->send(new Notify($admin));
            \Mail::to($admin)->send(new Notify($admin));

            // Redirect
            return redirect('/admin');
        }

        // redirect to login if exists
        return redirect('/admin/login');
    }

    public function destroy($id) {
        $user = User::find($id)->get();
        $user->delete();

        return redirect()->back();
    }

    public function create()
    {
        return view('admin.register');
    }
}
