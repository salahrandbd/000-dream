@props(['mode'])

<span class="logo-inner">
  <i class="bi bi-cloud-moon-fill {{ $mode == 'dark' ? 'text-dark' : 'text-light' }}"></i>
  <span class="fw-semibold {{ $mode == 'dark' ? 'text-dark' : 'text-light' }}">Dream</span>
</span>
