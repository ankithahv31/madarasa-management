<?php include '../Admin/navbar.php';
include '../db/db.class.php';
$db = new DB();
$sql = "SELECT * FROM staff_leave 
JOIN leave_types ON leave_types.T_id=staff_leave.type ORDER BY l_id DESC";
$res = $db->executeSelect($sql);

?>

<div class="ms-5 mt-5">
    <h2 class="text-dark" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Staff Leave Management</h2>
</div>

<div class="card container my- ">
    <div class="mt-4 table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">From Date</th>
                    <th scope="col">To Date</th>
                    <th scope="col">Type</th>
                    <th scope="col">Days</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($res) > 0) {
                    $count = 0;
                    foreach ($res as $row) {
                        $count++; ?>
                        <tr>
                            <th scope="row"><?php echo $count ?></th>
                            <td><?php echo $row['from_date'] ?></td>
                            <td><?php echo $row['to_date'] ?></td>
                            <td><?php echo $row['T_name'] ?></td>
                            <td><?php echo $row['days'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php if ($row['status'] == 1) { ?>
                                    <span class="text-success">Approved</span>
                                <?php } else if ($row['status'] == 0) { ?>
                                    <span class="text-warning">Pending..</span>
                                <?php } else { ?>
                                    <span class="text-danger">Rejected</span>
                                <?php } ?>
                            </td>
                            <td><?php if ($row['status'] == 1) { ?>
                                    <button class="btn btn-dark">Success</button>
                                <?php } else if ($row['status'] == 0) { ?>
                                    <button class="btn btn-success my-1" onclick="UpdateLeaveStatus('<?php echo $row['l_id'] ?>','1','<?php echo $row['type'] ?>',<?php echo $row['days'] ?>,'<?php echo$row['staff_id']?>');">Accept</button>
                                    <button class="btn btn-warning my-1" onclick="UpdateLeaveStatus('<?php echo $row['l_id'] ?>','2','<?php echo $row['type'] ?>',<?php echo $row['days'] ?>,'<?php echo$row['staff_id']?>');">Deny</button>
                                <?php } else { ?>
                                    <button class="btn btn-danger my-1">Rejected</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="12" class="text-center text-danger py-4">
                            <b> No Records Found</b>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>









<?php include '../include/footer.php' ?>