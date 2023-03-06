@props(['mode'])

<a href="{{ route('dashboard') }}" class="logo text-decoration-none">
  <i class="bi bi-cloud-moon-fill fs-2 {{ $mode == 'dark' ? 'text-dark' : 'text-light' }}"></i>
  <span class="fw-semibold {{ $mode == 'dark' ? 'text-dark' : 'text-light' }}">Dream</span>
</a>
