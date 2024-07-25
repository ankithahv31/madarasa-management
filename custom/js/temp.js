$(document).ready(function () {
  var currentDate = new Date().toISOString().split("T")[0];
  $("#from_date").attr("min", currentDate);
  $("#from_date").change(function () {
    var selectedDate = $(this).val();
    $("#to_date").val("");
    $("#to_date").attr("min", selectedDate);
  });
});
