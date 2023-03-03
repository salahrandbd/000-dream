<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PseudoName;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
  public function register()
  {
    return view('users.register');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'gender' => ['required', Rule::in(['Male', 'Female'])],
      'pseudo_name_id' => [
        'required',
        'unique:users',
        Rule::exists('pseudo_names', 'id')->where(function (Builder $query) {
          return $query->where('gender', request('gender'));
        }),
      ],
      'password' => ['required', 'confirmed', Password::min(8)->uncompromised()],
    ]);

    $user = User::create([
      'pseudo_name_id' => $validated['pseudo_name_id'],
      'password' => bcrypt($validated['password'])
    ]);

    auth()->login($user);

    return redirect('/')->with('message', 'Congrats! You have been successfully registered.');
  }

  public function login()
  {
    $pseudoNames = PseudoName::select('id', 'name')->get();
    return view('users.login', compact('pseudoNames'));
  }

  public function authenticate(Request $request)
  {
    $validated = $request->validate([
      'pseudo_name_id' => 'required',
      'password' => 'required'
    ]);

    if (auth()->attempt($validated)) {
      $request->session()->regenerate();

      return redirect('/')->with('message', 'You\'re now logged in!');
    } else {
      return back()->withErrors(['generic' => 'Invalid pseudo name or password'])->onlyInput('generic');
    }
  }
}
