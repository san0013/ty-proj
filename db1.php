<?php
// db.php - Database connection
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "fitness_db"; // Your database name



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// submit.php - Handle form submission
include 'db1.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $healthIssues = $_POST['health-issues'];
    $fitnessGoals = $_POST['fitness-goals'];
    $dietaryPreferences = $_POST['dietary-preferences'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (height, weight, age, gender, health_issues, fitness_goals, dietary_preferences) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ddisssss", $height, $weight, $age, $gender, $healthIssues, $fitnessGoals, $dietaryPreferences);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>