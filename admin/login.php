<?php
 session_start();
 $username = 'filip07';
 $password = 'simplelogin99';

 if (isset($_POST)) {
   if (($username == $_POST['username']) && ($password === $_POST['password'])) {
     $_SESSION['logged_in'] = TRUE;
     header('Location: ../index.php');
     exit;
   } else {
     //assignment
     $message = '<p class="error">Wrong username or password</p>';

   }
 }
 //end if submit


 ?><!DOCTYPE html>
 <html>
   <head>
     <title>Login Page</title>
   </head>
   <body>
     <h1>Login Page</h1>
     <label for="username"></label>
       Username:
     <form action="#" method="POST">
       <input type="text" placeholder="Enter your username..." name="username" title="Enter your username here!">
       </label>
         </from>

       <label for="password">
         Password:
       <form action="#" method="POST">
         <input type="text" placeholder="Enter your password..." name="password" title="Enter your password here!">
         </label>

         <input type="submit" name="submit" value="submit">
         <?php
         if(isset($message)) {
           echo $message;
         }

    ?>
     </form>

   </body>
 </html>
