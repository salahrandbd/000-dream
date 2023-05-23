<?php
namespace Database\Seeders;

use App\Models\PrayerOfferingOption;
use Illuminate\Database\Seeder;

class PrayerOfferingOptionSeeder extends Seeder
{
  private static string $csvFileAbsPath = 'database/csv/prayer-offering-options.csv';
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
        [
          $prayerTypeId,
          $option,
          $applicableGenders,
          $points,
          $specialPoints,
          $specialGenders,
          $shortDesc
        ] = $row;

        PrayerOfferingOption::create([
          'prayer_type_id' => $prayerTypeId,
          'option' => $option,
          'applicable_genders' => $applicableGenders,
          'points' => $points,
          'special_points' => $specialPoints ?: null,
          'special_genders' => $specialGenders ?: null,
          'short_desc' => $shortDesc ?: null,
        ]);
      }
      $idx++;
    }

    fclose($csvFileContents);
  }
}
