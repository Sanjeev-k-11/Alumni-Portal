<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; // Change if using a password
$database = "login"; // Replace with your actual database name

// Create DB connection
$conn = new mysqli($servername, $username, $password, $database);

// Check DB connection
if ($conn->connect_error) {
    $_SESSION['feedback_status'] = [
        'type' => 'error',
        'message' => 'Database connection failed: ' . $conn->connect_error
    ];
    header("Location: feedback_form.php");
    exit();
}

// Sanitize and fetch inputs
$name = isset($_POST['user_name']) ? trim($_POST['user_name']) : null;
$email = isset($_POST['user_email']) ? trim($_POST['user_email']) : null;
$rating = isset($_POST['rating']) ? intval($_POST['rating']) : null;
$category = isset($_POST['category']) ? trim($_POST['category']) : null;
$message = isset($_POST['feedback_message']) ? trim($_POST['feedback_message']) : '';

// Validate required fields
if (empty($message)) {
    $_SESSION['feedback_status'] = [
        'type' => 'error',
        'message' => 'Feedback message is required.'
    ];
    header("Location: feedback_form.php");
    exit();
}

// Prepare SQL statement
$sql = "INSERT INTO feedback (name, email, rating, category, message) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    $_SESSION['feedback_status'] = [
        'type' => 'error',
        'message' => 'Prepare failed: ' . $conn->error
    ];
    header("Location: feedback_form.php");
    exit();
}

// Bind parameters and execute
$stmt->bind_param("ssiss", $name, $email, $rating, $category, $message);

if ($stmt->execute()) {
    $_SESSION['feedback_status'] = [
        'type' => 'success',
        'message' => 'Thank you for your feedback!'
    ];
} else {
    $_SESSION['feedback_status'] = [
        'type' => 'error',
        'message' => 'Error saving feedback: ' . $stmt->error
    ];
}

$stmt->close();
$conn->close();

// Redirect back to the form page
header("Location: feedback_form.php");
exit();
