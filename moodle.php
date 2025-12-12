<?php
session_start();

// Пәндердің тізімі
$subjects = [
    'db' => [
        'id' => 'db',
        'name' => 'Деректер қоры жүйелерін құру',
        'code' => 'CS-401',
        'teacher' => 'Айгүл М.',
        'description' => 'Реляциялық деректер қорлары, SQL тілі, қауіпсіздік',
        'time_limit' => 20, // минут
        'total_questions' => 15,
        'total_score' => 25
    ],
    'cloud' => [
        'id' => 'cloud',
        'name' => 'Бұлттық есептеулерге кіріспе',
        'code' => 'CS-402',
        'teacher' => 'Нұрлан С.',
        'description' => 'Бұлттық архитектуралар, сервистер, қауіпсіздік',
        'time_limit' => 15,
        'total_questions' => 12,
        'total_score' => 20
    ],
    'python' => [
        'id' => 'python',
        'name' => 'Python-да бағдарламалау',
        'code' => 'CS-403',
        'teacher' => 'Марат Ж.',
        'description' => 'Python негіздері, алгоритмдер, кітапханалар',
        'time_limit' => 25,
        'total_questions' => 20,
        'total_score' => 30
    ],
    'parallel' => [
        'id' => 'parallel',
        'name' => 'Параллельді есептеулер',
        'code' => 'CS-404',
        'teacher' => 'Асхат К.',
        'description' => 'Параллель алгоритмдер, потоктар, синхронизация',
        'time_limit' => 30,
        'total_questions' => 18,
        'total_score' => 35
    ],
    'networks' => [
        'id' => 'networks',
        'name' => 'Компьютерлік желілер',
        'code' => 'CS-405',
        'teacher' => 'Гүлнар А.',
        'description' => 'Желі архитектурасы, протоколдар, қауіпсіздік',
        'time_limit' => 18,
        'total_questions' => 14,
        'total_score' => 22
    ],
    'methods' => [
        'id' => 'methods',
        'name' => 'Есептеу әдістері',
        'code' => 'CS-406',
        'teacher' => 'Бауыржан Т.',
        'description' => 'Сандық әдістер, алгоритмдер, оптимизация',
        'time_limit' => 22,
        'total_questions' => 16,
        'total_score' => 28
    ]
];

// Егер тест ID берілсе
$testId = isset($_GET['test']) ? $_GET['test'] : null;
$subjectId = isset($_GET['subject']) ? $_GET['subject'] : null;
$currentSubject = $subjectId && isset($subjects[$subjectId]) ? $subjects[$subjectId] : null;

// Тест сұрақтары (мысал үшін)
$testQuestions = [
    'db' => [
        [
            'id' => 1,
            'question' => 'Реляциялық деректер қоры дегеніміз не?',
            'options' => [
                'a' => 'Деректерді кесте түрінде ұйымдастыру',
                'b' => 'Деректерді график түрінде сақтау',
                'c' => 'Деректерді текст файлында сақтау',
                'd' => 'Деректерді Excel-де сақтау'
            ],
            'correct' => 'a',
            'score' => 2
        ],
        [
            'id' => 2,
            'question' => 'SQL сөзінің ашылуы қандай?',
            'options' => [
                'a' => 'Structured Query Language',
                'b' => 'Simple Question Language',
                'c' => 'System Query Logic',
                'd' => 'Standard Question Logic'
            ],
            'correct' => 'a',
            'score' => 1
        ],
        [
            'id' => 3,
            'question' => 'Қайсысы SQL командасы емес?',
            'options' => [
                'a' => 'SELECT',
                'b' => 'UPDATE',
                'c' => 'DELETE',
                'd' => 'PRINT'
            ],
            'correct' => 'd',
            'score' => 1
        ]
    ],
    'cloud' => [
        [
            'id' => 1,
            'question' => 'Бұлттық есептеулердің негізгі артықшылығы қандай?',
            'options' => [
                'a' => 'Төмен құны',
                'b' => 'Масштабтану мүмкіндігі',
                'c' => 'Екінші екеуі де',
                'd' => 'Ешқайсысы'
            ],
            'correct' => 'c',
            'score' => 2
        ],
        [
            'id' => 2,
            'question' => 'IaaS дегеніміз не?',
            'options' => [
                'a' => 'Инфрақұрылым ретіндегі сервис',
                'b' => 'Интернет ретіндегі сервис',
                'c' => 'Информация ретіндегі сервис',
                'd' => 'Интеграция ретіндегі сервис'
            ],
            'correct' => 'a',
            'score' => 1
        ]
    ]
];

