<?php

include("db_connect.php");

// $row= "";

//select Query
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $selectQuery = mysqli_query($conn, "SELECT * FROM vruser WHERE id = '$id'");
    $row = mysqli_fetch_assoc($selectQuery);

} 

//Update Query
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fullName = $_POST['fullName'];
    $emailAddress = $_POST['emailAddress'];
    $userPassword = $_POST['userPassword'];



    $updateQuery = "UPDATE vruser SET 
                    fullName = '$fullName',
                    emailAddress = '$emailAddress',
                    userPassword = '$userPassword'
                    WHERE id = '$id'";

    if (mysqli_query($conn, $updateQuery)) {
        $row['id'] = "";
        $row['fullName'] = "";
        $row['emailAddress'] = "";
        $row['userPassword'] = "";
        header("location:user_record.php");
    } else {
        echo "Record Not updated";
    }
}


?>


<!doctype html>
<html lang="en">

<head>
    <title>Update Record</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- css file link  -->
    <link rel="stylesheet" href="./assets/index.css">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
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
                        <a class="navbar-brand" href="index.php"><img src="./assets/images/swift.png"
                                alt="wait for logo"></a>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_record.php">User Record</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-light text-bold" href="update_record.php">Update record</a>
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

    <!-- update form section start  -->

    <div class="container d-flex justify-content-center pt-5">
        <div class="w-25  p-3 rounded-4" style="background-color:#F3F3F3">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?> ">
                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <label for="" class="form-label">Your Name</label>
                    <input type="text" class="form-control" value="<?php echo $row['fullName'] ?>" name="fullName"
                        id="fullName" aria-describedby="helpId" placeholder="" required />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" value="<?php echo $row['emailAddress'] ?>"
                        name="emailAddress" id="emailAddress" aria-describedby="emailHelpId" placeholder="" required />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="text" class="form-control" value="<?php echo $row['userPassword'] ?>"
                        name="userPassword" id="userPassword" placeholder="" required />
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn text-center text-light form-control"
                        style="background-color:#1F485B" onclick="return confirm('Are you sure you want to Update');" > Update </button>
                </div>
            </form>
        </div>
    </div>

    <!-- update form section start  -->


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>