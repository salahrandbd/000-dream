<?php

namespace App\Http\Controllers;

use App\Models\PseudoName;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PseudoNameController extends Controller
{
  public function available(Request $request)
  {
    $request->validate([
      'gender' => ['required', Rule::in(['Male', 'Female'])]
    ]);

    return response()->json([
      'pseudo_names' => PseudoName::
        whereNotIn('id', function ($query) {
          $query->select('pseudo_name_id')->from('users');
        })
        ->where('gender', '=', request('gender'))
        ->orderBy('name', 'asc')
        ->get(['id', 'name'])
    ]);
  }
}
