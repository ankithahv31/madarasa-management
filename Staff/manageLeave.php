<?php include 'navbar.php';
include '../db/db.class.php';
$db = new DB();
$StaffId = $_SESSION['Staffid'];
$sql = "SELECT * FROM staff_leave 
JOIN leave_types ON leave_types.T_id=staff_leave.type
WHERE staff_id=$StaffId ORDER BY l_id DESC";
$res = $db->executeSelect($sql);

$type = "SELECT * FROM leave_types";
$LeaveTyeps = $db->executeSelect($type);
?>

<div class="ms-5 mt-5">
    <h2 class="text-dark" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Leave Management</h2>
</div>

<div class="container mt-5 d-flex flex-row-reverse my-2">
    <button type="button" class="btn  btn-primary py-2 px-5 text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <span class="mx-1 my-auto">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
            </svg></span>
        Apply Leave</button>
</div>
<div class="card container">
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-group" method="post" action="../Action/staffAction.php" enctype="multipart/form-data">
                <input type="text" value="applyLeave" name="command" id="command" hidden>


                <div class="modal-header">
                    <div class="d-flex flex-grow-1 justify-content-center align-items-center">
                        <h4 class="modal-title " id="staticBackdropLabel"> Apply Leave</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body my-2">

                    <div class="mx-2 mb-2">
                        <label for="exampleFormControlInput1" class="form-label text2"><b>From Date</b></label>
                        <input type="date" class="form-control" id="from_date" name="from_date" required>
                    </div>
                    <div class="mx-2 mb-2">
                        <label for="exampleFormControlInput1" class="form-label text2"><b>To Date</b></label>
                        <input type="date" class="form-control" id="to_date" name="to_date" required>
                    </div>
                    <div class="mx-2 mb-2">
                        <label for="exampleFormControlInput1" class="form-label text2"><b>Leave Type</b></label>
                        <select class="form-select" aria-label="Default select example" id="type" name="type" required onchange="GetAvalilableDays(this.value);">
                            <option selected value="-1">Select Type</option>
                            <?php foreach ($LeaveTyeps as $row) { ?>
                                <option value="<?php echo $row['T_id'] ?>"><?php echo $row['T_name'] ?></option>
                            <?php  } ?>

                        </select>
                    </div>

                    <div class="mx-2 mb-2">
                        <label for="exampleFormControlInput1" class="form-label text2"><b>No Of Days</b></label>
                        <input type="number" class="form-control" id="days" name="days" placeholder="Days" minlength="10" maxlength="10" required>
                    </div>

                    <div class="mx-2 mb-4">
                        <label for="exampleFormControlInput1" class="form-label text2"><b>Description</b></label>
                        <textarea class="form-control" id="des" name="des" rows="3" required></textarea>
                    </div>
                    <div class="mx-2 mb-2 ">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" required>
                        <small> Cannot get altered once get Applied</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" id="leavebutton" class="btn text-dark buttons bg-info" onclick="return checkDays();">Apply</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../include/footer.php' ?>