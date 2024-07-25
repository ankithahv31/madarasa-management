<?php include 'navbar.php';
include '../db/db.class.php';
$db = new DB();
$StaffId = $_SESSION['Staffid'];
$currentYear = date("Y");
$sql = "SELECT * FROM asign_class WHERE staff_id= $StaffId AND YEAR=$currentYear ORDER BY classid ASC ";
$year = $db->executeSelect($sql);
?>

<div class="card container my-5 login-card">
    <div class="text-center my-4">
        <h3>Attendance</h3>
    </div>
    <div class=" mt-4  text-center row mx-4 mb-4">
        <!-- <div class="col">
            <select class="form-select" aria-label="Default select example" id="year" onchange="getAssignClass(this.value,<?php echo $StaffId ?>);" required>
                <option selected value="">Select Year</option>
                <?php foreach ($year as $row) { ?>
                    <option value="<?php echo $row['yearid'] ?>"><?php echo $row['year'] ?></option>
                <?php  } ?>

            </select>
        </div> -->
        <div class="col">
            <select class="form-select" aria-label="Default select example" id="class" name="class" onchange="getStudents(this.value);" required>
                <option selected value="-1">Select Class</option>
                <?php foreach ($year as $row) { ?>
                    <option value="<?php echo $row['classid'] ?>"><?php echo $row['classid'] ?> Standard</option>
                <?php  } ?>

            </select>
        </div>
        <!-- <div class="col">
            <button type="submit" class="btn px-5 text-white w-100 mx-3" style="background-color:purple;">Search</button>

        </div> -->

    </div>

    <div class="mydiv mx-2 mb-5 table-responsive" id="mydiv">

    </div>
</div>


<?php include '../include/footer.php'; ?>