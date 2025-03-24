<?php
session_start();
require_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $cause = $_POST['cause'] ?? '';
    $amount = $_POST['amount'] ?? '';
    $payment_method = $_POST['payment_method'] ?? '';

    // Validate form fields
    if (empty($cause) || empty($amount) || empty($payment_method)) {
        echo "<script>alert('All fields are required!'); window.location.href='DonationPortal.php';</script>";
        exit;
    }

    // Insert donation record
    $sql = "INSERT INTO donations (cause, amount, payment_method) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sds", $cause, $amount, $payment_method);

        if ($stmt->execute()) {
            echo "<script>alert('Thank you for your donation!'); window.location.href='DonationPortal.php';</script>";
        } else {
            echo "<script>alert('Error submitting donation. Please try again!');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Database error!');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Portal | Alumni</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-72 bg-gray-900 text-white p-6 fixed h-full">
            <h2 class="text-2xl font-bold text-center mb-6">🎓 Alumni Portal</h2>
            <nav>
                <ul>
                    <li class="mb-4"><a href="dashboard.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                    <li class="mb-4"><a href="NetworkingHub.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-users mr-2"></i>Networking Hub</a></li>
                    <li class="mb-4"><a href="JobPortal.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-briefcase mr-2"></i>Job Portal</a></li>
                    <li class="mb-4"><a href="DonationPortal.php" class="block p-3 bg-blue-600 hover:bg-blue-700 rounded transition"><i class="fas fa-donate mr-2"></i>Donations</a></li>
                    <li class="mb-4"><a href="EventsReunions.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-calendar-alt mr-2"></i>Events & Reunions</a></li>
                    <li class="mb-4"><a href="SuccessStories.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-trophy mr-2"></i>Success Stories</a></li>
                    <li class="mt-8"><a href="logout.php" class="block bg-red-600 hover:bg-red-700 p-3 rounded text-center transition"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 ml-72 overflow-y-auto">
            <section class="bg-gradient-to-r from-yellow-500 to-orange-600 text-white text-center py-14 px-10 rounded-lg shadow-lg mb-10">
                <h1 class="text-5xl font-extrabold">Support Our Cause \ud83d\udc96</h1>
                <p class="text-xl mt-3">Your donations make a difference in education, health, and disaster relief.</p>
            </section>

            <!-- Donation Form -->
            <form action="DonationPortal.php" method="POST" class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Make a Donation</h2>

                <label class="block mb-2 text-lg font-semibold">Choose a Cause:</label>
                <select name="cause" class="w-full p-3 border rounded mb-4" required>
                    <option value="Education Support">🎓 Education Support</option>
                    <option value="Medical Aid">🏥 Medical Aid</option>
                    <option value="Disaster Relief">🌍 Disaster Relief</option>
                    <option value="Innovation & Research">💡 Innovation & Research</option>
                </select>

                <label class="block mb-2 text-lg font-semibold">Enter Amount ($):</label>
                <input type="number" name="amount" class="w-full p-3 border rounded mb-4" placeholder="Enter donation amount" required min="1">

                <label class="block mb-2 text-lg font-semibold">Payment Method:</label>
                <select name="payment_method" class="w-full p-3 border rounded mb-4" required>
                    <option value="Credit/Debit Card">💳 Credit/Debit Card</option>
                    <option value="PayPal">📱 PayPal</option>
                    <option value="Bank Transfer">🏦  Bank Transfer</option>
                </select>

                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white p-3 rounded text-lg font-bold transition">Donate Now</button>
            </form>
        </main>
    </div>
</body>
</html>
