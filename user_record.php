<?php

include("db_connect.php");

$selectQuery = "SELECT * FROM vruser";
$query = mysqli_query($conn, $selectQuery);


//Delete Query

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $deleteQuery = mysqli_query($conn, "DELETE FROM vruser WHERE id = '$id'");
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>User Record</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- css file link  -->
    <link rel="stylesheet" href="./assets/index.css">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<style>
    .table>thead>tr>th {

        background-color: #1F485B;

    }

    td {
        text-align: center;
    }

    th {
        text-align: center;
        background-color: #1F485B;
    }

    .box {
        -ms-overflow-style: none;
        scrollbar-width: none;
        border-radius: 20px 20px 20px 20px;
    }
</style>

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
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-light text-bold" aria-current="page"
                                href="user_record.php">User Record</a>
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

    <div class="container d-flex justify-content-center align-items-center pt-2">
        <div class="w-75 box  bg-dark overflow-scroll" style="height:35rem">
            <table class="table table-dark  table-hover">
                <thead style="color: #1F485B;">
                    <tr class="sticky-top">
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th colspan="2">Operation</th>
                    </tr>
                </thead>
                <tbody> <?php

                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['fullName']}</td>
                    <td>{$row['emailAddress']}</td>
                    <td>{$row['userPassword']}</td>
                    <td><a href='update_record.php?id={$row['id']}' ><button class='btn btn-warning'>Update</button></a></td>
                    <td><button class='btn btn-danger text-center delete-btn' data-id='{$row['id']}'>Delete</button></td>
                </tr>";
                    }
                }


                ?>
                </tbody>

            </table>
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

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>