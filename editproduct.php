<?php 
    //Session
    session_start();
    $email=$_SESSION['email'];
    if (!(isset($_SESSION['email']))) {
        header("location:login.php");
    }

    include 'connect.php';
    
    $productname = "";
    $category = "";

    if (isset($_GET['pid'])) {

        $id = $_GET['pid'];
         $rec = mysqli_query($con,"SELECT * FROM products WHERE id='$id'");
         
         
         $record = mysqli_fetch_assoc($rec);
         $id=$record['id'];
         $productname = $record['name'];
         $category = $record['category'];
         $price = $record['price'];
         $quantity = $record['quantity'];

         if(isset($_POST['update'])) 
         {
             $pName = $_POST['name'];
             $categ = $_POST['category'];
             $prices = $_POST['price'];
             $quantities = $_POST['quantity'];
             if($productname != $pName || $category != $categ || $price != $prices || $quantity != $quantities)
             {
               $update = mysqli_query($con, "UPDATE products SET name = '$pName', category = '$categ', price = '$prices', 
               quantity = '$quantities', date_created=now() WHERE id='$id'");
               header('location:index.php');
             }
             
         }
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
    <!-- <link rel="shortcut icon" href="./../assets/favicon_0.ico" type="image/x-icon">     -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-4.3.1.slim.min.js"></script>
    
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container">
              <a class="navbar-brand" href="index.php"><img src="./assets/WingiLogo.png" height="40"></a>
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
    <br>
    <div class="container">
        <div class="registration-form">
            <form autocomplete="off" method="POST">
                <div class="form-label">
                    <h3>Edit Product</h3>
                    <hr>
                </div>
                <div class="form-group">
                    <label class="form-label"><b>Product name</b></label>
                    <input type="text" class="form-control item" name="name" value="<?php echo $productname; ?>">
                </div>
                <div class="form-group">
                <label class="form-label"><b>Category</b></label>
                    <input type="text" class="form-control item" name="category" value="<?php echo $category; ?>">
                </div>
                <div class="form-group">
                    <label class="form-label"><b>Price</b></label>
                    <input type="number" class="form-control item" name="price" value="<?php echo $price; ?>">
                </div>
                <div class="form-group">
                    <label class="form-label"><b>Quantity</b></label>
                    <input type="number" class="form-control item" name="quantity" value="<?php echo $quantity; ?>">
                </div>
                <div class="row">
                    <div class="col-6">
                        <input type = "submit" name = "update" value = "UPDATE" class = "btn btn-block signIn">
                    </div>
                    <div class="col-6">
                        <a href = "index.php" class = "btn btn-block signIn">CLOSE</a>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</body>
</html>