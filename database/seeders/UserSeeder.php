<?php

namespace Database\Seeders;

use App\Models\PseudoName;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  private static int $maxUsersCnt = 10;
  private static string $defaultPassword = 'dreamer';
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    while(User::count() != self::$maxUsersCnt) {
      $randPseudoName = PseudoName::inRandomOrder()->first();
      User::firstOrCreate(
        ['pseudo_name_id' => $randPseudoName->id],
        ['password' => bcrypt(self::$defaultPassword)]
      );
    }
  }
}
