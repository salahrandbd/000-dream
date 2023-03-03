<?php

namespace App\Http\Controllers;

use App\Models\PseudoName;
use App\Http\Requests\StorePseudoNameRequest;
use App\Http\Requests\UpdatePseudoNameRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PseudoNameController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return response()->json([
      'pseudo_names' => PseudoName::filter(request(['gender']))->get()
    ]);
  }

  public function available(Request $request)
  {
    $request->validate([
      'gender' => ['required', Rule::in(['Male', 'Female'])]
    ]);

    return response()->json([
      'pseudo_names' => PseudoName::join('users', 'pseudo_names.id', '<>', 'users.pseudo_name_id')
                        ->where('pseudo_names.gender', '=', request('gender'))
                        ->get(['pseudo_names.id', 'pseudo_names.name'])
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePseudoNameRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(PseudoName $pseudoName)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(PseudoName $pseudoName)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePseudoNameRequest $request, PseudoName $pseudoName)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(PseudoName $pseudoName)
  {
    //
  }
}
