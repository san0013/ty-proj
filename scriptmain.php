// script.php

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
        die("Connection failed: " . $conn->connect_error);<!-- register.php -->
        <?php
        // Configuration
        $db_host = 'localhost';
        $db_username = 'root';
        $db_password = '';
        $db_name = 'fitness_website';
        
        // Create connection
        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Get user data from form submission
        $age = $_POST['age'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $issues = $_POST['issues'];
        $goals = $_POST['goals'];
        
        // Insert user data into database
        $sql = "INSERT INTO users (age, height, weight, issues, goals) VALUES ('$age', '$height', '$weight', '$issues', '$goals')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        // Close connection
        $conn->close();
        ?>
    }

    if ($conn->query($sql) === TRUE) {
        echo "Data stored successfully!";
        // Redirect to recommendations.php
        header("Location: recommendations.php");
        exit;
    } else {
        echo "Error storing data: " . $conn->error;
    }
    // Handle form data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $age = $_POST["age"];
        $height = $_POST["height"];
        $weight = $_POST["weight"];
        $issues = $_POST["issues"];
        $goals = $_POST["goals"];

        // Store data in database
        $sql = "INSERT INTO user_data (age, height, weight, issues, goals) VALUES ('$age', '$height', '$weight', '$issues', '$goals')";
        if ($conn->query($sql) === TRUE) {
            echo "Data stored successfully!";
        } else {
            echo "Error storing data: " . $conn->error;
        }
    }

    // Close connection
    $conn->close();
?>