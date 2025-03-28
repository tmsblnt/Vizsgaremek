<?php
// Database connection settings
$servername = "localhost";
$username = "umszkikresz";
$password = "umszkikresz";
$dbname = "umszkikresz_db";

// Set default language
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'hu';

// Define translations
$translations = [
    'hu' => [
        'title' => 'UMSZKI KRESZ',
        'about' => 'A vizsgáról',
        'schedule' => 'Időpontfoglalás',
        'practice' => 'Gyakorlás',
        'contact' => 'Kapcsolat',
        'hero_title' => 'Felkészültél a KRESZ Vizsgára?',
        'hero_subtitle' => 'Fedezd fel a közlekedési szabályokat és lépj szintet a vizsgán!',
        'book_button' => 'Időpont foglalása',
        'practice_button' => 'Gyakorló teszt',
        'exam_title' => 'A KRESZ Vizsga',
        'exam_p1' => 'A KRESZ vizsga a közlekedési szabályok ismeretére és alkalmazására vonatkozó teszt. A sikeres vizsga után jogosítványt szerezhetsz, amely a közlekedés alapjait biztosítja.',
        'exam_p2' => 'A vizsga részletes követelményeit az alábbiakban találod.',
        'schedule_title' => 'Időpontfoglalás',
        'choose_time' => 'Válaszd ki az időpontot',
        'name' => 'Név',
        'email' => 'E-mail',
        'license_question' => 'Milyen jogosítványt szeretne letenni?',
        'submit' => 'Jelentkezés',
        'contact_title' => 'Kapcsolat',
        'contact_text' => 'Ha bármilyen kérdésed van, ne habozz kapcsolatba lépni velünk!',
        'message' => 'Üzenet',
        'send' => 'Küldés',
        'footer' => '© 2025 KRESZ Vizsgaközpont. Minden jog fenntartva.',
        'success_message' => 'Sikeres jelentkezés a %s kategóriára! Hamarosan felvesszük Önnel a kapcsolatot, %s',
        'practice_title' => 'Gyakorló Teszt',
        'practice_subtitle' => 'Teszteld tudásod interaktív kérdésekkel',
        'stats_title' => 'Statisztikák',
        'stats_exams' => 'Sikeres vizsgák',
        'stats_students' => 'Diákok',
        'stats_satisfaction' => 'Elégedettség',
        'faq_title' => 'Gyakori Kérdések',
        'faq1_q' => 'Mennyi ideig tart a vizsga?',
        'faq1_a' => 'A KRESZ vizsga általában 55 percig tart, amely alatt 55 kérdésre kell válaszolni.',
        'faq2_q' => 'Hány pontot kell elérni a sikeres vizsgához?',
        'faq2_a' => 'A sikeres vizsgához legalább 75%-os eredményt kell elérni.',
        'faq3_q' => 'Mi történik, ha nem sikerül a vizsga?',
        'faq3_a' => 'Sikertelen vizsga esetén újra kell jelentkezni egy másik időpontra.',
        'dark_mode' => 'Sötét mód',
        'light_mode' => 'Világos mód',
        'address' => 'Cím',
        'phone' => 'Telefon'
    ],
    'en' => [
        'title' => 'UMSZKI KRESZ',
        'about' => 'About the Exam',
        'schedule' => 'Book Appointment',
        'practice' => 'Practice',
        'contact' => 'Contact',
        'hero_title' => 'Ready for the Traffic Rules Exam?',
        'hero_subtitle' => 'Discover traffic regulations and level up on your exam!',
        'book_button' => 'Book an Appointment',
        'practice_button' => 'Practice Test',
        'exam_title' => 'The Traffic Rules Exam',
        'exam_p1' => 'The traffic rules exam is a test of knowledge and application of traffic regulations. After passing the exam, you can obtain a driver\'s license, which provides the basics of traffic participation.',
        'exam_p2' => 'You can find the detailed requirements of the exam below.',
        'schedule_title' => 'Book an Appointment',
        'choose_time' => 'Choose your time',
        'name' => 'Name',
        'email' => 'Email',
        'license_question' => 'What type of license would you like to obtain?',
        'submit' => 'Submit',
        'contact_title' => 'Contact',
        'contact_text' => 'If you have any questions, don\'t hesitate to contact us!',
        'message' => 'Message',
        'send' => 'Send',
        'footer' => '© 2025 Traffic Rules Exam Center. All rights reserved.',
        'success_message' => 'Successfully registered for category %s! We will contact you soon, %s',
        'practice_title' => 'Practice Test',
        'practice_subtitle' => 'Test your knowledge with interactive questions',
        'stats_title' => 'Statistics',
        'stats_exams' => 'Successful Exams',
        'stats_students' => 'Students',
        'stats_satisfaction' => 'Satisfaction',
        'faq_title' => 'Frequently Asked Questions',
        'faq1_q' => 'How long does the exam take?',
        'faq1_a' => 'The traffic rules exam usually takes 55 minutes, during which you need to answer 55 questions.',
        'faq2_q' => 'How many points do I need to pass?',
        'faq2_a' => 'To pass the exam, you need to achieve at least 75% of the total points.',
        'faq3_q' => 'What happens if I fail the exam?',
        'faq3_a' => 'If you fail the exam, you need to register for another appointment.',
        'dark_mode' => 'Dark Mode',
        'light_mode' => 'Light Mode',
        'address' => 'Address',
        'phone' => 'Phone'
    ]
];

// Define translations for practice test
$test_translations = [
    'hu' => [
        'title' => 'KRESZ Gyakorló Teszt',
        'subtitle' => '30 alapvető közlekedési kérdés',
        'instructions' => 'Válaszolj a következő kérdésekre. A teszt végén 10 véletlenszerű kérdést kapsz a vizsgára való felkészüléshez.',
        'question' => 'Kérdés',
        'submit' => 'Válaszok beküldése',
        'next' => 'Következő',
        'previous' => 'Előző',
        'correct' => 'Helyes',
        'incorrect' => 'Helytelen',
        'your_answer' => 'A te válaszod',
        'correct_answer' => 'Helyes válasz',
        'score' => 'Eredmény',
        'out_of' => '/',
        'restart' => 'Újrakezdés',
        'random_test' => 'Véletlenszerű teszt',
        'time_remaining' => 'Hátralévő idő',
        'minutes' => 'perc',
        'seconds' => 'másodperc',
        'test_complete' => 'Teszt befejezve',
        'review_answers' => 'Válaszok áttekintése',
        'random_test_title' => 'Véletlenszerű 10 kérdéses teszt',
        'random_test_subtitle' => 'Készülj fel a vizsgára ezzel a 10 véletlenszerű kérdéssel',
        'start_random_test' => 'Véletlenszerű teszt indítása',
        'back_to_full_test' => 'Vissza a teljes teszthez',
        'close_test' => 'Teszt bezárása',
        'percentage' => 'Százalék'
    ],
    'en' => [
        'title' => 'Traffic Rules Practice Test',
        'subtitle' => '30 fundamental traffic questions',
        'instructions' => 'Answer the following questions. At the end, you will receive 10 random questions to prepare for the exam.',
        'question' => 'Question',
        'submit' => 'Submit Answers',
        'next' => 'Next',
        'previous' => 'Previous',
        'correct' => 'Correct',
        'incorrect' => 'Incorrect',
        'your_answer' => 'Your answer',
        'correct_answer' => 'Correct answer',
        'score' => 'Score',
        'out_of' => 'out of',
        'restart' => 'Restart',
        'random_test' => 'Random Test',
        'time_remaining' => 'Time remaining',
        'minutes' => 'minutes',
        'seconds' => 'seconds',
        'test_complete' => 'Test Complete',
        'review_answers' => 'Review Answers',
        'random_test_title' => 'Random 10 Question Test',
        'random_test_subtitle' => 'Prepare for your exam with these 10 random questions',
        'start_random_test' => 'Start Random Test',
        'back_to_full_test' => 'Back to Full Test',
        'close_test' => 'Close Test',
        'percentage' => 'Percentage'
    ]
];

