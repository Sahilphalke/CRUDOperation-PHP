<?php

include("db_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $fullName = $_REQUEST['fullName'];
    $emailAddress = $_REQUEST['emailAddress'];
    $userPassword = $_REQUEST['userPassword'];


    $insertQuery = "INSERT INTO vruser (fullName,emailAddress,userPassword)
                    VALUES('$fullName','$emailAddress','$userPassword')";

    if (mysqli_query($conn, $insertQuery)) {
        header("location:index.php");
    } else {
        echo "Data inserted failed";
    }

}

?>

<!doctype html>
<html lang="en">

<head>
    <title></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <link rel="stylesheet" href="./assets/index.css">

    <!-- font awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- navbar section start   -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4 p-1 rounded-5 pe-3 ps-3"
                        style="background-color:	#1F485B">
                        <a class="navbar-brand" href="index.php"><img src="./assets/images/swift.png" alt="wait for logo"></a>
                        <li class="nav-item">
                            <a class="nav-link active text-light text-bold" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_record.php">User Record</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="update_record.php">Update record</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="searchById.php">Search by ID</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- navbar section end   -->

    <!-- form section start -->
    <div class="container d-flex justify-content-center align-items-center pt-1">
        <div class="row rounded-5 overflow-hidden p-0" style="width:68%;background-color:#1F485B;">
            <div class="col-lg-5 position-relative left p-0">
                <div class="ps-5">
                    <img src="./assets/images/pngegg (70) 1.png" alt="wait for image" width="30%">
                    <p class="pt-3">Getting <br>
                        Started With <br>
                        VR Creation</p>
                </div>
                <div class="d-flex justify-content-end position-relative pt-0" style="left:100px">
                    <img src="./assets/images/abstraction.png" alt="wait for image" width="105%">
                </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-center align-items-center rounded-5 p-0"
                style="width:58.33%;background-color:#F3F3F3">
                <div style="width:78%">
                    <h5 class="pb-3">Create Account</h5>
                    <div class="d-flex justify-content-between pb-3">
                        <div
                            class="d-flex justify-content-center align-items-center gap-2 border border-dark rounded-2 p-2">
                            <i class="fa-brands fa-google"></i>
                            <span>Signup with Google</span>
                        </div>
                        <div
                            class="d-flex justify-content-center align-items-center gap-2 border border-dark rounded-2 p-2">
                            <i class="fa-brands fa-facebook-f"></i>
                            <span>Signup with Facebook</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                        <div style="height:1px;width:20%;border:1px solid black"></div>
                        OR
                        <div style="height:1px;width:20%;border:1px solid black"></div>
                    </div>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="fullName" id="fullName"
                                aria-describedby="helpId" placeholder="Full Name" required />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" name="emailAddress" id="emailAddress"
                                aria-describedby="emailHelpId" placeholder="Email" required />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="userPassword" id="userPassword"
                                placeholder="Password" required />
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn form-control">Create Account</button>
                        </div>
                        <h6>Already have an account? <a href="#" class="text-decoration-none" style="color:#1F485B">Log
                                In</a></h6>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- form section end -->




    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>