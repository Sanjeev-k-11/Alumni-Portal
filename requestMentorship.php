<?php
// Include your database connection file (adjust the path if necessary)
include 'connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $mentorName = $_POST['mentorName'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Prepare SQL query to insert the mentorship request into the database
    $sql = "INSERT INTO mentorship_requests (mentor_name, student_name, student_email, student_phone, request_date) 
            VALUES (?, ?, ?, ?, NOW())";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $mentorName, $name, $email, $phone);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Mentorship request submitted successfully!'); window.location.href='NetworkingHub.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to submit mentorship request.'); window.location.href='NetworkingHub.php';</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
