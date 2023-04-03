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

    return redirect('/')->with([
      'alert-type' => 'success',
      'message' => 'Congrats! You have been successfully registered.'
    ]);
  }

  public function login()
  {
    $pseudoNames = PseudoName
      ::select('id', 'name')
      ->orderBy('name', 'asc')
      ->get();
    return view('users.login', compact('pseudoNames'));
  }

  public function authenticate(Request $request)
  {
    $validated = $request->validate([
      'pseudo_name_id' => 'required',
      'password' => 'required',
    ]);

    if (auth()->attempt($validated, request('remember'))) {
      $request->session()->regenerate();
      return redirect('/')->with([
        'alert-type' => 'success',
        'message' => 'You\'re now logged in!'
      ]);
    } else {
      return back()->withErrors(['generic' => 'Invalid pseudo name or password'])->onlyInput('generic');
    }
  }

  public function destroy(Request $request)
  {
    auth()->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login')->with([
      'alert-type' => 'success',
      'message' => 'Logged out successfully'
    ]);
  }

  public function showEditProfile()
  {
    $pseudoNames = PseudoName::
      whereNotIn('id', function ($query) {
        $query
          ->select('pseudo_name_id')
          ->where('pseudo_name_id', '<>', auth()->user()->pseudo_name_id)
          ->from('users');
      })
      ->where('gender', '=', auth()->user()->pseudoName->gender)
      ->orderBy('name')
      ->get(['id', 'name']);

    return view('users.edit-profile', compact('pseudoNames'));
  }

  public function editProfile(Request $request)
  {
    $validated = $request->validate([
      'pseudo_name_id' => [
        'nullable',
        Rule::unique('users')->ignore(auth()->id()),
        Rule::exists('pseudo_names', 'id')->where(function (Builder $query) {
          return $query->where('gender', auth()->user()->pseudoName->gender);
        })
      ],
      'password' => ['nullable', 'confirmed', Password::min(8)->uncompromised()]
    ]);

    $user = User::find(auth()->id());

    $validated['pseudo_name_id'] && $user['pseudo_name_id'] = $validated['pseudo_name_id'];
    $validated['password'] && $user['password'] = bcrypt($validated['password']);

    if(!$user->save()) {
      return back()->with([
        'alert-type' => 'error',
        'message' => 'Failed to update the profile'
      ]);
    } else {
      return back()->with([
        'alert-type' => 'success',
        'message' => 'Profile updated successfully'
      ]);
    }
  }
}
