<?php include '../Admin/navbar.php' ?>
<div class="ms-5 mt-5">
        <h2 class="text-dark" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Event Management</h2>
    </div>
<div class="container mt-5 d-flex flex-row-reverse my-2">
    <button type="button" class="btn  btn-primary py-2 px-5 text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <span class="mx-1 my-auto">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
            </svg></span>
        Add Event</button>
</div>
<div class="container card table-responsive">
    <table class="table mt-3 ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Date </th>
                <th scope="col">Time</th>
                <th scope="col">Venue</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                <!-- <th scope="col"></th> -->
            </tr>
        </thead>
        <tbody>
            <?php require_once '../db/db.class.php';
            $db = new DB();
            $count = 0;
            $res = [];
            $query = "SELECT * FROM event";
            $res = $db->executeSelect($query);
            if (count($res) > 0) {
                foreach ($res as $row) {
                    $count++;
            ?><tr>
                        <th scope="row"><?php echo $count ?></th>
                        <td><img src="../media/Event/<?php echo $row['evt_image'] ?>" width="50" height="50" alt="avathar"></td>
                        <td><?php echo $row['evt_title'] ?></td>
                        <td><?php echo $row['evt_date'] ?></td>
                        <td><?php echo $row['evt_time'] ?></td>
                        <td><?php echo $row['evt_venue'] ?></td>
                        <td><?php echo $row['evt_discription'] ?></td>
                        <td><?php if ($row['evt_enabled'] == 1) { ?>
                                <span class="text-success">Active</span>
                            <?php } else { ?>
                                <span class="text-danger">Deactive</span>
                            <?php } ?>
                        </td>
                        <td><?php if ($row['evt_enabled'] == 1) { ?>
                                <button type="button" class="btn btn-warning" onclick="UpdateEventStatus(<?php echo $row['event_id'] ?>,'0')">Disable</button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-success" onclick="UpdateEventStatus(<?php echo $row['event_id'] ?>,'1')">Enable</button>
                            <?php } ?>
                        </td>
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
                <input type="text" value="AddEvent" name="command" id="command" hidden>


                <div class="modal-header">
                    <div class="d-flex flex-grow-1 justify-content-center align-items-center">
                        <h4 class="modal-title " id="staticBackdropLabel">

                            Add Event</h4>

                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body my-2">

                    <div class="mx-2 mb-2">
                        <label for="exampleFormControlInput1" class="form-label text2"><b>Title</b></label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                    </div>




                    <div class="mx-2 mb-2">
                        <label for="exampleFormControlInput1" class="form-label text2"><b>Date</b></label>
                        <input type="date" class="form-control" id="date" name="date" placeholder="Date" required>
                    </div>


                    <div class="mx-2 mb-2">
                        <label for="exampleFormControlInput1" class="form-label text2"><b>Time</b></label>
                        <input type="time" class="form-control" id="time" name="time" placeholder="Time" required>
                    </div>
                    <div class="mx-2 mb-2">
                        <label for="exampleFormControlInput1" class="form-label text2"><b>Venue</b></label>
                        <input type="text" class="form-control" id="Venue" name="Venue" placeholder="Venue" required>
                    </div>


                    <div class="mx-2 mb-2">
                        <label for="exampleFormControlInput1" class="form-label text2"><b>Description</b></label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mx-2 mb-2">
                        <label for="exampleFormControlInput1" class="form-label text2"><b>Image</b></label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="image" name="image" accept=".png,.jpeg,.jpg,.webp" required>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn text-dark buttons bg-info" onclick="return EventValidation();">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../include/footer.php' ?>