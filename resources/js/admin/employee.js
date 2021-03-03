window.onload = (event) => {
  let validationField;
  let ul;

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
        successResponse(response, form, 'Succesfully added an employee', 'add');
      })
      .catch(function(error) {
        e.originalEvent.submitter.removeAttribute("disabled");

        errorResponse(error);
      });
  });

  $('[data-toggle="modal"]').on('click', (event) => {
    let id = event.currentTarget.attributes[1].value;

    if (id == '#addEmployeeModal')
      validationField = document.getElementById(0);
    else
      validationField = document.getElementById(event.currentTarget.attributes[1].value);

    ul = validationField.firstElementChild;

    $('#update_employee_modal' + id).on('submit', (e) => {
      e.preventDefault();
      e.originalEvent.submitter.setAttribute("disabled", true);
      let form = $('#update_employee_modal' + id);
      let data = form.serialize();

      removeValidationMessage();

      axios({
          method: 'put',
          url: '/employee/' + id,
          data
        }).then(function(response) {
          successResponse(response, form, 'Succesfully updated the employee', 'update');
        })
        .catch(function(error) {
          e.originalEvent.submitter.removeAttribute("disabled");

          errorResponse(error);
        });
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

  let successResponse = (response, form, message, type) => {
    if (response.status === 200) {
      if (type == 'add') form[0].reset();

      addMessage([message], 'success');

      setTimeout(() => {
        window.location.reload();
      }, 1500);
    }
  }

  let errorResponse = (error) => {
    let validationField = document.getElementById('validationField');

    if (Object.keys(error.response.data.errors).length > 0) {
      let errors = Object.values(error.response.data.errors);

      addMessage(errors, 'error');
    }
  }
};