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
        <aside class="w-72 bg-orange-400 text-black p-6 fixed h-full">
            <h2 class="text-2xl font-bold text-center mb-6">🎓 Alumni Portal</h2>
            <nav>
                <ul>
                    <li class="mb-4"><a href="dashboard.php" class="block p-3 hover:bg-rose-50 rounded transition"><i class="fas fa-tachometer-alt ml-2"> </i> Dashboard</a></li>
                    <li class="mb-4"><a href="NetworkingHub.php" class="block p-3 rounded hover:bg-rose-50 transition"><i class="fas fa-users ml-2"> </i> Networking Hub</a></li>
                    <li class="mb-4"><a href="JobPortal.php" class="block p-3 rounded hover:bg-rose-50 transition"><i class="fas fa-briefcase ml-2"> </i> Job Portal</a></li>
                    <li class="mb-4"><a href="DonationPortal.php" class="block p-3 rounded hover:bg-rose-50 transition"><i class="fas fa-donate ml-2"> </i> Donations</a></li>
                    <li class="mb-4"><a href="EventsReunions.php" class="block p-3 rounded hover:bg-rose-50 transition"><i class="fas fa-calendar-alt ml-2"> </i> Events & Reunions</a></li>
                    <li class="mb-4"><a href="SuccessStories.php" class="block p-3 bg-orange-200 rounded hover:bg-rose-50 transition"><i class="fas fa-trophy ml-2"> </i> Success Stories</a></li>
                    <li class="mt-8"><a href="logout.php" class="block bg-red-600 hover:bg-red-700 p-3 rounded text-center transition"><i class="fas fa-sign-out-alt ml-2"> </i> Logout</a></li>
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

            
        </main>
    </div>

    <!-- JavaScript for Read More -->
    <script>
    let currentIndex = 0;

    const stories = [
    {
        name: "Aarav Mehta", year: 2010, slogans: [
            "Innovating AI, one line of code at a time!",
            "Driving machine learning advancements from Bengaluru.",
            "Building intelligent systems for a digital India.",
            "Transforming businesses with AI-powered solutions.",
            "Empowering industries with smart technology."
        ]
    },
    {
        name: "Priya Sharma", year: 2012, slogans: [
            "Championing women in FinTech from Mumbai.",
            "Simplifying finance with user-first design.",
            "Bridging financial gaps with technology.",
            "Creating inclusive platforms for Bharat.",
            "Driving FinTech for the next billion."
        ]
    },
    {
        name: "Rahul Verma", year: 2015, slogans: [
            "Revolutionizing Indian healthcare with data.",
            "From Delhi to diagnostics: powering hospitals with AI.",
            "Improving patient care using real-time analytics.",
            "Building data platforms for government hospitals.",
            "Transforming healthcare delivery in Tier-2 cities."
        ]
    },
    {
        name: "Sneha Iyer", year: 2011, slogans: [
            "Empowering rural India through digital literacy.",
            "Driving social change in Tamil Nadu's villages.",
            "Creating impact through grassroots innovation.",
            "Leading rural women into the digital age.",
            "Making change sustainable, community by community."
        ]
    },
    {
        name: "Karthik Reddy", year: 2013, slogans: [
            "Telling India's untold stories through cinema.",
            "Writing scripts that reflect real India.",
            "Voicing social causes through documentaries.",
            "Creating narratives that inspire change.",
            "Crafting Indian stories for the global stage."
        ]
    },
    {
        name: "Neha Kapoor", year: 2014, slogans: [
            "Making communication accessible across India.",
            "Breaking linguistic barriers with tech.",
            "Connecting Bharat with multilingual platforms.",
            "Bringing voice tech to every home.",
            "Simplifying communication for every Indian."
        ]
    },
    {
        name: "Ananya Bose", year: 2016, slogans: [
            "Leading the sustainable fashion movement in Kolkata.",
            "Crafting eco-conscious clothing with local artisans.",
            "Promoting handloom and heritage with ethics.",
            "Bringing conscious fashion to Indian youth.",
            "Sustainability stitched in every thread."
        ]
    },
    {
        name: "Rohit Deshmukh", year: 2017, slogans: [
            "Powering Maharashtra with solar innovation.",
            "Empowering villages with clean energy.",
            "From rooftops to grids: solar for all.",
            "Driving green energy startups in Pune.",
            "Creating India’s clean energy future."
        ]
    },
    {
        name: "Ishita Jain", year: 2018, slogans: [
            "Democratizing education in India with EdTech.",
            "Making learning accessible in every language.",
            "Building apps that reach every district.",
            "Empowering students with affordable learning.",
            "Redefining classrooms through digital transformation."
        ]
    },
    {
        name: "Arjun Nair", year: 2019, slogans: [
            "Innovating affordable healthcare devices for India.",
            "Designing med-tech for rural clinics.",
            "Building portable health solutions in Kerala.",
            "Enhancing diagnosis with low-cost innovations.",
            "Healthcare that reaches every corner of the country."
        ]
    }
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