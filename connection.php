<?php
// Connect to DB.
$connection = new mysqli(
    'localhost',
    'root',
    'root', // Mac users, put root!
    'simple-blog-project'
);

// Handle error.
if ($connection->error) {
    echo 'CONNECTION ERROR:' . $connection->error;
    die;
} else {

}
?>
