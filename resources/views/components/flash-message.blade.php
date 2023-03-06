@if (session()->has('message'))
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          @if (session('alert-type') == 'success')
            <i class="bi bi-check-circle-fill text-primary"></i>
            <span class="ms-2 text-primary fw-medium">{{ session('message') }}</span>
          @elseif (session('alert-type') == 'error')
            <i class="bi bi-x-circle-fill text-danger"></i>
            <span class="ms-2 text-danger fw-medium">{{ session('message') }}</span>
          @endif
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
@endif
