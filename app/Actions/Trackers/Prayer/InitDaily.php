<?php

namespace App\Actions\Trackers\Prayer;

use App\Models\PrayerTracker;
use App\Models\PrayerVariation;
use Illuminate\Support\Facades\DB;

class InitDaily
{
  public function execute(): void
  {
    $prayerVariationsCnt = PrayerVariation::count();
    $prayerTrackersCntByDate = PrayerTracker::where([
      ['user_id', '=', auth()->id()],
      ['date', '=', request('date')]
    ])->count();

    if ($prayerVariationsCnt != $prayerTrackersCntByDate) {
      DB::transaction(function () {
        $prayerVariations = PrayerVariation::all();
        foreach ($prayerVariations as $prayerVariation) {
          PrayerTracker::create([
            'prayer_variation_id' => $prayerVariation['id'],
            'user_id' => auth()->id(),
            'date' => request('date')
          ]);
        }
      });
    }
  }
}
