<?php
session_start();
class Add_to_cart
{   
    private $conn;
    public function insert_into_cart($postId, $username, $quantity) {
      try {
          $this->conn = new mysqli("localhost", "kul", "Kul@123456", "USER");
  
          // Check for connection errors
          if ($this->conn->connect_error) {
              throw new Exception("Connection failed: " . $this->conn->connect_error);
          }
  
          $stmt = $this->conn->prepare("INSERT INTO cart (post_id, user_name, quantity) VALUES (?, ?, ?)");
  
          // Check if the prepare() call succeeded
          if ($stmt === false) {
              throw new Exception("Error preparing statement: " . $this->conn->error);
          }
  
          // Bind parameters and execute the statement
          $stmt->bind_param("iss", $postId, $username, $quantity);
  
          if ($stmt->execute()) {
              // Cart insertion successful
              echo json_encode(array('success' => true));
          } else {
              // Failed to insert into cart
              echo json_encode(array('success' => false, 'error' => 'Failed to insert into cart'));
          }
  
          // Close the statement and connection
          $stmt->close();
          $this->conn->close();
      } catch (Exception $e) {
          // Handle exceptions
          echo json_encode(array('success' => false, 'error' => $e->getMessage()));
      }
  }
  
  
}

$add_to_cart = new Add_to_cart();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['postId'])) {
        $postId = $_POST['postId'];
        $username = $_SESSION['username'];
        $quantity=$_POST['quantity'];
        $add_to_cart->insert_into_cart($postId, $username,$quantity);
    }
} else {
  echo json_encode(array('success' => false, 'error' => 'Invalid request method'));
}
