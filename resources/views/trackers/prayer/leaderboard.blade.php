@php
  use Carbon\Carbon;
@endphp

<x-layout>
  <div class="prayer-leaderboard-container">
    <div class="row my-3">
      <div class="col-12">
        <h5 class="page-title text-uppercase fw-semibold mb-0 d-flex align-items-center">
           Salah Leaderboard
          <span class="badge rounded-pill bg-primary fs-7 ls-0 ms-2">Last 30 days</span>
        </h5>
      </div>
    </div>
    <div class="card mb-3">
      <div class="card-body">
        @forelse ($leaders as $key => $leader)
          @if ($key != 0)
            <hr>
          @endif

          <div class="row align-items-end">
            <div class="col-12 mb-2 mb-sm-0 col-sm-2 text-center d-flex justify-content-center justify-content-sm-start">
              <div class="position-relative">
                <img class="rounded-circle" width="64" src="{{ asset('storage/images/' . strtolower($leader->gender) . '.png') }}" alt="Header Avatar">
                @if ($leader->user_id == auth()->id())
                  <i class="bi bi-check-circle-fill text-primary position-absolute top-0 start-0"></i>
                @endif
              </div>
            </div>
            <div class="col-12 mb-2 mb-sm-0 col-sm-4">
              <h6>Fard Success Rate:</h6>
              <div class="progress">
                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $leader->fard_success_rate }}%;">{{ $leader->fard_success_rate }}%</div>
              </div>
            </div>
            <div class="col-12 mb-2 mb-sm-0 col-sm-4">
              <h6>Sunnah Success Rate:</h6>
              <div class="progress">
                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $leader->sunnah_success_rate }}%;">{{ $leader->sunnah_success_rate }}%</div>
              </div>
            </div>
            <div class="col-12 mb-2 mb-sm-0 col-sm-2">
              Others: {{ $leader->others_rakats_count }} rak'ats
            </div>
          </div>
        @empty
          <p class="text-center mb-0">No leaders found</p>
        @endforelse
      </div>
    </div>
  </div>
</x-layout>


