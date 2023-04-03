document.addEventListener('DOMContentLoaded', function () {
  const historicDateForm = $('.historic-date-form');
  const historicDateInp = $('#historic_date_inp');

  historicDateForm.on('submit', function (e) {
    e.preventDefault();
    location.href = `/trackers/prayer/daily/${historicDateInp.val()}`;
  });

  // enable all tooltips
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
}, false);
