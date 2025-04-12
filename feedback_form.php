<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback & Surveys</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
        }
        p.instructions {
            text-align: center;
            color: #555;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Important */
        }
        textarea {
            height: 120px;
            resize: vertical; /* Allow vertical resize */
        }
        .rating-group label {
            display: inline-block; /* Align radio buttons horizontally */
            margin-right: 15px;
            font-weight: normal;
        }
         .rating-group input[type="radio"] {
            margin-right: 5px;
            vertical-align: middle; /* Align radio button with label text */
         }
        button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            text-align: center;
        }
        .message.success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }
         .message.error {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Feedback & Surveys</h1>
        <p class="instructions">Share your thoughts and help improve our services.</p>

        <?php
        // Display feedback messages if redirected here with status
        session_start(); // Start session to access session variables
        if (isset($_SESSION['feedback_status'])) {
            $status_type = $_SESSION['feedback_status']['type']; // 'success' or 'error'
            $status_message = $_SESSION['feedback_status']['message'];
            echo "<div class='message $status_type'>$status_message</div>";
            unset($_SESSION['feedback_status']); // Clear the message after displaying
        }
        ?>

        <form action="submit_feedback.php" method="post">
            <div class="form-group">
                <label for="name">Name (Optional)</label>
                <input type="text" id="name" name="user_name" placeholder="Your Name">
            </div>

            <div class="form-group">
                <label for="email">Email (Optional)</label>
                <input type="email" id="email" name="user_email" placeholder="your.email@example.com">
            </div>

             <div class="form-group">
                <label>Rating (Optional)</label>
                <div class="rating-group">
                    <label><input type="radio" name="rating" value="1"> 1 (Poor)</label>
                    <label><input type="radio" name="rating" value="2"> 2</label>
                    <label><input type="radio" name="rating" value="3"> 3 (Average)</label>
                    <label><input type="radio" name="rating" value="4"> 4</label>
                    <label><input type="radio" name="rating" value="5"> 5 (Excellent)</label>
                </div>
            </div>

            <div class="form-group">
                <label for="category">Category (Optional)</label>
                <select id="category" name="category">
                    <option value="">-- Select a Category --</option>
                    <option value="Website Feedback">Website Feedback</option>
                    <option value="Service Quality">Service Quality</option>
                    <option value="Product Suggestion">Product Suggestion</option>
                    <option value="General Inquiry">General Inquiry</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="feedback_text">Feedback / Comments *</label>
                <textarea id="feedback_text" name="feedback_message" placeholder="Please provide your detailed feedback here..." required></textarea>
            </div>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>

</body>
</html>