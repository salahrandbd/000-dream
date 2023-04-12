<?php

namespace App\Actions\Trackers\Prayer;

use App\Models\PrayerTracker;
use App\Models\PrayerOfferingOption;
use Illuminate\Support\Carbon;

class GetDailyDetails
{
  public function isSpecialPrayer(PrayerTracker $prayerTracker)
  {
    return $prayerTracker->prayerVariation->prayerName->special_days
      && $prayerTracker->prayerVariation->prayerName->special_genders
      && in_array(auth()->user()->pseudoName->gender, json_decode($prayerTracker->prayerVariation->prayerName->special_genders))
      && in_array(Carbon::parse(request('date'))->isoFormat('ddd'), json_decode($prayerTracker->prayerVariation->prayerName->special_days));
  }

  public function getPrayerName(PrayerTracker $prayerTracker)
  {
    return $this->isSpecialPrayer($prayerTracker)
      ? $prayerTracker->prayerVariation->prayerName->special_name
      : $prayerTracker->prayerVariation->prayerName->name;
  }

  public function getPrayerDesc(PrayerTracker $prayerTracker)
  {
    return $this->isSpecialPrayer($prayerTracker)
      ? $prayerTracker->prayerVariation->special_short_desc
      : $prayerTracker->prayerVariation->short_desc;
  }

  public function getPrayerOfferingOptions(PrayerTracker $prayerTracker, array $prayerOfferingOptions)
  {
    $prayerOfferingOptionsFiltered = array_filter($prayerOfferingOptions, function ($item) use ($prayerTracker) {
      return ($prayerTracker->prayerVariation->prayer_type_id == $item['prayer_type_id'])
            && in_array(auth()->user()->pseudoName->gender, json_decode($item['applicable_genders']));
    });

    $prayerOfferingOptionsMapped = array_map(function ($item) {
      return [
        'id' => $item['id'],
        'option' => $item['option'],
        'points' => $item['special_genders'] && in_array(auth()->user()->pseudoName->gender, json_decode($item['special_genders'])) ? $item['special_points'] : $item['points'],
        'short_desc' => $item['short_desc']
      ];
    }, $prayerOfferingOptionsFiltered);


    return $prayerOfferingOptionsMapped;
  }

  public function execute(): array
  {
    $prayerOfferingOptions = PrayerOfferingOption::all()->toArray();

    $prayerTrackers = PrayerTracker::where([
      ['user_id', '=', auth()->id()],
      ['date', '=', request('date')]
    ])->get();

    $prayerTrackersNew = [];

    foreach ($prayerTrackers as $prayerTracker) {
      $prayerTrackersNew[] = [
        'prayer_variation_id' => $prayerTracker->prayer_variation_id,
        'prayer_offering_option_id' => $prayerTracker->prayer_offering_option_id,
        'rakats_cnt' => $prayerTracker->rakats_cnt,
        'prayer_name' => $this->getPrayerName($prayerTracker),
        'prayer_type' => $prayerTracker->prayerVariation->prayerType->type ?? null,
        'prayer_desc' => $this->getPrayerDesc($prayerTracker),
        'prayer_offering_options' => $this->getPrayerOfferingOptions($prayerTracker, $prayerOfferingOptions)
      ];
    }

    return $prayerTrackersNew;
  }
}
