<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Stories | Alumni</title>
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
                    <li class="mb-4"><a href="DonationPortal.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-donate mr-2"></i>Donations</a></li>
                    <li class="mb-4"><a href="EventsReunions.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-calendar-alt mr-2"></i>Events & Reunions</a></li>
                    <li class="mb-4"><a href="SuccessStories.php" class="block p-3 bg-blue-600 hover:bg-blue-700 rounded transition"><i class="fas fa-trophy mr-2"></i>Success Stories</a></li>
                    <li class="mt-8"><a href="logout.php" class="block bg-red-600 hover:bg-red-700 p-3 rounded text-center transition"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 ml-72 overflow-y-auto">
            <!-- Page Header -->
            <section class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white text-center py-14 px-10 rounded-lg shadow-lg mb-10">
                <h1 class="text-5xl font-extrabold">Success Stories 🌟</h1>
                <p class="text-xl mt-3">Be inspired by the achievements of our alumni.</p>
            </section>

            <!-- Success Stories Listings -->
            <section id="stories-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Stories will be loaded here -->
            </section>

            <!-- Load More Button -->
            <div class="text-center mt-8">
                <button id="load-more" class="px-6 py-3 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-lg font-semibold shadow-md hover:scale-105 transition-all">Load More Stories</button>
            </div>

            <!-- More Stories Coming Soon -->
            <div class="mt-16">
                <p class="text-center text-gray-600">More inspiring success stories coming soon...</p>
                <div class="h-48"></div> <!-- Just for scrolling effect -->
            </div>
        </main>
    </div>

    <!-- JavaScript for Read More -->
    <script>
    let currentIndex = 0;

    const stories = [
    {
        name: "Jane Doe", year: 2010, slogans: [
            "Innovating AI, one line of code at a time!",
            "Leading the charge in machine learning advancements.",
            "Building intelligent systems for a smarter future.",
            "Revolutionizing industries through artificial intelligence.",
            "Creating AI solutions that empower and transform."
        ]
    },
    {
        name: "John Smith", year: 2012, slogans: [
            "FinTech visionary, building financial freedom.",
            "Disrupting the financial world with innovative solutions.",
            "Creating accessible and equitable financial platforms.",
            "Empowering individuals through financial technology.",
            "Leading the next generation of financial innovation."
        ]
    },
    {
        name: "Emily Johnson", year: 2015, slogans: [
            "Data-driven healthcare revolutionizing medicine!",
            "Unlocking the power of data to improve healthcare outcomes.",
            "Pioneering data science in the medical field.",
            "Transforming healthcare with cutting-edge data analytics.",
            "Making breakthroughs in medicine through data-driven insights."
        ]
    },
    {
        name: "Michael Brown", year: 2011, slogans: [
            "Changing lives, one initiative at a time.",
            "Leading with empathy and dedication to social impact.",
            "Empowering communities through grassroots development.",
            "Making a difference in the lives of those in need.",
            "Creating sustainable solutions for a better world."
        ]
    },
    {
        name: "Jessica Davis", year: 2013, slogans: [
            "Words can change the world, one page at a time.",
            "Crafting stories that resonate and inspire.",
            "Bringing narratives to life through captivating prose.",
            "Exploring the human condition through the power of literature.",
            "Inspiring change and understanding through the written word."
        ]
    },
    {
        name: "Daniel Wilson", year: 2014, slogans: [
            "Making communication seamless, one app at a time.",
            "Connecting the world through innovative technology.",
            "Breaking down barriers with intuitive communication tools.",
            "Empowering global collaboration with seamless communication.",
            "Creating the future of connectivity and communication."
        ]
    },
    {
        name: "Olivia Martinez", year: 2016, slogans: [
            "Building brands that care, one ethical choice at a time.",
            "Creating sustainable and responsible fashion enterprises.",
            "Promoting ethical and eco-conscious consumerism.",
            "Driving positive change through fashion and style.",
            "Redefining fashion with a focus on sustainability and ethics."
        ]
    },
    {
        name: "Matthew Garcia", year: 2017, slogans: [
            "Power for tomorrow, one renewable source at a time.",
            "Harnessing the potential of clean and sustainable energy.",
            "Designing innovative solutions for a greener future.",
            "Leading the charge in renewable energy technology.",
            "Creating a world powered by sustainable and clean resources."
        ]
    },
    {
        name: "Sophia Lee", year: 2018, slogans: [
            "Learn at your own pace, one online lesson at a time.",
            "Revolutionizing education with accessible online resources.",
            "Creating inclusive and personalized learning experiences.",
            "Empowering individuals through flexible education.",
            "Transforming education with the power of digital learning."
        ]
    },
    {
        name: "David Anderson", year: 2019, slogans: [
            "Healing the world, one device at a time.",
            "Creating life-saving technologies.",
            "Leading the charge in developing state-of-the-art tools and more.",
            "Improving all the devices out there for your best healthcare.",
            "Healing through technology."
        ]
    },

    ];


    const generateUniqueStory = (name, year, slogans) => {
    const sloganList = slogans.map(slogan => `- ${slogan}`).join('\n');
    return `📖 ${name} (Class of ${year}):\n${sloganList}`;
    };

    function loadStories() {
        const container = document.getElementById('stories-container');
        const storiesToShow = stories.slice(currentIndex, currentIndex + 3);

        storiesToShow.forEach(story => {
            const storyCard = `
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
                    <h2 class="text-2xl font-bold text-gray-800">${story.name}</h2>
                    <p class="text-gray-600">🎓 Class of ${story.year}</p>
                    <button onclick="readMore('${story.name}', '${story.year}', '${encodeURIComponent(JSON.stringify(story.slogans))}')" class="block bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 mt-4 rounded text-center transition">Read More</button>
                </div>
            `;
            container.innerHTML += storyCard;
        });

        currentIndex += 3;

        // Disable the button when all stories are loaded
        if (currentIndex >= stories.length) {
            document.getElementById('load-more').disabled = true;
            document.getElementById('load-more').innerText = "No more stories to load!";
        }
    }

    function readMore(name, year, slogansJSON) {
     const slogans = JSON.parse(decodeURIComponent(slogansJSON));
         const story = generateUniqueStory(name, year, slogans);
        alert(story);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const loadMoreButton = document.getElementById('load-more');

        loadMoreButton.addEventListener('click', () => {
            if (currentIndex < stories.length) {
                loadStories();
            } else {
                loadMoreButton.disabled = true;
                loadMoreButton.innerText = "No more stories to load!"; // Update button text if no more stories
            }
        });

        loadStories(); // Load initial stories when page loads
    });
</script>

</body>
</html>