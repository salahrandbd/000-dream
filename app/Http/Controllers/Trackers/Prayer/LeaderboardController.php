<?php

namespace App\Http\Controllers\Trackers\Prayer;

use App\Http\Controllers\Controller;
use App\Actions\Trackers\Prayer\GetLeaders;


class LeaderboardController extends Controller
{
  public function index(GetLeaders $getLeaders)
  {
    $leaders = $getLeaders->execute();

    // dd($leaders);
    return view('trackers.prayer.leaderboard', compact('leaders'));
  }
}
