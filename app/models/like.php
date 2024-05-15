<?php
// start a session
session_start();

// ClassLikeUpdate
class LikeUpdate
{
    // Database connection object
    private $conn;

    /**
     * @param int $postId The ID of the post.
     * @param string $username The username of the user toggling the like.
     */
    public function toggle_like($postId, $username)
    {
        // creating database connection
        $this->conn = new mysqli("localhost", "kul", "Kul@123456", "USER");

        // Check if the user has already liked the post
        $checkQuery = "SELECT * FROM likes WHERE post_id = $postId AND user_name = '$username'";
        $checkResult = $this->conn->query($checkQuery);

        // Toggle like status based on existing like record
        if ($checkResult->num_rows > 0) {
            $_SESSION['liked'] = false;
            // User has already liked the post, so delete the like record
            $query = "DELETE FROM likes WHERE post_id = $postId AND user_name = '$username'";
            $query1 = "UPDATE posts SET like_count=like_count-1 WHERE post_id=$postId";
        } else {
            // User has not liked the post, so insert a new like record
            $_SESSION['liked'] = true;
            $query = "INSERT INTO likes (post_id, user_name,like_status) VALUES ($postId, '$username','liked')";
            $query1 = "UPDATE posts SET like_count = like_count+1 WHERE post_id=$postId";
        }

        // Execute queries and handle results
        if ($this->conn->query($query) && $this->conn->query($query1)) {
            // Get the updated like count for the post
            $likeCountQuery = "SELECT COUNT(*) AS like_count FROM likes WHERE post_id = $postId";
            $result = $this->conn->query($likeCountQuery);
            $row = $result->fetch_assoc();
            return $row['like_count'];
        } else {
            return -1;
        }
    }
}

// creating Object
$likeUpdate = new LikeUpdate();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if post_id is set
    if (isset($_POST['post_id'])) {
        $postId = $_POST['post_id'];
        $username = $_SESSION['username'];
        // Toggle like for the post and get updated like count
        $likeCount = $likeUpdate->toggle_like($postId, $username);
        // Prepare response data
        $response = [
            'post_id' => $postId,
            'likes' => $likeCount,
            'like_status' => $_SESSION['liked']
        ];
        header('Content-Type: application/json');
        // Send JSON response
        echo json_encode($response);
    }
} else {
    // Handle invalid requests
    echo json_encode(["error" => "Invalid"]);
}
