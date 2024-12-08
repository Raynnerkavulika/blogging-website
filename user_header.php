<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <a href="user_dashboard.php" class="logo">My<span>Panel</span></a>

   <div class="profile">
      <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="update.php" class="btn">update profile</a>
   </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i> <span>home</span></a>
      <a href="useradd_post.php"><i class="fas fa-pen"></i> <span>add posts</span></a>
      <a href="view_post.php"><i class="fas fa-eye"></i> <span>view posts</span></a>
      <a href="../components/user_logout.php" style="color:var(--red);" onclick="return confirm('logout from the website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
   </nav>

   <div class="flex-btn">
      <a href="admin_login.php" class="option-btn">login</a>
      <a href="register_admin.php" class="option-btn">register</a>
   </div>

</header>

<div id="menu-btn" class="fas fa-bars"></div>