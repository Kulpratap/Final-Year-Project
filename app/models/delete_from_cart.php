<?php
session_start();
if (isset($_POST['post_id'])) {
    $postId = $_POST['post_id'];
    $username=$_SESSION['username'];
    $conn = new mysqli("localhost", "kul", "Kul@123456", "USER");
    // Perform the delete operation in your database
    $sql = "DELETE FROM cart WHERE post_id = $postId AND user_name='$username'";
    $conn->query($sql);
} else {
    http_response_code(400);
    echo 'Post ID is required.';
}
?>
