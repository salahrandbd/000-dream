<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrayerName;

class PrayerNameSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $csvData = fopen(base_path('database/csv/prayer-names.csv'), 'r');
    $firstRow = true;
    while (($data = fgetcsv($csvData, 555, ',')) !== false) {
      if($firstRow) {
        $firstRow = false;
        continue;
      }

      PrayerName::create([
        'name' => empty($data['0']) ? null : $data[0],
        'special_name' => empty($data['1']) ? null : $data[1],
        'special_days' => empty($data['2']) ? null : $data[2],
        'special_genders' => empty($data['3']) ? null : $data[3]
      ]);
    }
    fclose($csvData);
  }
}
