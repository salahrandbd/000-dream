<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PseudoName extends Model
{
  use HasFactory;

  public function scopeFilter($query, array $filters)
  {
    if($filters['gender'] ?? false) {
      $query->where('gender', '=', request('gender'));
    }
  }
}
