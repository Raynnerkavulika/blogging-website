<?php
include 'config.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name,FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email,FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password = filter_var($password,FILTER_SANITIZE_STRING);
    $cpassword = $_POST['cpassword'];
    $cpassword = filter_var($cpassword,FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = 'uploaded_img/'.$image;

$select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
$select_user->execute([$email]);

if($select_user ->rowCount()>0){
    $message[] = "user already exist";
}elseif($password != $cpassword){
    $message[] = "confirm passwords you've entered does not match";
}else{
    $insert_user = $conn->prepare("INSERT INTO `users`(name,email,password,image) VALUES(?,?,?,?)");
    $insert_user->execute([$name,$email,$password,$image]);
    
    if($insert_user){
        if($image_size > 2000000){
            $message[] = "image size is too large";
        }else{
            move_uploaded_file($image_tmp_name,$image_folder);
            $message[] = "You have been registered successfully";
            header("location:login.php");
        }
    }
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register page</title>
    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">
    <!-- cdn js file link -->
     <link rel="stylesheet" href="">
</head>
<body>
    <section class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>create an account</h3>
            <input type="text" placeholder="enter your name" class="box" required name="name">
            <input type="email" placeholder="enter your email" class="box" required name="email">
            <input type="password" placeholder="enter your password" class="box" required name="password">
            <input type="password" placeholder="confirm your password" class="box" required name="cpassword">
            <input type="image" placeholder="image/jpeg,image/png,image/jpg" class="box" required name="image">
            <input type="submit" name="submit" class="btn" value="register now">
            <p>already have an account?<a href="login.php">login here</a>
            </p>
        </form>
    </section>
</body>
</html>