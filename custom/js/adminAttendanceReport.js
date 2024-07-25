function getAdminAttendanceReport(e) {
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
        url: "../Staff/customReport.php", // Replace "page.php" with the actual PHP page URL
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
        url: "../Staff/customdateReport.php", // Replace "page.php" with the actual PHP page URL
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
        url: "../Staff/classStudentAttreport.php", // Replace "page.php" with the actual PHP page URL
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
        url: "../Staff/classStudentClassDatereport.php", // Replace "page.php" with the actual PHP page URL
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