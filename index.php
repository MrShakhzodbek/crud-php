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
            <div class="col-lg-6">
                <h4 class="mt-2 text-primary">All Users in database</h4>
            </div>
            <div class="col-lg-6 d-flex justify-content-end">
                <a href="#" class="btn btn-success m-1 float-right"><i class="fas fa-table fa-lg"></i> &nbsp; Export to Excell</a>
                <button type="button" class="btn btn-primary m-1 float-right" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i class="fas fa-user-plus fa-lg"></i> &nbsp; Add New Users</button>

            </div>

        </div>
        <hr class="my-1">

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" id="showUser">
                            
                </div>
            </div>
        </div>

        <!-- Modal_start -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add New Users</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="form-data">
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
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("table").DataTable();

            function showAllUsers(){
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {action: "view"},
                    success: function(response){
                        $('#showUser').html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });

                    }
                })
            }
            $('#insert').click(function(e){
                if($("#form-data")[0].checkValidity()){
                    e.preventDefault();
                    $.ajax({
                        url:"action.php",
                        type: "POST",
                        data: $("#form-data").serialize()+"&action=insert",
                        success: function(response){
                            Swal.fire({
                                title: 'User added succesfully',
                                type: 'success'
                            })
                            $("#staticBackdrop").modal('hide');
                            $("#form-data")[0].reset();
                            showAllUsers();
                        }
                    })
                }  
            })
        })
    </script>
</body>

</html>