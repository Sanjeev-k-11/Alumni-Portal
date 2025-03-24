<?php
session_start();
if (isset($_SESSION['message'])) {
    echo "<div class='bg-green-500 text-white p-4 rounded mb-4 text-center font-bold'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events & Reunions | Alumni</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex">
    <aside class="fixed inset-y-0 left-0 w-72 bg-gray-900 text-white p-6 h-full">
            <h2 class="text-2xl font-bold text-center mb-6">🎓 Alumni Portal</h2>
            <nav>
            <ul>
                <li class="mb-4"><a href="dashboard.php" class="block p-3 bg-blue-600 hover:bg-blue-700 rounded transition"> <i class="fas fa-tachometer-alt ml-2"></i> Dashboard</a></li>
                    <li class="mb-4"><a href="NetworkingHub.php" class="block p-3 rounded hover:bg-gray-800 transition"> <i class="fas fa-users ml-2"></i> Networking Hub</a></li>
                    <li class="mb-4"><a href="JobPortal.php" class="block p-3 rounded hover:bg-gray-800 transition"> <i class="fas fa-briefcase ml-2"></i> Job Portal</a></li>
                    <li class="mb-4"><a href="DonationPortal.php" class="block p-3 rounded hover:bg-gray-800 transition"> <i class="fas fa-donate ml-2"></i> Donations</a></li>
                    <li class="mb-4"><a href="EventsReunions.php" class="block p-3 rounded hover:bg-gray-800 transition"> <i class="fas fa-calendar-alt ml-2"></i> Events & Reunions</a></li>
                    <li class="mb-4"><a href="SuccessStories.php" class="block p-3 rounded hover:bg-gray-800 transition"> <i class="fas fa-trophy ml-2"></i> Success Stories</a></li>
                    <li class="mt-8"><a href="logout.php" class="block bg-red-600 hover:bg-red-700 p-3 rounded text-center transition"> <i class="fas fa-sign-out-alt ml-2"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main class="flex-1 p-10 ml-72 overflow-y-auto">
            <section class="bg-gradient-to-r from-purple-600 to-blue-500 text-white text-center py-14 px-10 rounded-lg shadow-lg mb-10">
                <h1 class="text-5xl font-extrabold">Events & Reunions 🎉</h1>
                <p class="text-xl mt-3">Join alumni events, reunions, and stay connected with your network.</p>
            </section>

            <section id="events-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"></section>

            <div class="text-center mt-10">
                <button id="load-more" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded transition">Load More</button>
            </div>

            <div class="mt-16">
                <p class="text-center text-gray-600">More exciting events coming soon...</p>
                <div class="h-48"></div>
            </div>
        </main>
    </div>

    <script>
        const eventNames = [
            'Annual Alumni Meet', 'Tech Innovation Summit', 'Alumni Sports Day',
            'Healthcare & Wellness Seminar', 'Networking Gala', 'Cultural Fest',
            'Entrepreneurship Bootcamp', 'Music & Arts Festival', 'Career Development Workshop',
            'Fundraising Dinner', 'AI & Robotics Conference', 'Green Energy Forum'
        ];

        const venues = [
            'Grand Hall, New York', 'Silicon Valley', 'University Stadium',
            'Healthcare Center, LA', 'Downtown Conference Hall', 'Cultural Arena',
            'Startup Hub, SF', 'City Park Amphitheater', 'Career Hub, Chicago',
            'Luxury Banquet Hall', 'Tech Park Auditorium', 'Green Energy Plaza'
        ];

        const events = Array.from({ length: 80 }, (_, i) => ({
            name: eventNames[i % eventNames.length],
            date: `2025-${String(Math.floor(i / 12) + 1).padStart(2, '0')}-${String((i % 30) + 1).padStart(2, '0')}`,
            venue: venues[i % venues.length]
        }));

        let currentIndex = 0;
        const batchSize = 3;

        function loadEvents() {
            const container = document.getElementById('events-container');
            const end = currentIndex + batchSize;
            for (let i = currentIndex; i < end && i < events.length; i++) {
                const event = events[i];
                const eventCard = `
                    <div class='bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all'>
                        <h2 class='text-2xl font-bold text-gray-800'><i class='fas fa-calendar mr-2'></i> ${event.name}</h2>
                        <p class='text-gray-600 mt-2'>📅 Date: ${event.date}</p>
                        <p class='text-gray-600'>📍 Venue: ${event.venue}</p>
                        <button onclick="showRegisterForm(${i})" class='block bg-green-600 hover:bg-green-700 text-white py-2 px-4 mt-4 rounded transition'>Register</button>
                        <form id="register-form-${i}" method='POST' action='register1.php' style="display: none;" class="mt-4">
                            <input type='text' name='name' placeholder='Your Name' required class='border p-2 w-full mt-2 rounded'>
                            <input type='email' name='email' placeholder='Your Email' required class='border p-2 w-full mt-2 rounded'>
                            <input type='hidden' name='event' value='${event.name}'>
                            <button type='submit' class='block bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 mt-4 rounded transition'>Submit</button>
                        </form>
                    </div>
                `;
                container.innerHTML += eventCard;
            }
            currentIndex += batchSize;
            if (currentIndex >= events.length) {
                document.getElementById('load-more').style.display = 'none';
            }
        }

        function showRegisterForm(index) {
            document.getElementById(`register-form-${index}`).style.display = 'block';
        }

        document.getElementById('load-more').addEventListener('click', loadEvents);

        window.onload = loadEvents;
    </script>

</body>
</html>
