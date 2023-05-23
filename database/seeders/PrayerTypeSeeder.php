<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrayerType;

class PrayerTypeSeeder extends Seeder
{
  private static string $csvFileAbsPath = 'database/csv/prayer-types.csv';
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $csvFileContents = fopen(base_path(self::$csvFileAbsPath), 'r');

    $idx = 0;
    while (($row = fgetcsv($csvFileContents, 555, ',')) !== false) {
      if($idx != 0) {
        [$type] = $row;
        PrayerType::create([
          'type' => $type,
        ]);
      }
      $idx++;
    }

    fclose($csvFileContents);
  }
}
