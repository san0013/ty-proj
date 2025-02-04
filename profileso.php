<?php
session_start();
$mysqli = new mysqli("localhost", "username", "password", "fitness_website");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: loginso.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $issues = $_POST['issues'];
    $goals = $_POST['goals'];

    $stmt = $mysqli->prepare("UPDATE users SET age = ?, height = ?, weight = ?, issues = ?, goals = ? WHERE id = ?");
    $stmt->bind_param("iidssi", $age, $height, $weight, $issues, $goals, $user_id);

    if ($stmt->execute()) {
        header("Location: recommendationsso.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$mysqli->close();
?>