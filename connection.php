<?php
$connection = new mysqli(
  'localhost',
  'root',
  'root', // MAC users put root!
  'simple_blog'
);
// handle error.
if($connection->error) {
  echo 'CONNECTION ERROR:' . $connection->error;
  die;
} else {
  
}
 ?>
