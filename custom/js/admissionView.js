$(function () {
  getAddmissonData();

  $("#firstName").keyup(function (event) {
    getAddmissonData();
  });
});

function getAddmissonData() {
  var fname = $("#firstName").val();
  $.ajax({
    type: "GET",
    url: "../Admin/custom_admission_view.php",
    data: {
      fname: fname,
    },
    timeout: 10000,
    success: function (data) {
      $("#AddmissonData").html(data);
    },
  });
}

function DeleteStudent(StudentId) {
  Swal.fire({
    title: "Are you sure? This will cannot be reverted",
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: "Yes",
    denyButtonText: "No",
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "../Action/adminAction.php",
        data: {
          id: StudentId,
          command: "deleteStudent",
        },
        timeout: 10000,
        success: function (responce) {
          console.log(responce);
          if (responce == 1) {
            Swal.fire({
              icon: "success",
              title: "Success!",
              text: "Successfully Removed.",
            });

            setTimeout(function () {
              document.location.reload();
            }, 1000);
          } else {
            Swal.fire({
              title: "Error",
              text: "Something went wrong.",
              icon: "error",
              button: "OK",
            });
          }
          //   document.location.reload();
        },
      });
    } else if (result.isDenied) {
    }
  });
}
