<?php 
    include 'connect.php';
    if(isset($_POST['saveProduct'])) 
    {
        $name = $_POST['productName'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $add = mysqli_query($con,"INSERT INTO products VALUES(null, '$name', '$category', '$price', '$quantity',now())");
        echo "<script>window.alert('Product successfully added!');
        window.location.href='../html/index.php';</script>";
        
    }
?>