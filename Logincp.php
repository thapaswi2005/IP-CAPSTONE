<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'grocery_store';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];

// Validate form data
if (empty($name) || empty($username) || empty($password) || empty($dob) || empty($gender)) {
    $error_message = "Please fill in all fields.";
} else {
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into database
    $query = "INSERT INTO users (name, username, password, dob, gender) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $name, $username, $hashed_password, $dob, $gender);
    $stmt->execute();

    // Check if insertion was successful
    if ($stmt->affected_rows > 0) {
        $success_message = "Login successful! You will be redirected to the dashboard.";
        header("Location: dashboard.php");
        exit;
    } else {
        $error_message = "Login failed. Please try again.";
    }
}

// Close connection
$conn->close();
?>

<!-- Display error or success message -->
<div class="error-message">
    <?php if (isset($error_message)) { echo $error_message; } ?>
    <?php if (isset($success_message)) { echo $success_message; } ?>
</div>

