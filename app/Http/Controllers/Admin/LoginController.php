<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Rules\MatchOldPassword;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Log;
use Session;


class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {

        return view('auth.login');
    }

    // Handle user authentication
    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {
    //         // Authentication successful
    //         return redirect('/accueil'); 
    //     }

    //     // Authentication failed
    //     return back()->withErrors(['email' => 'Invalid credentials']);
    // }

    // public function authenticate(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|string',
    //         'password' => 'required|string',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         $email = $request->email;
    //         $password = $request->password;

    //         // Check if the user is active
    //         $user = User::where('email', $email)
    //             ->first();

    //         if ($user) {
    //             if ($user->status === 'Active' && Auth::attempt(['email' => $email, 'password' => $password])) {
    //                 // Authentication successful for an active user
    //                 $user = Auth::user();
    //                 Session::put('name', $user->name);
    //                 Session::put('email', $user->email);
    //                 Session::put('user_id', $user->id); // Use 'id' instead of 'user_id'
    //                 Session::put('join_date', $user->join_date);
    //                 Session::put('phone_number', $user->phone_number);
    //                 Session::put('status', $user->status);
    //                 Session::put('role_name', $user->role_name);
    //                 Session::put('photo', $user->photo);
    //                 Session::put('position', $user->position);
    //                 Session::put('department', $user->department);
    //                 Toastr::success('Login successfully :)', 'Success');
    //                 DB::commit(); // Commit the transaction
    //                 return redirect()->intended('accueil');
    //             } else {
    //                 Toastr::error('Login failed. Your account is inactive or disabled :(', 'Error');
    //             }
    //         } else {
    //             Toastr::error('Login failed. Wrong username or password :(', 'Error');
    //         }

    //         return redirect('login');
    //     } catch (\Exception $e) {
    //         DB::rollBack(); // Rollback the transaction on error
    //         Toastr::error('Login failed :(', 'Error');
    //         return redirect()->back();
    //     }
    // }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    
        DB::beginTransaction();
    
        try {
            $email = $request->email;
            $password = $request->password;
    
            // Check if the user exists
            $user = User::where('email', $email)->first();
    
            if ($user) {
                // Check if the user is active
                if ($user->status === 'Active') {
                    // Attempt to authenticate the user
                    if (Auth::attempt(['email' => $email, 'password' => $password])) {
                        // Authentication successful
                        $user = Auth::user();
    
                        // Store user session data
                        Session::put('name', $user->name);
                        Session::put('email', $user->email);
                        Session::put('user_id', $user->id);
                        Session::put('join_date', $user->join_date);
                        Session::put('phone_number', $user->phone_number);
                        Session::put('status', $user->status);
                        Session::put('role_name', $user->role_name);
                        Session::put('photo', $user->photo);
                        Session::put('position', $user->position);
                        Session::put('department', $user->department);
    
                        // Success message
                        Toastr::success('Login successfully :)', 'Success');
                        DB::commit();
    
                        // Redirect to intended page or default route
                        return redirect()->intended('accueil');
                    } else {
                        // Authentication failed, incorrect password
                        Toastr::error('Login failed. Your account is inactive or disabled :(', 'Error');
                        return redirect()->route('login');
                    }
                } else {
                    // User status is not active
                    Toastr::error('Login failed. Your account is inactive or disabled :(', 'Error');
                    return redirect()->route('login');
                }
            } else {
                // User does not exist
                Toastr::error('Login failed. Wrong username or password :(', 'Error');
                return redirect()->route('login'); 
            }
    
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Login failed :(', 'Error');
            return redirect()->route('login');
        }
    }
    
}
