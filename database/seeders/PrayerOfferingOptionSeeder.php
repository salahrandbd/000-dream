<?php
namespace Database\Seeders;

use App\Models\PrayerOfferingOption;
use Illuminate\Database\Seeder;

class PrayerOfferingOptionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $csvData = fopen(base_path('database/csv/prayer-offering-options.csv'), 'r');
    $firstRow = true;
    while (($data = fgetcsv($csvData, 555, ',')) !== false) {
      if($firstRow) {
        $firstRow = false;
        continue;
      }

      PrayerOfferingOption::create([
        'prayer_type_id' => empty($data['0']) ? null : $data[0],
        'option' => empty($data['1']) ? null : $data[1],
        'applicable_genders' => empty($data['2']) ? null : $data[2],
        'points' => empty($data['3']) ? null : $data[3],
        'special_points' => empty($data['4']) ? null : $data[4],
        'special_genders' => empty($data['5']) ? null : $data[5],
        'short_desc' => empty($data['6']) ? null : $data[6],
      ]);
    }
    fclose($csvData);
  }
}
