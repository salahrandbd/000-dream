<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $period = CarbonPeriod::create('2023-03-01', '2023-05-07');

    foreach ($period as $date) {
      foreach(\App\Models\PrayerVariation::all() as $prayerVariation) {
        if(in_array($prayerVariation->id, [2, 4, 6, 7, 9])) {
          \App\Models\PrayerTracker::create([
            'user_id' => 4,
            'prayer_variation_id' => $prayerVariation->id,
            'prayer_offering_option_id' => [3, 4, 5, 6][rand(0, 3)],
            'date' => $date->format('Y-m-d')
          ]);
        } else if(in_array($prayerVariation->id, [1, 3, 5, 8, 10])) {
          \App\Models\PrayerTracker::create([
            'user_id' => 4,
            'prayer_variation_id' => $prayerVariation->id,
            'prayer_offering_option_id' => [7, 8, 9][rand(0, 2)],
            'date' => $date->format('Y-m-d')
          ]);
        } else {
          \App\Models\PrayerTracker::create([
            'user_id' => 4,
            'prayer_variation_id' => $prayerVariation->id,
            'rakats_cnt' => rand(1, 20),
            'date' => $date->format('Y-m-d')
          ]);
        }
      }
    }
  }
}
