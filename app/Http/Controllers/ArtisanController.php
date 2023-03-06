<?php

namespace App\Http\Controllers;

use Artisan;
use Illuminate\Http\Request;

class ArtisanController extends Controller
{
  public function __construct()
  {
    $this->middleware('artisan');
  }

  public function configClear()
  {
    Artisan::call('config:clear');
  }

  public function configCache()
  {
    Artisan::call('config:cache');
  }

  public function cacheClear()
  {
    Artisan::call('cache:clear');
  }

  public function viewClear()
  {
    Artisan::call('view:clear');
  }

  public function storageLink()
  {
    Artisan::call('storage:link');
  }

  public function migrate()
  {
    Artisan::call('migrate');
  }

  public function seedPseudoName()
  {
    Artisan::call('db:seed --class=PseudoNameSeeder');
  }
}
