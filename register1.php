<?php
// register1.php
session_start();
$conn = new mysqli("localhost", "root", "", "login"); // Adjust DB credentials if needed

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['name'], $_POST['email'], $_POST['event'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $event = $conn->real_escape_string($_POST['event']);
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO event_registrations (name, email, event, registration_date)
            VALUES ('$name', '$email', '$event', '$date')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Registration successful for $event!";
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
    }
    $conn->close();
    header("Location: EventsReunions.php"); // Redirect back to events page
    exit;
} else {
    echo "Invalid form submission.";
}
?>
