<?php include '../db/db.class.php';
$db = new DB();
$classId = $_GET['Clas'];
$sql = "SELECT COUNT(DISTINCT DATE) AS totalclass FROM attendance WHERE studentclass=$classId";
$result = $db->executeSelect($sql);
$count = 1;

$query = "SELECT DISTINCT(admission_form.add_id),admission_form.* FROM attendance 
JOIN admission_form ON admission_form.add_id=attendance.student_id
WHERE studentclass=$classId";
$result2 = $db->executeSelect($query);

?>
<form method="post" action="../Action/staffAction.php">
    <input type="text" value="saveattendance" name="command" hidden>
    <input type="text" value="<?php echo $classId ?>" name="Studentclass" hidden>
    <div class="">
        <div class="d-flex justify-content-end row me-3 text-center">
            <label class="col-md-3 mt-2 text-center"><b>Total Class:</b></label>
            <input type="text" value="<?php echo $result[0]['totalclass'] ?>" class="form-control w-25 col-md-2 text-center" readonly>
        </div>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Total Present</th>
                    <th scope="col">Percentage</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($result2) > 0) {
                    foreach ($result2 as $row) {
                        $Present = "SELECT SUM(attendance) AS totalpresent FROM attendance WHERE student_id='" . $row['add_id'] . "'  AND studentclass=$classId AND attendance=1";
                        $result3 = $db->executeSelect($Present);
                        if ($result3[0]['totalpresent'] == "") {
                            $totalpresent = 0;
                        } else {
                            $totalpresent = $result3[0]['totalpresent'];
                        }
                        $percentage = ($totalpresent / $result[0]['totalclass']) * 100;

                ?>
                        <tr>
                            <td><?php echo $count++ ?></td>
                            <td><?php echo $row['fname'] ?> <?php echo $row['mname'] ?> <?php echo $row['lname'] ?></td>
                            <td>
                                <?php echo    $totalpresent ?>
                            </td>
                            <td><?php echo  $percentage ?>%</td>
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
                <!-- <div class="col-md-3 d-flex justify-content-end">
                    <button type="submit" class="btn text-white px-5 me-3" style="background-color:purple">Save</button>

                </div> -->


            </div>
        <?php } ?>
    </div>
</form>