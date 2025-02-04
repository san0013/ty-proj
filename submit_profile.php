<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "user_management");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Collect data from the form
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$age = mysqli_real_escape_string($conn, $_POST['age']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$location = mysqli_real_escape_string($conn, $_POST['location']);
$occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
$fitness_goal = mysqli_real_escape_string($conn, $_POST['fitness_goal']);
$workout_preference = mysqli_real_escape_string($conn, $_POST['workout_preference']);
$dietary_preference = mysqli_real_escape_string($conn, $_POST['dietary_preference']);

// Insert data into the database
$query = "INSERT INTO user_profiles (name, email, age, gender, location, occupation, fitness_goal, workout_preference, dietary_preference) 
          VALUES ('$name', '$email', '$age', '$gender', '$location', '$occupation', '$fitness_goal', '$workout_preference', '$dietary_preference')";

if (mysqli_query($conn, $query)) {
    echo "Profile created successfully!";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>