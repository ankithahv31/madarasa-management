<?php include '../Admin/navbar.php';
require_once '../db/db.class.php';
$db = new DB();
$staffid = $_GET['staffId'];
?>
<?php
$sql1 = "SELECT * FROM year";
$sql3 = "SELECT * FROM classes";
$year = $db->executeSelect($sql1);
$class = $db->executeSelect($sql3);
?>

<div class="card container my-5 w-50">
    <div class="text-center my-4">
        <h3>Assign Class</h3>
    </div>
    <form method="post" action="../Action/adminAction.php">
        <input type="text" value="AssignClass" name="command" hidden>
        <input type="text" value="<?php echo $staffid ?>" name="staffid" hidden>
        <div class="mx-2 mb-3">
            <label for="exampleFormControlInput1" class="form-label text2"><b>Year</b></label>
            <select class="form-select" aria-label="Default select example" id="year" name="year" onchange="getClassData(this.value);" required>
                <option selected value="">Select Year</option>
                <?php foreach ($year as $row) { ?>
                    <option value="<?php echo $row['year'] ?>"><?php echo $row['year'] ?></option>
                <?php  } ?>

            </select>
        </div>
        <div class="mx-2 mb-3">
            <label for="exampleFormControlInput1" class="form-label text2"><b>Class</b></label>
            <div class="row  py-2 mx-1" style="border: 1px solid #d9d7d7;">
                <?php foreach ($class as $row) { ?>
                    <div class="col-md-3 mt-2">
                        <div class="form-check">
                            <label for="exampleFormControlInput1" class="form-label text2"><b><?php echo $row['class'] ?> Standard</b></label>
                            <input class="form-check-input " type="checkbox" name="checkbox[]" value="<?php echo $row['class'] ?>" id="flexCheckIndeterminate">
                        </div>
                    </div>
                <?php  } ?>

            </div>
        </div>

        <div class="mx-2 mb-5 text-center d-flex justify-content-center mt-3">
            <button type="submit" class="btn px-5 text-white w-100" style="background-color:purple;">Assign</button>

        </div>
    </form>
</div>


<?php include '../include/footer.php' ?>