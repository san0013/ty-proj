
$host = 'localhost';
$username = 'root';  // Replace with your MySQL username
$password = '';  // Replace with your MySQL password
$dbname = 'my_database';    // Replace with your database name

// Create a new MySQLi connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the connection is still active before using it
if ($conn->ping()) {
    // Connection is active, you can use the MySQLi object
    $stmt = $conn->prepare('INSERT INTO users (username) VALUES (?)');
    $stmt->bind_param('s', $username);
    $stmt->execute();
} else {
    // Connection is not active, you need to reconnect or handle the error
    die("Connection is not active");
}

$conn->close();