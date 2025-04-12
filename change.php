<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['error'])) {
    $messageType = 'error';
    $messageContent = htmlspecialchars($_GET['error']);
} elseif (isset($_GET['success'])) {
    $messageType = 'success';
    $messageContent = htmlspecialchars($_GET['success']);
} else {
    $messageType = '';
    $messageContent = '';
}

// Ensure that user information is properly set
$firstName = isset($_SESSION['firstName']) ? $_SESSION['firstName'] : 'Alumni';
$lastName = isset($_SESSION['lastName']) ? $_SESSION['lastName'] : 'Alumni';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Not Available';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Dashboard | Government Engineering College</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        /* Pop-up Styles */
        .message-popup {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 30px;
            border-radius: 10px;
            font-weight: bold;
            color: white;
            display: none;
            z-index: 1000;
        }

        .message-popup.error {
            background-color: #e74c3c;
        }

        .message-popup.success {
            background-color: #2ecc71;
        }

        .back-btn {
            display: inline-block;
            padding: 8px 12px;
            font-size: 16px;
            color: #4CAF50;
            font-weight: 600;
            text-decoration: none;
            border-bottom: 2px solid #4CAF50;
            margin-bottom: 10px;
            margin-top: 10px;
            transition: color 0.3s, border-color 0.3s;
        }

        .back-btn:hover {
            color: #45a049;
            border-color: #45a049;
        }

        .back-btn i {
            margin-right: 8px;
        }

        /* Body Background */
        body {
            background: linear-gradient(135deg, #3b4b5c, #2c3e50);
            background-size: 300% 300%;
            animation: gradientBG 10s ease infinite;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Animation for background */
        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>

<body class="font-sans text-gray-800">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white p-8 rounded-lg shadow-md text-center mb-10">
        <h1 class="text-3xl font-bold">Welcome, <?php echo htmlspecialchars($firstName); ?>!</h1>
        <p class="mt-2 text-lg">Your Alumni Portal awaits.</p>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto p-6">
        <!-- Go Back Button -->
        <a href="javascript:history.back()" class="back-btn">
            <i class="fas fa-arrow-left"></i> Go Back
        </a>

        <!-- User Info Section -->
        <section class="bg-white p-6 rounded-lg shadow-md mt-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">User Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p><strong>First Name:</strong> <?php echo htmlspecialchars($firstName); ?></p>
                    <p><strong>Last Name:</strong> <?php echo htmlspecialchars($lastName); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                </div>
                <div>
                    <h3 class="text-xl w-[50vh] font-semibold text-gray-800 mb-4 text-center">Edit Information</h3>
                    <form action="update_user.php" method="POST" class="space-y-4">
                        <input type="text" name="firstname" placeholder="New First Name" class="w-[50vh] p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <input type="text" name="lastName" placeholder="New Last Name" class="w-[50vh] p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <div class="text-center w-[50vh]">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700  transition">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Password Change Section -->
        <section class="bg-white w-[80vh] p-6 rounded-lg shadow-md mt-6 mx-auto flex flex-col items-center">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center w-full">Change Password</h2>
            <form action="change_password.php" method="POST" class="space-y-4 w-full max-w-[50vh]">
                <input type="password" name="old_password" placeholder="Current Password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <input type="password" name="new_password" placeholder="New Password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <input type="password" name="confirm_password" placeholder="Confirm New Password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <div class="text-center w-full">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition">Change Password</button>
                </div>
            </form>
        </section>
    </main>

    <!-- Pop-up Message -->
    <div id="messagePopup" class="message-popup <?php echo $messageType; ?>" role="alert">
        <?php echo $messageContent; ?>
    </div>

    <script>
        // Display pop-up message if exists
        window.onload = function() {
            const messagePopup = document.getElementById('messagePopup');
            if (messagePopup) {
                messagePopup.style.display = 'block';
                setTimeout(function() {
                    messagePopup.style.display = 'none';
                }, 5000); // Hide after 5 seconds
            }
        };
    </script>
</body>

</html>