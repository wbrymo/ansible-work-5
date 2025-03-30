<?php
$host = 'localhost';
$user = 'devops';
$pass = 'password';
$db   = 'studentdb';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id    = $_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE students SET name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssi", $name, $email, $id);
        if ($stmt->execute()) {
            echo "Record updated successfully.<br>";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    echo '<a href="index.php">Back to List</a>';
} else {
    echo "Invalid request.";
}

$conn->close();
?>
