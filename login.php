<?php
include 'config.php';

if(isset($_POST['submit'])){
    
    $email = $_POST['email'];
    $email = filter_var($email,FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password = filter_var($password,FILTER_SANITIZE_STRING);
    
$select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
$select_user->execute([$email,$password]);
$row = $select_user->fetch(PDO::FETCH_ASSOC);

if($select_user ->rowCount()>0){
    if($row['user_type'] == 'admin'){
        $_SESSION['admin'] = $row['id'];
        header("location:dashboard.php");
    }elseif($row['user_type'] == 'user'){
        $_SESSION['user'] = $row['id'];
        header("location:index.php");
    }else{
        echo'ooops!!You have entered wrong email or password';
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">
    <!-- cdn js file link -->
     <link rel="stylesheet" href="">
</head>
<body>
    <section class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>welcome back</h3>
            <input type="email" placeholder="enter your email" class="box" required name="email">
            <input type="password" placeholder="enter your password" class="box" required name="password">
            <input type="submit" name="submit" class="btn" value="login now">
            <p>don't have an account?<a href="register.php">register here</a>
            </p>
        </form>
    </section>
</body>
</html>