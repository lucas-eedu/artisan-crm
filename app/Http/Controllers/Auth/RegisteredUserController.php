<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            // Company
            'company_name' => ['required', 'string', 'min:2', 'max:255'],
            'segment' => ['nullable', 'string', 'max:50'],
            'state' => ['required', 'string', 'min:2', 'max:2'],
            'number_employees' => ['nullable', 'string', 'max:50'],
            'status' => ['in:active,inactive'],
            // User
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $company = Company::create([
            'name' => $request->company_name,
            'segment' => $request->segment,
            'state' => $request->state,
            'number_employees' => $request->number_employees,
            'status' => 'active'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_id' => '2',
            'company_id' => $company->id
        ]);

        event(new Registered($user));

        Auth::login($user);

        flash('Conta criada com sucesso!')->success();

        return redirect(RouteServiceProvider::HOME);
    }
}
