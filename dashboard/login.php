<?php
session_start();

// Kapcsolódás az adatbázishoz
$servername = "localhost";
$username = ""; // Az adatbázis felhasználó neve
$password = ""; // Az adatbázis jelszó
$dbname = "umszkikresz_db"; // Az adatbázis neve

$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolódás ellenőrzése
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Bejelentkezés kezelése
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $felhasznalonev = $_POST['felhasznalonev'];
    $jelszo = $_POST['jelszo'];

    // Felhasználónév ellenőrzése
    $sql = "SELECT * FROM felhasznalok WHERE felhasznalonev = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $felhasznalonev);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Jelszó ellenőrzése
            if (password_verify($jelszo, $user['jelszo'])) {
                // Sikeres bejelentkezés, session elmentése
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['felhasznalonev'] = $user['felhasznalonev'];


                // Átirányítás a dashboardra
                header("Location: index.php");
                exit();
            } else {
                $error_message = "Hibás jelszó!";
            }
        } else {
            $error_message = "Nincs ilyen felhasználó!";
        }
        $stmt->close();
    } else {
        $error_message = "Hiba a lekérdezés végrehajtása során!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMSZKI KRESZ - Bejelentkezés</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4ff1b3cd4b.js" crossorigin="anonymous"></script>
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #f97316;
            --background: #f9fafb;
            --background-dark: #1e293b;
            --card: rgba(255, 255, 255, 0.9);
            --card-dark: rgba(30, 41, 59, 0.8);
            --text: #334155;
            --text-dark: #e2e8f0;
            --border: rgba(203, 213, 225, 0.4);
            --border-dark: rgba(71, 85, 105, 0.4);
            --shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            --shadow-dark: 0 8px 30px rgba(0, 0, 0, 0.25);
            --accent-1: #ec4899;
            --accent-2: #8b5cf6;
            --accent-3: #10b981;
            --accent-4: #f59e0b;
            --accent-5: #3b82f6;
        }

        /* Animation keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes shooting-star {
            0% {
                transform: translateX(0) translateY(0) rotate(215deg) scale(0);
                opacity: 0;
            }

            10% {
                transform: translateX(-20vw) translateY(20vh) rotate(215deg) scale(1);
                opacity: 1;
            }

            100% {
                transform: translateX(-100vw) translateY(100vh) rotate(215deg) scale(0.2);
                opacity: 0;
            }
        }

        @keyframes twinkle {

            0%,
            100% {
                opacity: 0.2;
            }

            50% {
                opacity: 1;
            }
        }

        @keyframes buttonGlow {

            0%,
            100% {
                box-shadow: 0 0 5px rgba(99, 102, 241, 0.4), 0 0 10px rgba(99, 102, 241, 0.2);
            }

            50% {
                box-shadow: 0 0 15px rgba(99, 102, 241, 0.6), 0 0 20px rgba(99, 102, 241, 0.4);
            }
        }

        /* Base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        body.dark {
            background-color: var(--background-dark);
            color: var(--text-dark);
        }

        /* Background effects */
        .background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .background-gradient {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--background) 0%, var(--background) 100%);
            transition: all 0.3s ease;
        }

        .dark .background-gradient {
            background: linear-gradient(135deg, var(--background-dark) 0%, #0f172a 100%);
        }

        .stars {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .dark .stars {
            opacity: 1;
        }

        .star {
            position: absolute;
            background-color: #ffffff;
            border-radius: 50%;
            animation: twinkle var(--duration, 4s) ease-in-out infinite;
            animation-delay: var(--delay, 0s);
            opacity: var(--opacity, 0.7);
        }

        .shooting-star {
            position: absolute;
            width: 100px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #ffffff, transparent);
            border-radius: 50%;
            filter: drop-shadow(0 0 6px #ffffff);
            animation: shooting-star var(--duration, 6s) linear infinite;
            animation-delay: var(--delay, 0s);
            opacity: 0;
        }

        .shooting-star::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 15px;
            height: 15px;
            background: radial-gradient(circle, #ffffff, transparent 70%);
            border-radius: 50%;
            transform: translateX(5px) translateY(-7px);
        }

        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            opacity: 0.3;
            animation: float var(--duration, 15s) ease-in-out infinite;
            animation-delay: var(--delay, 0s);
        }

        .dark .particle {
            opacity: 0.15;
        }

        /* Login container */
        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            background: var(--card);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            position: relative;
            z-index: 10;
            overflow: hidden;
            animation: fadeIn 0.8s ease;
            transition: all 0.3s ease;
        }

        .dark .login-container {
            background: var(--card-dark);
            border-color: var(--border-dark);
            box-shadow: var(--shadow-dark);
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .dark .login-container:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        /* Decorative elements */
        .corner-accent {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary);
            box-shadow: 0 0 10px rgba(99, 102, 241, 0.5);
            animation: pulse 4s infinite;
        }

        .corner-accent-1 {
            top: 15px;
            left: 15px;
        }

        .corner-accent-2 {
            top: 15px;
            right: 15px;
            animation-delay: 1s;
        }

        .corner-accent-3 {
            bottom: 15px;
            left: 15px;
            animation-delay: 2s;
        }

        .corner-accent-4 {
            bottom: 15px;
            right: 15px;
            animation-delay: 3s;
        }

        .circuit-lines {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 0;
            opacity: 0.1;
        }

        .circuit-line {
            position: absolute;
            background: var(--primary);
        }

        .circuit-line-1 {
            top: 20px;
            left: 20px;
            width: 30px;
            height: 2px;
        }

        .circuit-line-2 {
            top: 20px;
            left: 20px;
            width: 2px;
            height: 30px;
        }

        .circuit-line-3 {
            bottom: 20px;
            right: 20px;
            width: 30px;
            height: 2px;
        }

        .circuit-line-4 {
            bottom: 20px;
            right: 20px;
            width: 2px;
            height: 30px;
        }

        .glow-effect {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.3) 0%, transparent 70%);
            opacity: 0.5;
            z-index: -1;
            animation: pulse 4s infinite;
        }

        .glow-effect-top {
            top: -100px;
            right: -100px;
            width: 200px;
            height: 200px;
        }

        .glow-effect-bottom {
            bottom: -100px;
            left: -100px;
            width: 200px;
            height: 200px;
            animation-delay: 2s;
        }

        /* Logo and header */
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
            animation: pulse 3s infinite;
        }

        .logo i {
            font-size: 1.8rem;
        }

        .login-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .login-subtitle {
            font-size: 0.9rem;
            color: var(--text-secondary);
            opacity: 0.8;
        }

        /* Form elements */
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group label {
            position: absolute;
            top: 50%;
            left: 3rem;
            transform: translateY(-50%);
            color: rgba(51, 65, 85, 0.6);
            font-size: 0.9rem;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .dark .input-group label {
            color: rgba(226, 232, 240, 0.6);
        }

        .input-group input:focus~label,
        .input-group input:not(:placeholder-shown)~label {
            top: 0;
            left: 1rem;
            transform: translateY(-50%);
            font-size: 0.75rem;
            padding: 0 0.5rem;
            background: var(--card);
            border-radius: 4px;
            color: var(--primary);
            font-weight: 500;
        }

        .dark .input-group input:focus~label,
        .dark .input-group input:not(:placeholder-shown)~label {
            background: var(--card-dark);
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            color: rgba(51, 65, 85, 0.6);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .dark .input-icon {
            color: rgba(226, 232, 240, 0.6);
        }

        .input-group input:focus~.input-icon,
        .input-group input:not(:placeholder-shown)~.input-icon {
            color: var(--primary);
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            color: var(--text);
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .dark input[type="text"],
        .dark input[type="password"] {
            background: rgba(30, 41, 59, 0.3);
            border-color: var(--border-dark);
            color: var(--text-dark);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            background: rgba(255, 255, 255, 0.8);
        }

        .dark input[type="text"]:focus,
        .dark input[type="password"]:focus {
            background: rgba(30, 41, 59, 0.5);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }

        input::placeholder {
            color: transparent;
        }

        /* Remember me and forgot password */
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: relative;
            display: inline-block;
            width: 18px;
            height: 18px;
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid var(--border);
            border-radius: 4px;
            margin-right: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dark .checkmark {
            background: rgba(30, 41, 59, 0.3);
            border-color: var(--border-dark);
        }

        .remember-me:hover input~.checkmark {
            border-color: var(--primary);
        }

        .remember-me input:checked~.checkmark {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-color: transparent;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
            left: 6px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .remember-me input:checked~.checkmark:after {
            display: block;
        }

        .remember-me label {
            color: rgba(51, 65, 85, 0.8);
            font-size: 0.85rem;
            cursor: pointer;
            user-select: none;
        }

        .dark .remember-me label {
            color: rgba(226, 232, 240, 0.8);
        }

        .forgot-password a {
            color: var(--primary);
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .forgot-password a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Button */
        .button-container {
            margin-bottom: 1.5rem;
        }

        .login-button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            border-radius: 0.75rem;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            animation: buttonGlow 3s infinite;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        .login-button:active {
            transform: translateY(1px);
        }

        .login-button::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.2),
                    transparent);
            transition: all 0.6s ease;
        }

        .login-button:hover::before {
            left: 100%;
        }

        /* Error message */
        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border-left: 3px solid #ef4444;
            color: #ef4444;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            animation: fadeIn 0.5s ease;
        }

        .dark .error-message {
            background: rgba(239, 68, 68, 0.2);
        }

        /* Social login */
        .login-divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .login-divider::before,
        .login-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .dark .login-divider::before,
        .dark .login-divider::after {
            background: var(--border-dark);
        }

        .login-divider span {
            padding: 0 1rem;
            color: rgba(51, 65, 85, 0.6);
            font-size: 0.85rem;
        }

        .dark .login-divider span {
            color: rgba(226, 232, 240, 0.6);
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .social-button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid var(--border);
            color: var(--text);
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dark .social-button {
            background: rgba(30, 41, 59, 0.3);
            border-color: var(--border-dark);
            color: var(--text-dark);
        }

        .social-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .dark .social-button:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .social-button.facebook {
            color: #1877f2;
        }

        .social-button.google {
            color: #ea4335;
        }

        .social-button.twitter {
            color: #1da1f2;
        }

        /* Sign up link */
        .signup-link {
            text-align: center;
            font-size: 0.9rem;
            color: rgba(51, 65, 85, 0.8);
        }

        .dark .signup-link {
            color: rgba(226, 232, 240, 0.8);
        }

        .signup-link a {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .signup-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Theme toggle */
        .theme-toggle {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--card);
            border: 1px solid var(--border);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 100;
            box-shadow: var(--shadow);
        }

        .dark .theme-toggle {
            background: var(--card-dark);
            border-color: var(--border-dark);
            color: var(--text-dark);
            box-shadow: var(--shadow-dark);
        }

        .theme-toggle:hover {
            transform: rotate(30deg);
        }

        /* Responsive styles */
        @media (max-width: 480px) {
            .login-container {
                padding: 2rem 1.5rem;
                max-width: 90%;
            }

            .login-title {
                font-size: 1.5rem;
            }

            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .forgot-password {
                align-self: flex-end;
            }
        }
    </style>
</head>

<body>
    <!-- Background effects -->
    <div class="background-container">
        <div class="background-gradient"></div>
        <div class="stars" id="stars"></div>
        <div class="particles" id="particles"></div>
    </div>

    <!-- Theme toggle button -->
    <button id="themeToggle" class="theme-toggle">
        <i class="fa-solid fa-moon"></i>
    </button>

    <!-- Login container -->
    <div class="login-container">
        <!-- Decorative elements -->
        <div class="corner-accent corner-accent-1"></div>
        <div class="corner-accent corner-accent-2"></div>
        <div class="corner-accent corner-accent-3"></div>
        <div class="corner-accent corner-accent-4"></div>

        <div class="circuit-lines">
            <div class="circuit-line circuit-line-1"></div>
            <div class="circuit-line circuit-line-2"></div>
            <div class="circuit-line circuit-line-3"></div>
            <div class="circuit-line circuit-line-4"></div>
        </div>

        <div class="glow-effect glow-effect-top"></div>
        <div class="glow-effect glow-effect-bottom"></div>

        <!-- Login header -->
        <div class="login-header">
            <div class="logo-container">
                <div class="logo">
                    <i class="fa-solid fa-car-side"></i>
                </div>
            </div>
            <h1 class="login-title">UMSZKI KRESZ</h1>
            <p class="login-subtitle">Jelentkezz be a folytatáshoz</p>
        </div>

        <!-- Login form -->
        <form method="POST" action="">
            <?php if (isset($error_message)): ?>
                <div class="error-message">
                    <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <div class="input-group">
                <i class="fa-solid fa-user input-icon"></i>
                <input type="text" id="felhasznalonev" name="felhasznalonev" placeholder=" " required>
                <label for="felhasznalonev">Felhasználónév</label>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock input-icon"></i>
                <input type="password" id="jelszo" name="jelszo" placeholder=" " required>
                <label for="jelszo">Jelszó</label>
            </div>

            <div class="button-container">
                <button type="submit" class="login-button">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Bejelentkezés
                </button>
            </div>
        </form>

        <script>
            // Theme toggle functionality
            const themeToggle = document.getElementById('themeToggle');
            const body = document.body;
            const icon = themeToggle.querySelector('i');

            // Check for saved theme preference or default to light
            if (localStorage.getItem('theme') === 'dark') {
                body.classList.add('dark');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }

            themeToggle.addEventListener('click', toggleTheme);

            function toggleTheme() {
                body.classList.toggle('dark');

                if (body.classList.contains('dark')) {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                    localStorage.setItem('theme', 'dark');
                } else {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                    localStorage.setItem('theme', 'light');
                }
            }

            // Create stars for dark mode
            document.addEventListener('DOMContentLoaded', function () {
                const starsContainer = document.getElementById('stars');
                const starCount = 150;

                // Create fixed stars
                for (let i = 0; i < starCount; i++) {
                    const star = document.createElement('div');
                    star.classList.add('star');

                    // Random position
                    const posX = Math.random() * 100;
                    const posY = Math.random() * 100;

                    // Random size
                    const size = Math.random() * 3 + 1;

                    // Random opacity and animation
                    const opacity = Math.random() * 0.7 + 0.3;
                    const duration = Math.random() * 5 + 3;
                    const delay = Math.random() * 5;

                    // Apply styles
                    star.style.left = `${posX}%`;
                    star.style.top = `${posY}%`;
                    star.style.width = `${size}px`;
                    star.style.height = `${size}px`;
                    star.style.opacity = opacity;
                    star.style.setProperty('--opacity', opacity);
                    star.style.setProperty('--duration', `${duration}s`);
                    star.style.setProperty('--delay', `${delay}s`);

                    starsContainer.appendChild(star);
                }

                // Create shooting stars periodically
                function createShootingStar() {
                    const shootingStar = document.createElement('div');
                    shootingStar.classList.add('shooting-star');

                    // Random position (always start from top-right area)
                    const posX = Math.random() * 50 + 50;
                    const posY = Math.random() * 30;

                    // Random animation duration
                    const duration = Math.random() * 3 + 3;

                    // Apply styles
                    shootingStar.style.left = `${posX}%`;
                    shootingStar.style.top = `${posY}%`;
                    shootingStar.style.setProperty('--duration', `${duration}s`);
                    shootingStar.style.setProperty('--delay', '0s');

                    starsContainer.appendChild(shootingStar);

                    // Remove shooting star after animation completes
                    setTimeout(() => {
                        shootingStar.remove();
                    }, duration * 1000);
                }

                // Create shooting stars periodically
                setInterval(createShootingStar, 4000);

                // Create initial shooting stars
                for (let i = 0; i < 2; i++) {
                    setTimeout(createShootingStar, i * 1500);
                }

                // Create floating particles
                const particlesContainer = document.getElementById('particles');
                const particleCount = 15;

                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');

                    // Random position
                    const posX = Math.random() * 100;
                    const posY = Math.random() * 100;

                    // Random size
                    const size = Math.random() * 100 + 50;

                    // Random animation
                    const duration = Math.random() * 20 + 10;
                    const delay = Math.random() * 10;

                    // Apply styles
                    particle.style.left = `${posX}%`;
                    particle.style.top = `${posY}%`;
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.setProperty('--duration', `${duration}s`);
                    particle.style.setProperty('--delay', `${delay}s`);

                    particlesContainer.appendChild(particle);
                }

                // Add 3D hover effect to login container
                const loginContainer = document.querySelector('.login-container');

                loginContainer.addEventListener('mousemove', (e) => {
                    const rect = loginContainer.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;

                    const moveX = (x - centerX) / 25;
                    const moveY = (y - centerY) / 25;

                    loginContainer.style.transform = `translateY(-5px) rotateX(${-moveY}deg) rotateY(${moveX}deg)`;
                });

                loginContainer.addEventListener('mouseleave', () => {
                    loginContainer.style.transform = 'translateY(0) rotateX(0) rotateY(0)';
                });

                // Password strength indicator
                const passwordInput = document.getElementById('jelszo');
                if (passwordInput) {
                    passwordInput.addEventListener('input', function () {
                        // You can add password strength indicator functionality here
                    });
                }
            });
        </script>
</body>
</html>