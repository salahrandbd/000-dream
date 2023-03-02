const genderInp = $('[name="gender"]');
const pseudoNameInp = $('[name="pseudo_name_id"]');

genderInp.on('change', (e) => {
  $.ajax({
    url: `/pseudo-names/?gender=${$(e.target).val()}`,
    method: 'GET',
    beforeSend: () => {
      pseudoNameInp.html('<option selected value="">--Choose an option--</option>');
    },
    success: (res) => {
      res.pseudo_names.forEach((item) => {
        console.log(item.id, item.name);
        pseudoNameInp.append(`<option value="${item.id}">${item.name}</option>`)
      });
    },
    error: (err) => {
      console.log(err.responseJSON.message);
    }
  })
});
