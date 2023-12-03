<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Форма для регистрации сотрудника
    public function create()
    {
        return view('users.register');
    }

    // Регистрация нового сотрудника
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('message', 'Сотрудник зарегистрирован!');
    }

    // Выход работника из акаунта
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Вы вышли из профиля');
    }

    // Форма авторизации сотрудника
    public function login()
    {
        return view('users.login');
    }

    // Авторизация пользователя
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields))
        {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Вы вошли');
        }

        return back()->withErrors(['email' => 'Неверное значение'])
            ->onlyInput('email');
    }
}
