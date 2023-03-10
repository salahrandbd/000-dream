<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrayerType;

class PrayerTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $csvData = fopen(base_path('database/csv/prayer-types.csv'), 'r');
    $firstRow = true;
    while (($data = fgetcsv($csvData, 555, ',')) !== false) {
      if($firstRow) {
        $firstRow = false;
        continue;
      }

      PrayerType::create([
        'type' => empty($data['0']) ? null : $data[0],
      ]);
    }
    fclose($csvData);
  }
}
