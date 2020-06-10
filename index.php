<?php

     session_start();
     require_once('dbconnect.php');
    
     if (isset($_SESSION['user'])) {
         header('Location: home.php');
     }

     if (isset($_POST['username']) && isset($_POST['password'])) {
         $username = $_POST['username'];
         $password = hash('sha256', $_POST['password']);
         $result = $db->users->findOne(array('username'=>$username, 'password'=>$password));
          if (!$result) {
                
          } else {
                $_SESSION['user'] = $result->_id;
                header("Location: home.php");
          }
      }

?>

<html>
<head>
     <title>Friends Circle</title>
     <legend><b>Friends Circle</b></title>
</head>
<body>
     <form method="post" action="index.php">
     <br>
     <fieldset>
             <label form="username">Username: </label><input type="text" name="username" /><br><br>
              <label form="password">Password: </label><input type="password" name="password" /><br><br>
              <input type="submit" value="login">
     </fieldset>
     </form>
     <a href="register.php">No account? Register here.</a>
</body>
</html>
        