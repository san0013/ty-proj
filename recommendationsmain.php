// recommendations.php

<?php
    // Configuration
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "fitness_database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user data
    $sql = "SELECT * FROM user_data WHERE id = 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // Provide personalized recommendations
    if ($row["age"] < 30) {
        echo "Based on your age, we recommend a high-intensity workout routine.";
    } else {
        echo "Based on your age, we recommend a low-impact workout routine.";
    }

    if ($row["height"] < 160) {
        echo "Based on your height, we recommend a diet rich in protein to support muscle growth.";
    } else {
        echo "Based on your height, we recommend a balanced diet with moderate protein intake.";
    }

    // Close connection
    $conn->close();
?>