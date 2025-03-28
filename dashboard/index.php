<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Function to fetch latest data
function fetchLatestData($conn, $licenseFilter = 'all', $searchQuery = '') {
    // SQL query with filters
    $sql = "SELECT * FROM registrations WHERE 1=1";
    if ($licenseFilter != 'all') {
        $sql .= " AND license = '$licenseFilter'";
    }

    if (!empty($searchQuery)) {
        $searchQuery = $conn->real_escape_string($searchQuery);
        $sql .= " AND (id LIKE '%$searchQuery%' OR name LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%' OR license LIKE '%$searchQuery%')";
    }

    $result = $conn->query($sql);
    $registrations = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $registrations[] = $row;
        }
    }

    // Calculate statistics
    $statistics = [
        'a' => 0,
        'b' => 0,
        'c' => 0,
        'd' => 0,
        'e' => 0
    ];

    foreach ($registrations as $row) {
        $statistics[$row['license']]++;
    }

    return [
        'registrations' => $registrations,
        'statistics' => $statistics
    ];
}

// Felhasználói név lekérése a session-ból
$userName = isset($_SESSION['felhasznalonev']) ? $_SESSION['felhasznalonev'] : 'Név nem található';

// Kijelentkezés funkció
if (isset($_GET['logout'])) {
    session_unset(); // Minden session változó törlése
    session_destroy(); // Session befejezése
    header("Location: login.php"); // Visszairányítás a login.php-ra
    exit();
}

// Adatbázis kapcsolat beállítása
$servername = "localhost";
$username = ""; // Adatbázis felhasználó
$password = ""; // Adatbázis jelszó
$dbname = ""; // Az adatbázis neve

// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolódás ellenőrzése
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// AJAX endpoint for fetching data
if (isset($_GET['fetch_data']) && $_GET['fetch_data'] == 'true') {
    $licenseFilter = isset($_GET['license_filter']) ? $_GET['license_filter'] : 'all';
    $searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';
    
    $data = fetchLatestData($conn, $licenseFilter, $searchQuery);
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

// Alapértelmezett értékek
$updateMessage = '';
$profilePicture = 'assets/default-avatar.png';
$userData = [
    'nickname' => $userName,
    'username' => $userName, // Alapértelmezetten a becenév és felhasználónév megegyezik
    'email' => ''
];

// Felhasználói adatok lekérése
$userId = $_SESSION['user_id'];
$userQuery = "SHOW TABLES LIKE 'felhasznalok'";
$tableExists = $conn->query($userQuery);

if ($tableExists->num_rows > 0) {
    $userQuery = "SELECT * FROM felhasznalok WHERE id = '$userId'";
    $userResult = $conn->query($userQuery);

    if ($userResult && $userResult->num_rows > 0) {
        $userData = $userResult->fetch_assoc();

        // Profilkép elérési útja
        if (isset($userData['profile_picture']) && !empty($userData['profile_picture']) && file_exists($userData['profile_picture'])) {
            $profilePicture = $userData['profile_picture'];
        }

        // Beállítjuk a nickname értékét a felhasznalonev alapján
        $userData['nickname'] = $userData['felhasznalonev'];
        $userData['username'] = $userData['felhasznalonev'];
    }
}

// Jogosítvány típus szűrésének kezelése
$licenseFilter = isset($_GET['license_filter']) ? $_GET['license_filter'] : 'all';
$searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Törlés kezelése
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $deleteSql = "DELETE FROM registrations WHERE id = '$deleteId'";
    if ($conn->query($deleteSql) === TRUE) {
        echo "<script>alert('A jelentkező törölve lett: ID - " . $deleteId . "');</script>";
    }
}

// Becenév módosítás kezelése
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_nickname'])) {
    $newNickname = trim($_POST['nickname']);

    // Ellenőrizzük, hogy a becenév nem üres
    if (empty($newNickname)) {
        $updateMessage = '<div class="alert alert-danger">A becenév nem lehet üres!</div>';
    } else {
        // Becenév frissítése az adatbázisban
        $updateNicknameSql = "UPDATE felhasznalok SET felhasznalonev = '" . $conn->real_escape_string($newNickname) . "' WHERE id = '$userId'";

        if ($conn->query($updateNicknameSql) === TRUE) {
            // Frissítsük a session-ben is a felhasználónevet
            $_SESSION['felhasznalonev'] = $newNickname;
            $userName = $newNickname;
            $userData['felhasznalonev'] = $newNickname;
            $userData['nickname'] = $newNickname;
            $updateMessage = '<div class="alert alert-success">A becenév sikeresen módosítva!</div>';
        } else {
            $updateMessage = '<div class="alert alert-danger">Hiba történt a becenév módosítása során: ' . $conn->error . '</div>';
        }
    }
}

