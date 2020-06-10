<?php

     session_start();
     require_once('dbconnect.php');
 
     if (!isset($_POST['body']) || empty($_POST['body'])) {
         header('Location: home.php');
         exit;
     }

     $user_id = $_SESSION['user'];
     $userdata = $db->users->findOne(array('_id'=>$user_id));
     $body = substr($_POST['body'],0,140);
     $date = date('Y-m-d H:i:s');

     $db->tweets->insertOne( array('Userid'=>$user_id, 'Username'=>$userdata['username'], 'body' => $body, 'created'=> $date ));

     header('Location: home.php');

?>