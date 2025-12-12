<!DOCTYPE html>
<html lang="kz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бағалау жүйесі | UNIVER - Оқытушы</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --univer-blue: #003366;
            --univer-dark: #123456;
            --univer-light: #0056b3;
            --univer-accent: #e9f2ff;
            --teacher-color: #32406bff;
            --rk1-color: #2E8B57;
            --rk2-color: #4682B4;
            --lab-color: #8A2BE2;
            --srs-color: #FF8C00;
            --active-color: #28a745;
            --inactive-color: #ffc107;
            --closed-color: #6c757d;
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
            margin-bottom: 25px;
        }
        
        .card-header {
            background-color: var(--univer-accent) !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
        }
        
        /* Бейджи */
        .rk1-badge { background-color: var(--rk1-color); color: white; }
        .rk2-badge { background-color: var(--rk2-color); color: white; }
        .lab-badge { background-color: var(--lab-color); color: white; }
        .srs-badge { background-color: var(--srs-color); color: white; }
        
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
        
        /* Таблицы */
        .grades-table th {
            background-color: var(--univer-accent);
            border-top: none;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .grades-table td {
            vertical-align: middle;
        }
        
        .student-cell {
            position: sticky;
            left: 0;
            background-color: white;
            z-index: 5;
            box-shadow: 2px 0 2px rgba(0,0,0,0.1);
        }
        
        .grade-input {
            width: 70px;
            text-align: center;
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 5px;
            transition: all 0.2s;
        }
        
        .grade-input:focus {
            border-color: var(--teacher-color);
            box-shadow: 0 0 0 0.2rem rgba(50, 64, 107, 0.25);
            outline: none;
        }
        
        .grade-input.changed {
            background-color: #fff3cd;
            border-color: #ffc107;
        }
        
        .grade-input.saved {
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        
        .grade-input.disabled {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
        
        /* Статусы РК */
        .rk-status {
            font-size: 0.8rem;
            padding: 3px 8px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .rk-status:hover {
            opacity: 0.9;
        }
        
        .rk-active {
            background-color: var(--active-color);
            color: white;
        }
        
        .rk-inactive {
            background-color: var(--inactive-color);
            color: white;
        }
        
        .rk-closed {
            background-color: var(--closed-color);
            color: white;
        }
        
        /* Кнопки действий */
        .action-buttons {
            position: sticky;
            top: 0;
            z-index: 20;
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        /* Индикаторы */
        .changed-indicator {
            width: 8px;
            height: 8px;
            background-color: #ffc107;
            border-radius: 50%;
            display: inline-block;
            margin-left: 5px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        
        /* Фильтры и поиск */
        .filter-card {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
        }
        
        /* Адаптивность */
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.85rem;
            }
            
            .grade-input {
                width: 60px;
                font-size: 0.85rem;
            }
            
            .student-cell {
                position: relative;
                box-shadow: none;
            }
        }
        
        /* Иконки статусов */
        .status-icon {
            font-size: 0.9rem;
            margin-right: 5px;
        }
        
        .passed { color: #28a745; }
        .failed { color: #dc3545; }
        .pending { color: #ffc107; }
        
        /* Цвета оценок */
        .grade-a { color: #28a745; font-weight: bold; }
        .grade-b { color: #17a2b8; font-weight: bold; }
        .grade-c { color: #ffc107; font-weight: bold; }
        .grade-d { color: #fd7e14; font-weight: bold; }
        .grade-f { color: #dc3545; font-weight: bold; }
        
        /* Кнопки для каждого студента */
        .student-actions {
            display: flex;
            gap: 5px;
            margin-top: 5px;
        }
        
        .save-btn, .lock-btn {
            padding: 2px 8px;
            font-size: 0.75rem;
            border-radius: 3px;
            border: 1px solid #dee2e6;
            background-color: white;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .save-btn:hover {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
        }
        
        .lock-btn:hover {
            background-color: #6c757d;
            color: white;
            border-color: #6c757d;
        }
        
        .save-btn.saved {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
        }
        
        .lock-btn.locked {
            background-color: #6c757d;
            color: white;
            border-color: #6c757d;
        }
        
        /* Прогресс бар */
        .progress-container {
            height: 20px;
            border-radius: 10px;
            overflow: hidden;
            background-color: #e9ecef;
            margin: 10px 0;
        }
        
        .progress-bar {
            height: 100%;
            background-color: var(--teacher-color);
            transition: width 0.3s;
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
                        <a class="nav-link active" href="teacher_grades.php">
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
        <!-- Панель управления -->
        <div class="action-buttons">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h4 class="mb-1"><i class="fas fa-chart-bar me-2 teacher-highlight"></i>Бағалау жүйесі</h4>
                    <p class="text-muted mb-0">Студенттердің бағаларын басқару</p>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary btn-sm" id="saveAllBtn">
                            <i class="fas fa-save me-1"></i> Барлығын сақтау
                            <span class="changed-indicator" id="saveIndicator" style="display: none;"></span>
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="revertBtn">
                            <i class="fas fa-undo me-1"></i> Барлығын қайтару
                        </button>
                    </div>
                    
                    <button class="btn btn-success btn-sm" id="calculateFinalBtn">
                        <i class="fas fa-calculator me-1"></i> Қорытынды есептеу
                    </button>
                    
                    <button class="btn btn-warning btn-sm" id="lockAllRk2Btn">
                        <i class="fas fa-lock me-1"></i> РК2 құлыптау
                    </button>
                </div>
            </div>
            
            <!-- Прогресс сохранения РК2 -->
            <div class="mt-3" id="rk2ProgressContainer" style="display: none;">
                <div class="d-flex justify-content-between mb-1">
                    <small>РК2 сақталу прогрессі:</small>
                    <small><span id="rk2SavedCount">0</span>/<span id="rk2TotalCount">0</span></small>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="rk2ProgressBar" style="width: 0%"></div>
                </div>
            </div>
            
            <!-- Индикатор изменений -->
            <div class="mt-3" id="changeInfo" style="display: none;">
                <div class="alert alert-warning alert-dismissible fade show py-2" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <span id="changeCount">0</span> өзгеріс сақталмаған
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Жабу"></button>
                </div>
            </div>
        </div>
        
        <!-- Фильтры и выбор курса -->
        <div class="filter-card">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="courseSelect" class="form-label">Курс таңдау</label>
                    <select class="form-select" id="courseSelect">
                        <option value="python">Python бағдарламалау (АИТ-21-01)</option>
                        <option value="database">Деректер қоры жүйелері (АИТ-21-02)</option>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label for="rkSelect" class="form-label">Рубеж таңдау</label>
                    <select class="form-select" id="rkSelect">
                        <option value="all">Барлық бағалар</option>
                        <option value="rk1" selected>РК1 бағалары (7-8 апта) - ЖАБЫҚ</option>
                        <option value="rk2">РК2 бағалары (13-14 апта) - БЕЛСЕНДІ</option>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label for="studentSearch" class="form-label">Студент бойынша іздеу</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="studentSearch" placeholder="Аты-жөні немесе ID...">
                    </div>
                </div>
            </div>
            
            <!-- Статусы РК -->
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="d-flex align-items-center gap-3">
                        <span class="fw-bold">Рубеждер статусы:</span>
                        <span class="rk-status rk-closed">
                            <i class="fas fa-lock me-1"></i> РК1: Жабық (7-8 апта)
                        </span>
                        <span class="rk-status rk-active">
                            <i class="fas fa-check-circle me-1"></i> РК2: Белсенді (13-14 апта)
                        </span>
                        <button class="btn btn-sm btn-outline-secondary ms-auto" id="toggleRk1Btn" disabled>
                            <i class="fas fa-lock me-1"></i> РК1 құлыптау
                        </button>
                        <button class="btn btn-sm btn-outline-danger" id="toggleRk2Btn">
                            <i class="fas fa-lock-open me-1"></i> РК2 құлыптау
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Основная таблица оценок -->
        <div class="content-card card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-users me-2"></i>Студенттердің бағалары - Python бағдарламалау (АИТ-21-01)
                    <small class="text-muted ms-2">10 студент, 1-ші семестр</small>
                </h5>
                <span class="badge bg-success">РК2 белсенді</span>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover grades-table" id="gradesTable">
                        <thead>
                            <tr>
                                <th class="student-cell">№</th>
                                <th class="student-cell">Студент</th>
                                <th class="student-cell">ID</th>
                                
                                <!-- РК1 -->
                                <th colspan="2" class="text-center rk1-badge">РК1 (7-8 апта)</th>
                                
                                <!-- РК2 -->
                                <th colspan="2" class="text-center rk2-badge">РК2 (13-14 апта)</th>
                                
                                <!-- Итоговые показатели -->
                                <th colspan="3" class="text-center bg-success text-white">Қорытынды көрсеткіштер</th>
                                
                                <!-- Действия -->
                                <th class="text-center">Әрекеттер</th>
                            </tr>
                            <tr>
                                <!-- Заголовки колонок -->
                                <th class="student-cell"></th>
                                <th class="student-cell">Аты-жөні</th>
                                <th class="student-cell">Студент ID</th>
                                
                                <!-- РК1 -->
                                <th>РК1 баллы<br><small>макс. 100</small></th>
                                <th>РК1 статусы</th>
                                
                                <!-- РК2 -->
                                <th>РК2 баллы<br><small>макс. 100</small></th>
                                <th>РК2 статусы</th>
                                
                                <!-- Итоговые -->
                                <th>Жалпы балл</th>
                                <th>Қорытынды баға</th>
                                <th>Сессияға рұқсат</th>
                                
                                <!-- Действия -->
                                <th>Балдарды сақтау</th>
                            </tr>
                        </thead>
                        <tbody id="gradesTableBody">
                            <!-- Данные будут загружены через JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Әр студенттің РК2 баллын жеке сақтап, содан кейін құлыптаңыз.
                        </span>
                    </div>
                    <div>
                        <span class="badge bg-light text-dark me-2">
                            <i class="fas fa-sync-alt me-1"></i> Соңғы жаңарту: <span id="lastUpdate">қазір</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Статистика -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="content-card card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-chart-pie me-2"></i>РК2 бағалары бойынша статистика</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center" id="gradesStats">
                            <!-- Статистика будет обновляться -->
                        </div>
                        <div class="mt-3">
                            <canvas id="rk2Chart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="content-card card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-check-circle me-2"></i>РК2 сақталу статусы</h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>РК2 басқару:</h6>
                            <ul class="mb-0 small">
                                <li>Әр студенттің РК2 баллын жеке сақтау керек</li>
                                <li>Барлық студенттердің РК2 баллдары сақталғаннан кейін ғана құлыптауға болады</li>
                                <li>Құлыптағаннан кейін өзгерту үшін деканатқа өтініш беру керек</li>
                                <li>РК1 қазірдің өзінде жабық және өзгертілмейді</li>
                            </ul>
                        </div>
                        
                        <div class="table-responsive mt-3">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Студент</th>
                                        <th>РК2 баллы</th>
                                        <th>Статусы</th>
                                        <th>Сақталды</th>
                                    </tr>
                                </thead>
                                <tbody id="rk2StatusTable">
                                    <!-- Данные будут загружены -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Модальное окно подтверждения блокировки РК2 -->
    <div class="modal fade" id="lockRk2Modal" tabindex="-1" aria-labelledby="lockRk2ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning" id="lockRk2ModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>РК2 құлыптау
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Жабу"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="fas fa-lock me-2"></i>
                        <strong>Ескерту!</strong> Бұл әрекетті кері қайтару мүмкін емес!
                    </div>
                    
                    <div id="lockCheckResults">
                        <!-- Результаты проверки будут здесь -->
                    </div>
                    
                    <div class="mt-3">
                        <label for="lockReason" class="form-label">Себеп (міндетті емес)</label>
                        <textarea class="form-control" id="lockReason" rows="2" placeholder="РК2 құлыптау себебі..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Болдырмау</button>
                    <button type="button" class="btn btn-danger" id="confirmLockRk2">РК2 құлыптау</button>
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
                        © 2025 UNIVER. Оқытушылар порталы.
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Глобальные переменные
        let gradesData = [];
        let changedGrades = new Set();
        let currentCourse = 'python';
        let rk1Locked = true; // РК1 закрыт
        let rk2Locked = false; // РК2 пока открыт
        let rk2SavedStudents = new Set(); // Студенты с сохраненным РК2
        
        // Примерные данные студентов (РК1 уже закрыт, работаем с РК2)
        const sampleStudents = [
            { 
                id: 1, 
                name: "Нұрлан С.", 
                studentId: "AIT210101", 
                rk1: 88, 
                rk2: null, // Еще не выставлен
                rk1Saved: true,
                rk2Saved: false,
                rk1Locked: true,
                rk2Locked: false
            },
            { 
                id: 2, 
                name: "Айгерім Қ.", 
                studentId: "AIT210102", 
                rk1: 92, 
                rk2: null,
                rk1Saved: true,
                rk2Saved: false,
                rk1Locked: true,
                rk2Locked: false
            },
            { 
                id: 3, 
                name: "Әлишер Б.", 
                studentId: "AIT210103", 
                rk1: 75, 
                rk2: null,
                rk1Saved: true,
                rk2Saved: false,
                rk1Locked: true,
                rk2Locked: false
            },
            { 
                id: 4, 
                name: "Мадина Т.", 
                studentId: "AIT210104", 
                rk1: 85, 
                rk2: null,
                rk1Saved: true,
                rk2Saved: false,
                rk1Locked: true,
                rk2Locked: false
            },
            { 
                id: 5, 
                name: "Данияр М.", 
                studentId: "AIT210105", 
                rk1: 52, 
                rk2: null,
                rk1Saved: true,
                rk2Saved: false,
                rk1Locked: true,
                rk2Locked: false
            },
            { 
                id: 6, 
                name: "Гүлназ Ж.", 
                studentId: "AIT210106", 
                rk1: 95, 
                rk2: null,
                rk1Saved: true,
                rk2Saved: false,
                rk1Locked: true,
                rk2Locked: false
            },
            { 
                id: 7, 
                name: "Аслан Р.", 
                studentId: "AIT210107", 
                rk1: 68, 
                rk2: null,
                rk1Saved: true,
                rk2Saved: false,
                rk1Locked: true,
                rk2Locked: false
            },
            { 
                id: 8, 
                name: "Сания С.", 
                studentId: "AIT210108", 
                rk1: 79, 
                rk2: null,
                rk1Saved: true,
                rk2Saved: false,
                rk1Locked: true,
                rk2Locked: false
            },
            { 
                id: 9, 
                name: "Бекзат Қ.", 
                studentId: "AIT210109", 
                rk1: 42, 
                rk2: null,
                rk1Saved: true,
                rk2Saved: false,
                rk1Locked: true,
                rk2Locked: false
            },
            { 
                id: 10, 
                name: "Диана А.", 
                studentId: "AIT210110", 
                rk1: 87, 
                rk2: null,
                rk1Saved: true,
                rk2Saved: false,
                rk1Locked: true,
                rk2Locked: false
            }
        ];
        
        // Инициализация данных
        function initGradesData() {
            // Загружаем из localStorage или используем примерные данные
            const savedData = localStorage.getItem(`teacher_grades_${currentCourse}`);
            if (savedData) {
                gradesData = JSON.parse(savedData);
            } else {
                gradesData = JSON.parse(JSON.stringify(sampleStudents));
            }
            
            // Обновляем набор сохраненных студентов
            updateSavedStudentsSet();
            
            renderGradesTable();
            updateStats();
            updateRk2Progress();
            updateChangeIndicator();
        }
        
        // Обновление набора сохраненных студентов
        function updateSavedStudentsSet() {
            rk2SavedStudents.clear();
            gradesData.forEach(student => {
                if (student.rk2Saved) {
                    rk2SavedStudents.add(student.id);
                }
            });
        }
        
        // Отрисовка таблицы оценок
        function renderGradesTable() {
            const tableBody = document.getElementById('gradesTableBody');
            tableBody.innerHTML = '';
            
            gradesData.forEach((student, index) => {
                const row = document.createElement('tr');
                
                // Расчет итоговых показателей
                const totalScore = (student.rk1 || 0) + (student.rk2 || 0);
                const finalGrade = calculateFinalGrade(student);
                const admissionStatus = checkAdmission(student);
                
                row.innerHTML = `
                    <td class="student-cell">${index + 1}</td>
                    <td class="student-cell fw-bold">${student.name}</td>
                    <td class="student-cell text-muted">${student.studentId}</td>
                    
                    <!-- РК1 -->
                    <td>
                        <input type="number" 
                                                              class="grade-input rk1-input ${student.rk1Locked ? 'disabled' : ''}" 
                               data-student="${student.id}" 
                               data-type="rk1"
                               value="${student.rk1 !== null ? student.rk1 : ''}" 
                               min="0" max="100" 
                               ${student.rk1Locked ? 'disabled' : ''}>
                    </td>
                    <td>
                        <span class="rk-status ${student.rk1Locked ? 'rk-closed' : 'rk-active'}">
                            <i class="fas fa-${student.rk1Locked ? 'lock' : 'check-circle'} me-1"></i>
                            ${student.rk1Locked ? 'Жабық' : 'Белсенді'}
                        </span>
                    </td>
                    
                    <!-- РК2 -->
                    <td>
                        <input type="number" 
                               class="grade-input rk2-input ${student.rk2Locked ? 'disabled' : ''} ${student.rk2Saved ? 'saved' : ''}" 
                               data-student="${student.id}" 
                               data-type="rk2"
                               value="${student.rk2 !== null ? student.rk2 : ''}" 
                               min="0" max="100" 
                               ${student.rk2Locked ? 'disabled' : ''}
                               placeholder="0-100">
                    </td>
                    <td>
                        <span class="rk-status ${student.rk2Locked ? 'rk-closed' : student.rk2Saved ? 'rk-inactive' : 'rk-active'}">
                            <i class="fas fa-${student.rk2Locked ? 'lock' : student.rk2Saved ? 'check' : 'edit'} me-1"></i>
                            ${student.rk2Locked ? 'Жабық' : student.rk2Saved ? 'Сақталды' : 'Өңдеу'}
                        </span>
                    </td>
                    
                    <!-- Итоговые показатели -->
                    <td class="fw-bold ${getGradeClass(totalScore)}">
                        ${totalScore}
                    </td>
                    <td class="fw-bold ${getGradeClass(finalGrade)}">
                        ${getLetterGrade(finalGrade)}
                    </td>
                    <td>
                        <span class="status-icon ${admissionStatus ? 'passed' : 'failed'}">
                            <i class="fas fa-${admissionStatus ? 'check-circle' : 'times-circle'}"></i>
                            ${admissionStatus ? 'Берілді' : 'Берілмеді'}
                        </span>
                    </td>
                    
                    <!-- Действия -->
                    <td>
                        <div class="student-actions">
                            <button class="save-btn ${student.rk2Saved ? 'saved' : ''}" 
                                    data-student="${student.id}"
                                    ${student.rk2Saved || student.rk2Locked ? 'disabled' : ''}>
                                <i class="fas fa-${student.rk2Saved ? 'check' : 'save'}"></i>
                                ${student.rk2Saved ? 'Сақталды' : 'Сақтау'}
                            </button>
                            <button class="lock-btn ${student.rk2Locked ? 'locked' : ''}" 
                                    data-student="${student.id}"
                                    ${!student.rk2Saved || student.rk2Locked ? 'disabled' : ''}>
                                <i class="fas fa-${student.rk2Locked ? 'lock' : 'lock-open'}"></i>
                                Құлыптау
                            </button>
                        </div>
                    </td>
                `;
                
                tableBody.appendChild(row);
            });
            
            // Добавляем обработчики событий
            attachGradeEventListeners();
            attachStudentActionListeners();
        }
        
        // Расчет итоговой оценки
        function calculateFinalGrade(student) {
            const rk1 = student.rk1 || 0;
            const rk2 = student.rk2 || 0;
            return (rk1 + rk2) / 2;
        }
        
        // Проверка допуска к сессии
        function checkAdmission(student) {
            const rk1 = student.rk1 || 0;
            const rk2 = student.rk2 || 0;
            
            // Правила КазНУ:
            // 1. Каждый РК минимум 50 баллов
            // 2. Сумма двух РК больше 100
            return rk1 >= 50 && rk2 >= 50 && (rk1 + rk2) > 100;
        }
        
        // Получение буквенной оценки
        function getLetterGrade(score) {
            if (score >= 90) return 'A';
            if (score >= 75) return 'B';
            if (score >= 60) return 'C';
            if (score >= 50) return 'D';
            return 'F';
        }
        
        // Получение класса для цвета оценки
        function getGradeClass(score) {
            if (score >= 90) return 'grade-a';
            if (score >= 75) return 'grade-b';
            if (score >= 60) return 'grade-c';
            if (score >= 50) return 'grade-d';
            return 'grade-f';
        }
        
        // Добавление обработчиков событий для полей ввода
        function attachGradeEventListeners() {
            document.querySelectorAll('.grade-input').forEach(input => {
                input.addEventListener('change', handleGradeChange);
                input.addEventListener('input', handleGradeInput);
                
                // Для РК2 полей добавляем дополнительный обработчик
                if (input.classList.contains('rk2-input')) {
                    input.addEventListener('blur', validateRk2Grade);
                }
            });
        }
        
        // Добавление обработчиков для кнопок студентов
        function attachStudentActionListeners() {
            document.querySelectorAll('.save-btn').forEach(btn => {
                btn.addEventListener('click', saveStudentGrade);
            });
            
            document.querySelectorAll('.lock-btn').forEach(btn => {
                btn.addEventListener('click', lockStudentRk2);
            });
        }
        
        // Валидация оценки РК2
        function validateRk2Grade(e) {
            const input = e.target;
            const value = parseInt(input.value);
            
            if (isNaN(value) || value < 0 || value > 100) {
                input.classList.add('is-invalid');
                showTooltip(input, '0-100 аралығындағы сан енгізіңіз');
                return false;
            }
            
            input.classList.remove('is-invalid');
            return true;
        }
        
        // Сохранение оценки студента
        function saveStudentGrade(e) {
            const button = e.target.closest('.save-btn');
            const studentId = parseInt(button.getAttribute('data-student'));
            
            // Находим студента
            const student = gradesData.find(s => s.id === studentId);
            if (!student) return;
            
            // Находим поле ввода РК2
            const rk2Input = document.querySelector(`.rk2-input[data-student="${studentId}"]`);
            if (!rk2Input) return;
            
            // Проверяем валидность
            const value = parseInt(rk2Input.value);
            if (isNaN(value) || value < 0 || value > 100) {
                showNotification('0-100 аралығындағы сан енгізіңіз', 'danger');
                return;
            }
            
            // Сохраняем оценку
            student.rk2 = value;
            student.rk2Saved = true;
            student.rk2Locked = false; // После сохранения еще не блокируем
            
            // Обновляем интерфейс
            rk2Input.classList.add('saved');
            button.innerHTML = '<i class="fas fa-check"></i> Сақталды';
            button.classList.add('saved');
            button.disabled = false; // Кнопка разблокирована для блокировки
            
            // Обновляем статус
            const statusCell = rk2Input.parentElement.nextElementSibling;
            statusCell.innerHTML = `
                <span class="rk-status rk-inactive">
                    <i class="fas fa-check me-1"></i>
                    Сақталды
                </span>
            `;
            
            // Добавляем в сохраненные
            rk2SavedStudents.add(studentId);
            
            // Обновляем прогресс
            updateRk2Progress();
            
            // Обновляем итоговые показатели
            updateStudentRow(studentId);
            
            // Сохраняем в localStorage
            saveToLocalStorage();
            
            showNotification(`${student.name} студентінің РК2 бағасы сақталды: ${value}`, 'success');
        }
        
        // Блокировка РК2 для отдельного студента
        function lockStudentRk2(e) {
            const button = e.target.closest('.lock-btn');
            const studentId = parseInt(button.getAttribute('data-student'));
            
            // Находим студента
            const student = gradesData.find(s => s.id === studentId);
            if (!student) return;
            
            // Проверяем, сохранена ли оценка
            if (!student.rk2Saved) {
                showNotification('Алдымен бағаны сақтаңыз!', 'warning');
                return;
            }
            
            if (confirm(`${student.name} студентінің РК2 бағасын құлыптағыңыз келе ме?`)) {
                // Блокируем
                student.rk2Locked = true;
                
                // Обновляем интерфейс
                const rk2Input = document.querySelector(`.rk2-input[data-student="${studentId}"]`);
                if (rk2Input) {
                    rk2Input.disabled = true;
                    rk2Input.classList.add('disabled');
                }
                
                button.innerHTML = '<i class="fas fa-lock"></i> Құлыпталды';
                button.classList.add('locked');
                button.disabled = true;
                
                // Обновляем статус
                const statusCell = rk2Input.parentElement.nextElementSibling;
                statusCell.innerHTML = `
                    <span class="rk-status rk-closed">
                        <i class="fas fa-lock me-1"></i>
                        Жабық
                    </span>
                `;
                
                // Сохраняем в localStorage
                saveToLocalStorage();
                
                showNotification(`${student.name} студентінің РК2 құлыпталды`, 'warning');
                
                // Проверяем, можно ли блокировать весь РК2
                checkRk2LockStatus();
            }
        }
        
        // Проверка статуса блокировки РК2
        function checkRk2LockStatus() {
            const allStudents = gradesData.length;
            const lockedStudents = gradesData.filter(s => s.rk2Locked).length;
            
            // Если все студенты заблокированы, показываем уведомление
            if (lockedStudents === allStudents) {
                document.getElementById('lockAllRk2Btn').disabled = false;
                showNotification('Барлық студенттердің РК2 құлыпталды. Енді бүкіл РК2 құлыптауға болады.', 'info');
            }
        }
        
        // Обновление строки студента
        function updateStudentRow(studentId) {
            const student = gradesData.find(s => s.id === studentId);
            if (!student) return;
            
            const rowIndex = gradesData.findIndex(s => s.id === studentId);
            const row = document.querySelectorAll('#gradesTableBody tr')[rowIndex];
            
            if (!row) return;
            
            // Пересчитываем итоги
            const totalScore = (student.rk1 || 0) + (student.rk2 || 0);
            const finalGrade = calculateFinalGrade(student);
            const admissionStatus = checkAdmission(student);
            
            // Обновляем ячейки
            const totalCell = row.cells[row.cells.length - 4]; // Изменено из-за новой колонки
            const gradeCell = row.cells[row.cells.length - 3];
            const admissionCell = row.cells[row.cells.length - 2];
            
            totalCell.textContent = totalScore;
            totalCell.className = `fw-bold ${getGradeClass(totalScore)}`;
            
            gradeCell.textContent = getLetterGrade(finalGrade);
            gradeCell.className = `fw-bold ${getGradeClass(finalGrade)}`;
            
            admissionCell.innerHTML = `
                <span class="status-icon ${admissionStatus ? 'passed' : 'failed'}">
                    <i class="fas fa-${admissionStatus ? 'check-circle' : 'times-circle'}"></i>
                    ${admissionStatus ? 'Берілді' : 'Берілмеді'}
                </span>
            `;
            
            // Обновляем admission в данных
            student.admission = admissionStatus;
        }
        
        // Обновление прогресса РК2
        function updateRk2Progress() {
            const savedCount = rk2SavedStudents.size;
            const totalCount = gradesData.length;
            const progress = (savedCount / totalCount) * 100;
            
            document.getElementById('rk2SavedCount').textContent = savedCount;
            document.getElementById('rk2TotalCount').textContent = totalCount;
            document.getElementById('rk2ProgressBar').style.width = `${progress}%`;
            
            // Показываем/скрываем прогресс бар
            const container = document.getElementById('rk2ProgressContainer');
            if (savedCount > 0) {
                container.style.display = 'block';
            } else {
                container.style.display = 'none';
            }
            
            // Обновляем таблицу статусов
            updateRk2StatusTable();
        }
        
        // Обновление таблицы статусов РК2
        function updateRk2StatusTable() {
            const tableBody = document.getElementById('rk2StatusTable');
            tableBody.innerHTML = '';
            
            gradesData.forEach(student => {
                const row = document.createElement('tr');
                
                let statusBadge, statusText;
                if (student.rk2Locked) {
                    statusBadge = 'badge bg-secondary';
                    statusText = 'Құлыпталды';
                } else if (student.rk2Saved) {
                    statusBadge = 'badge bg-success';
                    statusText = 'Сақталды';
                } else {
                    statusBadge = 'badge bg-warning';
                    statusText = 'Күтілуде';
                }
                
                row.innerHTML = `
                    <td>${student.name}</td>
                    <td>${student.rk2 !== null ? student.rk2 : '—'}</td>
                    <td><span class="${statusBadge}">${statusText}</span></td>
                    <td>
                        <i class="fas fa-${student.rk2Saved ? 'check text-success' : 'times text-danger'}"></i>
                    </td>
                `;
                
                tableBody.appendChild(row);
            });
        }
        
        // Обновление статистики
        function updateStats() {
            // Статистика только по РК2
            const rk2Grades = gradesData
                .filter(s => s.rk2 !== null)
                .map(s => s.rk2);
            
            const stats = {
                totalStudents: gradesData.length,
                withRk2: rk2Grades.length,
                averageRk2: rk2Grades.length > 0 
                    ? Math.round(rk2Grades.reduce((a, b) => a + b, 0) / rk2Grades.length)
                    : 0,
                savedCount: rk2SavedStudents.size
            };
            
            // Обновляем HTML статистики
            document.getElementById('gradesStats').innerHTML = `
                <div class="col-4 mb-3">
                    <div class="stat-number text-primary">${stats.withRk2}</div>
                    <div class="stat-label">РК2 бар</div>
                </div>
                <div class="col-4 mb-3">
                    <div class="stat-number text-success">${stats.averageRk2}</div>
                    <div class="stat-label">РК2 орташа</div>
                </div>
                <div class="col-4 mb-3">
                    <div class="stat-number ${stats.savedCount === stats.totalStudents ? 'text-success' : 'text-warning'}">${stats.savedCount}</div>
                    <div class="stat-label">Сақталды</div>
                </div>
            `;
            
            // Обновляем график распределения РК2
            updateRk2Chart(rk2Grades);
        }
        
        // Обновление графика РК2
        function updateRk2Chart(grades) {
            const ctx = document.getElementById('rk2Chart').getContext('2d');
            
            // Удаляем старый график если существует
            if (window.rk2Chart) {
                window.rk2Chart.destroy();
            }
            
            // Распределение по диапазонам
            const ranges = {
                '90-100': grades.filter(g => g >= 90).length,
                '75-89': grades.filter(g => g >= 75 && g < 90).length,
                '60-74': grades.filter(g => g >= 60 && g < 75).length,
                '50-59': grades.filter(g => g >= 50 && g < 60).length,
                '0-49': grades.filter(g => g < 50).length
            };
            
            window.rk2Chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['90-100', '75-89', '60-74', '50-59', '0-49'],
                    datasets: [{
                        label: 'Студенттер саны',
                        data: [
                            ranges['90-100'],
                            ranges['75-89'],
                            ranges['60-74'],
                            ranges['50-59'],
                            ranges['0-49']
                        ],
                        backgroundColor: [
                            '#28a745',
                            '#17a2b8',
                            '#ffc107',
                            '#fd7e14',
                            '#dc3545'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'РК2 баллдарының таралуы'
                        }
                    }
                }
            });
        }
        
        // Сохранение всех изменений
        function saveAllChanges() {
            // Сохраняем все оценки РК2, которые еще не сохранены
            let savedCount = 0;
            
            gradesData.forEach(student => {
                if (!student.rk2Saved && student.rk2 !== null) {
                    student.rk2Saved = true;
                    rk2SavedStudents.add(student.id);
                    savedCount++;
                }
            });
            
            if (savedCount > 0) {
                saveToLocalStorage();
                renderGradesTable();
                updateRk2Progress();
                showNotification(`${savedCount} студенттің РК2 бағасы сақталды`, 'success');
            } else {
                showNotification('Сақтау үшін жаңа өзгеріс жоқ', 'info');
            }
        }
        
        // Сохранение в localStorage
        function saveToLocalStorage() {
            localStorage.setItem(`teacher_grades_${currentCourse}`, JSON.stringify(gradesData));
            updateLastUpdateTime();
        }
        
        // Блокировка всего РК2
        function lockAllRk2() {
            // Проверяем, все ли студенты имеют сохраненные оценки
            const unsavedStudents = gradesData.filter(s => !s.rk2Saved);
            const unlockedStudents = gradesData.filter(s => !s.rk2Locked);
            
            if (unsavedStudents.length > 0) {
                const names = unsavedStudents.map(s => s.name).join(', ');
                showNotification(`Алдымен мына студенттердің бағасын сақтаңыз: ${names}`, 'danger');
                return;
            }
            
            // Показываем модальное окно подтверждения
            const modal = new bootstrap.Modal(document.getElementById('lockRk2Modal'));
            
            // Обновляем содержимое модального окна
            const resultsDiv = document.getElementById('lockCheckResults');
            resultsDiv.innerHTML = `
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Барлық студенттердің РК2 бағасы сақталды</strong>
                    <ul class="mt-2 mb-0">
                        <li>Жалпы студенттер: ${gradesData.length}</li>
                        <li>Сақталған: ${rk2SavedStudents.size}</li>
                        <li>Құлыпталған: ${gradesData.filter(s => s.rk2Locked).length}</li>
                    </ul>
                </div>
            `;
            
            modal.show();
        }
        
        // Подтверждение блокировки РК2
        function confirmLockAllRk2() {
            // Блокируем всех студентов
            gradesData.forEach(student => {
                if (!student.rk2Locked) {
                    student.rk2Locked = true;
                }
            });
            
            rk2Locked = true;
            
            // Сохраняем
            saveToLocalStorage();
            
            // Обновляем интерфейс
            renderGradesTable();
            
            // Блокируем кнопки
            document.getElementById('toggleRk2Btn').innerHTML = '<i class="fas fa-lock me-1"></i> РК2 құлыпталды';
            document.getElementById('toggleRk2Btn').classList.remove('btn-outline-danger');
            document.getElementById('toggleRk2Btn').classList.add('btn-secondary');
            document.getElementById('toggleRk2Btn').disabled = true;
            
            document.getElementById('lockAllRk2Btn').disabled = true;
            
            // Закрываем модальное окно
            const modal = bootstrap.Modal.getInstance(document.getElementById('lockRk2Modal'));
            modal.hide();
            
            showNotification('РК2 толығымен құлыпталды! Енді өзгерту мүмкін емес.', 'warning');
        }
        
        // Обновление времени последнего обновления
        function updateLastUpdateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('kz-KZ', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            document.getElementById('lastUpdate').textContent = timeString;
        }
        
        // Показать уведомление
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            notification.style.cssText = `
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            `;
            
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 3000);
        }
        
        // Обновление индикатора изменений
        function updateChangeIndicator() {
            // В этой системе изменения сохраняются сразу, так что индикатор не нужен
        }
        
        // Обработчики для полей ввода (остались от старой системы)
        function handleGradeChange(e) {
            // Не используется в новой системе
        }
        
        function handleGradeInput(e) {
            // Не используется в новой системе
        }
        
        // Инициализация при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            initGradesData();
            updateLastUpdateTime();
            
            // Обработчики кнопок
            document.getElementById('saveAllBtn').addEventListener('click', saveAllChanges);
            document.getElementById('lockAllRk2Btn').addEventListener('click', lockAllRk2);
            document.getElementById('confirmLockRk2').addEventListener('click', confirmLockAllRk2);
            
            document.getElementById('calculateFinalBtn').addEventListener('click', function() {
                gradesData.forEach(student => {
                    updateStudentRow(student.id);
                });
                showNotification('Қорытынды бағалар есептелді', 'success');
            });
            
            // Выбор курса
            document.getElementById('courseSelect').addEventListener('change', function() {
                currentCourse = this.value;
                initGradesData();
            });
            
            // Навигация
            const currentPage = 'teacher_grades.php';
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPage) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>