window.onload = (event) => {
  addEmployee();
};

let addEmployee = () => {
  let validationField = document.getElementById('validationField');
  let ul = validationField.firstElementChild;

  $('#add_employee_modal').on('submit', (e) => {
    e.preventDefault();
    e.originalEvent.submitter.setAttribute("disabled", true);
    let form = $('#add_employee_modal');
    let data = form.serialize();

    removeValidationMessage();

    axios({
        method: 'post',
        url: '/employee',
        data
      }).then(function(response) {
        if (response.status === 200) {
          form[0].reset();
          addMessage(['Successfully added an employee'], 'success');

          setTimeout(() => {
            window.location.reload();
          }, 1500);
        }
      })
      .catch(function(error) {
        e.originalEvent.submitter.removeAttribute("disabled");
        let validationField = document.getElementById('validationField');

        if (Object.keys(error.response.data.errors).length > 0) {
          let errors = Object.values(error.response.data.errors);

          addMessage(errors, 'error');
        }
      });
  });

  let addMessage = (message = [], type) => {
    validationField.classList.remove('d-none');

    if (type == 'success') {
      validationField.classList.add('alert-success');
      for (let i = 0; i < message.length; i++) {
        let li = document.createElement('li');
        li.textContent = message[i];

        ul.appendChild(li);
      }
    } else {
      validationField.classList.add('alert-danger');

      for (let i = 0; i < message.length; i++) {
        let li = document.createElement('li');
        li.textContent = message[i];

        ul.appendChild(li);
      }
    }
  }

  let removeValidationMessage = () => {
    if (ul.childElementCount > 0) {
      validationField.classList.remove('alert-danger', 'alert-success');
      while (ul.firstChild && !ul.firstChild.remove());
    }
  }
}