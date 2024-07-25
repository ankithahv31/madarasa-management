function UpdateStaffStatus(id, flag) {
  Swal.fire({
    title: "Are you sure?",
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
          id: id,
          flag: flag,
          command: "updateStaffStatus",
        },
        timeout: 10000,
        success: function () {
          document.location.reload();
        },
      });
    } else if (result.isDenied) {
    }
  });
}
function UpdateEventStatus(id, flag) {
  Swal.fire({
    title: "Are you sure?",
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
          id: id,
          flag: flag,
          command: "updateEventStatus",
        },
        timeout: 10000,
        success: function () {
          document.location.reload();
        },
      });
    } else if (result.isDenied) {
    }
  });
}
function UpdateAdmissionStatus(id, flag) {
  Swal.fire({
    title: "Are you sure?",
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
          id: id,
          flag: flag,
          command: "UpdateAdmissionStatus",
        },
        timeout: 10000,
        success: function () {
          document.location.reload();
        },
      });
    } else if (result.isDenied) {
    }
  });
}

function DisableCheckBoxes(DataArray) {
  $(".form-check-input").prop("disabled", false);

  var disabledValues = [];
  DataArray.forEach((element) => {
    var result = element.day + "," + element.sloat_id;
    disabledValues.push(result);
  });
  console.log(disabledValues);

  $(".form-check-input").each(function () {
    var checkboxValue = $(this).val();
    if (disabledValues.includes(checkboxValue)) {
      $(this).prop("checked", true).css("color", "red");
      $(this).prop("disabled", true);

      // checkboxValue.checked = true;

      $(this)
        .closest(".form-check")
        .find(".form-check-input")
        .addClass("disabled-checkbox");
    }
  });
}

function getSubject(Class) {
  var select = document.getElementById("subject");
  // Assuming you have multiple checkboxes with the class "myCheckbox"
  $(".form-check-input").prop("checked", false);

  if (Class == "") {
    select.length = 0;
    var newOption = document.createElement("option");
    newOption.value = "";
    newOption.text = "Select Subject";
    select.appendChild(newOption);
  } else {
    $.ajax({
      type: "GET",
      url: "../Action/adminAction.php",
      data: {
        class: Class,
        command: "getSubject",
      },
      timeout: 10000,
      success: function (data) {
        var jsonObject = JSON.parse(data);
        console.log(jsonObject);
        DisableCheckBoxes(jsonObject[1]);
        select.length = 0;
        var newOption = document.createElement("option");
        newOption.value = "";
        newOption.text = "Select Subject";
        select.appendChild(newOption);
        jsonObject[0].forEach((element) => {
          var newOption = document.createElement("option");
          newOption.value = element.id;
          newOption.text = element.sub_name;
          select.appendChild(newOption);
        });
      },
    });
  }
}

function SaveClass(e, id) {
  e.preventDefault();
  var checkedValues = [];
  var timetable = [];
  var subject = $("#subject").val();
  var Class = $("#class").val();
  $("input[type='checkbox']:checked").each(function () {
    checkedValues.push($(this).val());
  });

  if (checkedValues.length == "") {
    Swal.fire("Please select the sloat", "", "info");
  } else {
    checkedValues.forEach((data) => {
      var myString = data.split(",");

      timetable.push({
        day: myString[0],
        sloat: myString[1],
        staff: id,
        subject: subject,
        Class: Class,
      });
    });

    console.log(timetable);

    $.ajax({
      type: "POST",
      url: "../Action/adminAction.php",
      data: {
        datalist: timetable,
        command: "saveClass",
      },
      timeout: 10000,
      success: function (data) {
        Swal.fire("Successfully Saved", "", "success");
        console.log(data);
        setTimeout(function () {
          window.location.reload();
        }, 1000);
      },
    });
  }
}

