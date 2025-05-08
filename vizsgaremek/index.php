<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tmsblnt.hu | Vizsgaremek</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="universe">
        <!-- Stars and cosmic elements will be added by JavaScript -->
    </div>

    <div class="neon-glow" id="neonGlow"></div>
    <!-- Terminal Overlays -->
    <div class="terminal-overlay" id="linuxTerminal">
        <div class="terminal-window linux-terminal">
            <div class="terminal-header">
                <div class="terminal-close" onclick="closeTerminal('linuxTerminal')"></div>
                <div class="terminal-title">Linux Terminal</div>
            </div>
            <div class="terminal-content" id="linuxTerminalContent">
                <!-- Terminal content will be loaded from localStorage or default content -->
            </div>
        </div>
    </div>
    <div class="terminal-overlay" id="windowsTerminal">
        <div class="terminal-window windows-terminal">
            <div class="terminal-header">
                <div class="terminal-close" onclick="closeTerminal('windowsTerminal')"></div>
                <div class="terminal-title">Windows Terminal</div>
            </div>
            <div class="terminal-content" id="windowsTerminalContent">
                <!-- Terminal content will be loaded from localStorage or default content -->
            </div>
        </div>
    </div>
    <!-- Mobile Menu Toggle -->
    <div class="menu-toggle" id="menuToggle">
        <span></span>
    </div>
    <div class="app-container">
        <!-- Left Navbar -->
        <nav class="navbar" id="navbar">
            <ul class="nav-links">
                <li class="nav-link active" data-page="websites">
                    <a href="#websites">Források</a>
                </li>
                <li class="nav-link" data-page="documentation">
                    <a href="#documentation">Dokumentáció</a>
                </li>
                <li class="nav-link" data-page="contributors">
                    <a href="#contributors">Közreműködők</a>
                </li>
                <li class="nav-link" data-page="presentation">
                    <a href="#presentation">Prezentáció</a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Websites Page -->
            <section id="websites" class="page active">
                <h1 class="page-title">Források</h1>

                <div class="websites-grid">
                    <?php
                    // Sample website data - replace with your actual websites
                    $websites = [
                        [
                            'title' => 'UMSZKI KRESZ',
                            'description' => 'Vizsgaremek Weboldal',
                            'image' => 'umszkikresz.png',
                            'url' => 'https://tmsblnt.hu/umszkikresz'
                        ],
                        [
                            'title' => 'UMSZKIKRESZ DASHBOARD',
                            'description' => 'Vizsgaremek Dashboard.',
                            'image' => 'dashboard.png',
                            'url' => 'https://tmsblnt.hu/dashboard'
                        ],
                        [
                            'title' => 'LINUX SZERVER KONFIGURÁCIÓ',
                            'description' => 'Kattins a megtekintéshez.',
                            'image' => 'linux.jpg',
                            'url' => '#',
                            'terminal' => 'linuxTerminal'
                        ],
                        [
                            'title' => 'WINDOWS SZERVER KONFIGURÁCIÓ',
                            'description' => 'Kattins a megtekintéshez.',
                            'image' => 'windows.jpg',
                            'url' => '#',
                            'terminal' => 'windowsTerminal'
                        ]
                    ];

                    // Generate website cards
                    foreach ($websites as $site) {
                        echo '<div class="website-card">';
                        echo '<img src="' . $site['image'] . '" alt="' . $site['title'] . '" class="website-image">';
                        echo '<div class="website-content">';
                        echo '<h3 class="website-title">' . $site['title'] . '</h3>';
                        echo '<p class="website-description">' . $site['description'] . '</p>';

                        // Check if this is a terminal card
                        if (isset($site['terminal'])) {
                            echo '<a href="#" class="website-link" onclick="openTerminal(\'' . $site['terminal'] . '\'); return false;">Megtekintés</a>';
                        } else {
                            echo '<a href="' . $site['url'] . '" class="website-link" target="_blank">Megtekintés</a>';
                        }

                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </section>
            <!-- Documentation Page -->
            <section id="documentation" class="page">
                <h1 class="page-title">Dokumentáció</h1>

                <div class="pdf-container">
                    <div class="pdf-selector">
                        <?php
                        // Sample PDF documents - replace with your actual PDFs
                        $pdfs = [
                            [
                                'id' => 'doc1',
                                'title' => 'Pályázat',
                                'description' => 'Ez az a pályázat amire készítettük a mi Vizsgaremekünket',
                                'file' => 'Széchenyi2020_Pályázat(KresszVizsga).pdf'
                            ],
                            [
                                'id' => 'doc2',
                                'title' => 'Jelentkezés',
                                'description' => 'Ezzel jelentkeztünk a pályázatra',
                                'file' => 'Állásra Jelentkező Levél PDF.pdf'
                            ],
                            [
                                'id' => 'doc3',
                                'title' => 'Topológia',
                                'description' => 'Draw.io, Packet Tracer teljes és részleges topológia',
                                'file' => 'topologia.pdf'
                            ],
                            [
                                'id' => 'doc4',
                                'title' => 'Teljes Dokumentáció',
                                'description' => '',
                                'file' => ''
                            ]
                        ];

                        // Generate PDF options
                        foreach ($pdfs as $index => $pdf) {
                            $activeClass = $index === 0 ? 'active' : '';
                            echo '<div class="pdf-option ' . $activeClass . '" data-pdf="' . $pdf['file'] . '">';
                            echo '<div class="pdf-option-title">' . $pdf['title'] . '</div>';
                            echo '<div class="pdf-option-description">' . $pdf['description'] . '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>

                    <iframe id="pdfViewer" class="pdf-viewer" src="<?php echo $pdfs[0]['file']; ?>"
                        frameborder="0"></iframe>
                </div>
            </section>

            <!-- Contributors Page -->
            <section id="contributors" class="page">
                <h1 class="page-title">Közreműködők</h1>

                <div class="contributors-container">
                    <?php
                    // Sample contributor data - replace with your actual contributors
                    $contributors = [
                        [
                            'id' => 1,
                            'name' => 'Balog Bence',
                            'image' => 'balogbence.jpg',
                            'details' => 'A projekt során ő végezte el a teljes dokumentáció elkészítését, beleértve a Trello-t és Word-ben történő nyilvántartást és tervezést. Emellett felelt a projektvideó készítéséért, amely bemutatta a projekt fontosabb lépéseit és eredményeit. A költségvetés kezelése is az ő feladata volt, biztosítva, hogy minden költség a tervezett kereteken belül maradjon. A Windows szerver beállításai és karbantartása szintén az ő irányítása alatt zajlott. Továbbá folyamatosan ötletekkel és megoldásokkal támogatta a csapatot, és segítséget nyújtott más területeken is, amikor szükség volt rá.'
                        ],
                        [
                            'id' => 2,
                            'name' => 'Nagy Zsombor',
                            'image' => 'nagyzsombor.jpg',
                            'details' => 'A projekt során ő volt felelős a Packet Tracer eszközeinek konfigurálásáért, valamint a hálózati topológia megtervezéséért, amely biztosította, hogy a rendszer minden eleme hatékonyan és zökkenőmentesen működjön együtt. A tervezést követően a fizikai megvalósítást is ő végezte el, felügyelve az összes eszköz megfelelő telepítését és beállítását. Emellett folyamatosan aktívan hozzájárult ötletekkel a csapat munkájához, és készséggel segített más területeken is, amivel segítette a  projekt nagy mértékben való előrehaladását.'
                        ],
                        [
                            'id' => 3,
                            'name' => 'Tamás Bálint',
                            'image' => 'tamasbalint.jpg',
                            'details' => 'A projekt során ő volt felelős a teljes weboldalak tervezéséért és fejlesztéséért, beleértve a felhasználói felület kialakítását és a funkcionalitás megvalósítását. Emellett a Linux szerver beállításait és karbantartását is ő végezte, biztosítva a rendszerek stabil és biztonságos működését. Továbbá folyamatosan hozzájárult ötletekkel a csapat munkájához, és készséggel nyújtott támogatást más területeken is, amivel a projekt gördülékeny előrehaladását segítette.'
                        ]
                    ];

                    // Generate contributor cards
                    foreach ($contributors as $contributor) {
                        echo '<div class="contributor-card" data-id="' . $contributor['id'] . '">';
                        echo '<div class="contributor-image-container">';
                        echo '<img src="' . $contributor['image'] . '" alt="' . $contributor['name'] . '" class="contributor-image">';
                        echo '</div>';
                        echo '<h3 class="contributor-name">' . $contributor['name'] . '</h3>';
                        echo '</div>';
                    }
                    ?>
                </div>

                <!-- Contributor Details Section -->
                <div class="contributor-details-container" id="contributorDetails">
                    <div class="contributor-details-header">
                        <img src="/placeholder.svg" alt="" class="contributor-details-image"
                            id="contributorDetailsImage">
                        <h2 class="contributor-details-name" id="contributorDetailsName"></h2>
                    </div>
                    <div class="contributor-details-content" id="contributorDetailsContent">
                        <span id="typedText"></span><span class="cursor"></span>
                    </div>
                </div>
            </section>
            
            <!-- Presentation Page -->
            <section id="presentation" class="page">
                <h1 class="page-title">Prezentáció</h1>
                <!-- Enhanced Detailed Project Timeline Section -->
                <div class="presentation-timeline enhanced-timeline">
                    <div class="timeline-header">
                        <div class="timeline-header-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="gantt-icon"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line><line x1="7" y1="14" x2="12" y2="14"></line><line x1="7" y1="18" x2="16" y2="18"></line></svg>
                        </div>
                        <h3 class="timeline-title">Részletes Projekt Időrend</h3>
                    </div>
                    
                    <div class="timeline-tabs">
                        <button class="timeline-tab active" data-tab="gantt">Gantt Diagram</button>
                        <button class="timeline-tab" data-tab="milestones">Mérföldkövek</button>
                        <button class="timeline-tab" data-tab="resources">Linkek</button>
                    </div>
                    
                    <div class="timeline-content-container">
                        <!-- Gantt Chart Tab -->
                        <div class="timeline-tab-content active" id="gantt-tab">
                            <div class="enhanced-gantt-chart">
                                <div class="gantt-legend">
                                    <div class="legend-item">
                                        <span class="legend-color" style="background: linear-gradient(90deg, #00ffff, #0088ff);"></span>
                                        <span class="legend-text">Normál feladat</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-color" style="background: linear-gradient(90deg, #ff00ff, #ff0088);"></span>
                                        <span class="legend-text">Kiemelt feladat</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-color milestone"></span>
                                        <span class="legend-text">Mérföldkő</span>
                                    </div>
                                </div>
                                
                                <div class="gantt-timeline">            
                                    <div class="gantt-grid">
                                    <div class="gantt-row">
                                            <div class="gantt-row-label">
                                                <span class="task-name"></span>
                                                <span class="task-date"></span>
                                            </div>
                                            <div class="gantt-row-bars">
                                            </div>
                                    </div>
                                        <div class="gantt-row">
                                            <div class="gantt-row-label">
                                                <span class="task-name">Projekt Indítása</span>
                                                <span class="task-date">2024.12.25 - 2025.01.06</span>
                                            </div>
                                            <div class="gantt-row-bars">
                                                <div class="gantt-bar" style="width: 15%; left: 0%;">
                                                    <div class="gantt-bar-label">12</div>
                                                    <div class="gantt-tooltip">
                                                        <div class="tooltip-title">Projekt Indítása</div>
                                                        <div class="tooltip-dates">2024.12.25 - 2025.01.06</div>
                                                        <div class="tooltip-desc">Csapat összeszervezése, kezdeti tervezés</div>
                                                    </div>
                                                </div>
                                                <div class="gantt-milestone" style="left: 15%;" title="A kezdetek"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="gantt-row">
                                            <div class="gantt-row-label">
                                                <span class="task-name">Tervezési Fázis</span>
                                                <span class="task-date">2025.01.06 - 2025.01.17</span>
                                            </div>
                                            <div class="gantt-row-bars">
                                                <div class="gantt-bar" style="width: 20%; left: 15%;">
                                                    <div class="gantt-bar-label">11 nap</div>
                                                    <div class="gantt-tooltip">
                                                        <div class="tooltip-title">Tervezési Fázis</div>
                                                        <div class="tooltip-dates">2025.01.06 - 2025.01.17</div>
                                                        <div class="tooltip-desc">Követelmények meghatározása, architektúra tervezése | kivitelezése</div>
                                                    </div>
                                                </div>
                                                <div class="gantt-milestone" style="left: 35%;" title="Tervek elfogadva | Projekt vizsga elkezdése"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="gantt-row">
                                            <div class="gantt-row-label">
                                                <span class="task-name">Fejlesztési fázis</span>
                                                <span class="task-date">2025.01.18 - 2025.03.31</span>
                                            </div>
                                            <div class="gantt-row-bars">
                                                <div class="gantt-bar" style="width: 25%; left: 35%;">
                                                    <div class="gantt-bar-label">73 nap</div>
                                                    <div class="gantt-tooltip">
                                                        <div class="tooltip-title">Fejlesztés Kezdete</div>
                                                        <div class="tooltip-dates">2025.01.18 - 2025.03.31</div>
                                                        <div class="tooltip-desc">Teljes architektúra kiépítése</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="gantt-row">
                                            <div class="gantt-row-label">
                                                <span class="task-name">Tesztelés</span>
                                                <span class="task-date">2025.04.01 - 2025.04.07</span>
                                            </div>
                                            <div class="gantt-row-bars">
                                                <div class="gantt-bar" style="width: 15%; left: 60%;">
                                                    <div class="gantt-bar-label">6 nap</div>
                                                    <div class="gantt-tooltip">
                                                        <div class="tooltip-title">Tesztelés</div>
                                                        <div class="tooltip-dates">2025.04.01 - 2025.04.07</div>
                                                        <div class="tooltip-desc">Rendszer tesztelése, hibák javítása</div>
                                                    </div>
                                                </div>
                                                <div class="gantt-milestone" style="left: 75%;" title="Tesztelés befejezve"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="gantt-row">
                                            <div class="gantt-row-label">
                                                <span class="task-name">Projekt Lezárása</span>
                                                <span class="task-date">2025.04.07 - 2025.05.08</span>
                                            </div>
                                            <div class="gantt-row-bars">
                                                <div class="gantt-bar highlight-bar" style="width: 25%; left: 75%;">
                                                    <div class="gantt-bar-label">32 nap</div>
                                                    <div class="gantt-tooltip">
                                                        <div class="tooltip-title">Projekt Lezárása</div>
                                                        <div class="tooltip-dates">2025.04.07 - 2025.05.08</div>
                                                        <div class="tooltip-desc">Dokumentáció véglegesítése, projekt átadása</div>
                                                    </div>
                                                </div>
                                                <div class="gantt-milestone final" style="left: 100%;" title="Projekt átadva"></div>
                                            </div>
                                        </div>
                                        <div class="gantt-row">
                                            <div class="gantt-row-label">
                                                <span class="task-name"></span>
                                                <span class="task-date"></span>
                                            </div>
                                            <div class="gantt-row-bars">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="gantt-controls">
                                    <button class="gantt-zoom-btn" data-zoom="in">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                                    </button>
                                    <button class="gantt-zoom-btn" data-zoom="out">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Milestones Tab -->
                        <div class="timeline-tab-content" id="milestones-tab">
                            <div class="milestones-container">
                                <div class="milestone-card">
                                    <div class="milestone-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>
                                    </div>
                                    <div class="milestone-date">2024.11.01</div>
                                    <h4 class="milestone-title">Csapat kialakítva</h4>
                                    <p class="milestone-desc">A projekt csapat összeállítása és a szerepkörök kiosztása megtörtént.</p>
                                </div>
                                
                                <div class="milestone-card">
                                    <div class="milestone-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                    </div>
                                    <div class="milestone-date">2025.01.17</div>
                                    <h4 class="milestone-title">Tervek elfogadva</h4>
                                    <p class="milestone-desc">A projekt tervek és követelmények elfogadásra kerültek, a fejlesztés kezdődhet.</p>
                                </div>
                                
                                <div class="milestone-card">
                                    <div class="milestone-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                    </div>
                                    <div class="milestone-date">2024.01.15</div>
                                    <h4 class="milestone-title">Tesztelés befejezve</h4>
                                    <p class="milestone-desc">A rendszer tesztelése sikeresen lezárult, a kritikus hibák javításra kerültek.</p>
                                </div>
                                
                                <div class="milestone-card highlight">
                                    <div class="milestone-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                    </div>
                                    <div class="milestone-date">2024.03.15</div>
                                    <h4 class="milestone-title">Projekt átadva</h4>
                                    <p class="milestone-desc">A projekt sikeresen lezárult, a teljes dokumentáció és a rendszer átadásra került.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- LINKS TAB -->
                        <div class="timeline-tab-content" id="resources-tab">
                            <div class="resources-container">
                                <div class="resource-section">
                                    <h3 class="resource-section-title">Dokumentáció</h3>
                                    <div class="resource-cards">
                                        <div class="resource-card">
                                            <div class="resource-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                            </div>
                                            <h4 class="resource-title">GitHub Repository</h4>
                                            <a href="https://github.com/tmsblnt/vizsgaremek" class="website-link" target="_blank">Megtekintés</a>
                                        </div>
                                        <div class="resource-card">
                                            <div class="resource-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 16.1A5 5 0 0 1 5.9 20M2 12.05A9 9 0 0 1 9.95 20M2 8V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-6"></path><line x1="2" y1="20" x2="2" y2="20"></line></svg>
                                            </div>
                                            <h4 class="resource-title">Trello Projekt</h4>
                                            <a href="https://trello.com/b/YBd2c0NP" class="website-link" target="_blank">Megtekintés</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="resource-section">
                                    <h3 class="resource-section-title">Topológia Források</h3>
                                    <div class="resource-cards">
                                        <div class="resource-card">
                                            <div class="resource-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                            </div>
                                            <h4 class="resource-title">Netacad</h4>
                                            <a href="https://www.netacad.com/" class="website-link" target="_blank">Megtekintés</a>
                                        </div>
                                        <div class="resource-card">
                                            <div class="resource-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                            </div>
                                            <h4 class="resource-title">Szabad Információs Társadalom</h4>
                                            <a href="https://szit.hu/doku.php?id=oktatas:halozat" class="website-link" target="_blank">Megtekintés</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        // DOM Elements
        const menuToggle = document.getElementById('menuToggle');
        const navbar = document.getElementById('navbar');
        const navLinks = document.querySelectorAll('.nav-link');
        const pages = document.querySelectorAll('.page');
        const pdfOptions = document.querySelectorAll('.pdf-option');
        const pdfViewer = document.getElementById('pdfViewer');
        const neonGlow = document.getElementById('neonGlow');
        const contributorCards = document.querySelectorAll('.contributor-card');
        const contributorDetails = document.getElementById('contributorDetails');
        const contributorDetailsImage = document.getElementById('contributorDetailsImage');
        const contributorDetailsName = document.getElementById('contributorDetailsName');
        const typedText = document.getElementById('typedText');

        // Terminal elements
        const linuxTerminalContent = document.getElementById('linuxTerminalContent');
        const windowsTerminalContent = document.getElementById('windowsTerminalContent');

        // PPT elements
        const pptUploadArea = document.getElementById('pptUploadArea');
        const pptViewer = document.getElementById('pptViewer');
        const pptFrame = document.getElementById('pptFrame');
        const pptFileInput = document.getElementById('pptFileInput');
        const browseButton = document.getElementById('browseButton');
        const prevSlideBtn = document.getElementById('prevSlideBtn');
        const nextSlideBtn = document.getElementById('nextSlideBtn');
        const playPauseBtn = document.getElementById('playPauseBtn');
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        const downloadBtn = document.getElementById('downloadBtn');
        const progressBar = document.getElementById('progressBar');
        const slideThumbnails = document.getElementById('slideThumbnails');
        const currentSlideEl = document.getElementById('currentSlide');
        const totalSlidesEl = document.getElementById('totalSlides');

        // Timeline tabs
        const timelineTabs = document.querySelectorAll('.timeline-tab');
        const timelineContents = document.querySelectorAll('.timeline-tab-content');

        // Default terminal content
        const defaultLinuxContent = `<div class="terminal-prompt">
    <span class="terminal-user">user</span>
    <span class="terminal-at">@</span>
    <span class="terminal-machine">ubuntu-server</span>
    <span class="terminal-path">~</span>
    <span class="terminal-dollar">$</span>
    <span class="terminal-command">WEBSZERVER KONFIGURÁCIÓ</span>
</div>
<div class="terminal-output">
<ul>
<li>sudo apt install apache2</li>
<li>sudo apt install php</li>
<li>sudo apt install mariadb-server</li>
<li>sudo mysql_secure_installation</li>
<li>sudo apt install certbot python3-certbot-apache #HTTPS</li>
<li>sudo certbot --apache</li>
<li>sudo systemctl reload apache2</li>
</ul>
</div>
<div class="terminal-prompt">
    <span class="terminal-user">user</span>
    <span class="terminal-at">@</span>
    <span class="terminal-machine">ubuntu-server</span>
    <span class="terminal-path">~</span>
    <span class="terminal-dollar">$</span>
    <span class="terminal-command">File Megosztás (Samba/Webdav)</span>
</div>
<div class="terminal-output">
<h3>Samba</h3>
<ul>
<li>sudo apt install samba</li>
<li>mkdir /home/pi/Desktop/megoszt</li>
<li>sudo chmod 777 /home/pi/Desktop/megoszt</li>
</ul>
<ul>
<li>sudo apt install samba</li>
<li>mkdir /home/pi/Desktop/megoszt</li>
<li>sudo chmod 777 /home/pi/Desktop/megoszt</li>
</ul>
<h3>Webdav</h3>
<ul>
<li>sudo a2enmod dav</li>
<li>sudo a2enmod dav_fs</li>
<li>sudo a2enmod dav_lock</li>
<li>sudo a2enmod auth_digest</li>
<li>sudo service apache2 restart</li>
<li>sudo chown www-data:www-data /home/pi/Desktop/megoszt</li>
<li>sudo mkdir -p /usr/local/apache/var/</li>
<li>sudo chown www-data:www-data /usr/local/apache/var</li>
</ul>
<h3>Backup-manager</h3>
<ul>
<li>sudo apt install backup-manager</li>
<h5>telepítés után a /etc/backup-manager.conf config fájl</h5>
<li>export BM_REPOSITORY_USER="pi"</li>
<li>export BM_REPOSITORY_GROUP="pi"</li>
<li>export BM_REPOSITORY_CHMOD="777"</li>
<li>export BM_ARCHIVE_METHOD="tarball" átirnni: "tarball-incremental"</li>
<li>export BM_UPLOAD_METHOD="scp"    átírni: "none"</li>
<li>export BM_BURNING_METHOD="CDRW"  árírni: "none"</li>
</ul>
<h3>Időzítő beállítása (Crontab)</h3>
<ul>
<li>crontab -e</li>
<li>*/2 * * * * mentes.sh #két percenként menti</li>
</ul>
<h5>mentes.sh</h5>
<p>#!/bin/bash<br>
sudo /usr/sbin/backup-manager
</p>
<li>sudo chmod 777 mentes.sh</li>
<li>sudo chmod +x mentes.sh</li>
</div>`;

        const defaultWindowsContent = `<div class="terminal-prompt">
    <span class="terminal-path">C:\\Users\\Administrator></span>
    <span class="terminal-command">Active Directory</span>
</div>
<div class="terminal-output">
<ol>
<li>Server Roles => Active Directory Domain Services</li>
<li>Deployment Configuration => Root domain name: umszkikresz.local</li>
<li>Domain Controller Options => Jelszó állítás</li>
<li>Additional Options => NetBIOS domain name: UMSZKIKRESZ</li>
</ol>
</div>`;

        // Track current typewriter timeout
        let typewriterTimeout = null;
        
        // PPT variables
        let currentSlide = 1;
        let totalSlides = 5; // Default value, will be updated when PPT is loaded
        let isPlaying = false;
        let isFullscreen = false;
        let playInterval;
        let pptLoaded = false;

        // Get contributor data from PHP
        const contributorData = <?php echo json_encode($contributors); ?>;

        // Load terminal content from localStorage or use defaults
        function loadTerminalContent() {
            // Load Linux terminal content
            const savedLinuxContent = localStorage.getItem('linuxTerminalContent');
            if (savedLinuxContent) {
                linuxTerminalContent.innerHTML = savedLinuxContent;
            } else {
                linuxTerminalContent.innerHTML = defaultLinuxContent;
            }

            // Load Windows terminal content
            const savedWindowsContent = localStorage.getItem('windowsTerminalContent');
            if (savedWindowsContent) {
                windowsTerminalContent.innerHTML = savedWindowsContent;
            } else {
                windowsTerminalContent.innerHTML = defaultWindowsContent;
            }
        }

        // Mobile Menu Toggle
        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            navbar.classList.toggle('active');
        });

        // Navigation
        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();

                // Update active nav link
                navLinks.forEach(item => item.classList.remove('active'));
                link.classList.add('active');

                // Show corresponding page
                const pageId = link.getAttribute('data-page');
                pages.forEach(page => page.classList.remove('active'));
                document.getElementById(pageId).classList.add('active');

                // Close mobile menu if open
                if (window.innerWidth <= 992) {
                    menuToggle.classList.remove('active');
                    navbar.classList.remove('active');
                }

                // Add page transition effect
                window.scrollTo(0, 0);
                createParticles(50);

                // Hide contributor details if navigating away
                if (pageId !== 'contributors') {
                    contributorDetails.classList.remove('active');
                }
                
                // If navigating to presentation, initialize it
                if (pageId === 'presentation') {
                    initPresentation();
                }
            });
        });

        // PDF Selector
        pdfOptions.forEach(option => {
            option.addEventListener('click', () => {
                // Update active option
                pdfOptions.forEach(item => item.classList.remove('active'));
                option.classList.add('active');

                // Update PDF viewer
                const pdfFile = option.getAttribute('data-pdf');
                pdfViewer.src = pdfFile;

                // Add click effect
                createParticles(20, option);
            });
        });

        // Contributor Cards Click
        contributorCards.forEach(card => {
            card.addEventListener('click', () => {
                const contributorId = parseInt(card.getAttribute('data-id'));

                // Update active card
                contributorCards.forEach(c => c.classList.remove('active'));
                card.classList.add('active');

                // Find contributor data
                const contributor = contributorData.find(c => c.id === contributorId);

                if (contributor) {
                    // Update details header
                    contributorDetailsImage.src = contributor.image;
                    contributorDetailsImage.alt = contributor.name;
                    contributorDetailsName.textContent = contributor.name;

                    // Show details container (even if it's already visible)
                    contributorDetails.classList.add('active');

                    // Typewriter effect - will interrupt any ongoing animation
                    typeWriterEffect(contributor.details);

                    // Scroll to details
                    setTimeout(() => {
                        contributorDetails.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }, 300);

                    // Add click effect
                    createParticles(30, card);
                }
            });
        });

        // Typewriter effect function with interrupt capability
        function typeWriterEffect(text) {
            // Clear any existing animation
            if (typewriterTimeout) {
                clearTimeout(typewriterTimeout);
                typewriterTimeout = null;
            }

            // Clear any existing text
            typedText.textContent = '';
            let i = 0;
            const speed = 30; // typing speed in milliseconds

            function type() {
                if (i < text.length) {
                    typedText.textContent += text.charAt(i);
                    i++;
                    typewriterTimeout = setTimeout(type, speed);
                } else {
                    // Animation complete, clear the timeout reference
                    typewriterTimeout = null;
                }
            }

            // Start typing
            type();
        }
        
        // Terminal functions
        function openTerminal(terminalId) {
            const terminal = document.getElementById(terminalId);
            terminal.classList.add('active');
            createParticles(30);
        }

        function closeTerminal(terminalId) {
            const terminal = document.getElementById(terminalId);
            terminal.classList.remove('active');
        }
        
        // PPT functions
        function initPresentation() {
            // Initialize PPT upload functionality
            browseButton.addEventListener('click', () => {
                pptFileInput.click();
            });
            
            pptFileInput.addEventListener('change', handlePPTUpload);
            
            // Setup drag and drop for PPT upload
            pptUploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                pptUploadArea.classList.add('drag-over');
            });
            
            pptUploadArea.addEventListener('dragleave', () => {
                pptUploadArea.classList.remove('drag-over');
            });
            
            pptUploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                pptUploadArea.classList.remove('drag-over');
                
                if (e.dataTransfer.files.length) {
                    pptFileInput.files = e.dataTransfer.files;
                    handlePPTUpload();
                }
            });
            
            // Add event listeners for PPT controls
            prevSlideBtn.addEventListener('click', prevSlide);
            nextSlideBtn.addEventListener('click', nextSlide);
            playPauseBtn.addEventListener('click', togglePlayPause);
            fullscreenBtn.addEventListener('click', toggleFullscreen);
            
            // Add keyboard navigation
            document.addEventListener('keydown', handleKeyboardNavigation);
            
            // Initialize timeline tabs
            timelineTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const tabId = tab.getAttribute('data-tab');
                    
                    // Update active tab
                    timelineTabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    
                    // Show corresponding content
                    timelineContents.forEach(content => {
                        content.classList.remove('active');
                        if (content.id === `${tabId}-tab`) {
                            content.classList.add('active');
                        }
                    });
                    
                    // Add click effect
                    createParticles(15, tab);
                });
            });
        }
        
        function handlePPTUpload() {
            const file = pptFileInput.files[0];
            if (file && (file.name.endsWith('.ppt') || file.name.endsWith('.pptx'))) {
                // For demonstration, we'll use Google Docs Viewer to display the PPT
                // In a real implementation, you might want to use a more robust solution
                const fileUrl = URL.createObjectURL(file);
                const googleDocsUrl = `https://docs.google.com/viewer?url=${encodeURIComponent(fileUrl)}&embedded=true`;
                
                pptFrame.src = googleDocsUrl;
                pptUploadArea.style.display = 'none';
                pptViewer.style.display = 'block';
                
                // Update download button
                downloadBtn.href = fileUrl;
                downloadBtn.download = file.name;
                
                // Generate slide thumbnails (this is a simplified version)
                generateSlideThumbnails(5); // Assuming 5 slides for demonstration
                
                // Update slide counter
                currentSlide = 1;
                totalSlides = 5; // This would be determined from the actual PPT in a real implementation
                updateSlideCounter();
                
                pptLoaded = true;
                
                // Add animation effect
                createParticles(30);
            } else {
                alert('Kérjük, válasszon egy érvényes PowerPoint fájlt (.ppt vagy .pptx)');
            }
        }
        
        function generateSlideThumbnails(count) {
            slideThumbnails.innerHTML = '';
            
            for (let i = 1; i <= count; i++) {
                const thumbnail = document.createElement('div');
                thumbnail.className = 'slide-thumbnail';
                if (i === 1) thumbnail.classList.add('active');
                thumbnail.setAttribute('data-slide', i);
                
                const thumbnailNumber = document.createElement('span');
                thumbnailNumber.className = 'thumbnail-number';
                thumbnailNumber.textContent = i;
                
                thumbnail.appendChild(thumbnailNumber);
                slideThumbnails.appendChild(thumbnail);
                
                thumbnail.addEventListener('click', () => {
                    goToSlide(i);
                });
            }
        }
        
        function goToSlide(slideNumber) {
            if (!pptLoaded) return;
            
            // In a real implementation, you would communicate with the embedded PPT viewer
            // to navigate to the specific slide. This is a simplified version.
            currentSlide = slideNumber;
            
            // Update thumbnails
            const thumbnails = document.querySelectorAll('.slide-thumbnail');
            thumbnails.forEach(thumbnail => {
                thumbnail.classList.remove('active');
                if (parseInt(thumbnail.getAttribute('data-slide')) === slideNumber) {
                    thumbnail.classList.add('active');
                }
            });
            
            // Update button states
            prevSlideBtn.disabled = currentSlide === 1;
            nextSlideBtn.disabled = currentSlide === totalSlides;
            
            // Update progress bar
            updateProgressBar();
            
            // Update slide counter
            updateSlideCounter();
            
            // Add animation effect
            createParticles(20);
        }
        
        function prevSlide() {
            if (currentSlide > 1) {
                goToSlide(currentSlide - 1);
            }
        }
        
        function nextSlide() {
            if (currentSlide < totalSlides) {
                goToSlide(currentSlide + 1);
            }
        }
        
        function togglePlayPause() {
            if (!pptLoaded) return;
            
            isPlaying = !isPlaying;
            const playIcon = playPauseBtn.querySelector('.play-icon');
            const pauseIcon = playPauseBtn.querySelector('.pause-icon');
            
            if (isPlaying) {
                playIcon.style.display = 'none';
                pauseIcon.style.display = 'block';
                
                playInterval = setInterval(() => {
                    if (currentSlide < totalSlides) {
                        nextSlide();
                    } else {
                        togglePlayPause(); // Stop when reaching the end
                    }
                }, 5000);
            } else {
                playIcon.style.display = 'block';
                pauseIcon.style.display = 'none';
                
                clearInterval(playInterval);
            }
        }
        
        function toggleFullscreen() {
            const pptContainer = document.querySelector('.ppt-container');
            const fullscreenIcon = fullscreenBtn.querySelector('.fullscreen-icon');
            const minimizeIcon = fullscreenBtn.querySelector('.minimize-icon');
            
            if (!isFullscreen) {
                if (pptContainer.requestFullscreen) {
                    pptContainer.requestFullscreen();
                } else if (pptContainer.mozRequestFullScreen) {
                    pptContainer.mozRequestFullScreen();
                } else if (pptContainer.webkitRequestFullscreen) {
                    pptContainer.webkitRequestFullscreen();
                } else if (pptContainer.msRequestFullscreen) {
                    pptContainer.msRequestFullscreen();
                }
                
                fullscreenIcon.style.display = 'none';
                minimizeIcon.style.display = 'block';
                isFullscreen = true;
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
                
                fullscreenIcon.style.display = 'block';
                minimizeIcon.style.display = 'none';
                isFullscreen = false;
            }
        }
        
        function updateProgressBar() {
            const progress = (currentSlide / totalSlides) * 100;
            progressBar.style.width = `${progress}%`;
        }
        
        function updateSlideCounter() {
            currentSlideEl.textContent = currentSlide;
            totalSlidesEl.textContent = totalSlides;
        }
        
        function handleKeyboardNavigation(e) {
            // Only handle keyboard navigation when on presentation page
            const presentationPage = document.getElementById('presentation');
            if (!presentationPage.classList.contains('active')) {
                return;
            }
            
            if (e.key === 'ArrowRight' || e.key === ' ') {
                nextSlide();
            } else if (e.key === 'ArrowLeft') {
                prevSlide();
            } else if (e.key === 'f' || e.key === 'F') {
                toggleFullscreen();
            }
        }
        
        // Handle fullscreen change
        document.addEventListener('fullscreenchange', handleFullscreenChange);
        document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
        document.addEventListener('mozfullscreenchange', handleFullscreenChange);
        document.addEventListener('MSFullscreenChange', handleFullscreenChange);
        
        function handleFullscreenChange() {
            const fullscreenIcon = fullscreenBtn.querySelector('.fullscreen-icon');
            const minimizeIcon = fullscreenBtn.querySelector('.minimize-icon');
            
            if (
                document.fullscreenElement ||
                document.webkitFullscreenElement ||
                document.mozFullScreenElement ||
                document.msFullscreenElement
            ) {
                fullscreenIcon.style.display = 'none';
                minimizeIcon.style.display = 'block';
                isFullscreen = true;
            } else {
                fullscreenIcon.style.display = 'block';
                minimizeIcon.style.display = 'none';
                isFullscreen = false;
            }
        }

        // Timeline tabs functionality
        timelineTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const tabId = tab.getAttribute('data-tab');
                
                // Update active tab
                timelineTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                
                // Show corresponding content
                timelineContents.forEach(content => {
                    content.classList.remove('active');
                    if (content.id === `${tabId}-tab`) {
                        content.classList.add('active');
                    }
                });
                
                // Add click effect
                createParticles(15, tab);
            });
        });
        
        // Gantt chart zoom functionality
        const zoomButtons = document.querySelectorAll('.gantt-zoom-btn');
        let zoomLevel = 100;
        
        zoomButtons.forEach(button => {
            button.addEventListener('click', () => {
                const zoomType = button.getAttribute('data-zoom');
                const ganttGrid = document.querySelector('.gantt-grid');
                
                if (zoomType === 'in' && zoomLevel < 200) {
                    zoomLevel += 20;
                } else if (zoomType === 'out' && zoomLevel > 60) {
                    zoomLevel -= 20;
                }
                
                ganttGrid.style.width = `${zoomLevel}%`;
                createParticles(10, button);
            });
        });

        // Create stars with enhanced movement
        function createStar() {
            const universe = document.getElementById("universe");
            const star = document.createElement("div");
            star.classList.add("star");

            // Random position
            const x = Math.random() * 100;
            const y = Math.random() * 100;
            star.style.left = `${x}%`;
            star.style.top = `${y}%`;

            // Random movement direction
            const moveX = (Math.random() - 0.5) * 200;
            const moveY = (Math.random() - 0.5) * 200;
            star.style.setProperty('--moveX', `${moveX}px`);
            star.style.setProperty('--moveY', `${moveY}px`);

            // Random animation duration
            const duration = Math.random() * 20 + 10;
            star.style.animation = `starMovement ${duration}s linear infinite`;

            // Vary star sizes
            const size = Math.random() * 3 + 1;
            star.style.width = `${size}px`;
            star.style.height = `${size}px`;

            // Add twinkle effect to some stars
            if (Math.random() > 0.7) {
                star.style.animation += `, twinkle ${Math.random() * 3 + 1}s ease-in-out infinite alternate`;
            }

            universe.appendChild(star);
        }

        // Create shooting stars
        function createShootingStar() {
            const universe = document.getElementById("universe");
            const shootingStar = document.createElement("div");
            shootingStar.classList.add("shooting-star");

            // Random start position (usually from top or sides)
            const startX = Math.random() * window.innerWidth;
            const startY = Math.random() * (window.innerHeight / 3);

            // Random end position (usually towards bottom)
            const endX = startX + (Math.random() - 0.5) * window.innerWidth;
            const endY = startY + window.innerHeight * (0.5 + Math.random() * 0.5);

            // Set CSS variables for animation
            shootingStar.style.setProperty('--startX', `${startX}px`);
            shootingStar.style.setProperty('--startY', `${startY}px`);
            shootingStar.style.setProperty('--endX', `${endX}px`);
            shootingStar.style.setProperty('--endY', `${endY}px`);
            shootingStar.style.setProperty('--angle', `${Math.atan2(endY - startY, endX - startX)}rad`);

            // Animation duration
            const duration = Math.random() * 2 + 1;
            shootingStar.style.animation = `shootingStar ${duration}s linear forwards`;

            universe.appendChild(shootingStar);

            // Remove after animation completes
            setTimeout(() => {
                shootingStar.remove();
            }, duration * 1000);
        }

        function createStars(count) {
            for (let i = 0; i < count; i++) {
                createStar();
            }
        }

        function adjustStarCount() {
            const width = window.innerWidth;
            const height = window.innerHeight;
            const area = width * height;
            const starCount = Math.floor(area / 3000); // Adjust star density

            // Clear existing stars
            const universe = document.getElementById("universe");
            universe.innerHTML = ''; // This is the fix for the background issue

            createStars(starCount);
        }

        // Schedule shooting stars
        function scheduleShootingStars() {
            setInterval(() => {
                if (Math.random() > 0.5) {
                    createShootingStar();
                }
            }, Math.random() * 5000 + 3000);
        }

        // Create particle effect
        function createParticles(count, sourceElement = null) {
            let x, y;

            if (sourceElement) {
                const rect = sourceElement.getBoundingClientRect();
                x = rect.left + rect.width / 2;
                y = rect.top + rect.height / 2;
            } else {
                x = window.innerWidth / 2;
                y = window.innerHeight / 2;
            }

            for (let i = 0; i < count; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Random position around the source
                const angle = Math.random() * Math.PI * 2;
                const distance = Math.random() * 100;
                const particleX = x + Math.cos(angle) * distance;
                const particleY = y + Math.sin(angle) * distance;

                particle.style.left = `${particleX}px`;
                particle.style.top = `${particleY}px`;

                // Random color variations
                const hue = Math.random() > 0.5 ? '180' : '300'; // Cyan or magenta
                particle.style.backgroundColor = `hsla(${hue}, 100%, 70%, ${Math.random() * 0.5 + 0.5})`;

                document.body.appendChild(particle);

                // Remove particle after animation
                setTimeout(() => {
                    particle.remove();
                }, 1500);
            }
        }
        
        // Add click effects
        document.addEventListener('click', (e) => {
            createParticles(15, { getBoundingClientRect: () => ({ left: e.clientX, top: e.clientY, width: 0, height: 0 }) });
        });

        // Initialize cosmic background
        window.addEventListener("load", function () {
            // Load terminal content
            loadTerminalContent();

            adjustStarCount();
            scheduleShootingStars();

            // Start with a few shooting stars
            for (let i = 0; i < 3; i++) {
                setTimeout(() => {
                    createShootingStar();
                }, i * 1000);
            }

            // Initial particle burst
            createParticles(100);
            
            // Initialize presentation if we're on that page
            if (document.getElementById('presentation').classList.contains('active')) {
                initPresentation();
            }
            
            // Initialize Gantt chart tooltips with improved positioning
            const ganttBars = document.querySelectorAll('.gantt-bar');
            ganttBars.forEach(bar => {
                bar.addEventListener('mouseenter', function() {
                    const tooltip = this.querySelector('.gantt-tooltip');
                    if (tooltip) {
                        // Check if this is the first bar (Start Project)
                        const isFirstBar = this.style.left === '0%';
                        
                        if (isFirstBar) {
                            // Adjust tooltip position for the first bar to prevent cutoff
                            tooltip.style.left = '0';
                            tooltip.style.transform = 'translateX(0)';
                        } else {
                            // Reset to default positioning for other bars
                            tooltip.style.left = '50%';
                            tooltip.style.transform = 'translateX(-50%)';
                        }
                        
                        tooltip.style.opacity = '1';
                        tooltip.style.visibility = 'visible';
                    }
                });
                
                bar.addEventListener('mouseleave', function() {
                    const tooltip = this.querySelector('.gantt-tooltip');
                    if (tooltip) {
                        tooltip.style.opacity = '0';
                        tooltip.style.visibility = 'hidden';
                    }
                });
            });
            
            // Initialize milestone tooltips
            const milestones = document.querySelectorAll('.gantt-milestone');
            milestones.forEach(milestone => {
                const title = milestone.getAttribute('title');
                if (title) {
                    milestone.addEventListener('mouseenter', function() {
                        const tooltip = document.createElement('div');
                        tooltip.classList.add('milestone-tooltip');
                        tooltip.textContent = title;
                        this.appendChild(tooltip);
                    });
                    
                    milestone.addEventListener('mouseleave', function() {
                        const tooltip = this.querySelector('.milestone-tooltip');
                        if (tooltip) {
                            tooltip.remove();
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>

