<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the database
if (!$conn->select_db($dbname)) {
    die("Error selecting database: " . $conn->error);
}

// Function to check if all required fields are present
function checkRequiredFields($fields, $data) {
    foreach ($fields as $field) {
        if (empty($data[$field])) {
            die("Error: All fields are required!");
        }
    }
}

// Create tables if they do not exist
$createTablesSQL = [
    "CREATE TABLE IF NOT EXISTS mentorship_requests (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        request_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        status VARCHAR(50) NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS event_registrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        event_id INT NOT NULL,
        registration_date DATETIME DEFAULT CURRENT_TIMESTAMP
    )",
    "CREATE TABLE IF NOT EXISTS donations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        amount DECIMAL(10, 2) NOT NULL,
        donation_date DATETIME DEFAULT CURRENT_TIMESTAMP
    )",
    "CREATE TABLE IF NOT EXISTS job_applications (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        job_id INT NOT NULL,
        application_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        status VARCHAR(50) NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS alumni_connections (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        alumni_id INT NOT NULL,
        connection_date DATETIME DEFAULT CURRENT_TIMESTAMP
    )"
];

foreach ($createTablesSQL as $sql) {
    if ($conn->query($sql) === FALSE) {
        die("Error creating table: " . $conn->error);
    }
}

// Create connection using PDO
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
