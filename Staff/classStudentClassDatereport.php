<?php include '../db/db.class.php';
$db = new DB();
$classId = $_GET['Clas'];
$date = $_GET['date'];
$studentId = $_GET['name'];
// $sql = "SELECT COUNT(DISTINCT DATE) AS totalclass FROM attendance WHERE studentclass=$classId";
// $result = $db->executeSelect($sql);
$count = 1;

$query = "SELECT * FROM attendance 
JOIN admission_form ON admission_form.add_id=attendance.student_id
WHERE studentclass=$classId AND attendance.date='$date' AND student_id=$studentId";
$result2 = $db->executeSelect($query);

?>
<form method="post" action="../Action/staffAction.php">
    <input type="text" value="saveattendance" name="command" hidden>
    <input type="text" value="<?php echo $classId ?>" name="Studentclass" hidden>
    <div class="">
        <!-- <div class="d-flex justify-content-end row me-3 text-center">
            <label class="col-md-3 mt-2 text-center"><b>Total Class:</b></label>
            <input type="text" value="<?php echo $result[0]['totalclass'] ?>" class="form-control w-25 col-md-2 text-center" readonly>
        </div> -->
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Is_Present</th>
                    <!-- <th scope="col">Percentage</th> -->
                </tr>
            </thead>
            <tbody>
                <?php if (count($result2) > 0) {
                    foreach ($result2 as $row) {
                        if ($row['attendance'] == 1) {
                            $present = '<span class="text-success">Present</span>';
                        } else {
                            $present = '<span class="text-danger">Absent</span>';
                        }


                ?>
                        <tr>
                            <td><?php echo $count++ ?></td>
                            <td><?php echo $row['fname'] ?> <?php echo $row['mname'] ?> <?php echo $row['lname'] ?></td>
                            <td>
                                <?php echo    $present ?>
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

    </div>
</form>