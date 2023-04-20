<?php

namespace App\Http\Controllers\Others;

use App\Http\Controllers\Controller;
use Artisan;

class ArtisanController extends Controller
{
  public function migrate()
  {
    Artisan::call('migrate');
  }

  public function storageLink()
  {
    Artisan::call('storage:link');
  }

  public function seedPseudoName()
  {
    Artisan::call('db:seed --class=PseudoNameSeeder');
  }

  public function seedPrayerName()
  {
    Artisan::call('db:seed --class=PrayerNameSeeder');
  }

  public function seedPrayerType()
  {
    Artisan::call('db:seed --class=PrayerTypeSeeder');
  }

  public function seedPrayerVariation()
  {
    Artisan::call('db:seed --class=PrayerVariationSeeder');
  }

  public function seedPrayerOfferingOption()
  {
    Artisan::call('db:seed --class=PrayerOfferingOptionSeeder');
  }
}
