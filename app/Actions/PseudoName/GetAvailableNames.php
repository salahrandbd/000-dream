<?php

namespace App\Actions\PseudoName;

use App\Models\PseudoName;
use Illuminate\Database\Eloquent\Collection;

class GetAvailableNames
{
  public function execute(array $validated): Collection
  {
    return PseudoName::
      whereNotIn('id', function ($query) {
        $query->select('pseudo_name_id')->from('users');
      })
      ->where('gender', '=', $validated['gender'])
      ->orderBy('name', 'asc')
      ->get(['id', 'name']);
  }
}
