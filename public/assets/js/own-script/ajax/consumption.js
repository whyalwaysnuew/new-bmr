function addConsumption() {
  $.ajax({
    url: base_url + 'consumption/create',
    type: 'GET',
    success: (result) => {
      $('#sectionModal').modal('show'), $('#modalContent').html(result);
    },
  });
}

$(document).on('click', '#edit-data', function () {
  let id = $(this).attr('data-id');

  $.ajax({
    url: base_url + 'consumption/edit',
    type: 'GET',
    data: { id: id },
    success: (result) => {
      $('#sectionModal').modal('show'), $('#modalContent').html(result);
    },
  });
});

$(document).on('click', '#delete-data', function () {
  let id = $(this).attr('data-id');

  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Delete",
    cancelButtonText: "Cancel",
    reverseButtons: false,
    buttonsStyling: true,
    customClass: {
      confirmButton: "btn btn-danger",
      cancelButton: "btn btn-primary",
    },
  }).then((result) => {
    if (result.isConfirmed == true) {
      $.ajax({
        method: "GET",
        url: base_url + "consumption/delete?id=" + id,
      }).done(function (data) {
        Swal.fire(
          "Deleted!",
          "Your data is deleted from the servers",
          "success"
        ).then((result) => {
          location.reload();
        });
      });
    } else if (result.dismiss === "cancel") {
      Swal.fire({
        title: "Cancelled!",
        text: "Your data is safe.",
        icon: "error",
        customClass: {
          confirmButton: "btn btn-primary",
        },
      });
    }
  });
});
