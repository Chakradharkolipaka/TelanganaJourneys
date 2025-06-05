<!-- register.php (Backend) -->
<?php
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
$email = $_POST['email'];
$password = $_POST['password'];

// Inserting user data into the database
$sql = "INSERT INTO signup (Username, Email, Password) VALUES ('$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful! Redirecting to homepage...";
    // Redirect to homepage after successful registration
    header("refresh:3; url=HomePage.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
