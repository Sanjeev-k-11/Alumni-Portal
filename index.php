<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

try {
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    $conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
    if (!$conn->select_db($dbname)) {
         throw new Exception("Database selection failed: " . $conn->error);
    }
    $conn->query("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        firstName VARCHAR(100) NOT NULL,
        lastName VARCHAR(100) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
} catch (Exception $e) {
    error_log("Database setup error: " . $e->getMessage());
    die("A critical database error occurred. Please contact support or try again later.");
}

$message = '';
$message_type = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $message_type = $_SESSION['message_type'] ?? 'error';
    unset($_SESSION['message'], $_SESSION['message_type']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $redirect_location = $_SERVER['PHP_SELF'];
    $form_type_on_redirect = isset($_POST["signIn"]) ? 'login' : 'signup';

    try {
        if (isset($_POST["signUp"])) {
            $form_type_on_redirect = 'signup';
            $firstName = trim($_POST["fName"]);
            $lastName = trim($_POST["lName"]);
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);

            if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
                throw new Exception('All fields are required for signup!');
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 throw new Exception('Please enter a valid email address.');
            }
             if (strlen($password) < 6) {
                 throw new Exception('Password must be at least 6 characters long.');
             }

            $sqlCheck = "SELECT id FROM users WHERE email = ?";
            $stmtCheck = $conn->prepare($sqlCheck);
             if(!$stmtCheck) throw new Exception("Database error (checking email). Please try again.");
            $stmtCheck->bind_param("s", $email);
            $stmtCheck->execute();
            $stmtCheck->store_result();
            if ($stmtCheck->num_rows > 0) {
                 $stmtCheck->close();
                 throw new Exception('This email address is already registered.');
            }
            $stmtCheck->close();

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            if ($hashed_password === false) {
                throw new Exception("Error hashing password. Please try again.");
            }

            $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                 throw new Exception("Database error (creating user). Please try again.");
            }
            $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['message'] = 'Registration successful! You can now log in.';
                $_SESSION['message_type'] = 'success';
                $form_type_on_redirect = 'login';
            } else {
                 error_log("Signup DB Error: " . $stmt->error);
                 throw new Exception("Signup failed. Please try again later.");
            }
            $stmt->close();

        } elseif (isset($_POST["signIn"])) {
            $form_type_on_redirect = 'login';
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);

            if (empty($email) || empty($password)) {
                 throw new Exception('Email and password are required for login!');
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 throw new Exception('Please enter a valid email address.');
            }

            $sql = "SELECT id, firstName, lastName, password FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
             if (!$stmt) {
                 throw new Exception("Database error (finding user). Please try again.");
            }
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $db_firstName, $db_lastName, $hashed_password);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    session_regenerate_id(true);
                    $_SESSION["user_id"] = $id;
                    $_SESSION["firstName"] = $db_firstName;
                    $_SESSION["lastName"] = $db_lastName;
                    $_SESSION["email"] = $email;
                    $stmt->close();
                    $conn->close();
                    header("Location: dashboard.php");
                    exit();
                } else {
                     throw new Exception('Invalid email or password.');
                }
            } else {
                 throw new Exception('Invalid email or password.');
            }
            $stmt->close();
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['message_type'] = 'error';
    }

    $conn->close();
    header("Location: " . $redirect_location . "?form=" . $form_type_on_redirect);
    exit();
}

