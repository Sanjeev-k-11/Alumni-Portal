<?php
session_start();
require_once "connect.php"; // Ensure this connects to the correct database

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit("Unauthorized access!");
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: dashboard.php");
    exit();
}

// Retrieve and sanitize POST inputs
$old_password = trim($_POST["old_password"] ?? "");
$new_password = trim($_POST["new_password"] ?? "");
$confirm_password = trim($_POST["confirm_password"] ?? "");

// Validate inputs
if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
    header("Location: change.php?error=All fields are required!");
    exit();
}

if ($new_password !== $confirm_password) {
    header("Location: change.php?error=New passwords do not match!");
    exit();
}

$user_id = $_SESSION["user_id"];

// Fetch current password from the database
$sql = "SELECT password FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    header("Location: change.php?error=Failed to prepare SELECT statement!");
    exit();
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close(); // Close after fetching

// Verify the old password
if (!$row || !password_verify($old_password, $row["password"])) {
    header("Location: change.php?error=Old password is incorrect!");
    exit();
}

// Hash the new password
$new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

// Update password in the database
$sql = "UPDATE users SET password = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    header("Location: change.php?error=Failed to prepare UPDATE statement!");
    exit();
}

$stmt->bind_param("si", $new_hashed_password, $user_id);

if ($stmt->execute()) {
    header("Location: change.php?success=Password changed successfully!");
} else {
    header("Location: change.php?error=Error updating password!");
}

// Close properly
$stmt->close();
$conn->close();
exit();
?>
