var createForm = (function () {
  var submitButton;
  var validator;
  var form;
  // Handle form validation and submittion
  var handleForm = function () {
    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
    validator = FormValidation.formValidation(form, {
      fields: {
        gender: {
          validators: {
            notEmpty: {
              message: "Gender is required",
            },
          },
        },
        age: {
          validators: {
            notEmpty: {
              message: "Age is required",
            },
          },
        },
        height: {
          validators: {
            notEmpty: {
              message: "Height is required",
            },
          },
        },
        weight: {
          validators: {
            notEmpty: {
              message: "Weight is required",
            },
          },
        },
        scale: {
          validators: {
            notEmpty: {
              message: "Scale is required",
            },
          },
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap5({
          rowSelector: ".fv-row",
          eleInvalidClass: "is-invalid",
          eleValidClass: "is-valid",
        }),
      },
    });

    // Action buttons
    submitButton.addEventListener("click", function (e) {
      e.preventDefault();

      // Validate form before submit
      if (validator) {
        validator.validate().then(function (status) {
          if (status == "Valid") {
            submitButton.setAttribute("data-kt-indicator", "on");

            // Disable button to avoid multiple click
            submitButton.disabled = true;

            // Simulate ajax process
            setTimeout(function () {
              var form = new FormData($("#createForm")[0]);
              $.ajax({
                method: "POST",
                url: base_url + "bmr/store",
                dataType: "json",
                data: form,
                processData: false,
                contentType: false,
                success: function (result) {
                  if (result.response == 200) {
                    toastr.options = {
                      closeButton: false,
                      debug: false,
                      newestOnTop: true,
                      progressBar: false,
                      positionClass: "toastr-top-right",
                      preventDuplicates: true,
                      showDuration: "300",
                      hideDuration: "1000",
                      timeOut: "5000",
                      extendedTimeOut: "1000",
                      showEasing: "swing",
                      hideEasing: "linear",
                      showMethod: "fadeIn",
                      hideMethod: "fadeOut",
                    };

                    toastr.success(result.message);

                    submitButton.setAttribute("data-kt-indicator", "on");
                    submitButton.disabled = true;

                    window.setTimeout(function () {
                      $('#sectionResult').html(result.view);
                    }, 1000);

                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
                  } else {
                    toastr.options = {
                      closeButton: false,
                      debug: false,
                      newestOnTop: true,
                      progressBar: false,
                      positionClass: "toastr-top-right",
                      preventDuplicates: true,
                      showDuration: "300",
                      hideDuration: "1000",
                      timeOut: "5000",
                      extendedTimeOut: "1000",
                      showEasing: "swing",
                      hideEasing: "linear",
                      showMethod: "fadeIn",
                      hideMethod: "fadeOut",
                    };

                    toastr.error(result.message);

                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
                  }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  toastr.options = {
                    closeButton: false,
                    debug: false,
                    newestOnTop: true,
                    progressBar: false,
                    positionClass: "toastr-top-right",
                    preventDuplicates: true,
                    showDuration: "300",
                    hideDuration: "1000",
                    timeOut: "5000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                  };

                  toastr.error("Unexpected Error. Please try again.");

                  submitButton.removeAttribute("data-kt-indicator");
                  submitButton.disabled = false;
                },
              });
            }, 2000);
          } else {
            // Show error message.
            Swal.fire({
              text: "Sorry, looks like there are some errors detected, please try again.",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Ok",
              customClass: {
                confirmButton: "btn btn-primary",
              },
            });
          }
        });
      }
    });
  };

  return {
    // Public functions
    init: function () {
      // Elements
      form = document.querySelector("#createForm");
      submitButton = document.getElementById("submitForm");

      handleForm();
    },
  };
})();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  createForm.init();
});
