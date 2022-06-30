<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create()
    {

        return view('index', ['wanaRegister' => true, 'materials' => Material::all()]);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);
        // Hash Password

        $formFields['password'] = bcrypt($formFields['password']);

        //create user
        $user = User::create($formFields);

        //Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    public function login()
    {

        return view('index', ['wanaLogin' => true, 'materials' => Material::all()]);
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out');
    }

    public function accounts()
    {

        return view('components.accounts', ['accounts' => User::latest()->filter(request(['search']))->paginate(8)]);
    }

    public function order($orderby)
    {
        return view('components.accounts', ['accounts' => User::orderBy($orderby)->filter(request(['search']))->paginate(8)]);
    }

    public function edit(User $acoount)

    {
        return view('components.accounts', ['acoounts' => User::latest()->filter(request(['search']))->paginate(8), 'editAccount' => $acoount]);
    }



    public function destroy(User $account)
    {
        if ($account->isAdmin && $account->id !== auth()->id()) {

            abort(403, 'Unauthorized Action / Can not delete another admin');
        }
        $account->delete();
        return redirect('/')->with('message', 'User deleted succesfully');
    }
}