$initial_form = $_GET['form'] ?? 'login';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow: hidden;
        }
        .logo {
            width: auto;
            height: 55px;
            display: block;
            margin: 0 auto 1.75rem auto; /* Center logo */
        }
        .input-group {
            position: relative;
            margin-bottom: 1.25rem;
        }
        .input-icon {
            position: absolute;
            left: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            pointer-events: none;
            transition: color 0.3s ease;
            font-size: 0.9rem;
        }
        .input-field {
            padding-left: 2.8rem;
            width: 100%;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            background-color: #f9fafb;
            color: #1f2937;
            font-size: 0.9rem;
        }
        .input-field::placeholder { color: #9ca3af; }
        .input-field:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
            background-color: #ffffff;
        }
        .input-field:focus + .input-icon { color: #6366f1; }

        .btn {
            display: inline-block;
            transition: all 0.3s ease;
            padding: 0.8rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            width: 100%;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            cursor: pointer;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
         .btn:active {
            transform: translateY(0px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .btn-login { background-color: #6366f1; }
        .btn-login:hover { background-color: #4f46e5; }
        .btn-signup { background-color: #10b981; }
        .btn-signup:hover { background-color: #059669; }

        .feedback-message {
            padding: 0.8rem 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-align: center;
            border: 1px solid transparent;
            opacity: 0;
            animation: fadeInFeedback 0.5s 0.1s ease-out forwards; /* Added delay */
        }
        .feedback-success {
            background-color: #dcfce7; color: #166534; border-color: #86efac;
        }
        .feedback-error {
            background-color: #fee2e2; color: #991b1b; border-color: #fca5a5;
        }
        @keyframes fadeInFeedback { to { opacity: 1; } }

        .form-container-wrapper {
            width: 400px;
            max-width: 95%;
            overflow: hidden;
            border-radius: 1rem;
            background-color: #ffffff;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            position: relative; /* Needed for message positioning */
             opacity: 0; /* Start hidden for animation */
             animation: popIn 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55) forwards; /* Pop-in animation */
             animation-delay: 0.1s;
        }
        @keyframes popIn {
             from { opacity: 0; transform: scale(0.9); }
             to { opacity: 1; transform: scale(1); }
        }

        .form-slider {
            width: 800px; /* Double the wrapper width */
            display: flex;
            /* Smooth transition with cubic-bezier easing */
            transition: transform 0.8s cubic-bezier(0.77, 0, 0.175, 1);
        }
        .form-section {
            width: 400px; /* Match wrapper width */
            padding: 2.5rem; /* p-10 */
            flex-shrink: 0; /* Prevent shrinking */
            box-sizing: border-box;
             display: flex;
             flex-direction: column;
             justify-content: center; /* Center content vertically */
        }

        .form-switch-link {
            font-weight: 600;
            transition: color 0.3s ease;
        }
        .form-switch-link:hover { text-decoration: underline; }
        .link-login { color: #6366f1; }
        .link-login:hover { color: #4338ca; }
        .link-signup { color: #059669; }
        .link-signup:hover { color: #047857; }

         /* Message position inside wrapper */
         .message-area {
             position: absolute;
             top: 1rem;
             left: 1rem;
             right: 1rem;
             z-index: 10; /* Ensure message is above form content during transitions */
             pointer-events: none; /* Allow clicks through if empty */
         }
         .message-area .feedback-message {
             pointer-events: auto; /* Make message itself clickable if needed */
         }


    </style>
</head>
<body>

    <div class="form-container-wrapper">

        <div class="message-area">
             <?php if ($message): ?>
                <div class="feedback-message <?php echo ($message_type === 'success') ? 'feedback-success' : 'feedback-error'; ?>" role="alert">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
        </div>

        <div id="formSlider" class="form-slider">

            <!-- Login Form Section -->
            <div class="form-section">
                <img src="icon.png" alt="App Logo" class="logo">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Welcome Back!</h2>
                <p class="text-center text-gray-500 text-sm mb-6">Log in to continue.</p>

                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email Address" required class="input-field" autocomplete="email">
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Password" required class="input-field" autocomplete="current-password">
                         <i class="fas fa-lock input-icon"></i>
                    </div>
                    <button type="submit" name="signIn" class="btn btn-login mt-3">
                        Login
                    </button>
                </form>
                <p class="mt-6 text-sm text-center text-gray-600">
                    Don't have an account?
                    <a href="#" onclick="switchForm(event, 'signup')" class="form-switch-link link-login">
                        Sign up
                    </a>
                </p>
            </div>

            <!-- Signup Form Section -->
            <div class="form-section">
                <img src="icon.png" alt="App Logo" class="logo">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Create Account</h2>
                 <p class="text-center text-gray-500 text-sm mb-6">Join us today!</p>

                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                     <div class="input-group">
                        <input type="text" name="fName" placeholder="First Name" required class="input-field" autocomplete="given-name">
                         <i class="fas fa-user input-icon"></i>
                    </div>
                     <div class="input-group">
                        <input type="text" name="lName" placeholder="Last Name" required class="input-field" autocomplete="family-name">
                         <i class="fas fa-user input-icon"></i>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email Address" required class="input-field" autocomplete="email">
                         <i class="fas fa-envelope input-icon"></i>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Create Password (min. 6 chars)" required class="input-field" autocomplete="new-password">
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                    <button type="submit" name="signUp" class="btn btn-signup mt-3">
                        Sign Up
                    </button>
                </form>
                <p class="mt-6 text-sm text-center text-gray-600">
                    Already have an account?
                    <a href="#" onclick="switchForm(event, 'login')" class="form-switch-link link-signup">
                        Login
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        const formSlider = document.getElementById('formSlider');
        const initialForm = '<?php echo $initial_form; ?>';

        function switchForm(event, targetForm) {
            if (event) event.preventDefault();

            if (targetForm === 'signup') {
                formSlider.style.transform = 'translateX(-400px)'; // Slide left to show signup
            } else { // targetForm === 'login'
                formSlider.style.transform = 'translateX(0px)'; // Slide right to show login
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Set initial slider position without animation first
             if (initialForm === 'signup') {
                 formSlider.style.transition = 'none'; // Disable transition temporarily
                 formSlider.style.transform = 'translateX(-400px)';
                 // Force reflow/repaint before re-enabling transition
                 formSlider.offsetHeight; // Reading offsetHeight forces reflow
                 formSlider.style.transition = ''; // Re-enable transition
             } else {
                 formSlider.style.transform = 'translateX(0px)';
             }

            // Clean the URL
            if (window.history.replaceState) {
                const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                window.history.replaceState({ path: cleanUrl }, '', cleanUrl);
            }
        });

    </script>

</body>
</html>