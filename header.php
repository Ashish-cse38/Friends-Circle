<div>
    <legend><b>Friends Circle</b></legend><br>
    <span>Welcome, <?php echo $userdata['username']; ?>!</span><br>
    <a href="home.php" style="margin-right:10px">Home</a>
    <a href="profile.php?id=<?php echo $_SESSION['user']; ?>" style="margin-right:10px">View Profile</a>
    <a href="userlist.php" style="margin-right:10px">View Users List</a>
    <a href="logout.php">Log Out</a>
</div>