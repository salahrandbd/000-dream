<?php

namespace App\Actions\PseudoName;

use App\Models\User;
use \Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class GetAvailableNamesIncludingCurrent
{
  public function execute(User $user): Collection
  {
    return DB::table('pseudo_names')
      ->select('id', 'name')
      ->whereNotIn('id', function (Builder $query) use ($user) {
        $query
          ->select('pseudo_name_id')
          ->where('pseudo_name_id', '<>', $user->pseudo_name_id)
          ->from('users');
      })
      ->where('gender', '=', $user->pseudoName->gender)
      ->orderBy('name')
      ->get();
  }
}