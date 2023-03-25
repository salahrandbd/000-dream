@php
  use Carbon\Carbon;
@endphp

<x-layout>
  <div class="daily-prayer-tracker-container">
    <div class="row align-items-center my-3">
      <div class="col-12 col-sm-6 mb-2 mb-sm-0">
        <h5 class="page-title text-uppercase fw-semibold mb-0 d-flex flex-column flex-sm-row align-items-center">
          <span>Daily Salah Tracker</span>
          <span class="badge rounded-pill bg-primary fs-7 ls-0 ms-2">{{ Carbon::parse(request('date'))->toFormattedDayDateString() }}</span>
        </h5>
      </div>
      <div class="col-12 col-sm-6 d-flex justify-content-center justify-content-sm-end">
        <button class="btn btn-primary dropdown-toggle text-white" type="button" data-bs-toggle="dropdown">
          <i class="bi bi-clock-history"></i>
          <span class="ms-2">History</span>
        </button>
        <div class="dropdown ms-1">
          <ul class="dropdown-menu">
            <li class="px-3 py-2">
              <form action="" class="historic-date-form">
                <label for="historic_date_inp" class="form-label">Select a specific date</label>
                <input min="{{ auth()->user()->prayer_tracker_subscription_date }}" max="{{ Carbon::now()->format('Y-m-d') }}" value="{{ request('date') }}" type="date" name="historic_date_inp" class="form-control mb-2" id="historic_date_inp" required>
                <button class="btn btn-primary text-white w-100" type="submit">View</button>
              </form>
            </li>
          </ul>
        </div>
        <a href="{{ route('unsubscribe_to_prayer_tracker.show') }}" class="btn btn-danger text-white ms-2">Unsubscribe</a>
      </div>
    </div>
    <div class="card mb-3">
      <div class="card-body">
        <form action="{{ route('prayer_tracker_daily.update', request('date')) }}" method="POST">
          @csrf
          @method('PUT')

          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Something went wrong. Please, try again.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @foreach ($dailyDetails as $i => $dailyDetail)
            @if ($i != 0 && ($dailyDetails[$i]['prayer_name'] != $dailyDetails[$i - 1]['prayer_name']))
              <hr>
            @endif

            @if ($i == 0 || ($dailyDetails[$i]['prayer_name'] != $dailyDetails[$i - 1]['prayer_name']))
              <h6 class="card-title text-center text-uppercase mb-3">{{ $dailyDetail['prayer_name'] }}</h6>
            @endif

            @if ($dailyDetail['prayer_name'] != 'Others')
              <div class="row align-items-center mb-3">
                <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                  <div class="card-subtitle">{{ $dailyDetail['prayer_type'] }}</div>
                  <div class="text-muted">{{ $dailyDetail['prayer_desc'] }}</div>
                </div>
                <div class="col-12 col-sm-8">
                  <div class="row">
                    @foreach ($dailyDetail['prayer_offering_options'] as $prayerOfferingOption)
                      <div class="col-12 col-xl-6 mb-1">
                        <input class="form-check-input" type="radio" name="prayer_tracker[{{ $dailyDetail['prayer_variation_id'] }}]" value="{{ $prayerOfferingOption['id'] }}" id="prayer_tracker_{{ $dailyDetail['prayer_variation_id'] }}_{{ $prayerOfferingOption['id'] }}" {{ $dailyDetail['prayer_offering_option_id'] == $prayerOfferingOption['id'] ? 'checked' : ''  }}>
                        <label class="form-check-label ms-1" for="prayer_tracker_{{ $dailyDetail['prayer_variation_id'] }}_{{ $prayerOfferingOption['id'] }}">
                          <span>{{ $prayerOfferingOption['option'] }}</span>
                          <span class="text-muted">({{ $prayerOfferingOption['points'] }} pts)</span>
                        </label>
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $prayerOfferingOption['short_desc'] }}" class="cursor-pointer"><i class="bi bi-info-circle-fill"></i></span>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            @else
              <div class="row align-items-center mb-3">
                <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                  <label class="card-subtitle" for="prayer_tracker[{{ $dailyDetail['prayer_variation_id'] }}]">Rak'ats Count</label>
                  <div class="text-muted">{{ $dailyDetail['prayer_desc'] }}</div>
                </div>
                <div class="col-12 col-sm-8">
                  <input type="number" min="0" class="form-control" placeholder="Rak'ats Count" value="{{ $dailyDetail['rakats_cnt'] ?? 0 }}" name="prayer_tracker[{{ $dailyDetail['prayer_variation_id'] }}]" id="prayer_tracker[{{ $dailyDetail['prayer_variation_id'] }}]">
                </div>
              </div>
            @endif
          @endforeach
          <button class="save-btn btn btn-primary px-4 w-100 text-white">Save</button>
        </form>
      </div>
    </div>
  </div>
</x-layout>

@vite('resources/js/daily-prayer-tracker.js')
