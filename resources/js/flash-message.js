document.addEventListener('DOMContentLoaded', function () {
  const toastEl = $('.toast');
  if (toastEl.length) {
    console.log(toastEl[0]);
    const toast = new bootstrap.Toast(toastEl[0]);
    console.log(toast);
    toast.show();
  }
}, false);

