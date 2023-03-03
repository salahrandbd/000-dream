<x-layout>
  <div class="login-container container-fluid">
    <div class="login-row row">
      <div class="login-col col-12 col-md-6 mx-auto">
        <div class="login-card card my-5 p-3">
          <div class="login-card-body card-body">
            <div class="login-card-header text-center">
              <a class="logo text-decoration-none">
                <x-logo mode="dark"/>
              </a>
            </div>
            <form action="/users/authenticate" method="POST" class="login-form">
              @csrf
              <legend class="login-form-heading text-center fw-semibold mb-4">Login Now!</legend>

              @error('generic')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <i class="bi bi-times me-2"></i>
                  {{ $message }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @enderror

              <div class="mb-3">
                <label for="pseudo_name_id" class="form-label">Select your pseudo name</label>
                <select name="pseudo_name_id" id="pseudo_name_id" class="form-select @error('pseudo_name_id') is-invalid @enderror">
                  <option value="" selected>--Choose an option--</option>
                  @foreach ($pseudoNames as $pseudoName)
                    <option value="{{ $pseudoName->id }}">{{ $pseudoName->name }}</option>
                  @endforeach
                </select>
                @error('pseudo_name_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password"/>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <button type="submit" class="login-btn btn btn-primary text-white w-100">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layout>
