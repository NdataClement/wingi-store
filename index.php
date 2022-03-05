<?php
    //Session
    session_start();
    $email=$_SESSION['email'];
    if (!(isset($_SESSION['email']))) {
        header("location:login.php");
    }

    //Calling the database
    include 'connect.php';

    //Retrieving all products
    $query = mysqli_query($con,"SELECT * FROM products");

    //Adding product to the database
    if(isset($_POST['saveProduct'])) 
    {
        $name = $_POST['productName'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $add = mysqli_query($con,"INSERT INTO products VALUES(null, '$name', '$category', '$price', '$quantity',now())");
        echo "<script>window.alert('Product successfully added!');
        window.location.href='index.php';</script>";
        
    }

    //Deleting a selected product from the database
    if(isset($_GET['DeleteID'])){
        $id = $_GET['DeleteID'];
        $del = mysqli_query($con,"DELETE FROM products WHERE id = '$id'");
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="./assets/WingiIcon.png" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Wingi Store</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
      </script>
    
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container">
              <a class="navbar-brand" href="index.php"><img src="./assets/WingiLogo.png" height="40" alt="WINGI logo"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <span><i class="icon icon-user"></i></span>&nbsp;Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
              </div>
            </div>
          </nav>
        </header>
        <br><br><br><br>
        <h1 style="text-align: center; font-family: 'Trebuchet MS', sans-serif;"><b>WINGI STORE</b></h1>
        <hr style="margin: auto; width: 70%;">
        <br>
    <div class="container">
        <div id="newBtn" style="float: right; position:static;">
            <button class="btn" style="background-color: #aec905;" data-toggle="modal" data-target="#openModal"><b>ADD</b></button>
        </div>

        <!-- Modal for adding task -->
        <div class="modal fade" id="openModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add new product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label><b>Name</b></label>
                                    <input type="text" name="productName" class="form-control">
                                </div>
                                <div class="col-6 form-group">
                                    <label><b>Category</b></label>
                                    <select class="form-control" name="category">
                                        <option selected disabled>Select category</option>
                                        <option value="Clothes">Clothes</option>
                                        <option value="Jewellery">Jewellery</option>
                                        <option value="skin care">Skin care</option>
                                  </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label><b>Quantity</b></label>
                                    <input type="number" name="quantity" class="form-control">
                                </div>
                                <div class="col-6 form-group">
                                    <label><b>Price(Ksh)</b></label>
                                    <input type="number" name="price" class="form-control">
                                </div>
                            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-secondary" name="saveProduct" value="Save"></i></input>
                    </div>
                        </form>
                </div>
                </div>
            </div>
        </div>

        <br><br>
        <div>
            
        <table id="example" class='table table-striped table-hover table-bordered' style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                while($row = mysqli_fetch_array($query))
                {
                echo'
                    <tr>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['category'].'</td>
                        <td>'.$row['price'].'</td>
                        <td>'.$row['quantity'].'</td>
                        <td style="width: 15%;">
                            <a class="btn btn-secondary" href="editproduct.php?pid='.$row['id'].'">
                                <i class="bx bxs-edit-alt"></i>
                                Edit
                            </a>
                            <a class="btn btn-danger" href="index.php?DeleteID='.$row['id'].'">
                            <i class="bx bx-x"></i>
                                Delete
                            </a>
                        </td>
                    </tr>
                ';
                }
            ?>
                
            </tbody>
        </table>
        
        </div>
    </div>
</body>
</html>