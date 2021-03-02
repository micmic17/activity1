window.onload = (event) => {
  let validationField = document.getElementsByClassName('validationField')[0];
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

  $('#update_employee_modal').on('submit', (e) => {
    e.preventDefault();
    e.originalEvent.submitter.setAttribute("disabled", true);
    let form = $('#update_employee_modal');
    let data = form.serialize();

    removeValidationMessage();

    axios({
        method: 'put',
        url: '/employee/' + form[0][0].value,
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

  let removeValidationMessage = () => {
    if (ul.childElementCount > 0) {
      validationField.classList.remove('alert-danger', 'alert-success');
      while (ul.firstChild && !ul.firstChild.remove());
    }
  }

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
};