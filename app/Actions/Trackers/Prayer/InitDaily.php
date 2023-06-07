<?php

namespace App\Actions\Trackers\Prayer;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class InitDaily
{
  public function execute(User $user, string $date): void
  {
    $prayerVariationsCnt = DB::table('prayer_variations')->count();

    $prayerTrackersCntByDate = DB::table('prayer_trackers')
      ->where([
        ['user_id', $user->id],
        ['date', $date]
      ])->count();

    if ($prayerVariationsCnt != $prayerTrackersCntByDate) {
      DB::transaction(function () use ($user, $date) {
        $prayerVariations = DB::table('prayer_variations')->get();
        foreach ($prayerVariations as $prayerVariation) {
          DB::table('prayer_trackers')
            ->insert([
              'prayer_variation_id' => $prayerVariation->id,
              'user_id' => $user->id,
              'date' => $date
            ]);
        }
      });
    }
  }
}