// Тест нәтижелерін есептеу
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_test'])) {
    $subjectId = $_POST['subject_id'];
    $score = 0;
    $total = 0;
    $answers = [];
    
    if (isset($testQuestions[$subjectId])) {
        foreach ($testQuestions[$subjectId] as $question) {
            $qid = $question['id'];
            $total += $question['score'];
            
            if (isset($_POST['q'.$qid]) && $_POST['q'.$qid] === $question['correct']) {
                $score += $question['score'];
                $answers[$qid] = true;
            } else {
                $answers[$qid] = false;
            }
        }
    }
    
    $percentage = $total > 0 ? round(($score / $total) * 100, 2) : 0;
    
    // Нәтижені сессияға сақтау
    $_SESSION['test_result'] = [
        'subject_id' => $subjectId,
        'subject_name' => $subjects[$subjectId]['name'],
        'score' => $score,
        'total' => $total,
        'percentage' => $percentage,
        'answers' => $answers,
        'timestamp' => date('d.m.Y H:i:s')
    ];
    
    // Нәтиже бетіне бағыттау
    header('Location: moodle.php?result='.$subjectId);
    exit;
}

// Нәтижені көрсету
$showResult = isset($_GET['result']) && isset($_SESSION['test_result']);
$testResult = $showResult ? $_SESSION['test_result'] : null;

// Қолданушы аты
$currentUser = "Нұрлан С.";
?>

