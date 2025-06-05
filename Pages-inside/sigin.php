<!-- login_process.php (Backend) -->
<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tour";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching user input
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the username and password match
$sql = "SELECT * FROM signup WHERE Email='$username' AND Password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Login successful
    $_SESSION['username'] = $username;
    header("Location: HomePage.html"); // Redirect to homepage
} else {
    // Login failed
    echo "Invalid username or password";
}

$conn->close();
?>
