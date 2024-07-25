<?php include '../db/db.class.php';
$db = new DB();
$classId = $_GET['Clas'];
$sql = "SELECT * FROM admission_form WHERE student_class=$classId AND STATUS=1";
$result = $db->executeSelect($sql);
$count = 1;

?>
<form method="post" action="../Action/staffAction.php">
    <input type="text" value="saveattendance" name="command" hidden>
    <input type="text" value="<?php echo $classId ?>" name="Studentclass" hidden>
    <div class="">

        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Attendance</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($result) > 0) {
                    foreach ($result as $row) {
                ?>
                        <tr>
                            <td><?php echo $count++ ?></td>
                            <td><?php echo $row['fname'] ?> <?php echo $row['mname'] ?> <?php echo $row['lname'] ?></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input " type="hidden" name="checkbox[<?php echo $row['add_id'] ?>]" value="0" id="flexCheckIndeterminate">
                                    <input class="form-check-input " type="checkbox" name="checkbox[<?php echo $row['add_id'] ?>]" value="1" id="flexCheckIndeterminate">
                                </div>
                            </td>
                        </tr>

                    <?php  }
                } else { ?>
                    <tr>
                        <td colspan="12" class="text-center text-danger py-4">
                            <b> No Records Found</b>
                        </td>
                    </tr>
                <?php   } ?>
            </tbody>
        </table>
        <?php if (count($result) > 0) { ?>
            <div class="d-flex justify-content-end row">
                <!-- <div class="col d-flex justify-content-end">
                    <div class="form-check mt-2">
                    Check All<input class="form-check-input " type="checkbox" id="checkAll">

                    </div>

                </div> -->
                <div class="col-md-3 d-flex justify-content-end">
                    <button type="submit" class="btn text-white px-5 me-3" style="background-color:purple">Save</button>

                </div>


            </div>
        <?php } ?>
    </div>
</form>