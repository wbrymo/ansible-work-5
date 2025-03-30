<?php
$host = 'localhost';
$user = 'devops';
$pass = 'password';
$db   = 'studentdb';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if an ID is provided via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute delete statement
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "Record deleted successfully.<br>";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing delete statement.";
    }
} else {
    echo "No ID provided to delete.";
}

$conn->close();

// Redirect back to index after deletion
echo '<br><a href="index.php">Back to List</a>';
?>
