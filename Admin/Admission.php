<?php include '../Admin/navbar.php';

?>

<div class="ms-5 mt-5">
    <h2 class="text-dark" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Admission Management</h2>
</div>
<div class="container mt-5 d-flex flex-row-reverse my-2">
   <div class="row d-flex align-items-center">
    <div class="col-lg-4 col-md-4 col-12">
        <label class="text-dark bolder">Filter by:</label>
    </div>
    <div class="col-lg-8 col-md-8 col-12">
        <input type="text" class="form-control" placeholder="Last Name" name="firstName" id="firstName" >
    </div>
   </div>
</div>

<div class="card container my-5">
    <div class="mt-4 table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Father/Mother Name</th>
                    <th scope="col">Parents Name Add &Contact</th>
                    <th scope="col">Student D.O.B</th>
                    <th scope="col">Admission class</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="AddmissonData" >
               
            </tbody>
        </table>
    </div>
</div>

<?php include '../include/footer.php' ?>