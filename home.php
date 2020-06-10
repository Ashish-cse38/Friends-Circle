<?php
 
     session_start();
     require_once('dbconnect.php');

     if (!isset($_SESSION['user'])) {
         header('Location: index.php');
     }

     $userdata = $db->users->findOne( array('_id'=> $_SESSION['user']));

     function get_recent_tweets($db) {
       $result = $db->following->find( array('follower' => $_SESSION['user']));
       $result = iterator_to_array($result);
       $users_following = array();
       foreach ($result as $entry) {
          $users_following[] = $entry['user'];
       }
       $options = ["sort" => ["created" => -1]];
       $result = $db->tweets->find( array('Userid' => array('$in' => $users_following)),$options);
       $recent_tweets = iterator_to_array($result);
       return $recent_tweets;
     }
?>

<html>
<head>
     <title>Friends Circle</title>
</head>
<body>
     <?php include('header.php'); ?><br>
     <form method="post" action="create_tweet.php">
        <fieldset>
                 <label for="tweet">What's going on? </label><br>
                 <textarea rows=4 cols=50 name="body"></textarea><br>
                 <input type="submit" value="Tweet"/>
        </fieldset>
     </form>

     <div>
         <p><b>Tweets from people you're following:</b></a>
         <?php 
             $recent_tweets = get_recent_tweets($db);
             foreach ($recent_tweets as $tweet) {
                echo '<p><a href="profile.php?id=' .$tweet['Userid']. '">' .$tweet['Username']. '</a></p>';
                echo '<p>' .$tweet['body']. '</p>';
                echo '<p>' .$tweet['created']. '</p>';
                echo '<hr>';
             }
         ?>
     </div>

</body>
</html>