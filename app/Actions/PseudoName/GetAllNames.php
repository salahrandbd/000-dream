<?php

namespace App\Actions\PseudoName;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GetAllNames
{
  public function execute(): Collection
  {
    return DB::table('pseudo_names')
      ->select('id', 'name')
      ->orderBy('name', 'asc')
      ->get();
  }
}