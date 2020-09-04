<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD-OOP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" class="">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" class="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" class="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
</head>
<body>

<section>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#">Logo</a>

    <!-- Links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link" href="#">Link 1</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#">Link 2</a>
        </li>

        <!-- Dropdown -->
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Dropdown link
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Link 1</a>
            <a class="dropdown-item" href="#">Link 2</a>
            <a class="dropdown-item" href="#">Link 3</a>
        </div>
        </li>
    </ul>
    </nav>
</section>

<section>

    <div class="container">
    
        <div class="row">
        
            <div class="col-lg-12">
            
                <h4>CRUD Application using bootstrap 4, PHP-OOP, PDO-MYSQL, Ajax, Datatable</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h4 class="mt-2 text-primary">All users in database</h4>
            </div>
            <div class="col-lg-6">
                <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#staticBackdrop">Add Users</button>
            </div>
        </div>

        
        <table class="table table-striped" id="usersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
      
    </div>

</section>


    <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="addUser">

        <label for="">First Name:</label> <input type="text" class="form-control" name="fname">
        <label for="">Last Name:</label> <input type="text" class="form-control" name="lname">
        <br><button type="button" class="btn btn-info form-control" name="submit" id="submit">Add</button>
        </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){


    showUsers();

    function showUsers(){

        $('#usersTable').DataTable({

            serverSide: true,
            processing: true,
            order:[],
            ajax:{
                url:'action.php',
                type:'POST',
                data:{action:'view'}
                }
                    
        });

    }

    $( "#submit" ).click(function(e) {
        if ($('#addUser')[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
                url:'action.php',
                type:'POST',
                data: $('#addUser').serialize()+'&action=insert',
                success:function(data){
                    swal({
                        title: "Success!",
                        text: "You added a user!",
                        icon: "success",
                        button: "Done",
                    });
                    $('#staticBackdrop').modal('hide');
                    $('#addUser')[0].reset();
                   
                }

            });
        }
     });

    
});

</script>
</body>
</html>