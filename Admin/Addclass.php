<?php include '../Admin/navbar.php';
require_once '../db/db.class.php';
$db = new DB();
$staffid=$_GET['staffId'];
?>

<?php
$sql1 = "SELECT * FROM days";
$sql2 = "SELECT * FROM sloats";
$sql3 = "SELECT * FROM classes";
$days = $db->executeSelect($sql1);
$sloats = $db->executeSelect($sql2);
$class = $db->executeSelect($sql3);

?>




<div class="container mt-5 card">
    <form method="post" action="" onsubmit="SaveClass(event,<?php echo $staffid ?>);">
        <div class="container mt-4  text-center row">
            <div class="col">
                <select class="form-select" aria-label="Default select example" id="class" onchange="getSubject(this.value);" required>
                    <option selected value="">Select Class</option>
                    <?php foreach ($class as $row) { ?>
                        <option value="<?php echo $row['class'] ?>"><?php echo $row['class'] ?> Standard</option>
                    <?php  } ?>

                </select>
            </div>
            <div class="col">
                <select class="form-select" aria-label="Default select example" id="subject" name="subject" required>
                    <option selected>Select Subject</option>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn px-5 text-white w-100 mx-3" style="background-color:purple;">Save</button>

            </div>

        </div>

        <div class="my-2 card-body">
            <table class="table table-bordered mt-2">
                <thead class="bg-info text-dark" style="height: 60px;">
                    <tr class="text-center">
                        <th scope="col">Day</th>
                        <?php foreach ($sloats as $data) { ?>
                            <th scope="col"><?php echo $data['Slot'] ?></th>
                        <?php
                        } ?>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($days as $day) { ?>
                        <tr>
                            <th scope="row"><?php echo $day['day'] ?></th>
                            <?php foreach ($sloats as $data) { ?>
                                <td class="me-auto text-center">
                                    <div class="form-check d-flex justify-content-center text-center">
                                        <input class="form-check-input " type="checkbox" name="checkbox[]" value="<?php echo $day['day_id'] . "," . $data['slot_id'] ?>" id="flexCheckIndeterminate">
                                    </div>

                                </td>
                            <?php
                            } ?>

                        </tr>
                    <?php

                    } ?>
                </tbody>
            </table>

        </div>
    </form>
</div>




<?php include '../include/footer.php' ?>