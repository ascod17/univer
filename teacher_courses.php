<!DOCTYPE html>
<html lang="kz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Менің курстарым | UNIVER - Оқытушы</title>
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
            background-color: var(--teacher-color); /* Уникальный цвет для преподавателя */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }
        
        .navbar-brand i {
            color: #287abdff;
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
            background-color: #285692ff !important; /* Более темный оттенок */
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
        
        .course-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            transition: all 0.3s;
            margin-bottom: 20px;
            height: 100%;
        }
        
        .course-card:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
            border-color: var(--teacher-color);
        }
        
        .course-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 15px;
            color: white;
        }
        
        .course-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        
        .course-actions {
            border-top: 1px solid #dee2e6;
            padding: 10px;
            background-color: #f8f9fa;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
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
        
        /* Таблица студентов */
        .student-table {
            font-size: 0.9rem;
        }
        
        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--teacher-color);
        }
        
        .module-item {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s;
        }
        
        .module-item:hover {
            background-color: #f9f9f9;
        }
        
        .module-item:last-child {
            border-bottom: none;
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
                    <i ></i> Әл-фараби атындағы Қазақ ұлттық университеті
                </div>
            </div>
        </div>
    </div>
    
    <!-- Основная навигация -->
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
                        <a class="nav-link" href="main_teacher.php">
                            <i class="fas fa-home me-1"></i> Басты бет
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="teacher_courses.php">
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
                            <i class="fas fa-file-alt me-1"></i> бағалау
                        </a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="nav-link user-dropdown dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user-tie me-1"></i> Досымбек А.М.
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="teacher_profile.php"><i class="fas fa-user me-2"></i>Профиль</a></li>
                            <li><a class="dropdown-item" href="teacher_settings.php"><i class="fas fa-cog me-2"></i>Баптаулар</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i>Шығу</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Основной контент -->
    <main class="container my-4">
        <!-- Заголовок и кнопка добавления -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1"><i class="fas fa-book me-2 teacher-highlight"></i>Менің курстарым</h2>
                <p class="text-muted mb-0">Барлық белсенді курс тізімі және оларды басқару құралдары</p>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                <i class="fas fa-plus me-1"></i> Жаңа курс қосу
            </button>
        </div>
        
        <!-- Статистика курсов -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="stat-card courses">
                    <i class="fas fa-book text-primary"></i>
                    <h4>4</h4>
                    <p class="mb-0">Белсенді курс</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card students">
                    <i class="fas fa-users text-purple"></i>
                    <h4>142</h4>
                    <p class="mb-0">Жалпы студент</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <i class="fas fa-file-alt text-info"></i>
                    <h4>17</h4>
                    <p class="mb-0">Жүктелген материал</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card tasks">
                    <i class="fas fa-tasks text-success"></i>
                    <h4>23</h4>
                    <p class="mb-0">Тестілеу күтімі</p>
                </div>
            </div>
        </div>
        
        <!-- Фильтры и поиск -->
        <div class="content-card card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Курс атауы бойынша іздеу...">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <select class="form-select">
                            <option value="">Барлық факультеттер</option>
                            <option value="physics">Физика-техникалық</option>
                            <option value="math">Математика және механика</option>
                            <option value="it">Ақпараттық технологиялар</option>
                            <option value="chemistry">Химия</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select">
                            <option value="">Барлық семестрлер</option>
                            <option value="1">1-ші семестр</option>
                            <option value="2">2-ші семестр</option>
                            <option value="3">3-ші семестр</option>
                            <option value="4">4-ші семестр</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Список курсов -->
        <div class="row">
            <!-- Курс 1 -->
            <div class="col-lg-6 mb-4">
                <div class="course-card">
                    <div class="course-header" style="background-color: #1976d2;">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="course-icon">
                                    <i class="fas fa-atom"></i>
                                </div>
                                <h4 class="mb-1">Физика I</h4>
                                <p class="mb-0">ФТФ-101 | 1-ші курс</p>
                            </div>
                            <span class="badge bg-light text-dark">Белсенді</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Негізгі физикалық заңдар, механика, термодинамика және электромагнетизм негіздері.</p>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <i class="fas fa-users me-1 text-muted"></i>
                                <span class="small">32 студент</span>
                            </div>
                            <div>
                                <i class="fas fa-calendar-alt me-1 text-muted"></i>
                                <span class="small">Күзгі семестр</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between small text-muted mt-1">
                                <span>Курс өтті: 75%</span>
                                <span>Аяқталуы: 25.05.2025</span>
                            </div>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <span class="badge bg-info">Механика</span>
                            <span class="badge bg-info">Термодинамика</span>
                            <span class="badge bg-info">Электромагнетизм</span>
                        </div>
                    </div>
                    <div class="course-actions">
                        <div class="d-flex justify-content-between">
                            <a href="teacher_course_detail.php?id=1" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> Толығырақ
                            </a>
                            <a href="teacher_grades.php?course=1" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-check-circle me-1"></i> Бағалау
                            </a>
                            <a href="teacher_materials.php?course=1" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-upload me-1"></i> Материалдар
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Курс 2 -->
            <div class="col-lg-6 mb-4">
                <div class="course-card">
                    <div class="course-header" style="background-color: #388e3c;">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="course-icon">
                                    <i class="fas fa-calculator"></i>
                                </div>
                                <h4 class="mb-1">Математикалық талдау</h4>
                                <p class="mb-0">ММФ-201 | 2-ші курс</p>
                            </div>
                            <span class="badge bg-light text-dark">Белсенді</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Дифференциалдық және интегралдық есептеулер, функциялар теориясы, қатарлар.</p>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <i class="fas fa-users me-1 text-muted"></i>
                                <span class="small">28 студент</span>
                            </div>
                            <div>
                                <i class="fas fa-calendar-alt me-1 text-muted"></i>
                                <span class="small">Күзгі семестр</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between small text-muted mt-1">
                                <span>Курс өтті: 60%</span>
                                <span>Аяқталуы: 30.05.2025</span>
                            </div>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <span class="badge bg-info">Дифференциалдық есептеу</span>
                            <span class="badge bg-info">Интегралдық есептеу</span>
                            <span class="badge bg-info">Қатарлар</span>
                        </div>
                    </div>
                    <div class="course-actions">
                        <div class="d-flex justify-content-between">
                            <a href="teacher_course_detail.php?id=2" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> Толығырақ
                            </a>
                            <a href="teacher_grades.php?course=2" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-check-circle me-1"></i> Бағалау
                            </a>
                            <a href="teacher_materials.php?course=2" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-upload me-1"></i> Материалдар
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Курс 3 -->
            <div class="col-lg-6 mb-4">
                <div class="course-card">
                    <div class="course-header" style="background-color: #7b1fa2;">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="course-icon">
                                    <i class="fas fa-laptop-code"></i>
                                </div>
                                <h4 class="mb-1">Бағдарламалау негіздері</h4>
                                <p class="mb-0">АИТ-101 | 1-ші курс</p>
                            </div>
                            <span class="badge bg-light text-dark">Белсенді</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">C++ тіліндегі алгоритмдер мен деректер құрылымдары, объектіге бағытталған бағдарламалау.</p>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <i class="fas fa-users me-1 text-muted"></i>
                                <span class="small">25 студент</span>
                            </div>
                            <div>
                                <i class="fas fa-calendar-alt me-1 text-muted"></i>
                                <span class="small">Көктемгі семестр</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between small text-muted mt-1">
                                <span>Курс өтті: 90%</span>
                                <span>Аяқталуы: 15.05.2025</span>
                            </div>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <span class="badge bg-info">C++</span>
                            <span class="badge bg-info">Алгоритмдер</span>
                            <span class="badge bg-info">ООП</span>
                        </div>
                    </div>
                    <div class="course-actions">
                        <div class="d-flex justify-content-between">
                            <a href="teacher_course_detail.php?id=3" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> Толығырақ
                            </a>
                            <a href="teacher_grades.php?course=3" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-check-circle me-1"></i> Бағалау
                            </a>
                            <a href="teacher_materials.php?course=3" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-upload me-1"></i> Материалдар
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Курс 4 -->
            <div class="col-lg-6 mb-4">
                <div class="course-card">
                    <div class="course-header" style="background-color: #f57c00;">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="course-icon">
                                    <i class="fas fa-microchip"></i>
                                </div>
                                <h4 class="mb-1">Жаңа технологиялар</h4>
                                <p class="mb-0">АИТ-301 | 3-ші курс</p>
                            </div>
                            <span class="badge bg-light text-dark">Белсенді</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Жасанды интеллект, блокчейн, IoT және басқа заманауи технологиялармен танысу.</p>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <i class="fas fa-users me-1 text-muted"></i>
                                <span class="small">20 студент</span>
                            </div>
                            <div>
                                <i class="fas fa-calendar-alt me-1 text-muted"></i>
                                <span class="small">Күзгі семестр</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between small text-muted mt-1">
                                <span>Курс өтті: 45%</span>
                                <span>Аяқталуы: 20.06.2025</span>
                            </div>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <span class="badge bg-info">AI</span>
                            <span class="badge bg-info">Blockchain</span>
                            <span class="badge bg-info">IoT</span>
                        </div>
                    </div>
                    <div class="course-actions">
                        <div class="d-flex justify-content-between">
                            <a href="teacher_course_detail.php?id=4" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> Толығырақ
                            </a>
                            <a href="teacher_grades.php?course=4" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-check-circle me-1"></i> Бағалау
                            </a>
                            <a href="teacher_materials.php?course=4" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-upload me-1"></i> Материалдар
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Архивные курсы -->
        <div class="content-card card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-archive me-2"></i>Архивтелген курстар</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="module-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Химия негіздері</h6>
                                    <p class="small text-muted mb-0">2024 жылғы көктемгі семестр</p>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-secondary">Қайта белсендіру</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="module-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Инженерлік графика</h6>
                                    <p class="small text-muted mb-0">2023 жылғы күзгі семестр</p>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-secondary">Қайта белсендіру</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Модальное окно добавления курса -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel"><i class="fas fa-plus-circle me-2"></i>Жаңа курс қосу</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Жабу"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="courseName" class="form-label">Курс атауы *</label>
                                <input type="text" class="form-control" id="courseName" placeholder="Мысалы: Физика I" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="courseCode" class="form-label">Курс коды *</label>
                                <input type="text" class="form-control" id="courseCode" placeholder="Мысалы: ФТФ-101" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="faculty" class="form-label">Факультет *</label>
                                <select class="form-select" id="faculty" required>
                                    <option value="">Таңдаңыз...</option>
                                    <option value="physics">Физика-техникалық факультет</option>
                                    <option value="math">Математика және механика факультеті</option>
                                    <option value="it">Ақпараттық технологиялар факультеті</option>
                                    <option value="chemistry">Химия факультеті</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="semester" class="form-label">Семестр *</label>
                                <select class="form-select" id="semester" required>
                                    <option value="">Таңдаңыз...</option>
                                    <option value="1">1-ші семестр</option>
                                    <option value="2">2-ші семестр</option>
                                    <option value="3">3-ші семестр</option>
                                    <option value="4">4-ші семестр</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="courseDescription" class="form-label">Курс сипаттамасы</label>
                            <textarea class="form-control" id="courseDescription" rows="3" placeholder="Курстың қысқаша сипаттамасы..."></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Курс түсі</label>
                            <div class="d-flex gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="courseColor" id="colorBlue" value="#1976d2" checked>
                                    <label class="form-check-label" for="colorBlue">
                                        <span class="badge" style="background-color: #1976d2; width: 20px; height: 20px; display: inline-block;"></span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="courseColor" id="colorGreen" value="#388e3c">
                                    <label class="form-check-label" for="colorGreen">
                                        <span class="badge" style="background-color: #388e3c; width: 20px; height: 20px; display: inline-block;"></span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="courseColor" id="colorPurple" value="#7b1fa2">
                                    <label class="form-check-label" for="colorPurple">
                                        <span class="badge" style="background-color: #7b1fa2; width: 20px; height: 20px; display: inline-block;"></span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="courseColor" id="colorOrange" value="#f57c00">
                                    <label class="form-check-label" for="colorOrange">
                                        <span class="badge" style="background-color: #f57c00; width: 20px; height: 20px; display: inline-block;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Жабу</button>
                    <button type="button" class="btn btn-primary">Курсты қосу</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Футер -->
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
                        © 2025 UNIVER. Оқытушылар пор