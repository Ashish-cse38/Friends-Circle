<?php
 
     session_start();
     require_once('dbconnect.php');

     if (!isset($_GET['id'])) {
         header('Location:index.php'); }

     if (!isset($_GET['id'])) {
         header('Location:index.php'); }

     $userdata = $db->users->findOne(array('_id'=> $_SESSION['user']));
     $profile_id = $_GET['id'];
     $profiledata = $db->users->findOne(array('_id' =>new MongoDB\BSON\ObjectID("$profile_id")));

     function get_recent_tweets($db) {
        $id = $_GET['id'];
        $result = $db->tweets->find(array('Userid' => new MongoDB\BSON\ObjectID("$id")));
        $recent_tweets = iterator_to_array($result);
        return $recent_tweets;
     }

?> 

<html>
<head>
     <title>Friends Circle</title>
</head>
<body>
     <?php include('header.php'); ?>

     <div>
     <?php 
         $recent_tweets = get_recent_tweets($db);
         foreach ($recent_tweets as $tweet) {
           echo '<p><a href="profile.php?id=' .$tweet['Userid'].'">' . $tweet['Username'].'</a></p>';
           echo '<p>'.$tweet['body'].'</p>';
           echo '<p>'.$tweet['created'].'</p>';
           echo '<hr>';

           }
      ?>
      </div>

</body>
</html>
 