<!DOCTYPE html>
<html lang="kz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ДОЖ Moodle | UNIVER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --univer-blue: #003366;
            --univer-dark: #123456;
            --univer-light: #0056b3;
            --univer-accent: #e9f2ff;
            --moodle-purple: #9800ff;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .top-info-bar {
            background-color: var(--univer-dark);
            color: white;
            padding: 8px 0;
            font-size: 0.9rem;
        }
        
        .top-info-bar a {
            color: #a3d5ff;
            text-decoration: none;
        }
        
        .main-navbar {
            background-color: var(--univer-blue);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }
        
        .navbar-brand i {
            color: #4dabf7;
        }
        
        .nav-link {
            color: white !important;
            padding: 10px 15px !important;
            margin: 0 2px;
            border-radius: 4px;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }
        
        .nav-link.active {
            background-color: var(--univer-light) !important;
        }
        
        .user-dropdown {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 5px 15px;
        }
        
        /* Moodle спецификалық стильдер */
        .moodle-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s;
            margin-bottom: 25px;
        }
        
        .moodle-card:hover {
            transform: translateY(-3px);
        }
        
        .moodle-header {
            background: linear-gradient(135deg, var(--moodle-purple), #6a11cb);
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 20px;
        }
        
        .subject-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s;
            background-color: white;
        }
        
        .subject-card:hover {
            border-color: var(--moodle-purple);
            box-shadow: 0 5px 15px rgba(152, 0, 255, 0.1);
        }
        
        .subject-icon {
            font-size: 2.5rem;
            margin-right: 15px;
            color: var(--moodle-purple);
        }
        
        .test-badge {
            background-color: #28a745;
            color: white;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .timer-box {
            background-color: #f8f9fa;
            border: 2px solid #dc3545;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            font-family: 'Courier New', monospace;
        }
        
        #countdown {
            font-size: 2.5rem;
            font-weight: bold;
            color: #dc3545;
        }
        
        .question-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: white;
        }
        
        .option-label {
            display: block;
            padding: 12px 15px;
            margin-bottom: 10px;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .option-label:hover {
            background-color: #f8f9ff;
            border-color: var(--moodle-purple);
        }
        
        .option-input:checked + .option-label {
            background-color: #e9f2ff;
            border-color: var(--univer-light);
            font-weight: 600;
        }
        
        .result-card {
            border: 3px solid;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
        }
        
        .result-excellent {
            border-color: #28a745;
            background-color: #d4edda;
        }
        
        .result-good {
            border-color: #ffc107;
            background-color: #fff3cd;
        }
        
        .result-average {
            border-color: #fd7e14;
            background-color: #ffe5d0;
        }
        
        .result-poor {
            border-color: #dc3545;
            background-color: #f8d7da;
        }
        
        .progress-circle {
            width: 150px;
            height: 150px;
            margin: 0 auto;
        }
        
        .footer {
            background-color: var(--univer-dark);
            color: white;
            padding: 20px 0;
            margin-top: 40px;
        }
        
        @media (max-width: 768px) {
            .nav-link {
                padding: 8px 10px !important;
                margin: 2px 0;
            }
            
            .subject-card {
                padding: 15px;
            }
            
            .subject-icon {
                font-size: 2rem;
                margin-right: 10px;
            }
            
            #countdown {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Верхняя информационная панель -->
    <div class="top-info-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <i class="fas fa-phone-alt me-1"></i> 8 (727) 123-45-67 | 
                    <i class="fas fa-envelope ms-3 me-1"></i> <a href="mailto:info@univer.kz">info@univer.kz</a>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <i class="fas fa-clock me-1"></i> Дүйсенбі-Жұма: 9:00 - 18:00
                </div>
            </div>
        </div>
    </div>
    
    <!-- Основная навигация -->
    <nav class="navbar navbar-expand-lg main-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="main.php">
                <i class="fas fa-graduation-cap me-2"></i>UNIVER
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon">
                    <i class="fas fa-bars text-white"></i>
                </span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="main.php">
                            <i class="fas fa-home me-1"></i> Басты бет
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="library.php">
                            <i class="fas fa-book-open me-1"></i> Кітапхана
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="moodle.php">
                            <i class="fas fa-laptop-code me-1"></i> ДОЖ Moodle
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sabaq_keste.html">
                            <i class="fas fa-calendar-alt me-1"></i> Кесте
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="otynish.html">
                            <i class="fas fa-file-alt me-1"></i> Өтініштер
                        </a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="nav-link user-dropdown dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> <?php echo $currentUser; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>Профиль</a></li>
                            <li><a class="dropdown-item" href="settings.php"><i class="fas fa-cog me-2"></i>Баптаулар</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Шығу</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Основной контент -->
    <main class="container my-4">
        <!-- Шапка Moodle -->
        <div class="moodle-card">
            <div class="moodle-header">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-laptop-code fa-3x"></i>
                    </div>
                    <div>
                        <h2 class="mb-1">ДОЖ Moodle - Онлайн курстар</h2>
                        <p class="mb-0">Дистанциялық оқыту жүйесі. Курстарға қатысып, тест тапсырыңыз.</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Мұғалімдер тағайындаған онлайн тесттер:</strong> Әр пән астында тест тапсыруға болады. 
                    Тест уақыты әр пәнге тәуелді. Тест аяқталған соң нәтиже бірден көрсетіледі.
                </div>
            </div>
        </div>
        
        <!-- Егер нәтиже көрсетілетін болса -->
        <?php if($showResult && $testResult): ?>
        <div class="moodle-card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-trophy me-2"></i>Тест нәтижесі</h5>
            </div>
            <div class="card-body">
                <?php
                    $resultClass = 'result-average';
                    if ($testResult['percentage'] >= 90) $resultClass = 'result-excellent';
                    elseif ($testResult['percentage'] >= 70) $resultClass = 'result-good';
                    elseif ($testResult['percentage'] >= 50) $resultClass = 'result-average';
                    else $resultClass = 'result-poor';
                ?>
                
                <div class="result-card <?php echo $resultClass; ?> mb-4">
                    <h3 class="mb-3"><?php echo $testResult['subject_name']; ?></h3>
                    
                    <div class="progress-circle position-relative mb-4">
                        <div class="position-absolute top-50 start-50 translate-middle text-center">
                            <h2 class="mb-0"><?php echo $testResult['percentage']; ?>%</h2>
                            <small class="text-muted">Дәлдік</small>
                        </div>
                        <svg width="150" height="150" viewBox="0 0 36 36" class="circular-chart">
                            <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#eee" stroke-width="3"/>
                            <path class="circle" stroke-dasharray="<?php echo $testResult['percentage']; ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" 
                                  stroke="<?php echo $testResult['percentage'] >= 70 ? '#28a745' : ($testResult['percentage'] >= 50 ? '#ffc107' : '#dc3545'); ?>" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="alert alert-primary">
                                <h4 class="mb-0"><?php echo $testResult['score']; ?>/<?php echo $testResult['total']; ?></h4>
                                <small>Ұпай</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-info">
                                <h4 class="mb-0"><?php echo $testResult['percentage']; ?>%</h4>
                                <small>Дәлдік</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-secondary">
                                <h4 class="mb-0"><?php echo $testResult['timestamp']; ?></h4>
                                <small>Уақыты</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <?php if($testResult['percentage'] >= 70): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i> <strong>Тақырыпты меңгердіңіз!</strong> Жақсы жұмыс!
                        </div>
                        <?php elseif($testResult['percentage'] >= 50): ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i> <strong>Орташа нәтиже.</strong> Тақырыпты қайта қарап шығыңыз.
                        </div>
                        <?php else: ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-times-circle me-2"></i> <strong>Тақырыпты қайталаңыз.</strong> Материалды жақсырақ оқып шығыңыз.
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mt-4">
                        <a href="moodle.php" class="btn btn-primary me-2">
                            <i class="fas fa-arrow-left me-1"></i> Курстар тізіміне оралу
                        </a>
                        <button class="btn btn-outline-primary" id="showDetailsBtn">
                            <i class="fas fa-list me-1"></i> Жауаптарды көру
                        </button>
                    </div>
                </div>
                
                <!-- Жауаптардың толық тізімі (жасырын) -->
                <div id="answersDetails" class="mt-4" style="display: none;">
                    <h5><i class="fas fa-clipboard-list me-2"></i> Жауаптардың толық тізімі</h5>
                    
                    <?php if(isset($testQuestions[$testResult['subject_id']])): ?>
                        <?php foreach($testQuestions[$testResult['subject_id']] as $question): ?>
                            <div class="question-card">
                                <h6>Сұрақ <?php echo $question['id']; ?>: <?php echo $question['question']; ?></h6>
                                <p><strong>Дұрыс жауап:</strong> <?php echo $question['options'][$question['correct']]; ?></p>
                                <p>
                                    <strong>Сіздің жауабыңыз:</strong> 
                                    <?php if(isset($testResult['answers'][$question['id']]) && $testResult['answers'][$question['id']]): ?>
                                        <span class="text-success"><i class="fas fa-check me-1"></i> Дұрыс</span>
                                    <?php else: ?>
                                        <span class="text-danger"><i class="fas fa-times me-1"></i> Қате</span>
                                    <?php endif; ?>
                                </p>
                                <p><strong>Ұпай:</strong> <?php echo $question['score']; ?> балл</p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Егер тест беті көрсетілетін болса -->
        <?php if($currentSubject && !$showResult): ?>
        <div class="moodle-card">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0"><?php echo $currentSubject['name']; ?> - Тест</h5>
                        <small class="opacity-75">Код: <?php echo $currentSubject['code']; ?> | Мұғалім: <?php echo $currentSubject['teacher']; ?></small>
                    </div>
                    <div class="timer-box">
                        <div class="small text-muted">Қалған уақыт</div>
                        <div id="countdown"><?php echo str_pad($currentSubject['time_limit'], 2, '0', STR_PAD_LEFT); ?>:00</div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Нұсқаулар:</strong> 
                    <ul class="mb-0">
                        <li>Тесттің ұзақтығы: <strong><?php echo $currentSubject['time_limit']; ?> минут</strong></li>
                        <li>Барлық сұрақтар саны: <strong><?php echo $currentSubject['total_questions']; ?></strong></li>
                        <li>Жалпы балл: <strong><?php echo $currentSubject['total_score']; ?></strong></li>
                        <li>Уақыт аяқталғанда тест автоматты түрде тапсырылады</li>
                        <li>Артқа қайта оралу мүмкін емес</li>
                    </ul>
                </div>
                
                <form id="testForm" action="moodle.php" method="POST">
                    <input type="hidden" name="subject_id" value="<?php echo $currentSubject['id']; ?>">
                    
                    <?php if(isset($testQuestions[$currentSubject['id']])): ?>
                        <?php foreach($testQuestions[$currentSubject['id']] as $question): ?>
                            <div class="question-card">
                                <h5 class="mb-3"><?php echo $question['id']; ?>. <?php echo $question['question']; ?> 
                                    <span class="badge bg-secondary float-end"><?php echo $question['score']; ?> балл</span>
                                </h5>
                                
                                <?php foreach($question['options'] as $key => $option): ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input option-input" type="radio" name="q<?php echo $question['id']; ?>" id="q<?php echo $question['id']; ?>_<?php echo $key; ?>" value="<?php echo $key; ?>">
                                        <label class="form-check-label option-label" for="q<?php echo $question['id']; ?>_<?php echo $key; ?>">
                                            <strong><?php echo strtoupper($key); ?>.</strong> <?php echo $option; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                            <h5>Тест сұрақтары әзірленуде</h5>
                            <p class="text-muted">Бұл пәннің тест сұрақтары әлі дайын емес</p>
                        </div>
                    <?php endif; ?>
                    
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" name="submit_test" class="btn btn-success btn-lg">
                            <i class="fas fa-paper-plane me-2"></i> Тестті тапсыру
                        </button>
                        <a href="moodle.php" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Болдырмау
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Егер не нәтиже, не тест көрсетілмесе - курстар тізімі -->
        <?php if(!$currentSubject && !$showResult): ?>
        <div class="moodle-card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-book me-2"></i>Менің курстарым</h5>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Төменде сіздің пәндеріңіз тізімделген. Әр пән астында онлайн тест тапсыруға болады.</p>
                
                <div class="row">
                    <?php foreach($subjects as $subject): ?>
                    <div class="col-md-6 mb-3">
                        <div class="subject-card">
                            <div class="d-flex align-items-start">
                                <div class="subject-icon">
                                    <i class="fas fa-laptop-code"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1"><?php echo $subject['name']; ?></h5>
                                    <p class="small text-muted mb-2"><?php echo $subject['description']; ?></p>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge bg-secondary me-2"><?php echo $subject['code']; ?></span>
                                            <span class="badge bg-light text-dark">
                                                <i class="fas fa-user-tie me-1"></i><?php echo $subject['teacher']; ?>
                                            </span>
                                        </div>
                                        <div>
                                            <span class="badge bg-info me-2">
                                                <i class="fas fa-clock me-1"></i><?php echo $subject['time_limit']; ?> мин
                                            </span>
                                            <span class="badge bg-warning me-2">
                                                <i class="fas fa-question-circle me-1"></i><?php echo $subject['total_questions']; ?> сұр
                                            </span>
                                            <a href="moodle.php?subject=<?php echo $subject['id']; ?>" class="btn btn-sm btn-primary">
                                                Тест тапсыру <i class="fas fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Тест статистикасы -->
                <div class="mt-5 pt-4 border-top">
                    <h5><i class="fas fa-chart-bar me-2"></i> Тест статистикасы</h5>
                    <div class="row mt-3">
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3 class="text-primary">6</h3>
                                    <small class="text-muted">Барлық курстар</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3 class="text-success">2</h3>
                                    <small class="text-muted">Тапсырылған тесттер</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3 class="text-warning">85%</h3>
                                    <small class="text-muted">Орташа дәлдік</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3 class="text-info">4</h3>
                                    <small class="text-muted">Қалған тесттер</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Жиі қойылатын сұрақтар -->
        <div class="moodle-card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-question-circle me-2"></i>Жиі қойылатын сұрақтар</h5>
            </div>
            <div class="card-body">
                <div class="accordion" id="moodleFAQ">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target