// Get current language texts
$t = $translations[$lang];
$tt = $test_translations[$lang];

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $license = $_POST['license'];

    // SQL query to insert data into 'registrations' table
    $sql = "INSERT INTO registrations (name, email, license) 
            VALUES ('$name', '$email', '$license')";

    if ($conn->query($sql) === TRUE) {
        // Redirect on successful registration
        header("Location: " . $_SERVER['PHP_SELF'] . "?success=true&lang=" . $lang);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if registration was successful
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    // Show alert after successful registration
    $message = sprintf($t['success_message'], ucfirst($license), htmlspecialchars($name));
    echo "<script type='text/javascript'>
            setTimeout(function() {
                const toast = document.createElement('div');
                toast.className = 'success-toast';
                toast.innerHTML = '$message';
                document.body.appendChild(toast);
                
                setTimeout(function() {
                    toast.classList.add('show');
                }, 100);
                
                setTimeout(function() {
                    toast.classList.remove('show');
                    setTimeout(function() {
                        document.body.removeChild(toast);
                    }, 500);
                }, 5000);
            }, 1000);
          </script>";
}

// Define the 30 traffic questions with answers
$questions = [
    [
        'hu' => [
            'question' => 'Mit jelent a piros jelzőlámpa?',
            'options' => [
                'A' => 'Szabad az áthaladás',
                'B' => 'Megállás kötelező',
                'C' => 'Lassítás kötelező'
            ],
            'correct' => 'B'
        ],
        'en' => [
            'question' => 'What does a red traffic light mean?',
            'options' => [
                'A' => 'Proceed',
                'B' => 'Stop',
                'C' => 'Slow down'
            ],
            'correct' => 'B'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen sebességgel haladhat lakott területen belül?',
            'options' => [
                'A' => '30 km/h',
                'B' => '50 km/h',
                'C' => '70 km/h'
            ],
            'correct' => 'B'
        ],
        'en' => [
            'question' => 'What is the speed limit in residential areas?',
            'options' => [
                'A' => '30 km/h',
                'B' => '50 km/h',
                'C' => '70 km/h'
            ],
            'correct' => 'B'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mit jelent a "Főútvonal" tábla?',
            'options' => [
                'A' => 'Elsőbbségadás kötelező',
                'B' => 'Főútvonal vége',
                'C' => 'Ön főútvonalon halad, elsőbbsége van'
            ],
            'correct' => 'C'
        ],
        'en' => [
            'question' => 'What does the "Main Road" sign mean?',
            'options' => [
                'A' => 'Give way',
                'B' => 'End of main road',
                'C' => 'You are on a main road and have priority'
            ],
            'correct' => 'C'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen távolságra kell követnie az előtte haladó járművet?',
            'options' => [
                'A' => 'Legalább a sebességmérőn látható érték felének megfelelő méterben',
                'B' => 'Legalább 5 méter',
                'C' => 'Legalább 2 másodpercnyi követési távolság'
            ],
            'correct' => 'C'
        ],
        'en' => [
            'question' => 'What is the safe following distance behind another vehicle?',
            'options' => [
                'A' => 'At least half the speed in meters',
                'B' => 'At least 5 meters',
                'C' => 'At least 2 seconds following distance'
            ],
            'correct' => 'C'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mikor kell használni a ködfényszórót?',
            'options' => [
                'A' => 'Mindig, amikor esik az eső',
                'B' => 'Csak korlátozott látási viszonyok között',
                'C' => 'Éjszakai vezetés során mindig'
            ],
            'correct' => 'B'
        ],
        'en' => [
            'question' => 'When should you use fog lights?',
            'options' => [
                'A' => 'Always when it rains',
                'B' => 'Only in limited visibility conditions',
                'C' => 'Always during night driving'
            ],
            'correct' => 'B'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mit jelent a sárga jelzőlámpa?',
            'options' => [
                'A' => 'Megállás, ha biztonságosan megtehető',
                'B' => 'Gyorsítás, hogy átérjünk a kereszteződésen',
                'C' => 'Szabad az áthaladás'
            ],
            'correct' => 'A'
        ],
        'en' => [
            'question' => 'What does a yellow traffic light mean?',
            'options' => [
                'A' => 'Stop if it is safe to do so',
                'B' => 'Speed up to cross the intersection',
                'C' => 'Proceed'
            ],
            'correct' => 'A'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen esetben kötelező a biztonsági öv használata?',
            'options' => [
                'A' => 'Csak autópályán',
                'B' => 'Csak lakott területen kívül',
                'C' => 'Minden esetben, kivéve a jogszabályban meghatározott kivételeket'
            ],
            'correct' => 'C'
        ],
        'en' => [
            'question' => 'When is seat belt use mandatory?',
            'options' => [
                'A' => 'Only on highways',
                'B' => 'Only outside residential areas',
                'C' => 'In all cases, except for legally defined exceptions'
            ],
            'correct' => 'C'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen esetben tilos előzni?',
            'options' => [
                'A' => 'Kanyarban, ahol a látótávolság korlátozott',
                'B' => 'Egyenes útszakaszon',
                'C' => 'Autópályán'
            ],
            'correct' => 'A'
        ],
        'en' => [
            'question' => 'When is overtaking prohibited?',
            'options' => [
                'A' => 'In curves where visibility is limited',
                'B' => 'On straight road sections',
                'C' => 'On highways'
            ],
            'correct' => 'A'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mit jelent a "Gyalogátkelőhely" tábla?',
            'options' => [
                'A' => 'Tilos a gyalogosoknak átkelni',
                'B' => 'Gyalogátkelőhely következik, fokozott figyelem szükséges',
                'C' => 'Csak gyalogosok használhatják az utat'
            ],
            'correct' => 'B'
        ],
        'en' => [
            'question' => 'What does the "Pedestrian Crossing" sign mean?',
            'options' => [
                'A' => 'Pedestrians are prohibited from crossing',
                'B' => 'Pedestrian crossing ahead, increased attention required',
                'C' => 'Only pedestrians may use the road'
            ],
            'correct' => 'B'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen esetben kell elsőbbséget adni a gyalogosoknak?',
            'options' => [
                'A' => 'Csak a kijelölt gyalogátkelőhelyen',
                'B' => 'Csak akkor, ha gyermekek vagy idősek kelnek át',
                'C' => 'Kijelölt gyalogátkelőhelyen és kanyarodáskor az áthaladó gyalogosoknak'
            ],
            'correct' => 'C'
        ],
        'en' => [
            'question' => 'When must you give way to pedestrians?',
            'options' => [
                'A' => 'Only at marked pedestrian crossings',
                'B' => 'Only when children or elderly people are crossing',
                'C' => 'At marked pedestrian crossings and when turning to pedestrians crossing the road'
            ],
            'correct' => 'C'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mit jelent a "Megállni tilos" tábla?',
            'options' => [
                'A' => 'Tilos a megállás és a várakozás',
                'B' => 'Csak a várakozás tilos, a megállás engedélyezett',
                'C' => 'Csak a hosszú idejű parkolás tilos'
            ],
            'correct' => 'A'
        ],
        'en' => [
            'question' => 'What does the "No Stopping" sign mean?',
            'options' => [
                'A' => 'Both stopping and parking are prohibited',
                'B' => 'Only parking is prohibited, stopping is allowed',
                'C' => 'Only long-term parking is prohibited'
            ],
            'correct' => 'A'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen sebességgel haladhat autópályán?',
            'options' => [
                'A' => '90 km/h',
                'B' => '110 km/h',
                'C' => '130 km/h'
            ],
            'correct' => 'C'
        ],
        'en' => [
            'question' => 'What is the speed limit on highways?',
            'options' => [
                'A' => '90 km/h',
                'B' => '110 km/h',
                'C' => '130 km/h'
            ],
            'correct' => 'C'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mit jelent a "Kötelező haladási irány" tábla?',
            'options' => [
                'A' => 'Ajánlott haladási irány',
                'B' => 'Kötelező a megjelölt irányba haladni',
                'C' => 'Tilos a megjelölt irányba haladni'
            ],
            'correct' => 'B'
        ],
        'en' => [
            'question' => 'What does the "Mandatory Direction" sign mean?',
            'options' => [
                'A' => 'Recommended direction',
                'B' => 'You must proceed in the indicated direction',
                'C' => 'It is prohibited to proceed in the indicated direction'
            ],
            'correct' => 'B'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen esetben kell használni a vészvillogót?',
            'options' => [
                'A' => 'Csak műszaki hiba esetén',
                'B' => 'Balesetveszély esetén, vagy ha a jármű forgalmi akadályt képez',
                'C' => 'Esős időben a jobb láthatóság érdekében'
            ],
            'correct' => 'B'
        ],
        'en' => [
            'question' => 'When should you use hazard warning lights?',
            'options' => [
                'A' => 'Only in case of technical failure',
                'B' => 'In case of danger or when the vehicle constitutes a traffic obstacle',
                'C' => 'In rainy weather for better visibility'
            ],
            'correct' => 'B'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mit jelent a "Várakozni tilos" tábla?',
            'options' => [
                'A' => 'Tilos a megállás és a várakozás',
                'B' => 'Csak a várakozás tilos, a megállás engedélyezett',
                'C' => 'Csak a hosszú idejű parkolás tilos'
            ],
            'correct' => 'B'
        ],
        'en' => [
            'question' => 'What does the "No Parking" sign mean?',
            'options' => [
                'A' => 'Both stopping and parking are prohibited',
                'B' => 'Only parking is prohibited, stopping is allowed',
                'C' => 'Only long-term parking is prohibited'
            ],
            'correct' => 'B'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen esetben kell csökkenteni a sebességet?',
            'options' => [
                'A' => 'Csak esős időben',
                'B' => 'Csak éjszaka',
                'C' => 'Iskolák, gyalogátkelőhelyek közelében és minden olyan helyen, ahol a forgalmi viszonyok indokolják'
            ],
            'correct' => 'C'
        ],
        'en' => [
            'question' => 'When should you reduce speed?',
            'options' => [
                'A' => 'Only in rainy weather',
                'B' => 'Only at night',
                'C' => 'Near schools, pedestrian crossings, and wherever traffic conditions require it'
            ],
            'correct' => 'C'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mit jelent a "Körforgalom" tábla?',
            'options' => [
                'A' => 'Körforgalmú csomópont következik, ahol elsőbbséget kell adni a körforgalomban haladóknak',
                'B' => 'Körforgalmú csomópont következik, ahol elsőbbsége van a körforgalomba behajtóknak',
                'C' => 'Tilos behajtani a körforgalomba'
            ],
            'correct' => 'A'
        ],
        'en' => [
            'question' => 'What does the "Roundabout" sign mean?',
            'options' => [
                'A' => 'A roundabout is ahead, where you must give way to vehicles already in the roundabout',
                'B' => 'A roundabout is ahead, where vehicles entering have priority',
                'C' => 'It is prohibited to enter the roundabout'
            ],
            'correct' => 'A'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen esetben kell használni a fénykürtöt?',
            'options' => [
                'A' => 'Előzési szándék jelzésére lakott területen kívül',
                'B' => 'Veszélyhelyzetre való figyelmeztetésként',
                'C' => 'Mindkét válasz helyes'
            ],
            'correct' => 'C'
        ],
        'en' => [
            'question' => 'When should you use the headlight flash?',
            'options' => [
                'A' => 'To indicate intention to overtake outside residential areas',
                'B' => 'As a warning of danger',
                'C' => 'Both answers are correct'
            ],
            'correct' => 'C'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mit jelent a "Elsőbbségadás kötelező" tábla?',
            'options' => [
                'A' => 'Meg kell állni és elsőbbséget kell adni',
                'B' => 'Elsőbbséget kell adni a keresztező forgalomnak',
                'C' => 'Elsőbbsége van a keresztező forgalommal szemben'
            ],
            'correct' => 'B'
        ],
        'en' => [
            'question' => 'What does the "Give Way" sign mean?',
            'options' => [
                'A' => 'You must stop and give way',
                'B' => 'You must give way to crossing traffic',
                'C' => 'You have priority over crossing traffic'
            ],
            'correct' => 'B'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen esetben kell használni a tompított fényszórót?',
            'options' => [
                'A' => 'Csak éjszaka',
                'B' => 'Éjszaka és korlátozott látási viszonyok között nappal is',
                'C' => 'Csak lakott területen kívül'
            ],
            'correct' => 'B'
        ],
        'en' => [
            'question' => 'When should you use dipped headlights?',
            'options' => [
                'A' => 'Only at night',
                'B' => 'At night and during the day in limited visibility conditions',
                'C' => 'Only outside residential areas'
            ],
            'correct' => 'B'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mit jelent a "Állj! Elsőbbségadás kötelező" tábla?',
            'options' => [
                'A' => 'Meg kell állni, majd elsőbbséget kell adni a keresztező forgalomnak',
                'B' => 'Csak lassítani kell, és elsőbbséget adni',
                'C' => 'Csak akkor kell megállni, ha jön keresztező forgalom'
            ],
            'correct' => 'A'
        ],
        'en' => [
            'question' => 'What does the "Stop and Give Way" sign mean?',
            'options' => [
                'A' => 'You must stop and then give way to crossing traffic',
                'B' => 'You only need to slow down and give way',
                'C' => 'You only need to stop if there is crossing traffic'
            ],
            'correct' => 'A'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen esetben tilos a hangjelzés használata?',
            'options' => [
                'A' => 'Lakott területen 22:00 és 6:00 óra között, kivéve veszélyhelyzet',
                'B' => 'Autópályán',
                'C' => 'Esős időben'
            ],
            'correct' => 'A'
        ],
        'en' => [
            'question' => 'When is the use of horn prohibited?',
            'options' => [
                'A' => 'In residential areas between 10 PM and 6 AM, except in case of danger',
                'B' => 'On highways',
                'C' => 'In rainy weather'
            ],
            'correct' => 'A'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mit jelent a "Előzni tilos" tábla?',
            'options' => [
                'A' => 'Tilos előzni minden gépjárművet',
                'B' => 'Tilos előzni csak a tehergépjárműveket',
                'C' => 'Tilos előzni a kétkerekű járműveket'
            ],
            'correct' => 'A'
        ],
        'en' => [
            'question' => 'What does the "No Overtaking" sign mean?',
            'options' => [
                'A' => 'Overtaking all motor vehicles is prohibited',
                'B' => 'Overtaking only trucks is prohibited',
                'C' => 'Overtaking two-wheeled vehicles is prohibited'
            ],
            'correct' => 'A'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen esetben kell használni a távolsági fényszórót?',
            'options' => [
                'A' => 'Mindig éjszakai vezetés során',
                'B' => 'Csak lakott területen kívül, ha nem vakítja el a szembe jövő forgalmat és nincs megfelelő közvilágítás',
                'C' => 'Csak autópályán'
            ],
            'correct' => 'B'
        ],
        'en' => [
            'question' => 'When should you use high beam headlights?',
            'options' => [
                'A' => 'Always during night driving',
                'B' => 'Only outside residential areas, when not blinding oncoming traffic and there is no adequate street lighting',
                'C' => 'Only on highways'
            ],
            'correct' => 'B'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mit jelent a "Sebességkorlátozás" tábla?',
            'options' => [
                'A' => 'Ajánlott sebesség',
                'B' => 'Minimális sebesség',
                'C' => 'Maximális megengedett sebesség'
            ],
            'correct' => 'C'
        ],
        'en' => [
            'question' => 'What does the "Speed Limit" sign mean?',
            'options' => [
                'A' => 'Recommended speed',
                'B' => 'Minimum speed',
                'C' => 'Maximum allowed speed'
            ],
            'correct' => 'C'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen esetben kell elsőbbséget adni a mentőautónak?',
            'options' => [
                'A' => 'Csak ha megkülönböztető jelzést használ',
                'B' => 'Mindig, függetlenül attól, hogy használja-e a megkülönböztető jelzést',
                'C' => 'Csak kereszteződésekben'
            ],
            'correct' => 'A'
        ],
        'en' => [
            'question' => 'When must you give way to an ambulance?',
            'options' => [
                'A' => 'Only when it is using special signals',
                'B' => 'Always, regardless of whether it is using special signals',
                'C' => 'Only at intersections'
            ],
            'correct' => 'A'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mit jelent a "Gyermekek" veszélyt jelző tábla?',
            'options' => [
                'A' => 'Gyermekek játszótere következik',
                'B' => 'Gyermekek közlekedhetnek az úttesten',
                'C' => 'Gyermekek jelenlétére figyelmeztető tábla, általában iskola vagy óvoda közelében'
            ],
            'correct' => 'C'
        ],
        'en' => [
            'question' => 'What does the "Children" warning sign mean?',
            'options' => [
                'A' => 'Children\'s playground ahead',
                'B' => 'Children may use the road',
                'C' => 'Warning sign for the presence of children, usually near a school or kindergarten'
            ],
            'correct' => 'C'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen esetben kell viselni fényvisszaverő mellényt?',
            'options' => [
                'A' => 'Csak éjszaka, lakott területen kívül',
                'B' => 'Lakott területen kívül a leállított járművet elhagyva az úttesten és a leállósávon',
                'C' => 'Csak kerékpározás közben'
            ],
            'correct' => 'B'
        ],
        'en' => [
            'question' => 'When must you wear a reflective vest?',
            'options' => [
                'A' => 'Only at night, outside residential areas',
                'B' => 'Outside residential areas when leaving your stopped vehicle on the road or emergency lane',
                'C' => 'Only when cycling'
            ],
            'correct' => 'B'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mit jelent a "Egyirányú forgalmi út" tábla?',
            'options' => [
                'A' => 'Az úton csak a nyíl irányában szabad közlekedni',
                'B' => 'Az úton mindkét irányban szabad közlekedni',
                'C' => 'Az úton tilos közlekedni a nyíl irányában'
            ],
            'correct' => 'A'
        ],
        'en' => [
            'question' => 'What does the "One-Way Road" sign mean?',
            'options' => [
                'A' => 'Traffic may proceed only in the direction of the arrow',
                'B' => 'Traffic may proceed in both directions',
                'C' => 'Traffic is prohibited in the direction of the arrow'
            ],
            'correct' => 'A'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen esetben kell elsőbbséget adni a villamosnak?',
            'options' => [
                'A' => 'Soha, a villamosnak mindig elsőbbséget kell adnia',
                'B' => 'Csak a kijelölt gyalogátkelőhelyeken',
                'C' => 'Azonos irányú forgalomban és útkereszteződésben, kivéve, ha jelzőtábla vagy fényjelző készülék másképp rendelkezik'
            ],
            'correct' => 'C'
        ],
        'en' => [
            'question' => 'When must you give way to a tram?',
            'options' => [
                'A' => 'Never, the tram must always give way',
                'B' => 'Only at designated pedestrian crossings',
                'C' => 'In traffic moving in the same direction and at intersections, unless a sign or traffic light indicates otherwise'
            ],
            'correct' => 'C'
        ]
    ],
    [
        'hu' => [
            'question' => 'Mit jelent a "Kerékpárút" tábla?',
            'options' => [
                'A' => 'Csak kerékpárosok használhatják az utat',
                'B' => 'Kerékpárosok is használhatják az utat',
                'C' => 'Tilos kerékpárral közlekedni'
            ],
            'correct' => 'A'
        ],
        'en' => [
            'question' => 'What does the "Bicycle Path" sign mean?',
            'options' => [
                'A' => 'Only cyclists may use the path',
                'B' => 'Cyclists may also use the path',
                'C' => 'Cycling is prohibited'
            ],
            'correct' => 'A'
        ]
    ],
    [
        'hu' => [
            'question' => 'Milyen esetben kell megállni rendőri jelzésre?',
            'options' => [
                'A' => 'Csak ha szabálysértést követtünk el',
                'B' => 'Minden esetben, amikor a rendőr megállásra ad jelzést',
                'C' => 'Csak ha a rendőr egyenruhát visel'
            ],
            'correct' => 'B'
        ],
        'en' => [
            'question' => 'When must you stop at a police signal?',
            'options' => [
                'A' => 'Only if you have committed an offense',
                'B' => 'In all cases when the police officer signals to stop',
                'C' => 'Only if the police officer is wearing a uniform'
            ],
            'correct' => 'B'
        ]
    ]
];

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" class="light-mode">

