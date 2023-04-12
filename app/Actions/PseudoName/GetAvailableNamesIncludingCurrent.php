<?php

namespace App\Actions\PseudoName;

use App\Models\PseudoName;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;

class GetAvailableNamesIncludingCurrent
{
  public function execute(User $user): Collection
  {
    return PseudoName::
      whereNotIn('id', function (Builder $query) use($user) {
        $query
          ->select('pseudo_name_id')
          ->where('pseudo_name_id', '<>', $user->pseudo_name_id)
          ->from('users');
      })
      ->where('gender', '=', $user->pseudoName->gender)
      ->orderBy('name')
      ->get(['id', 'name']);
  }
}
