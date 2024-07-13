<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD-APP</title>
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PHP-CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center text-danger font-weight-normal my-3">CRUD Application Using PHP</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 d-flex justify-content-end">
                <a href="action.php?export=excel" class="btn btn-success m-1 float-right"><i class="fas fa-table fa-lg"></i> &nbsp; Export to Excel</a>
                <button type="button" class="btn btn-primary m-1 float-right" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i class="fas fa-user-plus fa-lg"></i> &nbsp; Add New Users</button>
            </div>
        </div>
        <hr class="my-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" id="showUser">
                    <h3 class="text-center text-success" style="margin-top:150px;">Loading ...</h3>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add New Users</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="form-data">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <input type="text" name="fname" class="form-control" placeholder="First Name" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="lname" class="form-control" placeholder="Last Name" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input type="email" name="email" class="form-control" placeholder="E-Mail" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input type="tel" name="phone" class="form-control" placeholder="Phone" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" name="insert" id="insert" value="Add User" class="btn btn-danger btn-block w-100">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editModalLabel">Edit Users</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="edit-form-data">
                            <div class="form-group">
                                <input type="text" name="fname" class="form-control" id="fname" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="lname" class="form-control" id="lname" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input type="email" name="email" class="form-control" id="email" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input type="tel" name="phone" class="form-control" id="phone" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" name="update" id="update" value="Update User" class="btn btn-primary btn-block w-100">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("table").DataTable();

            function showAllUsers() {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: { action: "view" },
                    success: function(response) {
                        $('#showUser').html(response);
                        $("table").DataTable({ order: [0, 'desc'] });
                    },
                    error: function(error) {
                        console.error("Error fetching data: ", error);
                    }
                });
            }

            $('#insert').click(function(e) {
                if ($("#form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#form-data").serialize() + "&action=insert",
                        success: function(response) {
                            Swal.fire({ title: 'User added successfully', icon: 'success' });
                            $("#staticBackdrop").modal('hide');
                            $("#form-data")[0].reset();
                            showAllUsers();
                        },
                        error: function(error) {
                            Swal.fire({ title: 'Error adding user', text: error.responseText, icon: 'error' });
                        }
                    });
                }
            });

            $("body").on("click", ".editBtn", function(e) {
                e.preventDefault();
                var edit_id = $(this).attr('id');
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: { edit_id: edit_id },
                    success: function(response) {
                        var data = JSON.parse(response);
                        $("#id").val(data.id);
                        $("#fname").val(data.first_name);
                        $("#lname").val(data.last_name);
                        $("#email").val(data.email);
                        $("#phone").val(data.phone);
                    },
                    error: function(error) {
                        console.error("Error fetching user data: ", error);
                    }
                });
            });

            $('#update').click(function(e) {
                if ($("#edit-form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#edit-form-data").serialize() + "&action=update",
                        success: function(response) {
                            Swal.fire({ title: 'User updated successfully', icon: 'success' });
                            $("#editModal").modal('hide');
                            $("#edit-form-data")[0].reset();
                            showAllUsers();
                        },
                        error: function(error) {
                            Swal.fire({ title: 'Error updating user', text: error.responseText, icon: 'error' });
                        }
                    });
                }
            });

            $("body").on("click", ".delBtn", function(e) {
                e.preventDefault();
                var tr = $(this).closest('tr');
                var del_id = $(this).attr('id');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "action.php",
                            type: "POST",
                            data: { del_id: del_id },
                            success: function(response) {
                                tr.css('background-color', '#ff6666');
                                Swal.fire('Deleted!', 'User deleted successfully!', 'success');
                                showAllUsers();
                            },
                            error: function(error) {
                                Swal.fire({ title: 'Error deleting user', text: error.responseText, icon: 'error' });
                            }
                        });
                    }
                });
            });

            $("body").on("click", '.infoBtn', function(e) {
                e.preventDefault();
                var info_id = $(this).attr('id');
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: { info_id: info_id },
                    success: function(response) {
                        var data = JSON.parse(response);
                        Swal.fire({
                            title: `<strong>User Info : ID(${data.id})</strong>`,
                            icon: 'info',
                            html: `<b>First Name :</b> ${data.first_name}<br><b>Last Name :</b> ${data.last_name}<br><b>Email :</b> ${data.email}<br><b>Phone :</b> ${data.phone}`,
                            showCancelButton: true
                        });
                    },
                    error: function(error) {
                        console.error("Error fetching user info: ", error);
                    }
                });
            });

            showAllUsers();
        });
    </script>
</body>

</html>
