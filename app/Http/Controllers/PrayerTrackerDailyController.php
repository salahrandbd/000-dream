<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrayerTrackerDailyController extends Controller
{
  public function index(string $date)
  {
    dd($date);
  }
}
