<?php

namespace App\Http\Controllers\Trackers\Prayer;

use App\Http\Controllers\Controller;
use App\Models\PrayerTracker;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
  public function subscribe()
  {
    $todayDate = Carbon::now()->format('Y-m-d');

    $user = DB::table('users')->findOrFail(auth()->id());
    $user->prayer_tracker_subscription_date = $todayDate;
    $user->save();

    return redirect()->route('prayer_tracker_daily.show', $todayDate)->with([
      'alert-type' => 'success',
      'message' => 'Subscribed to Salah Tracker successfully'
    ]);
  }

  public function unsubscribe()
  {
    $user = DB::table('users')->findOrFail(auth()->id());
    $user->prayer_tracker_subscription_date = null;
    $user->save();

    $prayerTrackerIds = DB::table('prayer_trackers')->where('user_id', auth()->id())->pluck('id');
    DB::table('prayer_trackers')->destroy($prayerTrackerIds);

    return redirect()->route('dashboard')->with([
      'alert-type' => 'success',
      'message' => 'Unsubscribed to Salah Tracker successfully'
    ]);
  }
}