document.addEventListener('DOMContentLoaded', function () {
  const historicDateForm = $('.historic-date-form');
  const historicDateInp = $('#historic_date_inp');

  historicDateForm.on('submit', function (e) {
    e.preventDefault();
    console.log(historicDateInp.val());
    location.href = `/trackers/prayer/daily/${historicDateInp.val()}`;
  });
}, false);
