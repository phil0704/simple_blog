<?php
require '../connection.php';

// Default message value

$message = '';
if ( isset( $_POST ) && !empty($_POST)){
  // Typecast as ID as integer to avoid the security risk.
  $id = (integer) $_GET['id'];
  $sql ='UPDATE post SET title="'.$_POST['title'].'", content="'.$_POST['content'].'", description="'.$_POST['description'].'" WHERE id='.$id.';';
  if ($connection->query( $sql)) {
    $message .='successfully updated post: "'.$_POST['title']. '"';
  } else {
    $message .= 'Failed post update. Please try again.';
  }
}

if ( isset($_GET['id'])) {
  // Typecast as ID as integer to avoid the security risk.
  $id = (integer) $_GET['id'];
  // Prepare SQL string.
  $sql = 'SELECT * FROM post WHERE id='.$id.';';
  // Execute SQL statement.
  if ( $result = $connection->query( $sql) ) {
     $message .='Post found!';
     $post;
     // Retrieve the post data ( we're only getting this time anyway!)
     while ( $row = $result->fetch_assoc()) $post = $row; // one syntax


// Decide Values
$title = $_POST['title'] ?? $post['title'];
$description = $_POST['description'] ?? $post['description'];
$content= $_POST['content'] ?? $post['content'];


  } else {
    $message .='An error was encountered while trying to retrieve this post.';
    $message .= '<br><pre>' .print_r(
      $connection->error_list, TRUE ). '</pre>';
  }
} else {
  // Redirect the user to the index to try again.
  header('Location: index.php');
  die; // Terminate script.
}



 ?><!DOCTYPE html>
 <html>
   <head>

     <title><?php echo $post['title']; ?></title>
   </head>
   <body>
     <h1><?php echo $post['title']; ?></h1>
     <?php if ( $message ) echo "<p>{$message}</p>";
     // Show a message! ?>
     <form action="#" method="POST">
       <label for="title">
           Title:
         <input type="text" name="title" placeholder="Enter a title...."<?php if (isset($title)) echo 'value="' .$title.'"'; ?>
        </label>
       <label for="content">
          Content:
         <textarea name="content" rows="10" cols="30" placeholder="Enter the blog post content...."><?php if (isset($content)) echo $content; ?></textarea>
       </label>
       <label for="description">
         Description:
        <input type="text" name="description" placeholder="Enter a description...."<?php if (isset($description)) echo 'value="' .$description.'"'; ?>
       </label>
       <input type="submit" value="Update Post">
     </form>
   </body>
 </html>
