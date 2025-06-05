<?php

// Database connection parameters
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $placeName = $_POST['placeName'] ?? '';
    $location = $_POST['location'] ?? '';
    $description = $_POST['description'] ?? '';

    // Handle file uploads
    $uploadDir = "uploads/";
    $place1Path = uploadFile($_FILES['place1'], $uploadDir);
    $place2Path = uploadFile($_FILES['place2'], $uploadDir);
    $place3Path = uploadFile($_FILES['place3'], $uploadDir);

    // Insert data into database
    $sql = "INSERT INTO suggestions (PlaceName, Location, Description, Place1, Place2, Place3) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $placeName, $location, $description, $place1Path, $place2Path, $place3Path);
    $stmt->execute();
 // Display pop-up message
 echo "<script>alert('Thanks for submitting! We will look after this place.🌟');</script>";
    // Redirect to a new page
    header("Location: HomePage.html");
    exit();
}

// Function to handle file upload
function uploadFile($file, $uploadDir) {
    $targetDir = $uploadDir . basename($file['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetDir, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($file["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($file["tmp_name"], $targetDir)) {
            return $targetDir;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    return "";
}
?>
