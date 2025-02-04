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

$user_id = $_SESSION['user_id'];
$stmt = $mysqli->prepare("SELECT age, height, weight, issues, goals FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($age, $height, $weight, $issues, $goals);
$stmt->fetch();
$stmt->close();

echo "<h2>Your Personalized Recommendations</h2>";
echo "<p>Age: $age</p>";
echo "<p>Height: $height cm</p>";
echo "<p>Weight: $weight kg</p>";
echo "<p>Health Issues: $issues</p>";
echo "<p>Fitness Goals: $goals</p>";

// Calculate BMI
$bmi = $weight / (($height / 100) ** 2);
echo "<p>Your BMI: " . round($bmi, 2) . "</p>";

// Provide recommendations based on BMI
if ($bmi < 18.5) {
    echo "<h3>Recommendations for Underweight:</h3>";
    echo "<ul>
            <li>Increase your calorie intake with nutrient-dense foods.</li>
            <li>Incorporate strength training to build muscle mass.</li>
            <li>Consider consulting a nutritionist for personalized meal plans.</li>
          </ul>";
} elseif ($bmi >= 18.5 && $bmi < 24.9) {
    echo "<h3>Recommendations for Healthy Weight:</h3>";
    echo "<ul>
            <li>Maintain a balanced diet with a variety of foods.</li>
            <li>Engage in regular physical activity to stay fit.</li>
            <li>Monitor your weight and adjust your diet as needed.</li>
          </ul>";
} elseif ($bmi >= 25 && $bmi < 29.9) {
    echo "<h3>Recommendations for Overweight:</h3>";
    echo "<ul>
            <li>Focus on a balanced diet with controlled portion sizes.</li>
            <li>Incorporate more physical activity into your daily routine.</li>
            <li>Consider setting specific weight loss goals.</li>
          </ul>";
} else {
    echo "<h3>Recommendations for Obesity:</h3>";
    echo "<ul>
            <li>Consult a healthcare provider for a personalized weight loss plan.</li>
            <li>Focus on a diet rich in fruits, vegetables, and whole grains.</li>
            <li>Engage in regular exercise, aiming for at least 150 minutes per week.</li>
          </ul>";
}

// Additional recommendations based on age
if ($age < 18) {
    echo "<h3>Recommendations for Youth:</h3>";
    echo "<ul>
            <li>Focus on developing healthy eating habits.</li>
            <li>Engage in a variety of physical activities.</li>
            <li>Avoid extreme diets; aim for balanced nutrition.</li>
          </ul>";
} elseif ($age >= 18 && $age < 65) {
    echo "<h3>Recommendations for Adults:</h3>";
    echo "<ul>
            <li>Maintain a balanced diet and stay active.</li>
            <li>Incorporate strength training exercises at least twice a week.</li>
            <li>Stay hydrated and manage stress effectively.</li>
          </ul>";
} else {
    echo "<h3>Recommendations for Seniors:</h3>";
    echo "<ul>
            <li>Focus on maintaining muscle mass and bone health.</li>
            <li>Engage in low-impact exercises like walking or swimming.</li>
            <li>Consult a healthcare provider for dietary needs.</li>
          </ul>";
}

$mysqli->close();
?>