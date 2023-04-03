<?php

namespace App\Http\Controllers\Trackers\Prayer;

use App\Http\Controllers\Controller;
use App\Models\PrayerTracker;
use App\Models\User;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
  public function subscribe() {
    $todayDate = Carbon::now()->format('Y-m-d');

    $user = User::findOrFail(auth()->id());
    $user->prayer_tracker_subscription_date = $todayDate;
    $user->save();

    return redirect()->route('prayer_tracker_daily.show', $todayDate)->with([
      'alert-type' => 'success',
      'message' => 'Subscribed to Salah Tracker successfully'
    ]);
  }

  public function showUnsubscribe()
  {
    return view('trackers.prayer.unsubscribe');
  }

  public function unsubscribe() {
    $user = User::findOrFail(auth()->id());
    $user->prayer_tracker_subscription_date = null;
    $user->save();

    $prayerTrackerIds = PrayerTracker::where('user_id', auth()->id())->pluck('id');
    PrayerTracker::destroy($prayerTrackerIds);

    return redirect()->route('dashboard')->with([
      'alert-type' => 'success',
      'message' => 'Unsubscribed to Salah Tracker successfully'
    ]);
  }
}
