<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./custom/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Madarasa Management</title>
    <link href="img/favicon.ico" rel="icon">
    <link href="../custom/css/app.css" rel="stylesheet">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="login">
    <div class="container">
        <div class="card login-card container my-5">
            <div class="card-body">
                <div style="height: 10%; width:10%" class="text-center mx-auto mt-4">
                    <p style="color: goldenrod;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                        </svg>
                    </p>
                </div>
                <div class="text-center">
                    <h3 style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">Staff Login</h3>
                </div>
                <form method="get" action="../Action/staffAction.php">
                    <input type="text" value="login" name="command" id="command" hidden>
                    <div class="mb-3 mx-3">
                        <label for="exampleInputEmail1" class="form-label">
                            <b class="txt">Email</b></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required oninvalid="this.setCustomValidity('Email is required')" oninput="setCustomValidity('')">
                    </div>
                    <div class="mb-2 mx-3">
                        <label for="exampleInputPassword1" class="form-label"><b class="txt">Password</b></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required oninvalid="this.setCustomValidity('Please Enter the password')" oninput="setCustomValidity('')">
                    </div>
                    <div class="text-end mb-4 me-3">
                        <a href="./forgotPassword.php">Forgot Password</a>
                    </div>
                    <div class="mb-5 mx-3 ">
                        <button type="submit" class="btn btn-info w-100 rounded-0 py-2">Login</button>
                    </div>

                </form>
            </div>
        </div>

        <?php include '../include/footer.php'; ?>