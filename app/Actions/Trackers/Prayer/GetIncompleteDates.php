<?php
namespace App\Actions\Trackers\Prayer;

use App\Models\PrayerTracker;

class GetIncompleteDates
{
  public const MAX_DATES_CNT = 5;

  public function execute() {
    return PrayerTracker::select('date')
      ->distinct()
      ->where('user_id', auth()->id())
      ->whereNull('prayer_offering_option_id')
      ->orderBy('date', 'DESC')
      ->limit(self::MAX_DATES_CNT)
      ->get();

  }
}
