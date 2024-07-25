<?php include '../Admin/navbar.php' ?>
<?php require_once '../db/db.class.php';
$db = new DB();
?>
<?php
$sql = "SELECT * FROM classes";
$class = $db->executeSelect($sql); ?>
<div class="container card my-5 w-75">
    <div class="text-center my-4">
        <h4>New Admission</h4>
    </div>
    <form method="post" action="../Action/adminAction.php" enctype="multipart/form-data">
        <input type="text" name="command" value="newAdmission" hidden>
        
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>First Name</b></label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" >
                </div>
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Last Name</b></label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" >
                </div>
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Home Name</b></label>
                    <input type="text" class="form-control" id="hname" name="hname" placeholder="Home Name" >
                </div>
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Parents Name & Address</b></label>
                    <textarea class="form-control" id="p_add_contatc" name="p_add_contatc" rows="3" ></textarea>
                </div>

                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Body Mark</b></label>
                    <textarea class="form-control" id="body_mark" name="body_mark" rows="3" ></textarea>
                </div>
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Acceptance No & Date</b></label>
                    <textarea class="form-control" id="acc_date" name="acc_date" rows="3" ></textarea>
                </div>
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Parent Contact</b></label>
                    <input type="number" class="form-control" id="contct" name="contct" placeholder="Contact" >
                </div>
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Student D.O.B</b></label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Student Gender</b></label>
                    <select class="form-select" aria-label="Default select example" id="gender" name="gender" >
                        <option selected value="-1">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Middle Name</b></label>
                    <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name" >
                </div>
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Father/Mother Name</b></label>
                    <input type="text" class="form-control" id="f_or_mname" name="f_or_mname" placeholder="Father/Mother Name" >
                </div>
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Parents Realtion with Student</b></label>
                    <input type="text" class="form-control" id="parent_rel" name="parent_rel" placeholder="Parent Relation" >
                </div>
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Parents Job</b></label>
                    <textarea class="form-control" id="parent_job" name="parent_job" rows="3" ></textarea>
                </div>
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Previous Madrasa Name</b></label>
                    <textarea class="form-control" id="prev_name" name="prev_name" rows="3" ></textarea>
                </div>
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>T.C No & Date</b></label>
                    <textarea class="form-control" id="tc_date" name="tc_date" rows="3" ></textarea>
                </div>
                
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Parents Email</b></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" >
                </div>
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Student Admission Class</b></label>
                    <select class="form-select" aria-label="Default select example" id="adm_class" name="adm_class" >
                        <option selected value="-1">Select Class</option>
                        <?php foreach ($class as $row) { ?>
                            <option value="<?php echo $row['class'] ?>"><?php echo $row['class'] ?> Standard</option>
                        <?php  } ?>

                    </select>
                </div>
                <div class="mx-2 mb-2">
                    <label for="exampleFormControlInput1" class="form-label text2"><b>Image</b></label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="image" name="image" accept=".png,.jpeg,.jpg,.webp" >
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-2 mb-4 mt-4 pb-2">
            <button type="submit" class="btn px-5 text-white w-100" style="background-color:purple;" onclick="return NewAdmissionValidation();" >Save</button>
        </div>
    </form>
</div <?php include '../include/footer.php' ?>