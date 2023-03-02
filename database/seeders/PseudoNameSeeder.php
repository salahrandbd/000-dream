<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PseudoName;

class PseudoNameSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $csvData = fopen(base_path('database/csv/pseudo-names.csv'), 'r');
    while (($data = fgetcsv($csvData, 555, ',')) !== false) {
      PseudoName::create([
        'name' => $data['0'],
        'gender' => $data['1'],
      ]);
    }
    fclose($csvData);
  }
}