// Jelszó módosítás kezelése
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Ellenőrizzük, hogy az új jelszó és a megerősítés egyezik-e
    if ($newPassword !== $confirmPassword) {
        $updateMessage = '<div class="alert alert-danger">Az új jelszó és a megerősítés nem egyezik!</div>';
    }
    // Ellenőrizzük, hogy az új jelszó elég hosszú-e
    elseif (strlen($newPassword) < 6) {
        $updateMessage = '<div class="alert alert-danger">Az új jelszónak legalább 6 karakter hosszúnak kell lennie!</div>';
    } else {
        // Ellenőrizzük a jelenlegi jelszót
        $passwordQuery = "SELECT jelszo FROM felhasznalok WHERE id = '$userId'";
        $passwordResult = $conn->query($passwordQuery);

        if ($passwordResult && $passwordResult->num_rows > 0) {
            $passwordData = $passwordResult->fetch_assoc();

            // Ellenőrizzük, hogy a jelenlegi jelszó helyes-e
            // Először megnézzük, hogy hash-elt jelszó-e, ha igen, akkor password_verify-t használunk
            if (
                (function_exists('password_verify') && password_verify($currentPassword, $passwordData['jelszo']))
                || $currentPassword === $passwordData['jelszo']
            ) {

                // Jelszó hashelése
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Jelszó frissítése az adatbázisban
                $updatePasswordSql = "UPDATE felhasznalok SET jelszo = '$hashedPassword' WHERE id = '$userId'";

                if ($conn->query($updatePasswordSql) === TRUE) {
                    $updateMessage = '<div class="alert alert-success">A jelszó sikeresen módosítva!</div>';
                } else {
                    $updateMessage = '<div class="alert alert-danger">Hiba történt a jelszó módosítása során: ' . $conn->error . '</div>';
                }
            } else {
                $updateMessage = '<div class="alert alert-danger">A jelenlegi jelszó helytelen!</div>';
            }
        } else {
            $updateMessage = '<div class="alert alert-danger">Felhasználói adatok nem találhatók!</div>';
        }
    }
}

// SQL lekérdezés szűrve a választott jogosítvány típus szerint, és kereső lekérdezés hozzáadása
$sql = "SELECT * FROM registrations WHERE 1=1"; // 1=1 biztosítja, hogy mindig legyen WHERE feltétel
if ($licenseFilter != 'all') {
    $sql .= " AND license = '$licenseFilter'";
}

if (!empty($searchQuery)) {
    $searchQuery = $conn->real_escape_string($searchQuery);  // Megakadályozza az SQL injekciót
    $sql .= " AND (id LIKE '%$searchQuery%' OR name LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%' OR license LIKE '%$searchQuery%')";
}

$result = $conn->query($sql);
$registrations = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $registrations[] = $row;
    }
} else {
    $registrations = [];  // Ha nincsenek eredmények, akkor üres tömb
}

// Statisztikák (kördiagram adatok)
$statistics = [
    'a' => 0,
    'b' => 0,
    'c' => 0,
    'd' => 0,
    'e' => 0
];

foreach ($registrations as $row) {
    $statistics[$row['license']]++;
}

// Aktív oldal kezelése
$activePage = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

