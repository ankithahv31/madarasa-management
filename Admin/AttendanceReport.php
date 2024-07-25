<?php include 'navbar.php';
include '../db/db.class.php';
$db = new DB();
$currentYear = date("Y");
$sql = "SELECT * FROM classes";
$class = $db->executeSelect($sql);
?>

<div class="card container my-5 ">
    <form method="post" onsubmit="getAdminAttendanceReport(event);">
        <div class="text-center my-4">
            <h3>Attendance Report</h3>
        </div>
        <div class=" mt-4  text-center row mx-4 mb-4">
            <div class="col-lg-3 col-md-3 col-sm-12 my-2">
                <select class="form-select" aria-label="Default select example" id="class" name="class"  required>
                    <option selected value="-1">Select Class</option>
                    <?php foreach ($class as $row) { ?>
                        <option value="<?php echo $row['class_id'] ?>"><?php echo $row['class_id'] ?> Standard</option>
                    <?php  } ?>

                </select>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 attdiv my-2">
                <select class="form-select" aria-label="Default select example" id="student" name="student"  required>
                    <option selected value="-1">Select Student</option>
                   

                </select>
            </div>
            <div class="col-lg-3 col-md-3 col-12 my-2 ">
                <select class="form-select" aria-label="Default select example" id="date" name="date"  required>
                    <option selected value="-1">Select Date</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-3 col-12 my-2">
                <button type="submit" class="btn text-white px-5 me-3" style="background-color:purple">Search</button>

            </div>
        </div>
        <div class="mydiv" id="mydiv">

        </div>
    </form>
</div>


<?php include '../include/footer.php'; ?>