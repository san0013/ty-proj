<?php
include 'db_connection.php';
session_start();
$conn = new mysqli('localhost', 'root', 'password', 'my_database');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['myusername'];
    $password = $_POST['mypassword'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    } else {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $username;
                header("Location: protected_page.php");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>