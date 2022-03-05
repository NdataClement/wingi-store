<?php
  session_start();
  include 'connect.php';

  if(isset($_POST['signIn']))
  {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $check = mysqli_query($con,"SELECT email, password FROM user 
      WHERE email = '$email' "); 
    while ($row = mysqli_fetch_array($check)) 
    {
      $dbPassword = $row['password'];

    if(password_verify($password, $dbPassword))
      {
        $_SESSION['email'] = $email;
        header("location:index.php");
      }
    }
    echo "<script>alert('Email or Password is not correct !');</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="./assets/WingiIcon.png" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Wingi Store</title>
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
              <a class="navbar-brand" href="login.php"><img src="./assets/WingiLogo.png" height="40"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            </div>
          </nav>
    </header>
    
    <br><br><br><br>
    <div class="container">
        <div class="registration-form">
            <form autocomplete="off" method="POST">
                <div class="form-icon">
                    <span><i class="icon icon-user"></i></span>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control item" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control item" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type = "submit" name = "signIn" value = "SIGN IN" class = "btn btn-block signIn">
                </div>
            </form>
        </div>
    </div>
</body>
</html>