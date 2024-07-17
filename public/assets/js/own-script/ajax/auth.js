$('#buttonRegister').on('click', function (){
    var form = new FormData($('#FormRegister')[0]);
    let username = $('#usernameRegister').val();
    let name = $('#name').val();
    let password = $('#passwordRegister').val();
    let password2 = $('#password_2').val();
    var button = $('#buttonRegister');

    button.html('Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span>').attr('disabled', true);

    if(name && username && password && password2 ){
      if(password == password2){
        $.ajax({
          url: base_url + "auth/register",
          method: "POST",
          data: form,
          processData: false,
          contentType: false,
          dataType: "json",
          success: (result) => {
            if(result.response == 400)
            {
                Swal.fire('Error!', result.message, 'error')
            } else {
                Swal.fire(
                    'Success!',
                    result.message, 
                    'success'
                ).then(() => {
                    window.location.reload();
                });
            }
          },
          complete: () => {
            button
              .html('<span class="indicator-label">Register</span>')
              .attr("disabled", false);
          },
          error: () => {
            Swal.fire(
                'Error!',
                'Something went wrong! Please try again.',
                'error'
            );
          },
        });
      } else {
        Swal.fire('Error!', 'Password Confirmation doesn`t match!', 'error');
      }
    } else {
        Swal.fire('Error!', 'All input should not be null', 'error');

    }
    button
          .html('<span class="indicator-label">Register</span>')
          .attr("disabled", false);
});

$('#buttonLogin').on('click', function (){
    var form = new FormData($('#FormLogin')[0]);
    let username = $('#usernameLogin').val();
    let password = $('#passwordLogin').val();
    var button = $('#buttonLogin');

    button
      .html(
        'Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span>'
      )
      .attr("disabled", true);

    if(username && password){
        $.ajax({
          url: base_url + "auth/login",
          method: "POST",
          data: form,
          processData: false,
          contentType: false,
          dataType: "json",
          success: (result) => {
            if(result.response == 200)
            {
                Swal.fire(
                    'Authentication Success!',
                    result.message,
                    'success'
                );
                
                window.setTimeout(() => {
                    window.location.href = base_url;
                }, 2000);
            } else {
                Swal.fire(
                    'Authentication Failed!',
                    result.message,
                    'error'
                );
            }
          },
          complete: () => {
            button
              .html('<span class="indicator-label">Login</span>')
              .attr("disabled", false);
          },
          error: () => {
            Swal.fire(
                'Error!',
                'Something went wrong. Please try again.',
                'error'
            )
          }
        });
    } else {
        Swal.fire(
            'Error!',
            'Required Username and Password.',
            'error'
        );

        button
          .html('<span class="indicator-label">Login</span>')
          .attr("disabled", false);
    }
});