<?php
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'teacher') {
    header('Location: ../login.php');
    exit;
}

$user_full_name = htmlspecialchars($_SESSION['user_full_name'] ?? 'Құрметті Қонақ'); 

// 4. Дерекқордан келетін немесе статикалық статистикалық деректер (көрсету үшін)
$active_courses = 4;
$total_students = 142;
$tasks_to_check = 23;
$new_requests = 7;

// Активті бетті анықтау (навигациядағы active класы үшін)
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="kz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Басты бет | UNIVER - Оқытушы</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --univer-blue: #003366;
            --univer-dark: #123456;
            --univer-light: #0056b3;
            --univer-accent: #e9f2ff;
            --teacher-color: #32406bff; /* Специальный цвет для преподавателя */
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        /* Верхняя информационная панель */
        .top-info-bar {
            background-color: var(--univer-dark);
            color: white;
            padding: 8px 0;
            font-size: 0.9rem;
        }
        
        .top-info-bar a {
            color: #5d8fb8ff;
            text-decoration: none;
        }
        
        .top-info-bar a:hover {
            color: white;
            text-decoration: underline;
        }
        
        /* Основная навигация */
        .main-navbar {
            background-color: var(--teacher-color); 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }
        
        .navbar-brand i {
            color: #287abdff; /* Бұл жерде тек белгіше түсінің қатесі жойылды, бірақ бастапқы CSS-тегі түсі сақталды */
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
            background-color: #285692ff !important; 
        }
        
        .user-dropdown {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 5px 15px;
        }
        
        .user-dropdown:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        /* Основной контент */
        .welcome-card {
            border-left: 5px solid var(--teacher-color);
            border-radius: 8px;
        }
        
        .content-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s;
            margin-bottom: 25px;
        }
        
        .content-card:hover {
            transform: translateY(-3px);
        }
        
        .card-header {
            background-color: var(--univer-accent) !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
        }
        
        .resource-btn {
            border-radius: 8px;
            padding: 12px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            min-height: 120px;
            transition: all 0.3s;
            border: 1px solid #dee2e6;
        }
        
        .resource-btn:hover {
            background-color: #e8f7f6; /* Светлый оттенок teacher-color */
            border-color: var(--teacher-color);
            transform: scale(1.03);
        }
        
        .resource-btn i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--teacher-color);
        }
        
        .news-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s;
        }
        
        .news-item:hover {
            background-color: #f9f9f9;
        }
        
        .news-date {
            color: var(--teacher-color);
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .badge-teacher {
            background-color: var(--teacher-color) !important;
        }
        
        .teacher-highlight {
            color: var(--teacher-color);
            font-weight: 600;
        }
        
        .footer {
            background-color: var(--univer-dark);
            color: white;
            padding: 20px 0;
            margin-top: 40px;
        }
        
        .stat-card {
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            margin-bottom: 15px;
        }
        
        .stat-card.courses {
            background-color: #e3f2fd;
            border-left: 4px solid #1976d2;
        }
        
        .stat-card.students {
            background-color: #f3e5f5;
            border-left: 4px solid #7b1fa2;
        }
        
        .stat-card.tasks {
            background-color: #e8f5e9;
            border-left: 4px solid #388e3c;
        }
        
        .stat-card i {
            font-size: 2rem;
            margin-bottom: 10px;
            opacity: 0.8;
        }
        
        /* Адаптивность */
        @media (max-width: 768px) {
            .nav-link {
                padding: 8px 10px !important;
                margin: 2px 0;
            }
            
            .navbar-collapse {
                padding-top: 10px;
            }
            
            .resource-btn {
                min-height: 100px;
            }
        }
    </style>
</head>
<body>
    <div class="top-info-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <i class="fas fa-phone-alt me-1"></i> 8 (727) 123-45-67 | 
                    <i class="fas fa-envelope ms-3 me-1"></i> <a href="mailto:info@univer.kz">info@univer.kz</a>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <i class="fas fa-university me-1"></i> Әл-фараби атындағы Қазақ ұлттық университеті </div>
            </div>
        </div>
    </div>
    
    <nav class="navbar navbar-expand-lg main-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="main_teacher.php">
                <i class="fas fa-chalkboard-teacher me-2"></i>UNIVER - Оқытушы
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon">
                    <i class="fas fa-bars text-white"></i>
                </span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'main_teacher.php' ? 'active' : ''); ?>" href="main_teacher.php">
                            <i class="fas fa-home me-1"></i> Басты бет
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="teacher_courses.php">
                            <i class="fas fa-book me-1"></i> Менің курстарым
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="teacher_keste.php">
                            <i class="fas fa-calendar-alt me-1"></i> Сабақ кестесі
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="teacher_grades.php">
                            <i class="fas fa-chart-bar me-1"></i> Атестация
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="teacher_requests.php">
                            <i class="fas fa-file-alt me-1"></i> Бағалау
                        </a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="nav-link user-dropdown dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> <?php echo $user_full_name; ?> 
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="teacher_profile.php"><i class="fas fa-user me-2"></i>Профиль</a></li>
                            <li><a class="dropdown-item" href="teacher_settings.php"><i class="fas fa-cog me-2"></i>Баптаулар</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i>Шығу</a></li>
                        </ul> 
                    </div> </div>
            </div>
        </div>
    </nav>
    
    <main class="container my-4">
        <div class="alert alert-success welcome-card" role="alert">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <i class="fas fa-chalkboard-teacher fa-2x"></i>
                </div>
                <div>
                    <h5 class="alert-heading mb-1">Құрметті оқытушы, <strong><?php echo $user_full_name; ?></strong>!</h5>
                    <p class="mb-0">Жүйеге қош келдіңіз! Қазіргі уақытта жүйе тестілеу кезеңінде өтуде. 
                    Кез-келген қателіктер байқалса, <a href="mailto:it@kaznu.kz" class="alert-link">it@kaznu.kz</a> мекенжайына хабарласыңыз.</p>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="stat-card courses">
                    <i class="fas fa-book text-primary"></i>
                    <h4><?php echo $active_courses; ?></h4>
                    <p class="mb-0">Белсенді курс</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card students">
                    <i class="fas fa-users text-purple"></i>
                    <h4><?php echo $total_students; ?></h4>
                    <p class="mb-0">Студенттер</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card tasks">
                    <i class="fas fa-tasks text-success"></i>
                    <h4><?php echo $tasks_to_check; ?></h4>
                    <p class="mb-0">Тестілеу күтімі</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <i class="fas fa-bell text-warning"></i>
                    <h4><?php echo $new_requests; ?></h4>
                    <p class="mb-0">Жаңа өтініштер</p>
                </div>
            </div>
        </div>
        
        <div class="content-card card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-tools me-2"></i>Оқытушы құралдары</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-3 col-sm-6">
                        <a href="teacher_courses.php" class="btn btn-outline-primary resource-btn">
                            <i class="fas fa-book-open"></i>
                            <span>Курстарды басқару</span>
                            <small class="text-muted mt-2">Материалдар, тапсырмалар</small>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="teacher_grades.php" class="btn btn-outline-primary resource-btn">
                            <i class="fas fa-check-circle"></i>
                            <span>Бағалау жүйесі</span>
                            <small class="text-muted mt-2">Бағаларды енгізу</small>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="teacher_keste.php" class="btn btn-outline-primary resource-btn">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Сабақ кестесі</span>
                            <small class="text-muted mt-2">Оқу процессін жоспарлау</small>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="teacher_attendance.php" class="btn btn-outline-primary resource-btn">
                            <i class="fas fa-user-check"></i>
                            <span>Сабаққа қатысу</span>
                            <small class="text-muted mt-2">Қатысуды тіркеу</small>
                        </a>
                    </div>
                </div>
                
                <div class="row g-4 mt-2">
                    <div class="col-md-3 col-sm-6">
                        <a href="teacher_materials.php" class="btn btn-outline-primary resource-btn">
                            <i class="fas fa-folder-plus"></i>
                            <span>Материалдар</span>
                            <small class="text-muted mt-2">Оқу материалдарын жүктеу</small>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="teacher_tests.php" class="btn btn-outline-primary resource-btn">
                            <i class="fas fa-question-circle"></i>
                            <span>Тест құру</span>
                            <small class="text-muted mt-2">Тесттер мен сынақтар</small>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="teacher_communications.php" class="btn btn-outline-primary resource-btn">
                            <i class="fas fa-comments"></i>
                            <span>Хабарласу</span>
                            <small class="text-muted mt-2">Студенттермен байланыс</small>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="teacher_analytics.php" class="btn btn-outline-primary resource-btn">
                            <i class="fas fa-chart-bar"></i>
                            <span>Аналитика</span>
                            <small class="text-muted mt-2">Оқу нәтижелері</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                <div class="content-card card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-bullhorn me-2"></i>Оқытушыларға арналған жаңалықтар</h5>
                        <span class="badge badge-teacher">Жаңа</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="news-item">
                            <div class="d-flex">
                                <div class="news-date me-3">12.05.2025</div>
                                <div>
                                    <h6>Күзгі семестрге дайындық</h6>
                                    <p class="mb-0">Келесі оқу жылына дайындық жұмыстары басталды. Оқу жоспарларын жаңартуды 30 мамырға дейін аяқтау қажет.</p>
                                </div>
                            </div>
                        </div>
                        <div class="news-item">
                            <div class="d-flex">
                                <div class="news-date me-3">08.05.2025</div>
                                <div>
                                    <h6>Сессиялық бағалау мерзімі</h6>
                                    <p class="mb-0">Күзгі семестрдің экзамендік нәтижелерін 25 мамырға дейін жүйеге енгізу қажет.</p>
                                </div>
                            </div>
                        </div>
                        <div class="news-item">
                            <div class="d-flex">
                                <div class="news-date me-3">03.05.2025</div>
                                <div>
                                    <h6>Оқытушылардың кәсіби дамуы</h6>
                                    <p class="mb-0">Маусым айында оқытушыларға арналған вебинарлар сериясы өтеді. Тіркелудің соңғы мерзімі - 20 мамыр.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="teacher_news.php" class="btn btn-sm btn-outline-primary">Барлық жаңалықтар <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
                
                <div class="content-card card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Тестілеу күтімі</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Курс</th>
                                        <th>Тапсырма</th>
                                        <th>Саны</th>
                                        <th>Мерзімі</th>
                                        <th>Әрекет</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Физика I</td>
                                        <td>Лабораториялық жұмыс №5</td>
                                        <td>32</td>
                                        <td>15.05.2025</td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Бағалау</a></td>
                                    </tr>
                                    <tr>
                                        <td>Математикалық талдау</td>
                                        <td>Іріктеме жұмысы</td>
                                        <td>28</td>
                                        <td>18.05.2025</td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Бағалау</a></td>
                                    </tr>
                                    <tr>
                                        <td>Бағдарламалау</td>
                                        <td>Проект қорғау</td>
                                        <td>15</td>
                                        <td>20.05.2025</td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Бағалау</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="content-card card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-bell me-2"></i>Жедел хабарламалар</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning d-flex align-items-start">
                            <i class="fas fa-exclamation-triangle me-3 mt-1"></i>
                            <div>
                                <strong>Ескерту!</strong> 
                                <p class="mb-0 small">"Физика I" курсындағы 5 студенттің лабораториялық жұмысы қайта қарауды талап етеді.</p>
                            </div>
                        </div>
                        
                        <div class="alert alert-info d-flex align-items-start">
                            <i class="fas fa-info-circle me-3 mt-1"></i>
                            <div>
                                <strong>Ақпарат</strong> 
                                <p class="mb-0 small">Жаңа академиялық жылдың оқу жоспарлары бекітілді. Өз курстарыңызды тексеріңіз.</p>
                            </div>
                        </div>
                        
                        <div class="alert alert-success d-flex align-items-start">
                            <i class="fas fa-check-circle me-3 mt-1"></i>
                            <div>
                                <strong>Құттықтаймыз!</strong> 
                                <p class="mb-0 small">Сіздің "Жаңа технологиялар" курсыңыз ең жоғары рейтингіліктердің бірі болды.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="content-card card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-calendar-day me-2"></i>Бүгінгі сабақтар</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <strong>10:00 - 11:30</strong>
                                <span class="badge bg-primary">Физика I</span>
                            </div>
                            <p class="mb-1 small">А-102 аудитория</p>
                            <p class="mb-0 small text-muted">Топ: Ф-21-01, 30 студент</p>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <strong>12:00 - 13:30</strong>
                                <span class="badge bg-success">Математикалық талдау</span>
                            </div>
                            <p class="mb-1 small">В-305 аудитория</p>
                            <p class="mb-0 small text-muted">Топ: М-21-03, 25 студент</p>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <strong>14:30 - 16:00</strong>
                                <span class="badge bg-warning text-dark">Бағдарламалау</span>
                            </div>
                            <p class="mb-1 small">Компьютерлік класс №4</p>
                            <p class="mb-0 small text-muted">Топ: АИ-21-02, 20 студент</p>
                        </div>
                        
                        <div class="d-grid">
                            <a href="teacher_keste.php" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-calendar-alt me-1"></i> Толық кестені қарау
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5><i class="fas fa-chalkboard-teacher me-2"></i>UNIVER - Оқытушы порталы</h5>
                    <p class="small">Оқытушыларға арналған кешенді құралдар жиынтығы. Оқу процесін тиімді басқару.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Байланыс ақпараты</h5>
                    <ul class="list-unstyled small">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Алматы, Тәуелсіздік көшесі 123</li>
                        <li><i class="fas fa-phone me-2"></i> 8 (727) 123-45-67</li>
                        <li><i class="fas fa-envelope me-2"></i> teachers@univer.kz</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Жүйе туралы</h5>
                    <p class="small">Бұл оқытушылар порталының прототипі. Нақты мәліметтер қолжетімді емес.</p>
                    <div class="small text-muted">
                        © 2025 UNIVER. Оқытушылар порталы.
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Активная навигация
        document.addEventListener('DOMContentLoaded', function() {
            // Подсветка активной ссылки
            const currentPage = 'main_teacher.php';
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                // PHP арқылы 'active' класы қосылғандықтан, бұл JavaScript блогын өзгерту қажет емес.
                // Егер қажет болса, осы жерде қосымша логиканы пайдалануға болады.
                const href = link.getAttribute('href');
                if (href && href.endsWith(currentPage)) {
                    // Тексеруді оңайыту үшін
                    // link.classList.add('active');
                } else {
                    // link.classList.remove('active');
                }
            });
            
            // Анимация карточек при загрузке
            const cards = document.querySelectorAll('.content-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
            
            // Обновление времени
            function updateTime() {
                const now = new Date();
                const timeElement = document.getElementById('currentTime');
                if (timeElement) {
                    timeElement.textContent = now.toLocaleTimeString('kz-KZ');
                }
            }
            
            // Обновляем время каждую минуту
            setInterval(updateTime, 60000);
            updateTime();
        });
    </script>
</body>
</html>