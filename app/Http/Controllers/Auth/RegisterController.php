<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
  /**
   * Show the registration form.
   */
  public function showRegistrationForm()
  {
    $companies = Company::all();
    return view('auth.register', compact('companies'));
  }

  /**
   * Handle a registration request.
   */
  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
      'role' => 'required|in:admin,company',
      'company_id' => 'nullable|exists:companies,id',
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'role' => $request->role,
      'company_id' => $request->company_id,
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect('/dashboard');
  }
}
