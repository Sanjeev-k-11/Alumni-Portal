<?php
include 'db_connect.php';

// Fetch mentorship requests
$sql = "SELECT * FROM mentorship_requests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Mentor Name: " . $row["mentor_name"]. " - Student Name: " . $row["student_name"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
