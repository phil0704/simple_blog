<?php
session_start();
require './connection.php';

$message = FALSE;

// SQL query string.
$sql = 'SELECT * FROM post;';

// Execute query.
if ($result = $connection->query($sql)) {
    $message = 'Blog posts queried successfully!';
} else {
    $message = 'An error was encountered while trying to retrieve blog posts.';
    $message .= '<br><pre>' .print_r($connection->error_list, TRUE).'</pre>';
}

?><!DOCTYPE html>
<html>
    <head>
        <title>Blog Index</title>
    </head>
    <body>
        <h1>Blog Index</h1>

        <?php
          include '../menu.php';
         ?>
        <?php if ($message) echo "<p>{$message}</p>"; // Show a message! ?>
        <ul>
            <?php while($row = $result->fetch_assoc()) : ?>
                <li>
                    <article>
                        <h2><?php echo $row['title']; ?></h2>
                        <p>
                            <time><?php echo date('Y.m.d', $row['date']); ?></time><br>
                            <?php echo $row['description']; ?>
                            <form action="./post.php" method="GET">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Read More">
                            </form>
                            <?php
                             // check if logged in
                            if($_SESSION['logged_in']):
                              ?>
                            <form action="./admin/edit.php" method="GET">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Edit Post">
                            </form>
                            <form action="./admin/delete.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Delete Post">
                            </form>
                            <a href="./admin/logout.php">logout here</a>
                              <?php
                               else: ?>
                                <a href="./admin/login.php">Login Page</a>

                                       <?php
                                  endif;
                                         ?>
                        </p>
                    </article>
                </li>
            <?php endwhile; ?>
        </ul>
    </body>
</html>
