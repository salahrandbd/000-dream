document.addEventListener('DOMContentLoaded', function () {
  const toastEl = $('.toast');
  if (toastEl.length) {
    const toast = new bootstrap.Toast(toastEl[0]);
    toast.show();
  }
}, false);

