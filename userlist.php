<?php
 
     session_start();
     require_once('dbconnect.php');

     if(!isset($_SESSION['user'])) {
        header("location:index.php");
     }

     $userdata = $db->users->findOne( array('_id'=> $_SESSION['user']));     

     function get_user_list($db) {
        $result = $db->users->find();
        $users = iterator_to_array($result);
        return $users;
     }
?>

<html>
<head>
     <title>Friends Circle</title>
</head>
<body>
     <?php include('header.php'); ?>
     
     <div>
         <p><b>List of users:</b></a>
         <?php
           $user_list = get_user_list($db);
           foreach ($user_list as $user) {
             echo '<span style="margin-right:5px">' .$user['username']. '</span>';
             echo '[<a href="profile.php?id=' .$user['_id']. '" style="margin-right:5px">Visit Profile</a>]';
             echo '[<a href="follow.php?id=' .$user['_id']. '" style="margin-right:5px">follow</a>]';
             echo '<hr>';

           }
         ?>
     </div>
</body>
</html>