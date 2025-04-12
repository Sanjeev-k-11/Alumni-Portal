<?php
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Dashboard | Government Engineering College</title>
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
                    <li class="mb-4"><a href="dashboard.php" class="block p-3 bg-blue-600 hover:bg-blue-700 rounded transition"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
                    <li class="mb-4"><a href="NetworkingHub.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-users mr-2"></i>Networking Hub</a></li>
                    <li class="mb-4"><a href="JobPortal.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-briefcase mr-2"></i>Job Portal</a></li>
                    <li class="mb-4"><a href="DonationPortal.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-donate mr-2"></i>Donations</a></li>
                    <li class="mb-4"><a href="EventsReunions.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-calendar-alt mr-2"></i>Events & Reunions</a></li>
                    <li class="mb-4"><a href="SuccessStories.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-trophy mr-2"></i>Success Stories</a></li>
                    <li class="mt-8"><a href="logout.php" class="block bg-red-600 hover:bg-red-700 p-3 rounded text-center transition"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 ml-72 overflow-y-auto">
            <!-- Profile Section -->
            <section class="bg-white p-6 rounded-lg shadow-lg flex flex-col mb-10">
                <div>
                    <h2 class="text-4xl font-bold">Welcome, <?php echo isset($_SESSION['firstName']) ? htmlspecialchars($_SESSION['firstName']) : 'Alumni'; ?>! 🎉</h2>
                    <p><?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Email not available'; ?></p>
                    <p class="text-gray-600">🎓 Class of 2012 | Software Engineer at Google</p>
                    <p class="text-gray-600">📍 San Francisco, USA</p>

                    <!-- Change Password Button -->
                    <a href="change.php" class="mt-4 inline-flex items-center bg-gray-800 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-gray-700 transition">
                        <i class="fas fa-key mr-2"></i> Change Password
                    </a>
                </div>
            </section>

            <!-- Dashboard Overview -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Networking Hub -->
                <div class="bg-blue-500 text-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold"><i class="fas fa-users mr-2"></i>Networking Hub</h2>
                    <p class="mt-2">Connect with alumni in your industry.</p>
                    <a href="NetworkingHub.php" class="block mt-4 bg-white text-blue-600 py-2 px-4 rounded text-center font-bold">Explore</a>
                </div>

                <!-- Job Portal -->
                <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold"><i class="fas fa-briefcase mr-2"></i>Job Portal</h2>
                    <p class="mt-2">Find job opportunities and post job openings.</p>
                    <a href="JobPortal.php" class="block mt-4 bg-white text-green-600 py-2 px-4 rounded text-center font-bold">Explore</a>
                </div>

                <!-- Donations -->
                <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold"><i class="fas fa-donate mr-2"></i>Donations</h2>
                    <p class="mt-2">Support college projects and initiatives.</p>
                    <a href="DonationPortal.php" class="block mt-4 bg-white text-yellow-600 py-2 px-4 rounded text-center font-bold">Donate Now</a>
                </div>

                <!-- Events & Reunions -->
                <div class="bg-purple-500 text-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold"><i class="fas fa-calendar-alt mr-2"></i>Events & Reunions</h2>
                    <p class="mt-2">Stay updated on upcoming alumni events.</p>
                    <a href="EventsReunions.php" class="block mt-4 bg-white text-purple-600 py-2 px-4 rounded text-center font-bold">View Events</a>
                </div>

                <!-- Success Stories -->
                <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold"><i class="fas fa-trophy mr-2"></i>Success Stories</h2>
                    <p class="mt-2">Read about inspiring alumni achievements.</p>
                    <a href="SuccessStories.php" class="block mt-4 bg-white text-red-600 py-2 px-4 rounded text-center font-bold">Explore</a>
                </div>

                <!-- Feedback & Surveys -->
                <div class="bg-teal-500 text-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold"><i class="fas fa-comments mr-2"></i>Feedback & Surveys</h2>
                    <p class="mt-2">Share your thoughts and help improve our services.</p>
                    <a href="feedback_form.php" class="block mt-4 bg-white text-teal-600 py-2 px-4 rounded text-center font-bold">Give Feedback</a>
                </div>
            </section>

            <!-- More Features Coming Soon -->
            <div class="mt-16">
                <p class="text-center text-gray-600">More features coming soon...</p>
                <div class="h-48"></div> <!-- Just for scrolling effect -->
            </div>
        </main>
    </div>

</body>
</html>
