<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FAQ Accordion</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body >
    <div><?php include 'header1.php'; ?></div>
    <div class="bg-white text-gray-800 font-sans px-6 py-10"> 
  <div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-10">FREQUENTLY ASKED QUESTIONS</h2>

    <!-- FAQ Item -->
    <div class="border-t pt-8 pb-6">
      <button onclick="toggleFAQ(1)" class="w-full flex justify-between items-center text-left text-lg font-semibold focus:outline-none">
        1. What is this website all about?
        <span id="arrow-1" class="transition-transform duration-300">▼</span>
      </button>
      <div id="faq-1" class="mt-4 text-gray-600 hidden">
        It is the official website of LPU Alumni. It is one of the several initiatives of Lovely Professional University Alumni Association. LPUAA aims to bring the entire alumni community together through this website.
      </div>
    </div>

    <div class="border-t pt-8 pb-6">
      <button onclick="toggleFAQ(2)" class="w-full flex justify-between items-center text-left text-lg font-semibold focus:outline-none">
        2. How can I register/login?
        <span id="arrow-2" class="transition-transform duration-300">▼</span>
      </button>
      <div id="faq-2" class="mt-4 text-gray-600 hidden">
        We encourage you to login through Facebook and LinkedIn. The system auto verifies instantly if you are an alumnus and gives you necessary access.
      </div>
    </div>

    <div class="border-t pt-8 pb-6">
      <button onclick="toggleFAQ(3)" class="w-full flex justify-between items-center text-left text-lg font-semibold focus:outline-none">
        3. How secure is my data?
        <span id="arrow-3" class="transition-transform duration-300">▼</span>
      </button>
      <div id="faq-3" class="mt-4 text-gray-600 hidden">
        The complete database is secured using industry standard security protocols. No user can access the data without appropriate permissions.
      </div>
    </div>

    <div class="border-t pt-8 pb-6">
      <button onclick="toggleFAQ(4)" class="w-full flex justify-between items-center text-left text-lg font-semibold focus:outline-none">
        4. My profile is incorrect. What do I do?
        <span id="arrow-4" class="transition-transform duration-300">▼</span>
      </button>
      <div id="faq-4" class="mt-4 text-gray-600 hidden">
        Profile information is retrieved from various sources and there is always a possibility that your information is not 100% accurate. The easiest thing to do is to ‘Improve your profile’. It takes less than a minute to update your information.
      </div>
    </div>

    <div class="border-t pt-8 pb-6 border-b">
      <button onclick="toggleFAQ(5)" class="w-full flex justify-between items-center text-left text-lg font-semibold focus:outline-none">
        5. Can I contact members on this website?
        <span id="arrow-5" class="transition-transform duration-300">▼</span>
      </button>
      <div id="faq-5" class="mt-4 text-gray-600 hidden">
        Based on your role with the college you will have permissions to contact various alumni. You can also control what communication you receive so that you don’t have to see a lot of irrelevant emails.
      </div>
    </div>

  </div>
  </div>
<div><?php include 'footer.php'; ?></div>
  <script>
    function toggleFAQ(id) {
      const faq = document.getElementById(`faq-${id}`);
      const arrow = document.getElementById(`arrow-${id}`);
      faq.classList.toggle("hidden");
      arrow.classList.toggle("rotate-180");
    }
  </script>
  
</body>
</html>
