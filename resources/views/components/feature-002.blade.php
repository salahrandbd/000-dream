<div class="new-feature-modal modal fade" id="new-feature-002" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex flex-column align-items-center">
        <img class="new-feature-icon" src="{{ asset('storage/images/new-feature.png') }}" width="128" alt="">
        <h5 class="new-feature-title modal-title text-capitalize my-3">#002 Change your profile pic now!</h5>
        <p class="new-feature-short-desc mb-0">Bored to see your default profile picture? Your await is over. <a href="{{ route('edit_profile.show') }}">Change</a> your profile picture whenever you want.</p>
      </div>
      <div class="row flex-column flex-sm-row justify-content-center align-items-center p-3">
        <div class="col-12 col-sm-6 mx-auto">
          <button type="button" class="dont-show-again-feature-btn btn btn-danger text-white w-100" data-bs-dismiss="modal">
            <i class="bi bi-x-lg me-2"></i>
            Don't show again
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