$conn->close();
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelentkezők Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        /* Base styles */
        body {
            background-color: var(--background);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            overflow-x: hidden;
        }

        body.dark {
            background-color: var(--background-dark);
            color: var(--text-dark);
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar styles */
        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 2rem 1.5rem;
            position: fixed;
            height: 100vh;
            transition: all 0.4s ease;
            z-index: 1000;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar-item {
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .sidebar-item a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
            text-decoration: none;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .sidebar-item:hover a {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .sidebar-item.active a {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Main content styles */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            transition: all 0.4s ease;
        }

        /* Header styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            animation: fadeIn 0.6s ease;
        }

        .greeting-card {
            background: var(--card);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
            width: 100%;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .dark .greeting-card {
            background: var(--card-dark);
            border-color: var(--border-dark);
            box-shadow: var(--shadow-dark);
        }

        .avatar {
            width: 50px;
            height: 50px;
            background-color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.25rem;
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .greeting {
            flex: 1;
        }

        .greeting h2 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: var(--text);
        }

        .dark .greeting h2 {
            color: var(--text-dark);
        }

        .greeting p {
            margin: 0;
            color: rgba(51, 65, 85, 0.8);
            font-size: 0.875rem;
        }

        .dark .greeting p {
            color: rgba(226, 232, 240, 0.8);
        }

        /* Actions bar styles */
        .actions-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            animation: fadeIn 0.7s ease;
        }

        .search-form {
            flex: 1;
            position: relative;
            min-width: 200px;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border-radius: 0.75rem;
            border: 1px solid var(--border);
            background-color: var(--card);
            font-size: 0.875rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }

        .dark .search-input {
            background-color: var(--card-dark);
            border-color: var(--border-dark);
            color: var(--text-dark);
            box-shadow: var(--shadow-dark);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(51, 65, 85, 0.5);
        }

        .dark .search-icon {
            color: rgba(226, 232, 240, 0.5);
        }

        .filter-form {
            min-width: 200px;
            position: relative;
        }

        .filter-select {
            appearance: none;
            width: 100%;
            padding: 0.75rem 2.5rem 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid var(--border);
            background-color: var(--card);
            font-size: 0.875rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }

        .dark .filter-select {
            background-color: var(--card-dark);
            border-color: var(--border-dark);
            color: var(--text-dark);
            box-shadow: var(--shadow-dark);
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .filter-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(51, 65, 85, 0.5);
            pointer-events: none;
        }

        .dark .filter-icon {
            color: rgba(226, 232, 240, 0.5);
        }

        /* Card styles */
        .card {
            background: var(--card);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            animation: fadeIn 0.8s ease;
        }

        .dark .card {
            background: var(--card-dark);
            border-color: var(--border-dark);
            box-shadow: var(--shadow-dark);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-title i {
            color: var(--primary);
        }

        /* Table styles */
        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .data-table th {
            text-align: left;
            padding: 1rem 1.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            color: rgba(51, 65, 85, 0.8);
            border-bottom: 1px solid var(--border);
            background-color: transparent;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .dark .data-table th {
            color: rgba(226, 232, 240, 0.8);
            border-bottom: 1px solid var(--border-dark);
        }

        .data-table td {
            padding: 1rem 1.5rem;
            font-size: 0.875rem;
            border-bottom: 1px solid var(--border);
            background-color: transparent;
            vertical-align: middle;
        }

        .dark .data-table td {
            border-bottom: 1px solid var(--border-dark);
        }

        .data-table tbody tr {
            transition: all 0.3s ease;
        }

        .data-table tbody tr:hover {
            background-color: rgba(99, 102, 241, 0.05);
        }

        .dark .data-table tbody tr:hover {
            background-color: rgba(99, 102, 241, 0.1);
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        .license-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            font-weight: 600;
            font-size: 0.75rem;
            color: white;
        }

        .license-a {
            background-color: var(--accent-1);
        }

        .license-b {
            background-color: var(--accent-2);
        }

        .license-c {
            background-color: var(--accent-3);
        }

        .license-d {
            background-color: var(--accent-4);
        }

        .license-e {
            background-color: var(--accent-5);
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border-radius: 0.5rem;
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .action-btn:hover {
            background-color: rgba(239, 68, 68, 0.2);
            transform: translateY(-2px);
        }

        /* Stats card styles */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--card);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            animation: fadeIn 0.9s ease;
        }

        .dark .stat-card {
            background: var(--card-dark);
            border-color: var(--border-dark);
            box-shadow: var(--shadow-dark);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .dark .stat-card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .stat-title {
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(51, 65, 85, 0.8);
            margin-bottom: 0.5rem;
        }

        .dark .stat-title {
            color: rgba(226, 232, 240, 0.8);
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        /* Chart styles */
        .chart-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }

        @media (max-width: 1200px) {
            .chart-section {
                grid-template-columns: 1fr;
            }
        }

        .chart-wrapper {
            position: relative;
            height: 300px;
            margin-top: 1rem;
        }

        .legend-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            background-color: rgba(255, 255, 255, 0.5);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            animation: slideIn 0.5s ease both;
        }

        .dark .legend-item {
            background-color: rgba(30, 41, 59, 0.5);
            border-color: var(--border-dark);
        }

        .legend-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .legend-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .legend-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        .legend-item:nth-child(4) {
            animation-delay: 0.4s;
        }

        .legend-item:nth-child(5) {
            animation-delay: 0.5s;
        }

        .legend-item:hover {
            transform: translateX(5px);
        }

        .legend-color {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            margin-right: 1rem;
        }

        .legend-text {
            font-weight: 500;
        }

        /* Toggle button styles */
        .theme-toggle {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .theme-toggle:hover {
            transform: rotate(30deg);
        }

        /* Empty state */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            text-align: center;
        }

        .empty-icon {
            font-size: 3rem;
            color: var(--border);
            margin-bottom: 1rem;
        }

        .dark .empty-icon {
            color: var(--border-dark);
        }

        .empty-text {
            font-size: 1rem;
            font-weight: 500;
            color: rgba(51, 65, 85, 0.6);
        }

        .dark .empty-text {
            color: rgba(226, 232, 240, 0.6);
        }

        /* Settings styles */
        .settings-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid var(--border);
            background-color: var(--card);
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .dark .form-control {
            background-color: rgba(30, 41, 59, 0.6);
            border-color: var(--border-dark);
            color: var(--text-dark);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        /* Alert styles */
        .alert {
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            animation: fadeIn 0.5s ease;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .dark .alert-success {
            background-color: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34d399;
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .dark .alert-danger {
            background-color: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
        }

        /* Password strength indicator */
        .password-strength {
            height: 5px;
            margin-top: 8px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .strength-weak {
            background-color: #ef4444;
            width: 30%;
        }

        .strength-medium {
            background-color: #f59e0b;
            width: 60%;
        }

        .strength-strong {
            background-color: #10b981;
            width: 100%;
        }

        .password-feedback {
            font-size: 0.75rem;
            margin-top: 5px;
        }

        /* Responsive styles */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                padding: 1.5rem 0.75rem;
            }

            .sidebar-brand span,
            .sidebar-item span {
                display: none;
            }

            .sidebar-brand {
                justify-content: center;
                margin-bottom: 2rem;
            }

            .sidebar-item a {
                justify-content: center;
                padding: 0.75rem;
            }

            .main-content {
                margin-left: 80px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1.5rem;
            }

            .greeting-card {
                padding: 1rem;
            }

            .greeting h2 {
                font-size: 1.1rem;
            }

            .actions-bar {
                flex-direction: column;
            }

            .filter-form,
            .search-form {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 0;
                padding: 0;
                overflow: hidden;
            }

            .sidebar.active {
                width: 250px;
                padding: 1.5rem;
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1001;
                background-color: var(--primary);
                color: white;
                border: none;
                width: 40px;
                height: 40px;
                border-radius: 0.5rem;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: var(--shadow);
                cursor: pointer;
            }

            .header {
                margin-top: 3rem;
            }
        }

        /* Utility classes */
        .no-data {
            text-align: center;
            padding: 2rem;
            color: rgba(51, 65, 85, 0.6);
        }

        .dark .no-data {
            color: rgba(226, 232, 240, 0.6);
        }

        /* Futuristic Sign-out Button */
        .futuristic-signout {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            margin-top: 0.75rem;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .futuristic-signout:hover {
            color: white;
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2), 0 0 0 1px rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .signout-icon-wrapper {
            position: relative;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signout-icon {
            font-size: 1.1rem;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .futuristic-signout:hover .signout-icon {
            transform: translateX(3px);
        }

        .signout-pulse {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
            height: 30px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: 1;
        }

        .futuristic-signout:hover .signout-pulse {
            animation: signout-pulse 1.5s infinite;
        }

        @keyframes signout-pulse {
            0% {
                width: 30px;
                height: 30px;
                opacity: 0.3;
            }

            70% {
                width: 45px;
                height: 45px;
                opacity: 0;
            }

            100% {
                width: 30px;
                height: 30px;
                opacity: 0;
            }
        }

        .signout-text {
            position: relative;
            z-index: 2;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .signout-hover-effect {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 0, 0, 0.1), rgba(255, 0, 0, 0.2));
            z-index: 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .futuristic-signout:hover .signout-hover-effect {
            opacity: 1;
        }

        /* Dark mode specific styles */
        body.dark .card-title,
        body.dark .data-table th,
        body.dark .data-table td,
        body.dark .legend-text,
        body.dark .stat-value,
        body.dark .greeting h2,
        body.dark h4 {
            color: white;
        }

        body.dark .card-title i {
            color: var(--primary);
        }

        body.dark .stat-title,
        body.dark .greeting p {
            color: rgba(255, 255, 255, 0.8);
        }

        /* Settings page specific dark mode styles */
        body.dark .form-label {
            color: rgba(255, 255, 255, 0.9);
        }

        body.dark small,
        body.dark .text-muted {
            color: rgba(255, 255, 255, 0.6);
        }

        body.dark .password-feedback {
            color: inherit;
        }

        body.dark .mb-4 {
            color: white;
        }

        @media (max-width: 992px) {
            .sidebar-footer {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .futuristic-signout {
                width: 100%;
                justify-content: center;
                margin-top: 1rem;
            }

            .theme-toggle {
                margin: 0 auto;
            }
        }

        /* For small tablets and large phones */
        @media (max-width: 768px) {
            .futuristic-signout {
                padding: 0.75rem;
            }

            /* Hide text on smaller screens */
            .signout-text {
                display: none;
            }

            /* Center the icon */
            .futuristic-signout {
                justify-content: center;
            }

            /* Make the icon wrapper take full width */
            .signout-icon-wrapper {
                width: 100%;
                display: flex;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .sidebar.active .sidebar-footer {
                padding-top: 1rem;
            }

            .sidebar.active .futuristic-signout {
                display: flex;
                width: 100%;
                padding: 0.75rem;
            }

            .sidebar:not(.active) .sidebar-footer {
                display: none;
            }

            /* Create a fixed logout button for mobile when sidebar is closed */
            .mobile-logout {
                display: none;
                position: fixed;
                bottom: 1rem;
                right: 1rem;
                z-index: 1001;
                background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
                color: white;
                border: none;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                align-items: center;
                justify-content: center;
                box-shadow: var(--shadow);
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .mobile-logout:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            }

            .sidebar:not(.active)~.main-content .mobile-logout {
                display: flex;
            }
        }

        /* For very tiny screens, make the logout button more compact */
        @media (max-width: 360px) {
            .mobile-logout {
                width: 45px;
                height: 45px;
                bottom: 0.75rem;
                right: 0.75rem;
            }

            .mobile-logout i {
                font-size: 1rem;
            }
        }

        /* Refresh button styles */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        #refreshData {
            transition: all 0.3s ease;
            height: 42px;
            padding: 0 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        #refreshData:hover {
            transform: translateY(-2px);
        }
        
        #refreshData i {
            transition: transform 0.3s ease;
        }
        
        #refreshData:hover i:not(.fa-spin) {
            transform: rotate(180deg);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        }
    </style>
</head>

<body>
    <!-- Mobile menu toggle -->
    <button class="mobile-toggle" id="menuToggle" style="display: none;">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <i class="fa-solid fa-car-side"></i>
                <span>UMSZKI KRESZ Dashboard</span>
            </div>

            <ul class="sidebar-menu">
                <li class="sidebar-item <?php echo ($activePage == 'dashboard') ? 'active' : ''; ?>">
                    <a href="?page=dashboard">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Áttekintés</span>
                    </a>
                </li>
                <li class="sidebar-item <?php echo ($activePage == 'statistics') ? 'active' : ''; ?>">
                    <a href="?page=statistics">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>Statisztika</span>
                    </a>
                </li>
                <li class="sidebar-item <?php echo ($activePage == 'settings') ? 'active' : ''; ?>">
                    <a href="?page=settings">
                        <i class="fa-solid fa-gear"></i>
                        <span>Beállítások</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <button id="themeToggle" class="theme-toggle">
                    <i class="fa-solid fa-moon"></i>
                </button>

                <!-- Futuristic Sign-out Button -->
                <a href="?logout=true" class="futuristic-signout">
                    <div class="signout-icon-wrapper">
                        <i class="fa-solid fa-right-from-bracket signout-icon"></i>
                        <div class="signout-pulse"></div>
                    </div>
                    <span class="signout-text">Kijelentkezés</span>
                    <div class="signout-hover-effect"></div>
                </a>
            </div>
        </aside>

        <!-- Main content -->
        <main class="main-content">
            <!-- Header with greeting -->
            <div class="greeting-card">
                <div class="avatar">
                    <?php if (file_exists($profilePicture)): ?>
                        <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profilkép">
                    <?php else: ?>
                        <?php echo substr(htmlspecialchars($userName), 0, 1); ?>
                    <?php endif; ?>
                </div>
                <div class="greeting">
                    <h2>Üdvözöllek, <?php echo htmlspecialchars($userName); ?>!</h2>
                    <p><?php echo date('Y. F j. l'); ?></p>
                </div>
            </div>

            <?php if ($activePage == 'dashboard' || $activePage == 'registrations'): ?>
                <!-- Dashboard / Registrations View -->

                <!-- Actions bar with search and filter -->
                <div class="actions-bar">
                    <form method="get" class="search-form">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" name="search_query" class="search-input"
                            placeholder="Keresés ID, Név, E-mail vagy Jogosítvány szerint"
                            value="<?php echo htmlspecialchars($searchQuery); ?>">
                        <input type="hidden" name="page" value="<?php echo $activePage; ?>">
                    </form>

                    <form method="get" class="filter-form">
                        <select name="license_filter" id="license_filter" class="filter-select"
                            onchange="this.form.submit()">
                            <option value="all" <?php echo ($licenseFilter == 'all') ? 'selected' : ''; ?>>Összes jogosítvány
                            </option>
                            <option value="a" <?php echo ($licenseFilter == 'a') ? 'selected' : ''; ?>>A jogosítvány</option>
                            <option value="b" <?php echo ($licenseFilter == 'b') ? 'selected' : ''; ?>>B jogosítvány</option>
                            <option value="c" <?php echo ($licenseFilter == 'c') ? 'selected' : ''; ?>>C jogosítvány</option>
                            <option value="d" <?php echo ($licenseFilter == 'd') ? 'selected' : ''; ?>>D jogosítvány</option>
                            <option value="e" <?php echo ($licenseFilter == 'e') ? 'selected' : ''; ?>>E jogosítvány</option>
                        </select>
                        <i class="fa-solid fa-filter filter-icon"></i>
                        <input type="hidden" name="page" value="<?php echo $activePage; ?>">
                    </form>
                    
                    <!-- Add refresh button -->
                    <button id="refreshData" class="btn btn-primary">
                        <i class="fa-solid fa-sync-alt"></i>
                        <span>Frissítés</span>
                    </button>
                </div>

                <!-- License type summary cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: rgba(236, 72, 153, 0.1); color: #ec4899;">
                            <i class="fa-solid fa-motorcycle"></i>
                        </div>
                        <div class="stat-title">A jogosítvány</div>
                        <div class="stat-value"><?php echo $statistics['a']; ?> fő</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: rgba(139, 92, 246, 0.1); color: #8b5cf6;">
                            <i class="fa-solid fa-car"></i>
                        </div>
                        <div class="stat-title">B jogosítvány</div>
                        <div class="stat-value"><?php echo $statistics['b']; ?> fő</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981;">
                            <i class="fa-solid fa-truck"></i>
                        </div>
                        <div class="stat-title">C jogosítvány</div>
                        <div class="stat-value"><?php echo $statistics['c']; ?> fő</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                            <i class="fa-solid fa-bus"></i>
                        </div>
                        <div class="stat-title">D jogosítvány</div>
                        <div class="stat-value"><?php echo $statistics['d']; ?> fő</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                            <i class="fa-solid fa-truck-moving"></i>
                        </div>
                        <div class="stat-title">E jogosítvány</div>
                        <div class="stat-value"><?php echo $statistics['e']; ?> fő</div>
                    </div>
                </div>

                <!-- Registrants table -->
                <div class="card" id="registrations">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa-solid fa-users"></i>
                            Jelentkezők listája
                        </h3>
                    </div>

                    <?php if (empty($registrations)): ?>
                        <div class="empty-state">
                            <i class="fa-solid fa-clipboard-list empty-icon"></i>
                            <p class="empty-text">Nincs megjeleníthető jelentkező</p>
                        </div>
                    <?php else: ?>
                        <div style="overflow-x: auto;">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Név</th>
                                        <th>E-mail</th>
                                        <th>Jogosítvány</th>
                                        <th>Művelet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($registrations as $row): ?>
                                        <tr>
                                            <td>#<?php echo htmlspecialchars($row['id']); ?></td>
                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                                            <td>
                                                <span
                                                    class="license-badge license-<?php echo htmlspecialchars($row['license']); ?>">
                                                    <?php echo strtoupper(htmlspecialchars($row['license'])); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="?page=<?php echo $activePage; ?>&delete_id=<?php echo $row['id']; ?>"
                                                    class="action-btn"
                                                    onclick="return confirm('Biztosan törölni szeretnéd ezt a jelentkezőt?');">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($activePage == 'statistics'): ?>
                <!-- Statistics section -->
                <div class="chart-section" id="statistics">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa-solid fa-chart-pie"></i>
                                Jogosítvány típusok megoszlása
                            </h3>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="licenseChart"></canvas>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa-solid fa-info-circle"></i>
                                Jelmagyarázat
                            </h3>
                        </div>
                        <ul class="legend-list">
                            <li class="legend-item">
                                <div class="legend-color" style="background-color: #ec4899;"></div>
                                <div class="legend-text">A jogosítvány</div>
                            </li>
                            <li class="legend-item">
                                <div class="legend-color" style="background-color: #8b5cf6;"></div>
                                <div class="legend-text">B jogosítvány</div>
                            </li>
                            <li class="legend-item">
                                <div class="legend-color" style="background-color: #10b981;"></div>
                                <div class="legend-text">C jogosítvány</div>
                            </li>
                            <li class="legend-item">
                                <div class="legend-color" style="background-color: #f59e0b;"></div>
                                <div class="legend-text">D jogosítvány</div>
                            </li>
                            <li class="legend-item">
                                <div class="legend-color" style="background-color: #3b82f6;"></div>
                                <div class="legend-text">E jogosítvány</div>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($activePage == 'settings'): ?>
                <!-- Settings Section -->
                <div class="card" id="settings">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa-solid fa-gear"></i>
                            Felhasználói beállítások
                        </h3>
                    </div>

                    <?php if (!empty($updateMessage)): ?>
                        <?php echo $updateMessage; ?>
                    <?php endif; ?>

                    <div class="settings-grid">
                        <div>
                            <h4 class="mb-4">Profil beállítások</h4>

                            <div class="mb-4 text-center">
                                <div
                                    style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem auto; border: 3px solid var(--primary);">
                                    <?php if (file_exists($profilePicture)): ?>
                                        <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profilkép"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    <?php else: ?>
                                        <div
                                            style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background-color: var(--primary); color: white; font-size: 2.5rem; font-weight: 700;">
                                            <?php echo substr(htmlspecialchars($userName), 0, 1); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <form method="post" action="?page=settings">
                                <div class="form-group">
                                    <label for="nickname" class="form-label">Becenév</label>
                                    <input type="text" id="nickname" name="nickname" class="form-control"
                                        value="<?php echo htmlspecialchars($userData['nickname']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="username" class="form-label">Felhasználónév</label>
                                    <input type="text" id="username" class="form-control"
                                        value="<?php echo htmlspecialchars($userData['username']); ?>" readonly>
                                    <small class="text-muted">A felhasználónév nem módosítható.</small>
                                </div>

                                <button type="submit" name="update_nickname" class="btn btn-primary">
                                    <i class="fa-solid fa-user me-2"></i>
                                    Becenév mentése
                                </button>
                            </form>
                        </div>

                        <div class="mt-4">
                            <h4 class="mb-4">Jelszó módosítása</h4>

                            <form method="post" action="?page=settings">
                                <div class="form-group">
                                    <label for="current_password" class="form-label">Jelenlegi jelszó</label>
                                    <input type="password" id="current_password" name="current_password"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="new_password" class="form-label">Új jelszó</label>
                                    <input type="password" id="new_password" name="new_password" class="form-control"
                                        required minlength="6" onkeyup="checkPasswordStrength()">
                                    <div class="password-strength" id="passwordStrength"></div>
                                    <div class="password-feedback" id="passwordFeedback"></div>
                                </div>

                                <div class="form-group">
                                    <label for="confirm_password" class="form-label">Új jelszó megerősítése</label>
                                    <input type="password" id="confirm_password" name="confirm_password"
                                        class="form-control" required minlength="6" onkeyup="checkPasswordMatch()">
                                    <div class="password-feedback" id="passwordMatchFeedback"></div>
                                </div>

                                <button type="submit" name="change_password" class="btn btn-primary">
                                    <i class="fa-solid fa-key me-2"></i>
                                    Jelszó módosítása
                                </button>
                            </form>
                        </div>

                        <div class="mt-5">
                            <h4 class="mb-4">Megjelenés</h4>

                            <div class="d-flex align-items-center">
                                <button id="lightThemeBtn" class="btn btn-primary me-3">
                                    <i class="fa-solid fa-sun me-2"></i>
                                    Világos mód
                                </button>

                                <button id="darkThemeBtn" class="btn btn-primary">
                                    <i class="fa-solid fa-moon me-2"></i>
                                    Sötét mód
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <script>
        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const lightThemeBtn = document.getElementById('lightThemeBtn');
        const darkThemeBtn = document.getElementById('darkThemeBtn');
        const body = document.body;
        const icon = themeToggle.querySelector('i');

        // Check for saved theme preference or default to light
        if (localStorage.getItem('theme') === 'dark') {
            body.classList.add('dark');
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        }

        themeToggle.addEventListener('click', toggleTheme);

        if (lightThemeBtn) {
            lightThemeBtn.addEventListener('click', setLightTheme);
        }

        if (darkThemeBtn) {
            darkThemeBtn.addEventListener('click', setDarkTheme);
        }

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

            // Update chart colors if chart exists
            if (typeof licenseChart !== 'undefined') {
                updateChartColors();
            }
        }

        function setLightTheme() {
            body.classList.remove('dark');
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
            localStorage.setItem('theme', 'light');

            // Update chart colors if chart exists
            if (typeof licenseChart !== 'undefined') {
                updateChartColors();
            }
        }

        function setDarkTheme() {
            body.classList.add('dark');
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
            localStorage.setItem('theme', 'dark');

            // Update chart colors if chart exists
            if (typeof licenseChart !== 'undefined') {
                updateChartColors();
            }
        }

        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');

        if (window.innerWidth <= 576) {
            menuToggle.style.display = 'flex';
        }

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth <= 576) {
                menuToggle.style.display = 'flex';
            } else {
                menuToggle.style.display = 'none';
                sidebar.classList.remove('active');
            }
        });

        // Password strength checker
        function checkPasswordStrength() {
            const password = document.getElementById('new_password');
            if (!password) return;

            const strengthBar = document.getElementById('passwordStrength');
            const feedback = document.getElementById('passwordFeedback');

            // Reset
            strengthBar.className = 'password-strength';
            feedback.textContent = '';

            if (password.value.length === 0) {
                return;
            }

            // Check strength
            let strength = 0;

            // Length check
            if (password.value.length >= 8) {
                strength += 1;
            }

            // Character variety check
            if (/[A-Z]/.test(password.value)) {
                strength += 1;
            }

            if (/[0-9]/.test(password.value)) {
                strength += 1;
            }

            if (/[^A-Za-z0-9]/.test(password.value)) {
                strength += 1;
            }

            // Update UI
            if (strength <= 1) {
                strengthBar.classList.add('strength-weak');
                feedback.textContent = 'Gyenge jelszó';
                feedback.style.color = '#ef4444';
            } else if (strength <= 3) {
                strengthBar.classList.add('strength-medium');
                feedback.textContent = 'Közepes erősségű jelszó';
                feedback.style.color = '#f59e0b';
            } else {
                strengthBar.classList.add('strength-strong');
                feedback.textContent = 'Erős jelszó';
                feedback.style.color = '#10b981';
            }
        }

        // Check if passwords match
        function checkPasswordMatch() {
            const newPassword = document.getElementById('new_password');
            const confirmPassword = document.getElementById('confirm_password');
            if (!newPassword || !confirmPassword) return;

            const feedback = document.getElementById('passwordMatchFeedback');

            if (confirmPassword.value.length === 0) {
                feedback.textContent = '';
                return;
            }

            if (newPassword.value === confirmPassword.value) {
                feedback.textContent = 'A jelszavak egyeznek';
                feedback.style.color = '#10b981';
            } else {
                feedback.textContent = 'A jelszavak nem egyeznek';
                feedback.style.color = '#ef4444';
            }
        }

        // Initialize chart if element exists
        document.addEventListener('DOMContentLoaded', function () {
            // Only initialize the chart if we're on the statistics page
            <?php if ($activePage == 'statistics'): ?>
                const chartCanvas = document.getElementById('licenseChart');
                if (chartCanvas) {
                    const ctx = chartCanvas.getContext('2d');
                    window.licenseChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['A', 'B', 'C', 'D', 'E'],
                            datasets: [{
                                data: [<?php echo $statistics['a']; ?>, <?php echo $statistics['b']; ?>, <?php echo $statistics['c']; ?>, <?php echo $statistics['d']; ?>, <?php echo $statistics['e']; ?>],
                                backgroundColor: ['#ec4899', '#8b5cf6', '#10b981', '#f59e0b', '#3b82f6'],
                                borderColor: body.classList.contains('dark') ? 'rgba(30, 41, 59, 0.8)' : 'white',
                                borderWidth: 2,
                                hoverOffset: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '70%',
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: body.classList.contains('dark') ? 'rgba(30, 41, 59, 0.9)' : 'rgba(255, 255, 255, 0.9)',
                                    titleColor: body.classList.contains('dark') ? '#e2e8f0' : '#334155',
                                    bodyColor: body.classList.contains('dark') ? '#e2e8f0' : '#334155',
                                    bodyFont: {
                                        family: "'Inter', sans-serif",
                                        size: 14
                                    },
                                    titleFont: {
                                        family: "'Inter', sans-serif",
                                        size: 14,
                                        weight: 'bold'
                                    },
                                    padding: 16,
                                    boxPadding: 8,
                                    boxWidth: 8,
                                    boxHeight: 8,
                                    usePointStyle: true,
                                    borderColor: body.classList.contains('dark') ? 'rgba(71, 85, 105, 0.4)' : 'rgba(203, 213, 225, 0.4)',
                                    borderWidth: 1,
                                    callbacks: {
                                        label: function (tooltipItem) {
                                            return tooltipItem.label + ' jogosítvány: ' + tooltipItem.raw + ' fő';
                                        }
                                    }
                                }
                            },
                            animation: {
                                animateScale: true,
                                animateRotate: true
                            }
                        }
                    });
                }
            <?php endif; ?>

            // Initialize futuristic sign-out button effects
            initFuturisticSignout();
            
            // Set up refresh button
            const refreshBtn = document.getElementById('refreshData');
            if (refreshBtn) {
                refreshBtn.addEventListener('click', refreshData);
            }
            
            // Auto refresh every 30 seconds
            setInterval(refreshData, 30000);
        });

        // Update chart colors
        function updateChartColors() {
            if (typeof licenseChart !== 'undefined' && licenseChart !== null) {
                licenseChart.options.plugins.tooltip.backgroundColor = body.classList.contains('dark') ? 'rgba(30, 41, 59, 0.9)' : 'rgba(255, 255, 255, 0.9)';
                licenseChart.options.plugins.tooltip.titleColor = body.classList.contains('dark') ? '#e2e8f0' : '#334155';
                licenseChart.options.plugins.tooltip.bodyColor = body.classList.contains('dark') ? '#e2e8f0' : '#334155';
                licenseChart.options.plugins.tooltip.borderColor = body.classList.contains('dark') ? 'rgba(71, 85, 105, 0.4)' : 'rgba(203, 213, 225, 0.4)';
                licenseChart.data.datasets[0].borderColor = body.classList.contains('dark') ? 'rgba(30, 41, 59, 0.8)' : 'white';
                licenseChart.update();
            }
        }
        
        // Function to refresh data asynchronously
        function refreshData() {
            const refreshBtn = document.getElementById('refreshData');
            if (refreshBtn) {
                // Add spinning animation to the refresh icon
                const icon = refreshBtn.querySelector('i');
                icon.classList.add('fa-spin');
                refreshBtn.disabled = true;
            }
            
            // Get current filter and search values
            const licenseFilter = document.getElementById('license_filter')?.value || 'all';
            const searchQuery = document.querySelector('.search-input')?.value || '';
            
            // Fetch data from server
            fetch(`?fetch_data=true&license_filter=${licenseFilter}&search_query=${encodeURIComponent(searchQuery)}`)
                .then(response => response.json())
                .then(data => {
                    updateDashboard(data);
                    
                    // Stop spinning animation
                    if (refreshBtn) {
                        const icon = refreshBtn.querySelector('i');
                        icon.classList.remove('fa-spin');
                        refreshBtn.disabled = false;
                        
                        // Show success indicator
                        refreshBtn.classList.add('btn-success');
                        setTimeout(() => {
                            refreshBtn.classList.remove('btn-success');
                        }, 1000);
                    }
                })
                .catch(error => {
                    console.error('Error refreshing data:', error);
                    
                    // Stop spinning and show error
                    if (refreshBtn) {
                        const icon = refreshBtn.querySelector('i');
                        icon.classList.remove('fa-spin');
                        refreshBtn.disabled = false;
                        
                        // Show error indicator
                        refreshBtn.classList.add('btn-danger');
                        setTimeout(() => {
                            refreshBtn.classList.remove('btn-danger');
                        }, 1000);
                    }
                });
        }
        
        // Function to update the dashboard with new data
        function updateDashboard(data) {
            // Update statistics
            const stats = data.statistics;
            for (const license in stats) {
                const statElement = document.querySelector(`.stat-card:nth-child(${getLicenseIndex(license)}) .stat-value`);
                if (statElement) {
                    statElement.textContent = `${stats[license]} fő`;
                    
                    // Add highlight animation
                    statElement.style.animation = 'none';
                    setTimeout(() => {
                        statElement.style.animation = 'pulse 1s';
                    }, 10);
                }
            }
            
            // Update table
            const tableBody = document.querySelector('.data-table tbody');
            if (tableBody) {
                // Clear existing rows
                tableBody.innerHTML = '';
                
                // Add new rows
                if (data.registrations.length === 0) {
                    // Show empty state if no data
                    const emptyRow = document.createElement('tr');
                    emptyRow.innerHTML = `
                        <td colspan="5" class="text-center py-4">
                            <div class="empty-state">
                                <i class="fa-solid fa-clipboard-list empty-icon"></i>
                                <p class="empty-text">Nincs megjeleníthető jelentkező</p>
                            </div>
                        </td>
                    `;
                    tableBody.appendChild(emptyRow);
                } else {
                    // Add each registration row
                    data.registrations.forEach(row => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>#${row.id}</td>
                            <td>${row.name}</td>
                            <td>${row.email}</td>
                            <td>
                                <span class="license-badge license-${row.license}">
                                    ${row.license.toUpperCase()}
                                </span>
                            </td>
                            <td>
                                <a href="?page=${getActivePage()}&delete_id=${row.id}" class="action-btn"
                                    onclick="return confirm('Biztosan törölni szeretnéd ezt a jelentkezőt?');">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        `;
                        tableBody.appendChild(tr);
                        
                        // Add fade-in animation
                        tr.style.animation = 'fadeIn 0.3s ease forwards';
                    });
                }
            }
            
            // Update chart if it exists
            if (typeof licenseChart !== 'undefined' && licenseChart !== null) {
                licenseChart.data.datasets[0].data = [
                    stats.a, stats.b, stats.c, stats.d, stats.e
                ];
                licenseChart.update();
            }
        }
        
        // Helper function to get license index for stat cards
        function getLicenseIndex(license) {
            const indexes = { 'a': 1, 'b': 2, 'c': 3, 'd': 4, 'e': 5 };
            return indexes[license] || 1;
        }
        
        // Helper function to get active page
        function getActivePage() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('page') || 'dashboard';
        }
        
        // Initialize futuristic sign-out button
        function initFuturisticSignout() {
            const signoutBtn = document.querySelector('.futuristic-signout');

            if (!signoutBtn) return;

            signoutBtn.addEventListener('mouseenter', function () {
                this.querySelector('.signout-icon').style.transform = 'translateX(3px)';
                this.querySelector('.signout-hover-effect').style.opacity = '1';
            });

            signoutBtn.addEventListener('mouseleave', function () {
                this.querySelector('.signout-icon').style.transform = '';
                this.querySelector('.signout-hover-effect').style.opacity = '0';
            });

            // Add click effect
            signoutBtn.addEventListener('click', function (e) {
                // Create ripple effect
                const ripple = document.createElement('div');
                ripple.className = 'signout-ripple';
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.backgroundColor = 'rgba(255, 255, 255, 0.4)';
                ripple.style.width = '10px';
                ripple.style.height = '10px';
                ripple.style.transform = 'scale(0)';
                ripple.style.pointerEvents = 'none';
                ripple.style.zIndex = '1';

                // Position the ripple where clicked
                const rect = this.getBoundingClientRect();
                ripple.style.left = (e.clientX - rect.left) + 'px';
                ripple.style.top = (e.clientY - rect.top) + 'px';

                this.appendChild(ripple);

                // Animate the ripple
                ripple.style.transition = 'all 0.6s ease';
                ripple.style.transform = 'scale(20)';
                ripple.style.opacity = '0';

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        }

        // Animate stat cards on scroll
        const statCards = document.querySelectorAll('.stat-card');
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeIn 0.6s ease forwards';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        statCards.forEach(card => {
            card.style.opacity = '0';
            observer.observe(card);
        });
    </script>
</body>
</html>