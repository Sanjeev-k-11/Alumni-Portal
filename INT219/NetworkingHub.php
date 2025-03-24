<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Networking Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth;
            /* Smooth scrolling */
        }

        .hidden {
            display: none;
        }

        .modal-bg {
            background: rgba(0, 0, 0, 0.6);
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-72 bg-gray-900 text-white p-6 fixed h-full">
            <h2 class="text-2xl font-bold text-center mb-6">🎓 Alumni Portal</h2>
            <nav>
                <ul>
                    <li class="mb-4"><a href="dashboard.php" class="block p-3 rounded hover:bg-gray-800"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                    <li class="mb-4"><a href="NetworkingHub.php" class="block p-3 rounded bg-blue-600"><i class="fas fa-users mr-2"></i>Networking Hub</a></li>
                    <li class="mb-4"><a href="JobPortal.php" class="block p-3 rounded hover:bg-gray-800"><i class="fas fa-briefcase mr-2"></i>Job Portal</a></li>
                    <li class="mb-4"><a href="DonationPortal.php" class="block p-3 rounded hover:bg-gray-800"><i class="fas fa-donate mr-2"></i>Donations</a></li>
                    <li class="mb-4"><a href="EventsReunions.php" class="block p-3 rounded hover:bg-gray-800"><i class="fas fa-calendar-alt mr-2"></i>Events & Reunions</a></li>
                    <li class="mb-4"><a href="SuccessStories.php" class="block p-3 rounded hover:bg-gray-800"><i class="fas fa-trophy mr-2"></i>Success Stories</a></li>
                    <li class="mt-8"><a href="logout.php" class="block bg-red-600 hover:bg-red-700 p-3 rounded text-center"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 ml-72 overflow-y-auto">
            <section class="bg-gradient-to-r from-green-500 to-blue-600 text-white text-center py-14 px-10 rounded-lg shadow-lg mb-10">
                <h1 class="text-5xl font-extrabold">Networking Hub 🌐</h1>
                <p class="text-xl mt-3">Connect with alumni, explore opportunities, and grow your network.</p>
            </section>

            <!-- Alumni Connections Section -->
            <section id="alumniConnections" class="bg-white p-8 rounded-lg shadow-lg mb-10">
                <h2 class="text-3xl font-bold text-gray-800 mb-6"><i class="fas fa-users mr-2"></i>Connect with Alumni</h2>
                <p class="text-gray-600 mb-6">Reach out to fellow alumni for career guidance, collaboration, or just to reconnect.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Alumni 1 -->
                    <div class="bg-gray-100 p-5 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-gray-800">John Doe</h3>
                        <p class="text-gray-600">Software Engineer at Google</p>
                        <p class="text-gray-600">New York, NY</p>
                        <button onclick="openConnectionForm('John Doe')" class="mt-3 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Connect</button>
                    </div>
                    <!-- Alumni 2 -->
                    <div class="bg-gray-100 p-5 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-gray-800">Jane Smith</h3>
                        <p class="text-gray-600">Data Scientist at Facebook</p>
                        <p class="text-gray-600">San Francisco, CA</p>
                        <button onclick="openConnectionForm('Jane Smith')" class="mt-3 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Connect</button>
                    </div>
                    <!-- Alumni 3 -->
                    <div class="bg-gray-100 p-5 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-gray-800">Emily Johnson</h3>
                        <p class="text-gray-600">UX Designer at Apple</p>
                        <p class="text-gray-600">Austin, TX</p>
                        <button onclick="openConnectionForm('Emily Johnson')" class="mt-3 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Connect</button>
                    </div>
                </div>
            </section>

            <!-- Connection Request Modal -->
            <div id="connectionModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
                <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
                    <h3 class="text-2xl font-bold mb-4">Connect with Alumni</h3>
                    <form id="connectionForm" action="connectAlumni.php" method="POST">
                        <input type="hidden" id="alumniName" name="alumniName">

                        <!-- Name Field -->
                        <div class="mb-4">
                            <label for="name" class="block text-lg">Your Name</label>
                            <input type="text" name="name" id="name" class="w-full p-3 border rounded" required>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="block text-lg">Your Email</label>
                            <input type="email" name="email" id="email" class="w-full p-3 border rounded" required>
                        </div>

                        <!-- Phone Number Field -->
                        <div class="mb-4">
                            <label for="phone" class="block text-lg">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="w-full p-3 border rounded" required>
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg">Submit Request</button>
                            <button type="button" onclick="closeModal()" class="px-6 py-2 ml-4 bg-gray-300 text-white rounded-lg">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Mentor Section -->
            <section id="mentorSection" class="bg-white p-8 rounded-lg shadow-lg mb-10">
                <h2 class="text-3xl font-bold text-gray-800 mb-6"><i class="fas fa-chalkboard-teacher mr-2"></i>Find a Mentor</h2>
                <p class="text-gray-600 mb-6">Find mentors who can guide you in your career growth and personal development.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Mentor 1 -->
                    <div class="bg-gray-100 p-5 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-gray-800">Michael Brown</h3>
                        <p class="text-gray-600">Senior Project Manager at Microsoft</p>
                        <button onclick="openMentorshipForm('Michael Brown')" class="mt-3 bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">Request Mentorship</button>
                    </div>
                    <!-- Mentor 2 -->
                    <div class="bg-gray-100 p-5 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-gray-800">Sara Lee</h3>
                        <p class="text-gray-600">Lead Data Analyst at Amazon</p>
                        <button onclick="openMentorshipForm('Sara Lee')" class="mt-3 bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">Request Mentorship</button>
                    </div>
                    <!-- Mentor 3 -->
                    <div class="bg-gray-100 p-5 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-gray-800">David Wilson</h3>
                        <p class="text-gray-600">CEO at Startup</p>
                        <button onclick="openMentorshipForm('David Wilson')" class="mt-3 bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">Request Mentorship</button>
                    </div>
                </div>
            </section>

            <!-- Mentorship Request Modal -->
            <div id="mentorshipModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
                <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
                    <h3 class="text-2xl font-bold mb-4">Request Mentorship</h3>
                    <form id="mentorshipForm" action="requestMentorship.php" method="POST">
                        <input type="hidden" id="mentorName" name="mentorName">

                        <!-- Name Field -->
                        <div class="mb-4">
                            <label for="name" class="block text-lg">Your Name</label>
                            <input type="text" name="name" id="name" class="w-full p-3 border rounded" required>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="block text-lg">Your Email</label>
                            <input type="email" name="email" id="email" class="w-full p-3 border rounded" required>
                        </div>

                        <!-- Phone Number Field -->
                        <div class="mb-4">
                            <label for="phone" class="block text-lg">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="w-full p-3 border rounded" required>
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg">Submit Request</button>
                            <button type="button" onclick="closeModal()" class="px-6 py-2 ml-4 bg-gray-300 text-white rounded-lg">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Job Section -->

            <section id="jobs" class="bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-3xl font-bold text-gray-800 mb-6"><i class="fas fa-briefcase mr-2"></i>Job Opportunities</h2>
                <div id="job-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Job listings will load here -->
                </div>
                <button onclick="loadMoreJobs()" class="mt-5 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Load More Jobs
                </button>
            </section>

            <!-- Job Application Form Modal -->
            <div id="applicationModal" class="fixed inset-0 flex items-center justify-center modal-bg hidden">
                <div class="bg-white p-8 rounded-lg shadow-lg w-1/2">
                    <h2 id="modal-title" class="text-3xl font-bold"></h2>
                    <p id="modal-company" class="text-gray-600"></p>
                    <p id="modal-location" class="text-gray-600"></p>
                    <p id="modal-salary" class="text-gray-600 font-bold mt-2"></p>
                    <p id="modal-type" class="text-gray-600 font-bold"></p>
                    <p id="modal-description" class="text-gray-700 mt-4"></p>
                    <form method="POST" action="JobPortal.php" onsubmit="return handleSubmit(event);">
                        <input type="hidden" name="jobTitle" id="hiddenJobTitle">
                        <input type="hidden" name="company" id="hiddenCompany">

                        <label class="block mb-2 text-lg font-medium">Name</label>
                        <input type="text" name="name" class="w-full p-3 rounded border mb-4" required>

                        <label class="block mb-2 text-lg font-medium">Email</label>
                        <input type="email" name="email" class="w-full p-3 rounded border mb-4" required>

                        <div class="mt-6 flex justify-between">
                            <button type="button" onclick="closeApplicationModal()" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">Cancel</button>
                            <button type="submit" id="submitBtn" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">Apply Now</button>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Application Success Message -->
            <div id="successMessage" class="fixed bottom-5 right-5 bg-green-500 text-white p-4 rounded-lg shadow-lg hidden">
                ✅ Application submitted successfully!
            </div>



            <script>
                // Function to open the connection form with alumni name
                function openConnectionForm(alumniName) {
                    document.getElementById('alumniName').value = alumniName; // Store the alumni's name
                    document.getElementById('connectionModal').classList.remove('hidden'); // Show the modal
                }

                // Function to close the connection form
                function closeModal() {
                    document.getElementById('connectionModal').classList.add('hidden'); // Hide the modal
                }

                // Prevent multiple submissions (optional for this form)
                document.getElementById("connectionForm").addEventListener("submit", function(event) {
                    const submitButton = document.querySelector("button[type='submit']");
                    submitButton.disabled = true; // Disable the submit button to prevent multiple submissions
                });

                function openMentorshipForm(mentorName) {
                    document.getElementById('mentorName').value = mentorName; // Store the mentor's name
                    document.getElementById('mentorshipModal').classList.remove('hidden'); // Show the modal
                }

                // Function to close the mentorship form
                function closeModal() {
                    document.getElementById('mentorshipModal').classList.add('hidden'); // Hide the modal
                }

                // Prevent multiple submissions (optional for this form)
                document.getElementById("mentorshipForm").addEventListener("submit", function(event) {
                    const submitButton = document.querySelector("button[type='submit']");
                    submitButton.disabled = true; // Disable the submit button to prevent multiple submissions
                });
                let isSubmitting = false; // Flag to track submission

                function handleSubmit(event) {
                    if (isSubmitting) {
                        return false; // Prevents double submission
                    }

                    const submitBtn = document.getElementById('submitBtn');
                    submitBtn.disabled = true; // Disable button immediately
                    submitBtn.innerText = "Submitting..."; // Feedback to user

                    isSubmitting = true; // Set the flag to true
                    return true; // Allow form submission
                }


                function getRandomJobs(count) {
                    const jobTitles = ["Software Engineer", "Data Analyst", "UX Designer", "Marketing Manager", "Project Manager", "Cybersecurity Expert", "AI Engineer", "Full Stack Developer"];
                    const companies = ["Google", "Facebook", "Amazon", "Apple", "Netflix", "Tesla", "Microsoft", "Adobe"];
                    const locations = ["New York", "San Francisco", "California", "Texas", "Florida", "Seattle", "Boston", "Chicago"];
                    const salaries = ["$60,000 - $80,000", "$70,000 - $90,000", "$50,000 - $75,000", "$80,000 - $110,000"];
                    const jobTypes = ["Full-time", "Part-time", "Internship"];
                    const descriptions = [
                        "Work on cutting-edge technologies and contribute to major projects.",
                        "Analyze data trends and provide business insights.",
                        "Design user-friendly interfaces and enhance user experience.",
                        "Lead marketing campaigns and increase brand visibility.",
                        "Manage projects, coordinate teams, and ensure timely delivery."
                    ];

                    let jobs = [];
                    for (let i = 0; i < count; i++) {
                        let job = {
                            title: jobTitles[Math.floor(Math.random() * jobTitles.length)],
                            company: companies[Math.floor(Math.random() * companies.length)],
                            location: locations[Math.floor(Math.random() * locations.length)],
                            salary: salaries[Math.floor(Math.random() * salaries.length)],
                            type: jobTypes[Math.floor(Math.random() * jobTypes.length)],
                            description: descriptions[Math.floor(Math.random() * descriptions.length)]
                        };
                        jobs.push(job);
                    }
                    return jobs;
                }

                function loadMoreJobs() {
                    let jobList = document.getElementById("job-list");
                    let jobs = getRandomJobs(3);
                    jobs.forEach(job => {
                        let jobCard = document.createElement("div");
                        jobCard.className = "bg-gray-100 p-5 rounded-lg shadow-md hover:shadow-lg transition cursor-pointer";
                        jobCard.innerHTML = `<h3 class="text-xl font-bold text-gray-800">${job.title}</h3>
                                     <p class="text-gray-600">${job.company} - ${job.location}</p>`;
                        jobCard.onclick = function() {
                            openApplicationModal(job.title, job.company, job.location, job.salary, job.type, job.description);
                        };
                        jobList.appendChild(jobCard);
                    });
                }

                function openApplicationModal(title, company, location, salary, type, description) {
                    document.getElementById("modal-title").innerText = title;
                    document.getElementById("modal-company").innerText = `Company: ${company}`;
                    document.getElementById("modal-location").innerText = `Location: ${location}`;
                    document.getElementById("modal-salary").innerText = `Salary: ${salary}`;
                    document.getElementById("modal-type").innerText = `Job Type: ${type}`;
                    document.getElementById("modal-description").innerText = description;
                    document.getElementById("hiddenJobTitle").value = title;
                    document.getElementById("hiddenCompany").value = company;
                    document.getElementById("applicationModal").classList.remove("hidden");
                }

                function closeApplicationModal() {
                    document.getElementById("applicationModal").classList.add("hidden");
                }

                // Initial load of jobs
                loadMoreJobs();
            </script>



</body>

</html>