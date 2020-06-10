<?php

     session_start();
     require_once('dbconnect.php');
    
     if (isset($_SESSION['user'])) {
         header('Location: home.php');
     }
 
     if (isset($_POST['password']) && isset($_POST['retype'])) {
     if ($_POST['password'] != $_POST['retype']) {
         echo 'That did not match, go back and try again';
         exit;
     }
     }

     if (isset($_POST['username']) && isset($_POST['password'])) {
         $username = $_POST['username'];
         $password = hash('sha256', $_POST['password']);
         $result = $db->users->insertOne(array('username'=>$username, 'password'=>$password));
         
          header('Location: index.php');
      }

?>

<html>
<head>
     <title>Friends Circle</title>
</head>

<body>
     <form method="post" action="register.php">
     <fieldset>
              <label form="username">Username: </label><input type="text" name="username" /><br><br>
              <label form="password">Password: </label><input type="password" name="password" /><br><br>
              <label form="retype">Retype Password: </label><input type="password" name="retype"/><br><br>
              <input type="submit" value="signup">
     </fieldset>
     </form>
     <a href="index.php">Already have a account? Login here.</a>
</body>
</html>