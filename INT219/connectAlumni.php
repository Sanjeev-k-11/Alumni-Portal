<?php
// Include your database connection file
include 'connect.php'; // Make sure to adjust the path if needed

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $alumniName = $_POST['alumniName'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Sanitize input data to prevent SQL injection and XSS attacks
    $alumniName = htmlspecialchars(strip_tags($alumniName));
    $name = htmlspecialchars(strip_tags($name));
    $email = htmlspecialchars(strip_tags($email));
    $phone = htmlspecialchars(strip_tags($phone));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.location.href='NetworkingHub.php';</script>";
        exit;
    }

    // Prepare SQL query to insert the connection request into the database
    $sql = "INSERT INTO alumni_connections (alumni_name, student_name, student_email, student_phone, request_date) 
            VALUES (?, ?, ?, ?, NOW())";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $alumniName, $name, $email, $phone);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Connection request submitted successfully!'); window.location.href='NetworkingHub.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to submit connection request.'); window.location.href='NetworkingHub.php';</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to NetworkingHub page if the request is not POST
    header("Location: NetworkingHub.php");
    exit;
}
?>
