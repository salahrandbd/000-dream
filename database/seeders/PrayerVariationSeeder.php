<?php
namespace Database\Seeders;

use App\Models\PrayerVariation;
use Illuminate\Database\Seeder;

class PrayerVariationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $csvData = fopen(base_path('database/csv/prayer-variations.csv'), 'r');
    $firstRow = true;
    while (($data = fgetcsv($csvData, 555, ',')) !== false) {
      if($firstRow) {
        $firstRow = false;
        continue;
      }

      PrayerVariation::create([
        'prayer_name_id' => empty($data['0']) ? null : $data[0],
        'prayer_type_id' => empty($data['1']) ? null : $data[1],
        'short_desc' => empty($data['2']) ? null : $data[2],
        'special_short_desc' => empty($data['3']) ? null : $data[3],
      ]);
    }
    fclose($csvData);
  }
}
