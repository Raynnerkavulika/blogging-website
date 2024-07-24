<?php 
include 'config.php';
 session_start();

 $admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    $admin_id = '1';
} 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- css file link -->
     <link rel="stylesheet" href="style.css">
</head>
<body>
    

<!-- header starts here -->
 <?php include 'admin_header.php'; ?>
<!-- header ends here -->
</body>
</html>