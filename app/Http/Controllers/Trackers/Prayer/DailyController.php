<?php

namespace App\Http\Controllers\Trackers\Prayer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trackers\Prayer\ShowDailyRequest;
use App\Http\Requests\Trackers\Prayer\UpdateDailyRequest;
use App\Actions\Trackers\Prayer\InitDaily;
use App\Actions\Trackers\Prayer\DailyDetails;
use App\Actions\Trackers\Prayer\UpdateDaily;

/**
 * Summary of DailyController
 */
class DailyController extends Controller
{
  public function show(ShowDailyRequest $request, InitDaily $initDaily, DailyDetails $dailyDetails)
  {
    $initDaily->execute();
    $dailyDetails = $dailyDetails->get();

    return view('trackers.prayer.daily', compact('dailyDetails'));
  }

  public function update(UpdateDailyRequest $request, UpdateDaily $updateDaily)
  {
    $updateDaily->execute($request->validated());

    return back()->with([
      'alert-type' => 'success',
      'message' => 'Details saved successfully!'
    ]);
  }
}
