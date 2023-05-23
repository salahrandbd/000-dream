<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PseudoName;

class PseudoNameSeeder extends Seeder
{
  private static string $csvFileAbsPath = 'database/csv/pseudo-names.csv';
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
        [$name, $gender] = $row;
          PseudoName::create([
          'name' => $name,
          'gender' => $gender
        ]);
      }
      $idx++;
    }

    fclose($csvFileContents);
  }
}