<head>
    <link rel="shortcut icon" href="SmallSquareLogoJpg.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $t['title']; ?></title>
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;600;700&family=Roboto:wght@300;400;500;700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Styles -->
    <style>
        :root {
            --primary: #0066ff;
            --primary-dark: #0052cc;
            --secondary: #ff3e00;
            --accent: #00e5ff;
            --background: #f8f9fa;
            --foreground: #212529;
            --card-bg: #ffffff;
            --card-border: rgba(0, 0, 0, 0.125);
            --input-bg: #ffffff;
            --input-border: #ced4da;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --header-bg: rgba(255, 255, 255, 0.95);
            --header-text: #212529;
            --footer-bg: #212529;
            --footer-text: #f8f9fa;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        .dark-mode {
            --primary: #3385ff;
            --primary-dark: #0066ff;
            --secondary: #ff5722;
            --accent: #00e5ff;
            --background: #121212;
            --foreground: #e0e0e0;
            --card-bg: #1e1e1e;
            --card-border: rgba(255, 255, 255, 0.125);
            --input-bg: #2d2d2d;
            --input-border: #444444;
            --header-bg: rgba(18, 18, 18, 0.95);
            --header-text: #e0e0e0;
            --footer-bg: #1e1e1e;
            --footer-text: #e0e0e0;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: var(--transition);
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--background);
            color: var(--foreground);
            line-height: 1.6;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Header & Navigation */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: var(--header-bg);
            backdrop-filter: blur(10px);
            z-index: 1000;
            box-shadow: var(--shadow);
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            max-width: 1400px;
            margin: 0 auto;
        }

        .navbar-brand {
            font-family: 'Exo 2', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 0.5rem;
            color: var(--secondary);
        }

        .navbar-toggler {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--header-text);
            cursor: pointer;
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            gap: 1.5rem;
        }

        .nav-link {
            color: var(--header-text);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 1rem;
            margin-top: 0;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(0, 102, 255, 0.8), rgba(0, 229, 255, 0.8));
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1503416997304-7f8bf166c121?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1932&q=80');
            background-size: cover;
            background-position: center;
            filter: brightness(0.4);
            z-index: -1;
        }

        .hero-content {
            max-width: 800px;
            z-index: 1;
        }

        .hero-title {
            font-family: 'Exo 2', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 1s ease;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            color: #ffffff;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 1s ease 0.2s;
            animation-fill-mode: both;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            animation: fadeInUp 1s ease 0.4s;
            animation-fill-mode: both;
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 1.8rem;
            border-radius: 50px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 1rem;
            text-align: center;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 102, 255, 0.4);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 102, 255, 0.5);
        }

        .btn-secondary {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
        }

        /* Scroll Down Indicator */
        .scroll-down {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 2rem;
            animation: bounce 2s infinite;
            cursor: pointer;
        }

        /* Sections */
        section {
            padding: 5rem 1rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            font-family: 'Exo 2', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            color: var(--primary);
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }

        /* About Section */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .about-content p {
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .about-image {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .about-image img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
        }

        .about-image:hover img {
            transform: scale(1.05);
        }

        /* Stats Section */
        .stats-section {
            background-color: var(--primary);
            color: white;
            text-align: center;
        }

        .stats-title {
            color: white;
        }

        .stats-title::after {
            background: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .stat-item {
            padding: 2rem;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            transition: var(--transition);
        }

        .stat-item:hover {
            transform: translateY(-10px);
            background-color: rgba(255, 255, 255, 0.2);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-family: 'Exo 2', sans-serif;
        }

        .stat-label {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* Schedule Section */
        .schedule-section {
            background-color: var(--card-bg);
            border-radius: 10px;
            box-shadow: var(--shadow);
            padding: 3rem;
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
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
            padding: 0.8rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--input-border);
            background-color: var(--input-bg);
            color: var(--foreground);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.25);
        }

        .schedule-image {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .schedule-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Practice Section */
        .practice-section {
            background-color: var(--background);
            text-align: center;
        }

        .practice-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .practice-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.8;
        }

        /* FAQ Section */
        .faq-section {
            background-color: var(--card-bg);
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            margin-bottom: 1.5rem;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
            background-color: var(--card-bg);
            border: 1px solid var(--card-border);
        }

        .faq-question {
            padding: 1.2rem;
            background-color: var(--primary);
            color: white;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-question i {
            transition: transform 0.3s ease;
        }

        .faq-answer {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }

        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }

        .faq-item.active .faq-answer {
            padding: 1.2rem;
            max-height: 200px;
        }

        /* Contact Section */
        .contact-section {
            background-color: var(--background);
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .contact-text h4 {
            font-weight: 500;
            margin-bottom: 0.2rem;
        }

        .contact-form {
            background-color: var(--card-bg);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        /* Footer */
        footer {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            padding: 3rem 1rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-brand {
            font-family: 'Exo 2', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .footer-about {
            margin-bottom: 1.5rem;
            opacity: 0.8;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--footer-text);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .social-icon:hover {
            background-color: var(--primary);
            transform: translateY(-3px);
        }

        .footer-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: white;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: var(--footer-text);
            opacity: 0.8;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            opacity: 1;
            color: var(--primary);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            opacity: 0.7;
            font-size: 0.9rem;
        }

        /* Theme Switcher */
        .theme-switcher {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 999;
            background-color: var(--card-bg);
            border-radius: 50px;
            padding: 0.5rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .theme-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background-color: transparent;
            color: var(--foreground);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .theme-btn.active {
            background-color: var(--primary);
            color: white;
        }

        /* Language Switcher */
        .language-switcher {
            display: flex;
            align-items: center;
            margin-left: 1.5rem;
        }

        .language-switcher a {
            display: flex;
            align-items: center;
            text-decoration: none;
            padding: 0.5rem;
            border-radius: 5px;
            transition: var(--transition);
        }

        .language-switcher a:hover {
            background-color: rgba(0, 102, 255, 0.1);
        }

        .language-switcher img {
            width: 24px;
            height: 16px;
            margin-right: 0.5rem;
        }

        /* Success Toast */
        .success-toast {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background-color: var(--success);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            transform: translateX(120%);
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        .success-toast.show {
            transform: translateX(0);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0) translateX(-50%);
            }

            40% {
                transform: translateY(-20px) translateX(-50%);
            }

            60% {
                transform: translateY(-10px) translateX(-50%);
            }
        }

        /* Traffic Light Animation */
        .traffic-light {
            position: relative;
            width: 80px;
            height: 200px;
            background-color: #333;
            border-radius: 10px;
            margin: 0 auto 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-evenly;
            padding: 10px 0;
        }

        .light {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #333;
            position: relative;
            overflow: hidden;
        }

        .light::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .light.red {
            background-color: #ff3333;
            animation: pulse 2s infinite alternate;
        }

        .light.yellow {
            background-color: #ffcc00;
            animation: pulse 2s infinite alternate 0.5s;
        }

        .light.green {
            background-color: #33cc33;
            animation: pulse 2s infinite alternate 1s;
        }

        @keyframes pulse {
            0% {
                opacity: 0.7;
                box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            }

            100% {
                opacity: 1;
                box-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
            }
        }

        /* Practice Test Styles */
        .test-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 2000;
            overflow-y: auto;
            padding: 2rem 0;
        }

        .test-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: var(--card-bg);
            border-radius: 10px;
            box-shadow: var(--shadow);
            padding: 2rem;
            position: relative;
        }

        .close-test {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--foreground);
            cursor: pointer;
            transition: var(--transition);
        }

        .close-test:hover {
            color: var(--primary);
            transform: scale(1.1);
        }

        .question-card {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border: 1px solid var(--card-border);
            border-radius: 8px;
            background-color: var(--card-bg);
        }

        .question-number {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .question-text {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .options-list {
            list-style: none;
            padding: 0;
        }

        .option-item {
            margin-bottom: 0.8rem;
        }

        .option-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0.8rem;
            border-radius: 8px;
            transition: var(--transition);
            border: 1px solid var(--card-border);
        }

        .option-label:hover {
            background-color: rgba(0, 102, 255, 0.05);
        }

        .option-radio {
            margin-right: 1rem;
        }

        .test-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .test-progress {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .progress-bar {
            height: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
            flex-grow: 1;
            margin: 0 1rem;
        }

        .progress-fill {
            height: 100%;
            background-color: var(--primary);
            width: 0;
            transition: width 0.3s ease;
        }

        .timer {
            font-weight: 700;
            color: var(--primary);
        }

        .results-container {
            text-align: center;
            padding: 2rem;
        }

        .score-display {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .score-text {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .result-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .review-list {
            margin-top: 2rem;
            text-align: left;
        }

        .review-item {
            margin-bottom: 1.5rem;
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid var(--card-border);
        }

        .review-question {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .review-answer {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
        }

        .correct {
            color: var(--success);
        }

        .incorrect {
            color: var(--danger);
        }

        .random-test-banner {
            background-color: var(--primary);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            text-align: center;
        }

        .random-test-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .random-test-subtitle {
            opacity: 0.9;
        }

        .question-image {
            max-width: 100%;
            height: auto;
            margin: 1rem 0;
            border-radius: 8px;
            border: 1px solid var(--card-border);
        }

        .percentage-display {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin: 1rem 0;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            background-color: rgba(0, 102, 255, 0.1);
            display: inline-block;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .navbar-nav {
                gap: 1rem;
            }

            .hero-title {
                font-size: 2.8rem;
            }

            .about-grid,
            .schedule-grid,
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .navbar-toggler {
                display: block;
            }

            .navbar-collapse {
                position: fixed;
                top: 70px;
                left: 0;
                width: 100%;
                height: 0;
                background-color: var(--header-bg);
                overflow: hidden;
                transition: height 0.3s ease;
                box-shadow: var(--shadow);
            }

            .navbar-collapse.show {
                height: auto;
            }

            .navbar-nav {
                flex-direction: column;
                padding: 1rem;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .hero-buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <nav class="navbar">
            <a href="#" class="navbar-brand">
                <i class="fas fa-traffic-light"></i> <?php echo $t['title']; ?>
            </a>
            <button class="navbar-toggler" id="navbar-toggler">
                <i class="fas fa-bars"></i>
            </button>
            <div class="navbar-collapse" id="navbar-collapse">
                <ul class="navbar-nav">
                    <li><a href="#about" class="nav-link"><?php echo $t['about']; ?></a></li>
                    <li><a href="#schedule" class="nav-link"><?php echo $t['schedule']; ?></a></li>
                    <li><a href="#practice" class="nav-link"><?php echo $t['practice']; ?></a></li>
                    <li><a href="#contact" class="nav-link"><?php echo $t['contact']; ?></a></li>
                    <li class="language-switcher">
                        <?php if ($lang == 'hu'): ?>
                            <a href="?lang=en" title="Switch to English">
                                <img src="https://flagcdn.com/w20/gb.png" alt="English Flag">
                                <span>EN</span>
                            </a>
                        <?php else: ?>
                            <a href="?lang=hu" title="Váltás magyarra">
                                <img src="https://flagcdn.com/w20/hu.png" alt="Hungarian Flag">
                                <span>HU</span>
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background"></div>
        <div class="hero-content">
            <h1 class="hero-title"><?php echo $t['hero_title']; ?></h1>
            <p class="hero-subtitle"><?php echo $t['hero_subtitle']; ?></p>
            <div class="hero-buttons">
                <a href="#schedule" class="btn btn-primary"><?php echo $t['book_button']; ?></a>
                <a href="#" class="btn btn-secondary" id="open-practice-test"><?php echo $t['practice_button']; ?></a>
            </div>
        </div>
        <a href="#about" class="scroll-down">
            <i class="fas fa-chevron-down"></i>
        </a>
    </section>

    <!-- About Section -->
    <section id="about" class="container">
        <h2 class="section-title"><?php echo $t['exam_title']; ?></h2>
        <div class="about-grid">
            <div class="about-content">
                <p><?php echo $t['exam_p1']; ?></p>
                <p><?php echo $t['exam_p2']; ?></p>

                <!-- Traffic Light Animation -->
                <div class="traffic-light">
                    <div class="light red"></div>
                    <div class="light yellow"></div>
                    <div class="light green"></div>
                </div>
            </div>
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80"
                    alt="KRESZ vizsga">
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <h2 class="section-title stats-title"><?php echo $t['stats_title']; ?></h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number" data-count="5000">0</div>
                    <div class="stat-label"><?php echo $t['stats_exams']; ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="8500">0</div>
                    <div class="stat-label"><?php echo $t['stats_students']; ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="98">0</div>
                    <div class="stat-label"><?php echo $t['stats_satisfaction']; ?> %</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Schedule Section -->
    <section id="schedule" class="container">
        <h2 class="section-title"><?php echo $t['schedule_title']; ?></h2>
        <div class="schedule-section">
            <div class="schedule-grid">
                <div>
                    <h4><?php echo $t['choose_time']; ?></h4>
                    <form action="" method="post">
                        <input type="hidden" name="lang" value="<?php echo $lang; ?>">
                        <div class="form-group">
                            <label for="name" class="form-label"><?php echo $t['name']; ?></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label"><?php echo $t['email']; ?></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="license" class="form-label"><?php echo $t['license_question']; ?></label>
                            <select class="form-control" id="license" name="license" required>
                                <option value="b">B <?php echo ($lang == 'hu') ? 'kategória' : 'category'; ?></option>
                                <option value="c">C <?php echo ($lang == 'hu') ? 'kategória' : 'category'; ?></option>
                                <option value="d">D <?php echo ($lang == 'hu') ? 'kategória' : 'category'; ?></option>
                                <option value="e">E <?php echo ($lang == 'hu') ? 'kategória' : 'category'; ?></option>
                                <option value="a">A <?php echo ($lang == 'hu') ? 'kategória' : 'category'; ?></option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo $t['submit']; ?></button>
                    </form>
                </div>
                <div class="schedule-image">
                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80"
                        alt="<?php echo $t['schedule_title']; ?>">
                </div>
            </div>
        </div>
    </section>

    <!-- Practice Section -->
    <section id="practice" class="practice-section">
        <div class="container">
            <h2 class="section-title"><?php echo $t['practice_title']; ?></h2>
            <div class="practice-content">
                <p class="practice-subtitle"><?php echo $t['practice_subtitle']; ?></p>
                <a href="#" class="btn btn-primary" id="open-practice-test-2"><?php echo $t['practice_button']; ?></a>
            </div>
        </div>
    </section>

    <!-- Practice Test Modal -->
    <div id="practice-test-modal" class="test-modal">
        <div class="test-container">
            <button class="close-test" id="close-test">
                <i class="fas fa-times"></i>
            </button>

            <h2 class="section-title"><?php echo $tt['title']; ?></h2>

            <div id="test-content">
                <!-- Test Form -->
                <p class="practice-subtitle"><?php echo $tt['instructions']; ?></p>

                <div id="random-test-banner" style="display: none;" class="random-test-banner">
                    <h3 class="random-test-title"><?php echo $tt['random_test_title']; ?></h3>
                    <p class="random-test-subtitle"><?php echo $tt['random_test_subtitle']; ?></p>
                </div>

                <div class="test-progress">
                    <span id="current-question">1</span> / <span id="total-questions">30</span>
                    <div class="progress-bar">
                        <div class="progress-fill" id="progress-fill"></div>
                    </div>
                    <div class="timer">
                        <i class="fas fa-clock"></i> <span id="timer">30:00</span>
                    </div>
                </div>

                <form id="test-form">
                    <?php
                    foreach ($questions as $q_id => $question):
                        ?>
                        <div class="question-card" id="question-<?php echo $q_id; ?>"
                            style="display: <?php echo $q_id === 0 ? 'block' : 'none'; ?>"
                            data-correct="<?php echo $question[$lang]['correct']; ?>">
                            <div class="question-number">
                                <?php echo $tt['question']; ?> <span
                                    class="question-index"><?php echo $q_id + 1; ?></span>/<span
                                    class="total-questions">30</span>
                            </div>
                            <div class="question-text">
                                <?php echo $question[$lang]['question']; ?>
                            </div>

                            <!-- Add traffic sign image for relevant questions -->


                            <ul class="options-list">
                                <?php foreach ($question[$lang]['options'] as $option_key => $option_text): ?>
                                    <li class="option-item">
                                        <label class="option-label">
                                            <input type="radio" name="question_<?php echo $q_id; ?>"
                                                value="<?php echo $option_key; ?>" class="option-radio" required>
                                            <span><?php echo $option_key . ') ' . $option_text; ?></span>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>

                    <div class="test-navigation">
                        <button type="button" id="prev-btn" class="btn btn-secondary"
                            disabled><?php echo $tt['previous']; ?></button>
                        <button type="button" id="next-btn" class="btn btn-primary"><?php echo $tt['next']; ?></button>
                        <button type="button" id="submit-btn" class="btn btn-primary"
                            style="display: none;"><?php echo $tt['submit']; ?></button>
                    </div>
                </form>
            </div>

            <div id="results-container" class="results-container" style="display: none;">
                <!-- Results will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2 class="section-title"><?php echo $t['faq_title']; ?></h2>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <?php echo $t['faq1_q']; ?>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <?php echo $t['faq1_a']; ?>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <?php echo $t['faq2_q']; ?>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <?php echo $t['faq2_a']; ?>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <?php echo $t['faq3_q']; ?>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <?php echo $t['faq3_a']; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <h2 class="section-title"><?php echo $t['contact_title']; ?></h2>
            <p class="text-center"><?php echo $t['contact_text']; ?></p>
            <div class="contact-grid">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-text">
                            <h4><?php echo $t['address']; ?></h4>
                            <p>1041 Budapest, Görgey Artúr u. 26</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-text">
                            <h4><?php echo $t['phone']; ?></h4>
                            <p>+36 1 123 4567</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Email</h4>
                            <p>info@umszkikresz.hu</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <form>
                        <div class="form-group">
                            <label for="contact-name" class="form-label"><?php echo $t['name']; ?></label>
                            <input type="text" class="form-control" id="contact-name"
                                placeholder="<?php echo $t['name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email" class="form-label"><?php echo $t['email']; ?></label>
                            <input type="email" class="form-control" id="contact-email"
                                placeholder="<?php echo $t['email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-label"><?php echo $t['message']; ?></label>
                            <textarea class="form-control" id="message" rows="4"
                                placeholder="<?php echo $t['message']; ?>" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo $t['send']; ?></button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-grid">
            <div>
                <div class="footer-brand">
                    <i class="fas fa-traffic-light"></i> <?php echo $t['title']; ?>
                </div>
                <p class="footer-about">
                    <?php echo ($lang == 'hu') ? 'Segítünk felkészülni a KRESZ vizsgára, hogy biztonságosan közlekedhess az utakon.' : 'We help you prepare for the traffic rules exam so you can safely navigate the roads.'; ?>
                </p>
                <div class="footer-social">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div>
                <h3 class="footer-title"><?php echo ($lang == 'hu') ? 'Gyors linkek' : 'Quick Links'; ?></h3>
                <ul class="footer-links">
                    <li><a href="#about"><?php echo $t['about']; ?></a></li>
                    <li><a href="#schedule"><?php echo $t['schedule']; ?></a></li>
                    <li><a href="#practice"><?php echo $t['practice']; ?></a></li>
                    <li><a href="#contact"><?php echo $t['contact']; ?></a></li>
                </ul>
            </div>
            <div>
                <h3 class="footer-title"><?php echo ($lang == 'hu') ? 'Kategóriák' : 'Categories'; ?></h3>
                <ul class="footer-links">
                    <li><a href="#">A <?php echo ($lang == 'hu') ? 'kategória' : 'category'; ?></a></li>
                    <li><a href="#">B <?php echo ($lang == 'hu') ? 'kategória' : 'category'; ?></a></li>
                    <li><a href="#">C <?php echo ($lang == 'hu') ? 'kategória' : 'category'; ?></a></li>
                    <li><a href="#">D <?php echo ($lang == 'hu') ? 'kategória' : 'category'; ?></a></li>
                    <li><a href="#">D <?php echo ($lang == 'hu') ? 'kategória' : 'category'; ?></a></li>
                    <li><a href="#">E <?php echo ($lang == 'hu') ? 'kategória' : 'category'; ?></a></li>
                </ul>
            </div>
            <div>
                <h3 class="footer-title"><?php echo ($lang == 'hu') ? 'Nyitvatartás' : 'Opening Hours'; ?></h3>
                <ul class="footer-links">
                    <li><?php echo ($lang == 'hu') ? 'Hétfő - Péntek' : 'Monday - Friday'; ?>: 8:00 - 16:00</li>
                    <li><?php echo ($lang == 'hu') ? 'Szombat' : 'Saturday'; ?>: 9:00 - 13:00</li>
                    <li><?php echo ($lang == 'hu') ? 'Vasárnap' : 'Sunday'; ?>:
                        <?php echo ($lang == 'hu') ? 'Zárva' : 'Closed'; ?></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p><?php echo $t['footer']; ?></p>
        </div>
    </footer>

    <!-- Theme Switcher -->
    <div class="theme-switcher">
        <button class="theme-btn" id="light-mode" title="<?php echo $t['light_mode']; ?>">
            <i class="fas fa-sun"></i>
        </button>
        <button class="theme-btn" id="dark-mode" title="<?php echo $t['dark_mode']; ?>">
            <i class="fas fa-moon"></i>
        </button>
    </div>

    <!-- Scripts -->
    <script>
        // Mobile Navigation
        document.addEventListener('DOMContentLoaded', function () {
            const navbarToggler = document.getElementById('navbar-toggler');
            const navbarCollapse = document.getElementById('navbar-collapse');

            navbarToggler.addEventListener('click', function () {
                navbarCollapse.classList.toggle('show');
            });

            // Close menu when clicking on a link
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function () {
                    navbarCollapse.classList.remove('show');
                });
            });

            // Smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // FAQ Accordion
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                question.addEventListener('click', function () {
                    item.classList.toggle('active');
                });
            });

            // Theme Switcher
            const lightModeBtn = document.getElementById('light-mode');
            const darkModeBtn = document.getElementById('dark-mode');
            const htmlElement = document.documentElement;

            // Check for saved theme preference
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                htmlElement.classList.add('dark-mode');
                darkModeBtn.classList.add('active');
            } else {
                lightModeBtn.classList.add('active');
            }

            lightModeBtn.addEventListener('click', function () {
                htmlElement.classList.remove('dark-mode');
                localStorage.setItem('theme', 'light');
                lightModeBtn.classList.add('active');
                darkModeBtn.classList.remove('active');
            });

            darkModeBtn.addEventListener('click', function () {
                htmlElement.classList.add('dark-mode');
                localStorage.setItem('theme', 'dark');
                darkModeBtn.classList.add('active');
                lightModeBtn.classList.remove('active');
            });

            // Animate stats counter
            const stats = document.querySelectorAll('.stat-number');

            function animateStats() {
                stats.forEach(stat => {
                    const target = parseInt(stat.getAttribute('data-count'));
                    const count = +stat.innerText;
                    const speed = target / 100;

                    if (count < target) {
                        stat.innerText = Math.ceil(count + speed);
                        setTimeout(animateStats, 20);
                    } else {
                        stat.innerText = target;
                    }
                });
            }

            // Start animation when stats section is in view
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateStats();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            const statsSection = document.querySelector('.stats-section');
            if (statsSection) {
                observer.observe(statsSection);
            }

            // Practice Test Modal
            const practiceTestModal = document.getElementById('practice-test-modal');
            const openPracticeTestBtn = document.getElementById('open-practice-test');
            const openPracticeTestBtn2 = document.getElementById('open-practice-test-2');
            const closeTestBtn = document.getElementById('close-test');

            function openPracticeTest() {
                practiceTestModal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }

            function closePracticeTest() {
                practiceTestModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            if (openPracticeTestBtn) {
                openPracticeTestBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    openPracticeTest();
                });
            }

            if (openPracticeTestBtn2) {
                openPracticeTestBtn2.addEventListener('click', function (e) {
                    e.preventDefault();
                    openPracticeTest();
                });
            }

            if (closeTestBtn) {
                closeTestBtn.addEventListener('click', function () {
                    closePracticeTest();
                });
            }

            // Close modal when clicking outside
            window.addEventListener('click', function (e) {
                if (e.target === practiceTestModal) {
                    closePracticeTest();
                }
            });

            // Test Navigation
            const testForm = document.getElementById('test-form');
            if (testForm) {
                const questions = document.querySelectorAll('.question-card');
                let totalQuestions = questions.length;
                const prevBtn = document.getElementById('prev-btn');
                const nextBtn = document.getElementById('next-btn');
                const submitBtn = document.getElementById('submit-btn');
                const progressFill = document.getElementById('progress-fill');
                const currentQuestionSpan = document.getElementById('current-question');
                const totalQuestionsSpan = document.getElementById('total-questions');

                let currentQuestion = 0;
                let isRandomTest = false;
                let randomQuestions = [];

                // Function to initialize random test
                function initRandomTest() {
                    isRandomTest = true;
                    document.getElementById('random-test-banner').style.display = 'block';

                    // Select 10 random questions
                    randomQuestions = [];
                    const indices = [];
                    while (indices.length < 10) {
                        const randomIndex = Math.floor(Math.random() * questions.length);
                        if (!indices.includes(randomIndex)) {
                            indices.push(randomIndex);
                            randomQuestions.push(questions[randomIndex]);
                        }
                    }

                    // Hide all questions
                    questions.forEach(q => {
                        q.style.display = 'none';
                    });

                    // Show only the first random question
                    if (randomQuestions.length > 0) {
                        randomQuestions[0].style.display = 'block';
                    }

                    // Update total questions
                    totalQuestions = 10;
                    document.querySelectorAll('.total-questions').forEach(el => {
                        el.textContent = '10';
                    });
                    totalQuestionsSpan.textContent = '10';

                    // Reset current question
                    currentQuestion = 0;
                    updateProgress();
                }

                // Function to initialize full test
                function initFullTest() {
                    isRandomTest = false;
                    document.getElementById('random-test-banner').style.display = 'none';

                    // Hide all questions
                    questions.forEach((q, i) => {
                        q.style.display = i === 0 ? 'block' : 'none';
                    });

                    // Update total questions
                    totalQuestions = questions.length;
                    document.querySelectorAll('.total-questions').forEach(el => {
                        el.textContent = totalQuestions.toString();
                    });
                    totalQuestionsSpan.textContent = totalQuestions.toString();

                    // Reset current question
                    currentQuestion = 0;
                    updateProgress();
                }

                // Update progress
                function updateProgress() {
                    const progress = ((currentQuestion + 1) / totalQuestions) * 100;
                    progressFill.style.width = progress + '%';
                    currentQuestionSpan.textContent = currentQuestion + 1;

                    // Update buttons
                    prevBtn.disabled = currentQuestion === 0;

                    if (currentQuestion === totalQuestions - 1) {
                        nextBtn.style.display = 'none';
                        submitBtn.style.display = 'block';
                    } else {
                        nextBtn.style.display = 'block';
                        submitBtn.style.display = 'none';
                    }
                }

                // Show question
                function showQuestion(index) {
                    if (isRandomTest) {
                        randomQuestions.forEach((q, i) => {
                            q.style.display = i === index ? 'block' : 'none';
                        });
                    } else {
                        questions.forEach((q, i) => {
                            q.style.display = i === index ? 'block' : 'none';
                        });
                    }
                    currentQuestion = index;
                    updateProgress();
                }

                // Event listeners
                prevBtn.addEventListener('click', function () {
                    if (currentQuestion > 0) {
                        showQuestion(currentQuestion - 1);
                    }
                });

                nextBtn.addEventListener('click', function () {
                    const currentQuestionElement = isRandomTest ? randomQuestions[currentQuestion] : questions[currentQuestion];
                    const radioButtons = currentQuestionElement.querySelectorAll('input[type="radio"]');
                    let answered = false;

                    radioButtons.forEach(radio => {
                        if (radio.checked) {
                            answered = true;
                        }
                    });

                    if (answered) {
                        if (currentQuestion < totalQuestions - 1) {
                            showQuestion(currentQuestion + 1);
                        }
                    } else {
                        alert('<?php echo ($lang == 'hu') ? 'Kérjük, válaszolj a kérdésre a folytatáshoz!' : 'Please answer the question to continue!'; ?>');
                    }
                });

                // Submit test
                submitBtn.addEventListener('click', function () {
                    // Collect all answers
                    const userAnswers = {};
                    const activeQuestions = isRandomTest ? randomQuestions : questions;

                    let allAnswered = true;
                    activeQuestions.forEach((question, index) => {
                        const questionId = question.id.split('-')[1];
                        const radioButtons = question.querySelectorAll('input[type="radio"]');
                        let answered = false;

                        radioButtons.forEach(radio => {
                            if (radio.checked) {
                                userAnswers[questionId] = radio.value;
                                answered = true;
                            }
                        });

                        if (!answered) {
                            allAnswered = false;
                        }
                    });

                    if (!allAnswered) {
                        alert('<?php echo ($lang == 'hu') ? 'Kérjük, válaszolj minden kérdésre a teszt beküldése előtt!' : 'Please answer all questions before submitting the test!'; ?>');
                        return;
                    }

                    // Calculate score
                    let score = 0;
                    let reviewHtml = '';

                    Object.keys(userAnswers).forEach(questionId => {
                        const question = document.getElementById('question-' + questionId);
                        const correctAnswer = question.getAttribute('data-correct');
                        const userAnswer = userAnswers[questionId];
                        const questionText = question.querySelector('.question-text').textContent;
                        const options = {};

                        question.querySelectorAll('.option-label').forEach(label => {
                            const value = label.querySelector('input').value;
                            const text = label.querySelector('span').textContent;
                            options[value] = text;
                        });

                        if (userAnswer === correctAnswer) {
                            score++;
                        }

                        // Build review HTML
                        reviewHtml += `
                            <div class="review-item">
                                <div class="review-question">
                                    ${parseInt(questionId) + 1}. ${questionText}
                                </div>
                                <div class="review-answer">
                                    <div>
                                        <strong><?php echo $tt['your_answer']; ?>:</strong> 
                                        ${options[userAnswer]}
                                    </div>
                                    <div class="${userAnswer === correctAnswer ? 'correct' : 'incorrect'}">
                                        ${userAnswer === correctAnswer
                                ? `<i class="fas fa-check-circle"></i> <?php echo $tt['correct']; ?>`
                                : `<i class="fas fa-times-circle"></i> <?php echo $tt['incorrect']; ?>
                                               <div>
                                                   <strong><?php echo $tt['correct_answer']; ?>:</strong> 
                                                   ${options[correctAnswer]}
                                               </div>`
                            }
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    // Calculate percentage
                    const percentage = Math.round((score / Object.keys(userAnswers).length) * 100);

                    // Display results
                    const resultsHtml = `
                        <div class="score-display">
                            ${score} <span style="font-size: 2rem;"><?php echo $tt['out_of']; ?> ${Object.keys(userAnswers).length}</span>
                        </div>
                        <div class="percentage-display">
                            ${percentage}%
                        </div>
                        <div class="score-text">
                            ${percentage >= 75
                            ? '<span class="correct"><i class="fas fa-check-circle"></i> ' + (<?php echo $lang == 'hu' ? 'true' : 'false'; ?> ? 'Sikeres teszt!' : 'Test passed!') + '</span>'
                            : '<span class="incorrect"><i class="fas fa-times-circle"></i> ' + (<?php echo $lang == 'hu' ? 'true' : 'false'; ?> ? 'Sikertelen teszt!' : 'Test failed!') + '</span>'
                        }
                        </div>
                        
                        <div class="review-list">
                            <h3><?php echo $tt['review_answers']; ?></h3>
                            ${reviewHtml}
                        </div>
                        
                        <div class="result-actions">
                            <a href="#" class="btn btn-primary" id="restart-test"><?php echo $tt['restart']; ?></a>
                            ${!isRandomTest
                            ? `<a href="#" class="btn btn-secondary" id="start-random-test"><?php echo $tt['random_test']; ?></a>`
                            : `<a href="#" class="btn btn-secondary" id="back-to-full-test"><?php echo $tt['back_to_full_test']; ?></a>`
                        }
                        </div>
                    `;

                    // Show results
                    document.getElementById('test-content').style.display = 'none';
                    const resultsContainer = document.getElementById('results-container');
                    resultsContainer.innerHTML = resultsHtml;
                    resultsContainer.style.display = 'block';

                    // Add event listeners to result buttons
                    document.getElementById('restart-test').addEventListener('click', function (e) {
                        e.preventDefault();
                        resetTest();
                    });

                    if (!isRandomTest && document.getElementById('start-random-test')) {
                        document.getElementById('start-random-test').addEventListener('click', function (e) {
                            e.preventDefault();
                            resetTest(true);
                        });
                    } else if (isRandomTest && document.getElementById('back-to-full-test')) {
                        document.getElementById('back-to-full-test').addEventListener('click', function (e) {
                            e.preventDefault();
                            resetTest(false);
                        });
                    }
                });

                // Reset test
                function resetTest(randomTest = false) {
                    // Reset all radio buttons
                    document.querySelectorAll('input[type="radio"]').forEach(radio => {
                        radio.checked = false;
                    });

                    // Hide results
                    document.getElementById('results-container').style.display = 'none';
                    document.getElementById('test-content').style.display = 'block';

                    // Initialize appropriate test
                    if (randomTest) {
                        initRandomTest();
                    } else {
                        initFullTest();
                    }

                    // Reset timer
                    timeLeft = 30 * 60;
                    updateTimer();
                }

                // Timer
                const timerElement = document.getElementById('timer');
                let timeLeft = 30 * 60; // 30 minutes in seconds

                function updateTimer() {
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;

                    timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        alert('<?php echo ($lang == 'hu') ? 'Az idő lejárt! A válaszaid automatikusan beküldésre kerülnek.' : 'Time\'s up! Your answers will be submitted automatically.'; ?>');
                        submitBtn.click();
                    }

                    timeLeft--;
                }

                const timerInterval = setInterval(updateTimer, 1000);

                // Initialize
                updateProgress();
            }
        });
    </script>
</body>
</html>