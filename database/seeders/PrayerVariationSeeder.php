<?php
namespace Database\Seeders;

use App\Models\PrayerVariation;
use Illuminate\Database\Seeder;

class PrayerVariationSeeder extends Seeder
{
  private static string $csvFileAbsPath = 'database/csv/prayer-variations.csv';
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
        [$prayerNameId, $prayerTypeId, $shortDesc, $specialShortDesc] = $row;
        PrayerVariation::create([
          'prayer_name_id' => $prayerNameId,
          'prayer_type_id' => $prayerTypeId ?: null,
          'short_desc' => $shortDesc,
          'special_short_desc' => $specialShortDesc ?: null,
        ]);
      }
      $idx++;
    }

    fclose($csvFileContents);
  }
}
