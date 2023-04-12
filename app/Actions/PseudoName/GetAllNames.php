<?php

namespace App\Actions\PseudoName;

use App\Models\PseudoName;
use Illuminate\Database\Eloquent\Collection;

class GetAllNames
{
  public function execute() : Collection
  {
    return PseudoName
      ::select('id', 'name')
      ->orderBy('name', 'asc')
      ->get();
  }
}
