<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from form
$username = $_POST['username'];
$password = $_POST['password'];

// Fetch user from database
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify password
    if (password_verify($password, $row['password'])) {
        echo "Login successful!";
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found.";
}

$conn->close();
?>
<?php
session_start(); // Start the session

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Replace this with your actual authentication logic
    // For example, check against a database
    if ($username === 'yourUsername' && $password === 'yourPassword') {
        // Authentication successful
        $_SESSION['username'] = $username; // Set session variable

        // Redirect to the main page
        header("Location: /index.php"); // Change to your main page URL
        exit(); // Make sure to exit after the redirect
    } else {
        // Authentication failed
        $error = "Invalid username or password.";
    }
}
?>