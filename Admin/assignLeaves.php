<?php include 'navbar.php';
require_once '../db/db.class.php';
$db = new DB();
$count = 0;
$res = [];
$currentYear = date('Y');
$query = "SELECT * FROM leave_manage JOIN staff ON staff.id=leave_manage.staff_id";
$res = $db->executeSelect($query);

$STaffIdsList = "SELECT staff_id FROM leave_manage WHERE year='$currentYear'";
$Result = $db->executeSelect($STaffIdsList);
$commaSeparatedIds = 0;
$excludedIds = [];
if (count($Result) > 0) {
    foreach ($Result as $row) {
        array_push($excludedIds, $row['staff_id']);
    }
    $commaSeparatedIds = implode(", ", $excludedIds);
}

$sql = "SELECT * FROM staff WHERE id NOT IN ($commaSeparatedIds)";
$StaffData = $db->executeSelect($sql);
?>

<div class="ms-5 mt-5">
    <h2 class="text-dark" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Assign Leave</h2>
</div>

<div class="container mt-5 d-flex flex-row-reverse my-2">
    <button type="button" class="btn  btn-primary py-2 px-5 text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <span class="mx-1 my-auto">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
            </svg></span>
        Assign</button>
</div>
<div class="container card table-responsive tablecards my-2">
    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Staff Image</th>
                <th scope="col">Staff Name</th>
                <th scope="col">Year</th>
                <th scope="col">Earned Leaves</th>
                <th scope="col">Casual Leaves</th>
                <th scope="col">Total Leaves</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if (count($res) > 0) {
                foreach ($res as $row) {
                    $count++;
            ?><tr>
                        <th scope="row"><?php echo $count ?></th>
                        <td><img src="../media/Staff/<?php echo $row['image'] ?>" width="50" height="50" alt="avathar"></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['year'] ?></td>
                        <td><?php echo $row['total_EL'] ?></td>
                        <td><?php echo $row['total_CL'] ?></td>
                        <td><?php echo $row['total_EL'] + $row['total_CL'] ?></td>

                    </tr>
                <?php }
            } else {
                ?>

                <tr>
                    <td colspan="12" class="text-center text-danger py-4">
                        <b> No Records Found</b>
                    </td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-group" method="post" action="../Action/adminAction.php" enctype="multipart/form-data">
                <input type="text" value="AssignLeave" name="command" id="command" hidden>
                <div class="modal-header">
                    <div class="d-flex flex-grow-1 justify-content-center align-items-center">
                        <h4 class="modal-title " id="staticBackdropLabel">Assign Leaves</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body my-2">
                    <div class="mx-2 mb-2">
                        <label for="exampleFormControlInput1" class="form-label text2"><b>Staff Name</b></label>
                        <select class="form-select" aria-label="Default select example" id="staff" name="staff" required>
                            <option selected value="">Select Staff</option>
                            <?php foreach ($StaffData as $row) { ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php  } ?>
                        </select>
                    </div>

                    <div class="mx-2 mb-2">
                        <label for="exampleFormControlInput1" class="form-label text2"><b>Earned Leaves</b></label>
                        <select class="form-select" aria-label="Default select example" id="total_el" name="total_el" required>
                            <?php for ($i = 1; $i < 11; $i++) {
                            ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php  } ?>
                        </select>
                    </div>

                    <div class="mx-2 mb-1">
                        <label for="exampleFormControlInput1" class="form-label text2"><b>Casual Leaves</b></label>
                        <select class="form-select" aria-label="Default select example" id="total_cl" name="total_cl" required>
                            <?php for ($i = 1; $i < 11; $i++) {
                            ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php  } ?>
                        </select>
                        <!-- <input type="number" class="form-control" id="total_cl" name="total_cl" placeholder="CL" required> -->
                    </div>
                </div>
                <div class="mx-2 mb-2 ms-4">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" required>
                    <small>Cannot get altered once get saved</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn text-dark buttons bg-info">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include '../include/footer.php' ?>