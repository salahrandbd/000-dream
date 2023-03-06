<x-layout>
  <div class="edit-profile-container">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('edit_profile') }}" method="POST">
          @csrf
          @method('PUT')

          <legend class="text-start fw-semibold mb-4">Edit Profile</legend>

          <div class="row mb-3">
            <div class="col-12 col-md-4 col-lg-2">
              <label for="gender" class="form-label">Gender</label>
            </div>
            <div class="col-12 col-md-8 col-lg-10">
              <input id="gender" class="form-control" value="{{ auth()->user()->pseudoName->gender }}" disabled />
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12 col-md-4 col-lg-2">
              <label for="pseudo_name_id" class="form-label">Pseudo name</label>
            </div>
            <div class="col-12 col-md-8 col-lg-10">
              <select name="pseudo_name_id" id="pseudo_name_id"
                class="form-select @error('pseudo_name_id') is-invalid @enderror" required>
                <option value="">--Choose an option--</option>
                @foreach ($pseudoNames as $pseudoName)
                  <option {{ $pseudoName->id == auth()->user()->pseudo_name_id ? 'selected' : '' }}
                    value="{{ $pseudoName->id }}">{{ $pseudoName->name }}</option>
                @endforeach
              </select>
              @error('pseudo_name_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12 col-md-4 col-lg-2">
              <label for="password" class="form-label">New Password</label>
            </div>
            <div class="col-12 col-md-8 col-lg-10">
              <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror" />
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12 col-md-4 col-lg-2">
              <label for="password_confirmation" class="form-label">Confirm Password</label>
            </div>
            <div class="col-12 col-md-8 col-lg-10">
              <input type="password" id="password_confirmation" name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror" />
              @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <button type="submit" class="btn btn-primary px-4 text-white">Edit</button>
        </form>
      </div>
    </div>
  </div>
</x-layout>
