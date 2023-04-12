<?php

namespace App\Actions\User;

use App\Models\User;

class EditUserProfile
{
  public function execute(string $userId, array $validated): void
  {
    $user = User::find($userId);

    if($validated['pseudo_name_id']) $user['pseudo_name_id'] = $validated['pseudo_name_id'];
    if($validated['password']) $user['password'] = bcrypt($validated['password']);

    $user->save();
  }
}
