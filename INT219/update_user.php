<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: change.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate POST data
if (isset($_POST['firstname']) && isset($_POST['lastName'])) {
    $userId = $_SESSION["user_id"];
    $firstName = trim($_POST['firstname']);
    $lastName = trim($_POST['lastName']);

    // Check if fields are empty
    if (empty($firstName) || empty($lastName)) {
        header("Location: dashboard.php?error=Fields cannot be empty");
        exit();
    }

    // Update user data
    $sql = "UPDATE users SET firstName = ?, lastName = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssi", $firstName, $lastName, $userId);
        if ($stmt->execute()) {
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            header("Location: dashboard.php?success=Profile updated successfully");
        } else {
            header("Location: dashboard.php?error=Failed to update profile");
        }
        $stmt->close();
    } else {
        header("Location: dashboard.php?error=Failed to prepare statement");
    }
} else {
    header("Location: dashboard.php?error=Invalid form submission");
}

// Close the connection properly
$conn->close();
?>
