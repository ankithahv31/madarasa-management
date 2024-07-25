<?php include '../Admin/navbar.php' ?>
<?php require_once '../db/db.class.php';
$db = new DB();
$count = 0;
$sql3 = "SELECT * FROM classes";
$sql = "SELECT *  FROM year";
$class = $db->executeSelect($sql3);
$year = $db->executeSelect($sql);
?>
<div class="container card my-5 result">
    <div class="text-center mt-5">
        <h3>Upload Result</h3>
    </div>
    <form method="post" enctype="multipart/form-data" action="../Action/adminAction.php">
        <input type="text" value="SaveResult" name="command" hidden>
        <div class="mx-2 mb-2 mt-2">
            <label for="exampleFormControlInput1" class="form-label text2"><b>Class</b></label>
            <select class="form-select" aria-label="Default select example" id="class" name="class" required>
                <option selected value="-1">Select Class</option>
                <?php foreach ($class as $row) { ?>
                    <option value="<?php echo $row['class'] ?>"><?php echo $row['class'] ?> Standard</option>
                <?php  } ?>

            </select>
        </div>
        <div class="mx-2 mb-2 mt-2">
            <label for="exampleFormControlInput1" class="form-label text2"><b>Year</b></label>
            <select class="form-select" aria-label="Default select example" id="year" name="year" required>
                <option selected value="-1">Select Year</option>
                <?php foreach ($year as $row2) { ?>
                    <option value="<?php echo $row2['year_id'] ?>"><?php echo $row2['year'] ?></option>
                <?php  } ?>

            </select>
        </div>
        <div class="mx-2 mb-2 mt-2">
            <label for="exampleFormControlInput1" class="form-label text2"><b>Document</b></label>
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="document" name="document" accept=".pdf,.doc,.docx" required>
            </div>
        </div>
        <div class="mx-2 mb-4 mt-4 pb-2">
            <button type="submit" class="btn px-5 text-white w-100" style="background-color:purple;" onclick="return UploadResultValidation();">Upload</button>

        </div>
    </form>
</div>
<?php include '../include/footer.php'?>