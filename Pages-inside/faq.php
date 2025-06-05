    <?php
    // Assuming you have already established a database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tour";
    $dsn = 'mysql:host=localhost;dbname=tour';


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
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
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $question = $_POST['question'] ?? '';
    $email = $_POST['email'] ?? '';

    // Insert data into database
    $sql = "INSERT INTO faq (Question, Email) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$question, $email]);
    echo "<script>
    setTimeout(function() {
        alert('Thanks for submitting! We will get back to you soon. 🌟');
        window.location.href = 'HomePage.html'; // Redirect after 2 seconds
    }, 1000);
  </script>";
    exit();
}
?>


