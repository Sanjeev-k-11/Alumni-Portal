<?php
$servername = "localhost";
$username = "root"; // Your DB username
$password = ""; // Your DB password
$dbname = "login"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : null;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : null;
    $job_title = isset($_POST['jobTitle']) ? mysqli_real_escape_string($conn, $_POST['jobTitle']) : null;
    $company = isset($_POST['company']) ? mysqli_real_escape_string($conn, $_POST['company']) : null;

    if ($name && $email && $job_title && $company) {
        // Insert application into the database
        $sql = "INSERT INTO job_applications (name, email, job_title, company) 
                VALUES ('$name', '$email', '$job_title', '$company')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Application submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: All fields are required!";
    }

   
}
?>
