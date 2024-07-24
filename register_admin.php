<?php 
include 'config.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name,FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass,FILTER_SANITIZE_STRING);
    $cpass = $_POST['cpass'];
    $cpass = filter_var($cpass,FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = 'uploaded_img/'.$image;

    $select = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
    $select->execute([$name]);

    if($select->rowCount()>0){
        $message[] = 'admin already exist';
    }else{
        if($pass != $cpass){
            $message[] = 'confirm password does not match';
    }else{
        $insert = $conn->prepare("INSERT INTO `admin`(name,password,image) VALUES(?,?,?)");
        $insert->execute([$name,$password,$image]);

        if($insert){
            if($image_size>2000000){
                $message[] = 'image size is too large';
            }else{
                move_uploaded_file($image_tmp_name,$image_folder);
                $message[] = 'registered successfully';
            }
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
    <title>register admin</title>
        <!-- font awesome cdn link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- css file link -->
     <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="form-container">
        <input type="text" name="name" placeholder="enter your name" class="box">
        <input type="password" name="pass" placeholder="enter your password" class="box">
        <input type="password" name="cpass" placeholder="confirm your password" class="box">
        <input type="file" name="image" accept="image/png,image/jpg,image/jpeg" class="box">
        <input type="submit" value="register now" class="btn" name="submit">
    </section>
</body>
</html>