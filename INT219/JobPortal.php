<?php
include 'connect.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $jobtitle = $_POST['jobTitle']; // Changed to match SQL column
    $company = $_POST['company'];
    $applied_at = date('Y-m-d H:i:s'); // Store current timestamp

    // SQL query to insert data
    $sql = "INSERT INTO job_applications (name, email, job_title, company, applied_at) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error: " . $conn->error);
    }
    
    $stmt->bind_param("sssss", $name, $email, $jobtitle, $company, $applied_at);

    if ($stmt->execute()) {
        echo "<script>alert('Application submitted successfully!'); window.location.href='JobPortal.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to submit application.'); window.location.href='JobPortal.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal | Alumni</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script>
        function searchJobs() {
            const searchTerm = document.getElementById("jobSearch").value.toLowerCase();
            const jobList = document.getElementById("jobList");
            jobList.innerHTML = ""; // Clear existing results

            jobs.forEach(job => {
                if (job.title.toLowerCase().includes(searchTerm) || job.company.toLowerCase().includes(searchTerm)) {
                    jobList.innerHTML += `
                        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
                            <h2 class="text-2xl font-bold text-gray-800"><i class="fas fa-building mr-2"></i> ${job.title}</h2>
                            <p class="text-gray-600 mt-2">Company: ${job.company}</p>
                            <p class="text-gray-600">Location: ${job.location}</p>
                            <p class="text-gray-600">Salary: ${job.salary}</p>
                            <button onclick="applyJob('${job.title}', '${job.company}')" class="block bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 mt-4 rounded text-center transition">Apply Now</button>
                        </div>
                    `;
                }
            });

            // If no results found
            if (jobList.innerHTML === "") {
                jobList.innerHTML = "<p>No jobs found matching your search.</p>";
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-72 bg-gray-900 text-white p-6 fixed h-full">
            <h2 class="text-2xl font-bold text-center mb-6">🎓 Alumni Portal</h2>
            <nav>
                <ul>
                <li class="mb-4"><a href="dashboard.php" class="block p-3 bg-blue-600 hover:bg-blue-700 rounded transition"><i class="fas fa-tachometer-alt ml-2"></i>Dashboard</a></li>
                    <li class="mb-4"><a href="NetworkingHub.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-users ml-2"></i>Networking Hub</a></li>
                    <li class="mb-4"><a href="JobPortal.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-briefcase ml-2"></i>Job Portal</a></li>
                    <li class="mb-4"><a href="DonationPortal.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-donate ml-2"></i>Donations</a></li>
                    <li class="mb-4"><a href="EventsReunions.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-calendar-alt ml-2"></i>Events & Reunions</a></li>
                    <li class="mb-4"><a href="SuccessStories.php" class="block p-3 rounded hover:bg-gray-800 transition"><i class="fas fa-trophy ml-2"></i>Success Stories</a></li>
                    <li class="mt-8"><a href="logout.php" class="block bg-red-600 hover:bg-red-700 p-3 rounded text-center transition"><i class="fas fa-sign-out-alt ml-2"></i>Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 ml-72 overflow-y-auto">
            <!-- Page Header -->
            <section class="bg-gradient-to-r from-green-600 to-blue-500 text-white text-center py-14 px-10 rounded-lg shadow-lg mb-10">
                <h1 class="text-5xl font-extrabold">Job Portal 💼</h1>
                <p class="text-xl mt-3">Find job opportunities, connect with employers, and grow your career.</p>
            </section>

            <!-- Search Bar -->
            <div class="mb-8">
                <input type="text" id="jobSearch" class="w-full p-4 rounded shadow-lg border focus:outline-none" placeholder="🔍 Search for jobs, companies..." onkeyup="searchJobs()">
            </div>

            <!-- Job Listings -->
            <section id="jobList" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"></section>

            <!-- Apply Modal (Hidden by default) -->
            <div id="applyModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                    <h3 class="text-2xl font-bold mb-4">Apply for Job</h3>
                    <form id="applyForm" action="JobPortal.php" method="POST">
                        <input type="hidden" name="jobTitle" id="jobTitle">
                        <input type="hidden" name="company" id="company">
                        
                        <div class="mb-4">
                            <label for="name" class="block text-lg">Your Name</label>
                            <input type="text" name="name" id="name" class="w-full p-3 border rounded" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-lg">Your Email</label>
                            <input type="email" name="email" id="email" class="w-full p-3 border rounded" required>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg">Submit Application</button>
                            <button type="button" onclick="closeModal()" class="px-6 py-2 ml-4 bg-gray-300 text-white rounded-lg">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-8">
                <button id="loadMoreBtn" onclick="showMoreJobs()" class="px-6 py-3 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-lg font-semibold shadow-md hover:scale-105 transition-all">Load More 🔽</button>
            </div>

        </main>
    </div>

    <!-- JavaScript for Dynamic Job Search & Load More -->
    <script>
        const jobs = [
            { title: "Software Engineer", company: "Google", location: "California, USA", salary: "$100,000 - $120,000" },
            { title: "Data Analyst", company: "Microsoft", location: "Seattle, USA", salary: "$80,000 - $100,000" },
            { title: "Marketing Manager", company: "Amazon", location: "New York, USA", salary: "$90,000 - $110,000" },
            { title: "UX Designer", company: "Apple", location: "San Francisco, USA", salary: "$95,000 - $115,000" },
            { title: "Backend Developer", company: "Facebook", location: "Menlo Park, USA", salary: "$110,000 - $130,000" },
            { title: "Product Manager", company: "Tesla", location: "Austin, USA", salary: "$120,000 - $140,000" },

            // Hidden Jobs (Only appear on "Load More" or search)
            { title: "Cybersecurity Analyst", company: "Cisco", location: "San Diego, USA", salary: "$85,000 - $105,000" },
            { title: "AI Engineer", company: "OpenAI", location: "Remote", salary: "$150,000 - $180,000" },
            { title: "Cloud Engineer", company: "AWS", location: "Seattle, USA", salary: "$100,000 - $120,000" },
            { title: "HR Manager", company: "Netflix", location: "Los Angeles, USA", salary: "$90,000 - $110,000" },
            { title: "Finance Analyst", company: "Goldman Sachs", location: "New York, USA", salary: "$95,000 - $115,000" },
            { title: "Game Developer", company: "Ubisoft", location: "Montreal, Canada", salary: "$85,000 - $105,000" }
        ];

        let visibleJobs = 6;

        function displayJobs() {
            const jobList = document.getElementById("jobList");
            jobList.innerHTML = "";
            jobs.slice(0, visibleJobs).forEach(job => {
                jobList.innerHTML += `
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
                        <h2 class="text-2xl font-bold text-gray-800"><i class="fas fa-building mr-2"></i> ${job.title}</h2>
                        <p class="text-gray-600 mt-2">Company: ${job.company}</p>
                        <p class="text-gray-600">Location: ${job.location}</p>
                        <p class="text-gray-600">Salary: ${job.salary}</p>
                        <button onclick="applyJob('${job.title}', '${job.company}')" class="block bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 mt-4 rounded text-center transition">Apply Now</button>
                    </div>
                `;
            });
        }

        function applyJob(jobTitle, company) {
            document.getElementById("jobTitle").value = jobTitle;
            document.getElementById("company").value = company;
            document.getElementById("applyModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("applyModal").classList.add("hidden");
        }

        function showMoreJobs() {
            visibleJobs = jobs.length;
            displayJobs();
            document.getElementById("loadMoreBtn").style.display = "none"; 
        }

        // Initial load (Show only 6 jobs)
        displayJobs();
    </script>

</body>
</html>