function getClassData(year) {
  // alert(year);
  $(".form-check-input").prop("checked", false);
  $(".form-check-input").prop("disabled", false);

  var disabledValues = [];

  $.ajax({
    type: "GET",
    url: "../Action/adminAction.php",
    data: {
      year: year,
      command: "getAssignedClass",
    },
    timeout: 10000,
    success: function (data) {
      var jsonObject = JSON.parse(data);
      console.log(jsonObject);
      jsonObject.forEach((element) => {
        disabledValues.push(element.classid);
      });

      $(".form-check-input").each(function () {
        var checkboxValue = $(this).val();
        if (disabledValues.includes(checkboxValue)) {
          $(this).prop("checked", true).css("color", "red");
          $(this).prop("disabled", true);
        }
      });
    },
  });
}

// function getAssignClass(year, Staffid) {
//     var select = document.getElementById("class");
//     if (year == "") {
//         select.length = 0;
//         var newOption = document.createElement("option");
//         newOption.value = "";
//         newOption.text = "Select Class";
//         select.appendChild(newOption);
//     } else {
//         $.ajax({
//             type: "GET",
//             url: "../Action/staffAction.php",
//             data: {
//                 id: Staffid,
//                 year: year,
//                 command: "getAsgnedClass"
//             },
//             timeout: 10000,
//             success: function (data) {
//                 var jsonObject = JSON.parse(data);
//                 console.log(jsonObject);
//                 select.length = 0;
//                 var newOption = document.createElement("option");
// newOption.value = "";
// newOption.text = "Select Class";
// select.appendChild(newOption);
// jsonObject.forEach(element => {
//     var newOption = document.createElement("option");
//     newOption.value = element.classid;
//     newOption.text = element.classid + " Standard";
//     select.appendChild(newOption);
// });
//             }
//         });

//     }

// }

function getStudents(classid) {
  if (classid == "-1") {
    $("#mydiv").html("");
  } else {
    $.ajax({
      url: "customAttendance.php", // Replace "page.php" with the actual PHP page URL
      method: "GET",
      data: { Clas: classid },
      success: function (response) {
        $("#mydiv").html(response);
      },
      error: function () {
        console.log("Error loading PHP page.");
      },
    });
  }
}

$(document).ready(function () {
  $("#checkAll").click(function () {
    $(".checkbox").prop("checked", this.checked);
  });
});

function getReport(classid) {
  if (classid == "-1") {
    $("#mydiv").html("");
  } else {
    $.ajax({
      url: "customReport.php", // Replace "page.php" with the actual PHP page URL
      method: "GET",
      data: { Clas: classid },
      success: function (response) {
        $("#mydiv").html(response);
      },
      error: function () {
        console.log("Error loading PHP page.");
      },
    });
  }
}

