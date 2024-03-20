<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Login (sanctum: token based).
     *
     * @param  LoginRequest $request
     * @return Response
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect('/login');
        }

        $user = Auth::user();

        if ($user->role == User::ROLE_SALES) {
            return redirect('/sales-order');
        } elseif ($user->role == User::ROLE_ADMIN_PURCHASE) {
            return redirect('/purchase-order');
        } else {
            return redirect('/home');
        }
    }
}
