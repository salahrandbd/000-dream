<?php

namespace App\Actions\PseudoName;

use \Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GetAvailableNames
{
  public function execute(array $validated): Collection
  {
    return DB::table('pseudo_names')
      ->select('id', 'name')
      ->whereNotIn('id', function ($query) {
        $query->select('pseudo_name_id')->from('users');
      })
      ->where('gender', $validated['gender'])
      ->orderBy('name', 'asc')
      ->get();
  }
}