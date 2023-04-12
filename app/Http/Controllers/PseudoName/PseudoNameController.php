<?php

namespace App\Http\Controllers\PseudoName;

use App\Http\Controllers\Controller;
use App\Actions\PseudoName\GetAvailableNames;
use App\Http\Requests\PseudoName\AvailableNamesRequest;

class PseudoNameController extends Controller
{
  public function available(AvailableNamesRequest $request, GetAvailableNames $getAvailableNames)
  {
    return response()->json([
      'pseudo_names' => $getAvailableNames->execute($request->validated())
    ]);
  }
}