function getAttendanceReport(e) {
  e.preventDefault();
  var Studentclass = $("#class").val();
  var Studentname = $("#student").val();
  var classdate = $("#date").val();
  var select = $("#student");
  var select2 = $("#date");
  $("#mydiv").html("");
  if (Studentclass == "-1") {
    alert("Student Class is required");
  } else if (Studentname == "-1" && classdate == "-1" && Studentclass == "-1") {
    clear(select, select2);

    $("#mydiv").html("");
  } else if (Studentname == "-1" && classdate == "-1") {
    $.ajax({
      type: "GET",
      url: "../Action/staffAction.php",
      data: {
        Studentclass: Studentclass,
        command: "getStudentNames",
      },
      timeout: 10000,
      success: function (data) {
        var jsonObject = JSON.parse(data);
        clear(select, select2);
        $.each(jsonObject[0], function (index, group) {
          select.append(
            $("<option>", {
              value: group.add_id,
              text: group.fname + " " + group.mname + " " + group.lname,
            })
          );
        });

        $.each(jsonObject[1], function (index, group) {
          select2.append(
            $("<option>", {
              value: group.days,
              text: group.days,
            })
          );
        });
        console.log(jsonObject);
      },
    });

    $.ajax({
      url: "customReport.php", // Replace "page.php" with the actual PHP page URL
      method: "GET",
      data: { Clas: Studentclass },

      success: function (response) {
        $("#mydiv").html(response);
      },
      error: function () {
        console.log("Error loading PHP page.");
      },
    });
  } else if (Studentname == "-1") {
    $("#mydiv").html("");

    $.ajax({
      url: "customdateReport.php", // Replace "page.php" with the actual PHP page URL
      method: "GET",
      data: {
        Clas: Studentclass,
        date: classdate,
      },

      success: function (response) {
        $("#mydiv").html(response);
      },
      error: function () {
        console.log("Error loading PHP page.");
      },
    });
  } else if (classdate == "-1") {
    $("#mydiv").html("");

    $.ajax({
      url: "classStudentAttreport.php", // Replace "page.php" with the actual PHP page URL
      method: "GET",
      data: {
        Clas: Studentclass,
        name: Studentname,
      },

      success: function (response) {
        $("#mydiv").html(response);
      },
      error: function () {
        console.log("Error loading PHP page.");
      },
    });
  } else {
    $.ajax({
      url: "classStudentClassDatereport.php", // Replace "page.php" with the actual PHP page URL
      method: "GET",
      data: {
        Clas: Studentclass,
        name: Studentname,
        date: classdate,
      },

      success: function (response) {
        $("#mydiv").html(response);
      },
      error: function () {
        console.log("Error loading PHP page.");
      },
    });
  }
}

function clear(select, select2) {
  select.empty();
  select.append(
    $("<option>", {
      value: -1,
      text: "Select Student",
    })
  );
  select2.empty();
  select2.append(
    $("<option>", {
      value: -1,
      text: "Select Date",
    })
  );
}

function UpdateLeaveStatus(leaveid, flag, type, days, staffId) {
  Swal.fire({
    title: "Are you sure?",
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
          id: leaveid,
          flag: flag,
          leaveType: type,
          days: days,
          staffId: staffId,
          command: "UpdateLeaveStatus",
        },
        timeout: 10000,
        success: function (res) {
          alert(res);
          document.location.reload();
        },
      });
    }
  });
}

var tempvalue = null;
var Tepes = null;
function GetAvalilableDays(type) {
  $("#days").val("");
  Tepes = type;
  $("#leavebutton").prop("disabled", true);

  if (type == "3") {
    $("#leavebutton").prop("disabled", false);
  } else {
    $.ajax({
      type: "GET",
      url: "../Action/staffAction.php",
      data: {
        type: type,
        command: "GetAvalilableDays",
      },
      timeout: 10000,
      success: function (data) {
        var jsonObject = JSON.parse(data);
        console.log(jsonObject);
        if (jsonObject.status) {
          $("#days").val(parseInt(jsonObject.days));
          $("#days").attr("min", parseInt(jsonObject.days));
          if (parseInt(jsonObject.days) > 0) {
            $("#leavebutton").prop("disabled", false);
          }
          tempvalue = parseInt(jsonObject.days);
        } else {
          alert("Please Contact Hm");
        }
        // $('#days').val(parseInt(data));
      },
    });
  }
}

function checkDays() {
  var fromDate = $("#from_date").val();
  var toDate = $("#to_date").val();
  var Type = $("#type").val();
  var Days = $("#Days").val();
  var description = $("#des").val();
  var days = $("#days").val();

  if (fromDate == "") {
    alert("From Date is required");
    return false;
  }
  if (toDate == "") {
    alert("To Date is required");
    return false;
  }
  if (Type == "-1") {
    alert("Leave Type is required");
    return false;
  }
  if (Days == "") {
    alert("Number Of Days is required");
    return false;
  }
  if (description == "") {
    alert("Description is required");
    return false;
  }

  if (Tepes == "3") {
    return true;
  } else if (tempvalue < days) {
    alert("You dont have enough leaves");
    return false;
  }
  return true;
}
