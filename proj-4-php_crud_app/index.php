<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$user = 'devops';
$pass = 'password';
$db = 'studentdb';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

echo "<h1>PHP CRUD App - Almost a DevOps Engineer!</h1>";
echo "<h1>This application was built by WALE, RUKKY & TIMI</h1>";
echo "<a href='create.php'>➕ Add New Student</a><br><br>";

echo "<table border='1'>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Actions</th>
        </tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>
                <a href='edit.php?id={$row['id']}'>✏️ Edit</a> |
                <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this record?\")'>🗑️ Delete</a>
            </td>
          </tr>";
}
echo "</table>";

$conn->close();
?>
