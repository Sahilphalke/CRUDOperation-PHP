<?php

include("db_connect.php");




if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $deleteQuery = mysqli_query($conn, "DELETE FROM vruser WHERE id = '$id'");
}


?>


<!doctype html>
<html lang="en">

<head>
    <title>Search </title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- css file link  -->
    <!-- <link rel="stylesheet" href="./assets/index.css"> -->

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
                        <a class="navbar-brand" href="#"><img src="./assets/images/swift.png" alt="wait for logo"></a>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_record.php">User Record</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="update_record.php">Update record</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-light text-bold" href="searchById.php">Search by ID</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- navbar section end   -->

    <!-- search section start -->

    <div class="container">
        <div class="d-flex justify-content-around">
            <div class="w-50 pt-5">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                    <!-- <label for="" class="form-label">Your ID</label> -->
                    <div class="mb-3 input-group">
                        <input type="int" class="form-control" name="searchId" id="searchId" aria-describedby="helpId"
                            placeholder="Enter Your ID" />
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>


            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="w-75 pt-5">
                <div class="row p-3 rounded-4" style="background-color: none;color:white">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $searchId = $_POST['searchId'];

                        // $selectQuery = "SELECT * FROM vruser WHERE id = '$searchId' ";
                        $selectQuery = "SELECT * 
                                        FROM vruser
                                        WHERE id = '$searchId' OR
                                        fullName LIKE  '%$searchId%' OR
                                        emailAddress = '$searchId';";

                        $result = mysqli_query($conn, $selectQuery);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                                echo
                                    "<ul class='list-group pb-2'>
                                        <li class='list-group-item'>
                                            <div class=' d-flex justify-content-around gap-2' >
                                                <input type='text' value='{$row['fullName']}' class='form-control text-center' aria-describedby='helpId' placeholder=''
                                                    style='background-color: #B7B1F2;color:black' readonly />
                                                <input type='text' value='{$row['emailAddress']}' class='form-control text-center' aria-describedby='helpId' placeholder=''
                                                    style='background-color: #B7B1F2;color:black' readonly />
                                                <input type='text' value='{$row['userPassword']}' class='form-control text-center' aria-describedby='helpId' placeholder=''
                                                    style='background-color: #B7B1F2;color:black' readonly />
                                                <a href='update_record.php?id={$row['id']}' ><button class='btn btn-warning'>Update</button></a>
                                                <button class='btn btn-danger text-center delete-btn' data-id='{$row['id']}'>Delete</button>
                                            </div>
                                        </li>
                                    </ul>
                                ";

                            }
                        } else {

                            echo "
                        
                        <div class='' >
                            <div class='text-center'>
                                <P style='font-size:15px;' class='text-warning fw-bold' >Data Is Not Present</P>
                                <p style='font-size:15px;' class='text-warning fw-bold' >Please Enter Correct Data</p>
                            </div>
                        </div>
                        ";
                        }
                    }


                    ?>

                </div>

            </div>
        </div>
    </div>

    <!-- bootstrap modal  -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are You sure You want to delete this Data
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmDelete">DELETE</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Select all delete buttons
            let deleteBtns = document.querySelectorAll('.delete-btn');
            let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            let confirmDeleteBtn = document.getElementById('confirmDelete');
            let selectedId = null; // Store the ID of the record to delete

            // Attach event listeners to all delete buttons
            deleteBtns.forEach((deleteBtn) => {
                deleteBtn.addEventListener('click', function () {
                    selectedId = this.getAttribute('data-id'); // Store the ID of the clicked button
                    console.log("Delete ID:", selectedId);

                    // Open the Bootstrap modal
                    deleteModal.show();
                });
            });

            // Handle delete confirmation
            confirmDeleteBtn.addEventListener("click", function () {
                if (selectedId) {
                    console.log("Deleting record with ID:", selectedId);

                    let url = `user_record.php?id=${selectedId}`
                    // Call API to delete the record
                    fetch(url, {
                        method: 'GET',
                        // headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        // body: 'id=' + selectedId
                    })
                        .then(response => {
                            response.json()
                            console.log("Here khk")
                            alert("Data is deleted")
                            window.location.reload();
                        })
                        .then(data => {
                            if (data.success) {

                                console.log("Record deleted successfully");
                                document.querySelector(`#row_${selectedId}`).remove(); // Remove row
                                deleteModal.hide(); // Close the modal
                            } else {
                                console.log("Error:", data.message);
                            }
                        })
                        .catch(error => console.error("Fetch error:", error));
                }
            });
        });
    </script>




    <!-- search section start -->

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>