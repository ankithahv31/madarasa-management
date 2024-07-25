<?php
require_once '../db/db.class.php';
$db = new DB();
$count = 0;
$res = [];
$firstname = $_GET['fname'];
if ($firstname == "") {
    $query = "SELECT * FROM admission_form ORDER BY add_id DESC";
} else {
    $query = "SELECT * FROM admission_form WHERE lname LIKE '%$firstname%' ORDER BY add_id DESC";
}
$res = $db->executeSelect($query); ?>


<?php if (count($res) > 0) {
    foreach ($res as $row) {
        $count++; ?>
        <tr>
            <th scope="row"><?php echo $count ?></th>
            <td><img src="../media/Admission/<?php echo $row['image_name'] ?>" width="50" height="50" alt="avathar"></td>
            <td><?php echo $row['fname'] ?> <?php echo $row['mname'] ?> <?php echo $row['lname'] ?></td>
            <td><?php echo $row['gender'] ?></td>
            <td><?php echo $row['father_mother_name'] ?></td>
            <td><?php echo $row['pname_add_contact'] ?></td>
            <td><?php echo $row['stud_dob'] ?></td>
            <td><?php echo $row['stud_admn_class'] ?> Standard</td>
            <td><?php if ($row['status'] == 1) { ?>
                    <span class="text-success">Completed</span>
                <?php } else { ?>
                    <span class="text-danger">Pending..</span>
                <?php } ?>
            </td>
            <td><?php if ($row['status'] == 1) { ?>
                    <button type="button" class="btn btn-danger d-flex align-items-center" onclick="DeleteStudent('<?php echo $row['add_id'] ?>');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                        </svg>
                        Delete</button>
                <?php } else { ?>
                    <button type="button" class="btn btn-success" onclick="UpdateAdmissionStatus(<?php echo $row['add_id'] ?>,'1')">Complete</button>
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