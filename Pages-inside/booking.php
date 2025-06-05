<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tour";
$dsn = 'mysql:host=localhost;dbname=tour';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
try {
    // Establish PDO connection
    $pdo = new PDO($dsn, $username, $password);
    
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
    die();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $name = $_POST['name'] ?? '';
    $persons = $_POST['persons'] ?? '';
    $email = $_POST['email'] ?? '';
    $number = $_POST['number'] ?? '';
    $aNumber = $_POST['aNumber'] ?? '';
    $address = $_POST['address'] ?? '';
    $pickup = $_POST['pickup'] ?? '';
    $places = $_POST['places'] ?? '';

    // Insert data into database
    $sql = "INSERT INTO booking (Name, Persons, Email, Number, ANumber, Address, Pickup, Places) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $persons, $email, $number, $aNumber, $address, $pickup, $places]);

    echo "<script>
    setTimeout(function() {
        alert('Thanks for Booking!! We will get back to you soon.🌟');
        window.location.href = 'HomePage.html'; // Redirect after 2 seconds
    }, 1000);
  </script>";

}
?>

