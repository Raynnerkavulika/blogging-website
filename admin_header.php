<header class="header">

<a href="admin_page.php" class="logo">Admin<span>panel</span></a>

<div class="profile">
    <?php 
    $select_profile = $conn->prepare("SELECT * FROM admin WHERE id=?");
    $select_profile->execute([$admin_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    ?>
    <p><?= $fetch_profile['name'];?></p>
    <a href="admin_update_profile.php" class="btn">update profile</a>
</div>

<nav class="navbar">
    <a href="admin_page.php"><i class="fas fa-home"></i><span>home</span></a>
    <a href="add_post.php"><i class="fas fa-pen"></i><span>add post</span></a>
    <a href="view_post.php"><i class="fas fa-eye"></i><span>view post</span></a>
    <a href="admin_accounts.php"><i class="fas fa-user"></i><span>accounts</span></a>
    <a href="admin_logout.php"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
</nav>

<div class="flex-btn">
    <a href="admin_login.php" class="btn">login</a>
    <a href="register_admin.php" class="option-btn">register</a>
</div>

</header>

<div id="menu-btn" class="fas fa-bars"></div>