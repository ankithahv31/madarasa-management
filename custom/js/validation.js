var nameRegex = /^[a-zA-Z\s']+$/;
var contactregex = /^[0-9]{10}$/;
var emailPattern = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;

function AddStaffValidation() {
  var staffname = $("#name").val();
  var contact = $("#Contact").val();
  var email = $("#email").val();
  var password = $("#password").val();
  var address = $("#address").val();
  var image = $("#image").val();

  if (staffname == "") {
    alert("Please enter the staff name");
    return false;
  }
  if (!nameRegex.test(staffname)) {
    alert("Name should only contain letter and white spaces");
    return false;
  }
  if (contact == "") {
    alert("Please enter the staff contact");
    return false;
  }
  if (!contactregex.test(contact)) {
    alert("Invalid Contact Number");
    return false;
  }
  if (email == "") {
    alert("Please enter the staff email");
    return false;
  }
  if (!emailPattern.test(email)) {
    alert("Invalid Emal Id");
    return false;
  }

  if (password == "") {
    alert("Please enter the password");
    return false;
  }
  if (password.length < 8) {
    alert("Password must be at least 8 characters long");
    return false;
  }
  if (address == "") {
    alert("Please enter the staff address");
    return false;
  }
  if (image == "") {
    alert("Please select the staff image");
    return false;
  }

  return true;
}

function EventValidation() {
  var title = $("#title").val();
  var date = $("#date").val();
  var time = $("#time").val();
  var venue = $("#Venue").val();
  var description = $("#description").val();
  var image = $("#image").val();

  if (title == "") {
    alert("Please enter the event title");
    return false;
  }
  if (date == "") {
    alert("Please enter the event date");
    return false;
  }
  if (time == "") {
    alert("Please enter the event time");
    return false;
  }
  if (venue == "") {
    alert("Please enter the event venue");
    return false;
  }
  if (description == "") {
    alert("Please enter the event description");
    return false;
  }
  if (image == "") {
    alert("Please select the event image");
    return false;
  }

  return true;
}

function NewAdmissionValidation() {
  var fname = $("#fname").val();
  var lname = $("#lname").val();
  // var mname = $("#mname").val();
  var fatherORmothername = $("#f_or_mname").val();
  var home_name = $("#hname").val();
  var parentRelation = $("#parent_rel").val();
  var parentNameANDAddress = $("#p_add_contatc").val();
  var parentsJOb = $("#parent_job").val();
  var bodyMark = $("#body_mark").val();
  // var prevMadrasaName = $("#prev_name").val();
  var acceptanceNo = $("#acc_date").val();
  // var tcNoandDate = $("#tc_date").val();
  var parentContact = $("#contct").val();
  var parentemail = $("#email").val();
  var studDob = $("#dob").val();
  var admissionClass = $("#adm_class").val();
  var studGender = $("#gender").val();
  var image = $("#image").val();

  if (fname == "") {
    alert("First Name is required");
    return false;
  }
  if (!nameRegex.test(fname)) {
    alert("Name should only contain letter and white spaces");
    return false;
  }
  // if (mname == "") {
  //   alert("Middle Name is required");
  //   return false;
  // }
  // if (!nameRegex.test(mname)) {
  //   alert("Name should only contain letter and white spaces");
  //   return false;
  // }
  if (lname == "") {
    alert("Last Name is required");
    return false;
  }
  if (!nameRegex.test(lname)) {
    alert("Name should only contain letter and white spaces");
    return false;
  }
  if (fatherORmothername == "") {
    alert("Father/Mother Name is required");
    return false;
  }
  if (!nameRegex.test(fatherORmothername)) {
    alert("Name should only contain letter and white spaces");
    return false;
  }
  if (home_name == "") {
    alert("Home Name is required");
    return false;
  }
  if (parentRelation == "") {
    alert("Parent Relation With Student is required");
    return false;
  }
  if (parentNameANDAddress == "") {
    alert("Parents Name & Address is required");
    return false;
  }
  if (parentsJOb == "") {
    alert("Parents Job is required");
    return false;
  }
  if (bodyMark == "") {
    alert("Body Mark is required");
    return false;
  }
  // if (prevMadrasaName == "") {
  //   alert("Previous Madarasa Name is required");
  //   return false;
  // }
  if (acceptanceNo == "") {
    alert("Acceptance No & Date is required");
    return false;
  }
  // if (tcNoandDate == "") {
  //   alert("T.C No & Date is required");
  //   return false;
  // }
  if (parentContact == "") {
    alert("Parents Contact Number is required");
    return false;
  }
  if (!contactregex.test(parentContact)) {
    alert("Invalid Contact Number");
    return false;
  }
  if (parentemail == "") {
    alert("Parents Email Id is required");
    return false;
  }
  if (!emailPattern.test(parentemail)) {
    alert("Invalid Emal Id");
    return false;
  }
  if (studDob == "") {
    alert("Student Date Of Birth is required");
    return false;
  }
  if (admissionClass == "-1") {
    alert("Student Admission class is required");
    return false;
  }
  if (studGender == "-1") {
    alert("Student Gender is required");
    return false;
  }
  if (image == "") {
    alert("Student Image is required");
    return false;
  }
  return true;
}

function UploadResultValidation() {
  var StudentClass = $("#class").val();
  var year = $("#year").val();
  var document = $("#document").val();
  if (StudentClass == "-1") {
    alert("Class is required");
    return false;
  }
  if (year == "-1") {
    alert("Year is required");
    return false;
  }
  if (document == "") {
    alert("Please select the result document");
    return false;
  }
  return true;
}


