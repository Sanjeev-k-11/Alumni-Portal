<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create users table if not exists
$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["signUp"])) {
        $firstName = trim($_POST["fName"]);
        $lastName = trim($_POST["lName"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password)) {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user data
            $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashed_password);
                if ($stmt->execute()) {
                    echo "<script>alert('Registration successful! You can now log in.');</script>";
                } else {
                    echo "<script>alert('Error: " . $stmt->error . "');</script>";
                }
                $stmt->close();
            }
        } else {
            echo "<script>alert('All fields are required!');</script>";
        }
    }

    if (isset($_POST["signIn"])) {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        if (!empty($email) && !empty($password)) {
            $sql = "SELECT id, firstName, lastName, password FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($id, $firstName, $lastName, $hashed_password);
                    $stmt->fetch();

                    if (password_verify($password, $hashed_password)) {
                        $_SESSION["user_id"] = $id;
                        $_SESSION["firstName"] = $firstName;
                        $_SESSION["lastName"] = $lastName;
                        $_SESSION["email"] = $email; // Store first name in session
                        header("Location: dashboard.php");
                        exit();
                    } else {
                        echo "<script>alert('Invalid password.');</script>";
                    }
                } else {
                    echo "<script>alert('User not found.');</script>";
                }
                $stmt->close();
            }
        } else {
            echo "<script>alert('All fields are required!');</script>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        .logo {
            width: auto;
            height: 60px; /* Adjusted height for better prominence */
            display: block; /* Ensures proper rendering and spacing */
        }
    </style>
</head>
<body class="flex justify-center items-center min-h-screen bg-gradient-to-r from-blue-300 via-purple-300 to-pink-300">
    <div class="relative w-[400px] overflow-hidden rounded-2xl shadow-2xl">
        <div id="container" class="w-[800px] flex transition-transform duration-700 ease-in-out transform">

            <!-- Login Form -->
            <div class="w-[400px] bg-white p-8">
                <!-- Logo -->
                <div class="flex justify-center mb-6">  <!-- Increased margin-bottom -->
                    <img src="icon.png" alt="Your App Logo" class="logo">  <!-- Replace your-logo.png -->
                </div>

                <h2 class="text-2xl font-bold text-center mb-4">Welcome Back!</h2>
                <form method="POST">
                    <input type="email" name="email" placeholder="Email" required class="w-full p-2 mb-4 border rounded-md focus:ring-2 focus:ring-blue-200 outline-none">
                    <input type="password" name="password" placeholder="Password" required class="w-full p-2 mb-4 border rounded-md focus:ring-2 focus:ring-blue-200 outline-none">
                    <button type="submit" name="signIn" class="w-full p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300">Login</button>
                </form>
                <p class="mt-4 text-sm text-gray-600">Don't have an account? <a href="#" onclick="toggleForm()" class="text-blue-500 hover:underline">Sign up</a></p>
            </div>

            <!-- Signup Form -->
            <div class="w-[400px] bg-white p-8">
               <!-- Logo -->
               <div class="flex justify-center mb-6">  <!-- Increased margin-bottom -->
                    <img src="icon.png" alt="Your App Logo" class="logo">  <!-- Replace your-logo.png -->
                </div>
                <h2 class="text-2xl font-bold text-center mb-4">Create Account</h2>
                <form method="POST">
                    <input type="text" name="fName" placeholder="First Name" required class="w-full p-2 mb-4 border rounded-md focus:ring-2 focus:ring-green-200 outline-none">
                    <input type="text" name="lName" placeholder="Last Name" required class="w-full p-2 mb-4 border rounded-md focus:ring-2 focus:ring-green-200 outline-none">
                    <input type="email" name="email" placeholder="Email" required class="w-full p-2 mb-4 border rounded-md focus:ring-2 focus:ring-green-200 outline-none">
                    <input type="password" name="password" placeholder="Password" required class="w-full p-2 mb-4 border rounded-md focus:ring-2 focus:ring-green-200 outline-none">
                    <button type="submit" name="signUp" class="w-full p-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-300">Sign Up</button>
                </form>
                <p class="mt-4 text-sm text-gray-600">Already have an account? <a href="#" onclick="toggleForm()" class="text-green-500 hover:underline">Login</a></p>
            </div>
        </div>
    </div>

    <script>
        function toggleForm() {
            const container = document.getElementById("container");
            container.style.transform = container.style.transform === "translateX(-400px)" ? "translateX(0)" : "translateX(-400px)";
        }
    </script>
</body>
</html>