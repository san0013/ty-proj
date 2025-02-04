<?php
// Database connection
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "nutrition_db"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize nutrient totals
$totalProtein = 0;
$totalCarbs = 0;
$totalFat = 0;

// Check if form data is received via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $foodName = $_POST['food_name'];
    $servings = (int)$_POST['servings'];

    // Fetch the nutrient information for the specified food item
    $stmt = $conn->prepare("SELECT protein, carbs, fat FROM food_items WHERE food_name = ?");
    $stmt->bind_param("s", $foodName);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($protein, $carbs, $fat);
        $stmt->fetch();
        
        // Calculate total nutrients based on servings
        $totalProtein = $protein * $servings;
        $totalCarbs = $carbs * $servings;
        $totalFat = $fat * $servings;
    } else {
        echo "Food item not found.";
        exit;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
