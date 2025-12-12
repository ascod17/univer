<!DOCTYPE html>
<html lang="kz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сабақ кестесі | UNIVER - Оқытушы</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --univer-blue: #003366;
            --univer-dark: #123456;
            --univer-light: #0056b3;
            --univer-accent: #e9f2ff;
            --teacher-color: #32406bff;
            --lecture-color: #D9E8FB;
            --lab-color: #E8F5E8;
            --practice-color: #FFF3CD;
            --seminar-color: #F3E5F5;
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
        
        /* Таблица расписания */
        .schedule-header {
            background: linear-gradient(135deg, var(--teacher-color), #285692ff);
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 15px 20px;
        }
        
        .schedule-table {
            border-collapse: collapse;
            width: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            background: white;
            border-radius: 0 0 10px 10px;
            overflow: hidden;
        }
        
        .schedule-table th {
            background-color: var(--univer-accent);
            color: var(--teacher-color);
            font-weight: 600;
            padding: 12px;
            text-align: center;
            border: 1px solid #dee2e6;
        }
        
        .schedule-table td {
            padding: 10px;
            border: 1px solid #dee2e6;
            vertical-align: top;
            min-height: 100px;
            position: relative;
        }
        
        .time-column {
            background-color: #f8f9fa;
            font-weight: 600;
            width: 80px;
            text-align: center;
            color: var(--teacher-color);
        }
        
        .lesson-card {
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 6px;
            font-size: 0.85rem;
            transition: transform 0.2s;
            position: relative;
            cursor: pointer;
        }
        
        .lesson-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .lecture { background-color: var(--lecture-color); border-left: 4px solid #0d6efd; }
        .lab { background-color: var(--lab-color); border-left: 4px solid #198754; }
        .practice { background-color: var(--practice-color); border-left: 4px solid #ffc107; }
        .seminar { background-color: var(--seminar-color); border-left: 4px solid #9c27b0; }
        
        .subject-type {
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 3px;
            color: white;
            display: inline-block;
            margin-bottom: 5px;
        }
        
        .type-lecture { background-color: #0d6efd; }
        .type-lab { background-color: #198754; }
        .type-practice { background-color: #ffc107; color: #000; }
        .type-seminar { background-color: #9c27b0; }
        
        .room-badge {
            background-color: var(--teacher-color);
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.75rem;
            display: inline-block;
            margin-top: 5px;
        }
        
        .empty-cell {
            background-color: #f8f9fa;
            min-height: 80px;
        }
        
        /* Кнопки редактирования */
        .lesson-actions {
            position: absolute;
            top: 5px;
            right: 5px;
            opacity: 0;
            transition: opacity 0.2s;
            display: flex;
            gap: 5px;
        }
        
        .lesson-card:hover .lesson-actions {
            opacity: 1;
        }
        
        .lesson-action-btn {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .lesson-action-btn:hover {
            background-color: var(--teacher-color);
            color: white;
            border-color: var(--teacher-color);
        }
        
        .add-lesson-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            min-height: 80px;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s;
            border-radius: 4px;
            flex-direction: column;
            gap: 5px;
        }
        
        .add-lesson-btn:hover {
            background-color: rgba(50, 64, 107, 0.1);
            color: var(--teacher-color);
        }
        
        /* Панель управления */
        .control-panel {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
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
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--teacher-color);
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        /* Адаптивность */
        @media (max-width: 992px) {
            .schedule-table {
                font-size: 0.85rem;
            }
            
            .lesson-card {
                padding: 8px;
                font-size: 0.8rem;
            }
            
            .time-column {
                width: 60px;
            }
        }
        
        @media (max-width: 768px) {
            .schedule-table {
                display: block;
                overflow-x: auto;
            }
            
            .control-panel {
                flex-direction: column;
            }
        }
        
        .current-week {
            background-color: #e7f1ff;
        }
        
        .draggable {
            cursor: move;
        }
        
        .drop-zone {
            min-height: 100px;
            border: 2px dashed #dee2e6;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            transition: all 0.3s;
        }
        
        .drop-zone:hover {
            border-color: var(--teacher-color);
            background-color: rgba(50, 64, 107, 0.05);
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
                        <a class="nav-link active" href="teacher_keste.php">
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
        <!-- Панель управления -->
        <div class="control-panel">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h4 class="mb-1"><i class="fas fa-calendar-alt me-2 teacher-highlight"></i>Сабақ кестесі</h4>
                    <p class="text-muted mb-0">Жеке сабақ кестесіңіз және басқару құралдары</p>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary btn-sm" id="prevWeekBtn">
                            <i class="fas fa-arrow-left me-1"></i> Алдыңғы апта
                        </button>
                        <select class="form-select form-select-sm" id="weekSelector" style="width: 200px;">
                            <option value="8" selected>Апта 8. 20.10.2025 - 26.10.2025</option>
                        </select>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="nextWeekBtn">
                            Келесі апта <i class="fas fa-arrow-right ms-1"></i>
                        </button>
                    </div>
                    
                    <button class="btn btn-primary btn-sm" id="addLessonBtn" data-bs-toggle="modal" data-bs-target="#addLessonModal">
                        <i class="fas fa-plus me-1"></i> Жаңа сабақ
                    </button>
                    
                    <button class="btn btn-success btn-sm" id="saveScheduleBtn">
                        <i class="fas fa-save me-1"></i> Сақтау
                    </button>
                    
                    <button class="btn btn-warning btn-sm" id="clearAllBtn">
                        <i class="fas fa-trash me-1"></i> Тазарту
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Сабақ кестесі -->
        <div class="schedule-header">
            <h5 class="mb-0">
                <i class="fas fa-table me-2"></i>
                Жеке сабақ кестесіңіз - 8-апта (20.10.2025 - 26.10.2025)
                <span id="scheduleStatus" class="badge bg-light text-dark ms-2">Сақталмаған өзгерістер бар</span>
            </h5>
        </div>
        
        <table class="schedule-table" id="scheduleTable">
            <thead>
                <tr>
                    <th class="time-column">Уақыт</th>
                    <th>Дүйсенбі</th>
                    <th>Сейсенбі</th>
                    <th>Сәрсенбі</th>
                    <th>Бейсенбі</th>
                    <th>Жұма</th>
                    <th>Сенбі</th>
                </tr>
            </thead>
            <tbody id="scheduleBody">
                <!-- Расписание будет генерироваться JavaScript -->
            </tbody>
        </table>
        
        <!-- Статистика -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="content-card card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Сабақтар статистикасы</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center" id="lessonStats">
                            <!-- Статистика будет обновляться -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="content-card card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Нұсқаулар</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled small">
                            <li class="mb-2">✅ Сабақ қосу үшін бос ұяшыққа басыңыз</li>
                            <li class="mb-2">✏️ Сабақты өзгерту үшін өңдеу түймесін басыңыз</li>
                            <li class="mb-2">🗑️ Сабақты өшіру үшін жойу түймесін басыңыз</li>
                            <li class="mb-2">📅 Сабақты тартып басқа уақытқа жылжытуға болады</li>
                            <li>💾 Өзгерістерді сақтау үшін "Сақтау" түймесін басыңыз</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Модальное окно добавления/редактирования занятия -->
    <div class="modal fade" id="lessonModal" tabindex="-1" aria-labelledby="lessonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lessonModalLabel">Жаңа сабақ қосу</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Жабу"></button>
                </div>
                <div class="modal-body">
                    <form id="lessonForm">
                        <input type="hidden" id="lessonId">
                        <input type="hidden" id="cellId">
                        
                        <div class="mb-3">
                            <label for="lessonSubject" class="form-label">Пән атауы *</label>
                            <select class="form-select" id="lessonSubject" required>
                                <option value="">Таңдаңыз...</option>
                                <option value="Python бағдарламалау">Python бағдарламалау</option>
                                <option value="Деректер қоры">Деректер қоры</option>
                                <option value="Веб-бағдарламалау">Веб-бағдарламалау</option>
                                <option value="Компьютерлік желілер">Компьютерлік желілер</option>
                                <option value="Мобильді қосымшалар">Мобильді қосымшалар</option>
                                <option value="Жасанды интеллект">Жасанды интеллект</option>
                                <option value="Бұлттық технологиялар">Бұлттық технологиялар</option>
                                <option value="Киберқауіпсіздік">Киберқауіпсіздік</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="lessonType" class="form-label">Сабақ түрі *</label>
                            <select class="form-select" id="lessonType" required>
                                <option value="lecture">Дәріс</option>
                                <option value="lab">Зертханалық жұмыс</option>
                                <option value="practice">Практика</option>
                                <option value="seminar">Семинар</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="lessonGroup" class="form-label">Топ *</label>
                            <select class="form-select" id="lessonGroup" required>
                                <option value="">Таңдаңыз...</option>
                                <option value="АИТ-21-01">АИТ-21-01 (25 студент)</option>
                                <option value="АИТ-21-02">АИТ-21-02 (20 студент)</option>
                                <option value="АИТ-20-03">АИТ-20-03 (18 студент)</option>
                                <option value="АИТ-22-01">АИТ-22-01 (30 студент)</option>
                                <option value="АИТ-19-04">АИТ-19-04 (15 студент)</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="lessonRoom" class="form-label">Кабинет *</label>
                            <input type="text" class="form-control" id="lessonRoom" placeholder="Мысалы: ФИТ, 119" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="lessonCredits" class="form-label">Кредит саны</label>
                            <input type="number" class="form-control" id="lessonCredits" min="1" max="10" value="3">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Күн және уақыт</label>
                            <div class="d-flex gap-2">
                                <select class="form-select" id="lessonDay">
                                    <option value="0">Дүйсенбі</option>
                                    <option value="1">Сейсенбі</option>
                                    <option value="2">Сәрсенбі</option>
                                    <option value="3">Бейсенбі</option>
                                    <option value="4">Жұма</option>
                                    <option value="5">Сенбі</option>
                                </select>
                                <select class="form-select" id="lessonTime">
                                    <option value="0">08:00-09:30</option>
                                    <option value="1">09:40-11:10</option>
                                    <option value="2">11:20-12:50</option>
                                    <option value="3">13:30-15:00</option>
                                    <option value="4">15:10-16:40</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Жабу</button>
                    <button type="button" class="btn btn-danger" id="deleteLessonBtn" style="display: none;">Жою</button>
                    <button type="button" class="btn btn-primary" id="saveLessonBtn">Сақтау</button>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Глобальные переменные
        let scheduleData = {};
        let currentWeek = 8;
        let hasUnsavedChanges = false;
        let editMode = false;
        let currentLessonId = null;
        
        // Временные интервалы
        const timeSlots = [
            { start: "08:00", end: "09:30" },
            { start: "09:40", end: "11:10" },
            { start: "11:20", end: "12:50" },
            { start: "13:30", end: "15:00" },
            { start: "15:10", end: "16:40" }
        ];
        
        // Дни недели
        const days = ["Дүйсенбі", "Сейсенбі", "Сәрсенбі", "Бейсенбі", "Жұма", "Сенбі"];
        
        // Типы занятий
        const lessonTypes = {
            lecture: { name: "Дәріс", class: "lecture", badge: "type-lecture", color: "#0d6efd" },
            lab: { name: "Зертханалық", class: "lab", badge: "type-lab", color: "#198754" },
            practice: { name: "Практика", class: "practice", badge: "type-practice", color: "#ffc107" },
            seminar: { name: "Семинар", class: "seminar", badge: "type-seminar", color: "#9c27b0" }
        };
        
        // Примерные начальные данные
        const initialSchedule = {
            "0_0": { // Дүйсенбі, 08:00
                id: 1,
                subject: "Python бағдарламалау",
                type: "lecture",
                group: "АИТ-21-01",
                room: "ФИТ, 119",
                credits: 3
            },
            "0_1": { // Дүйсенбі, 09:40
                id: 2,
                subject: "Python бағдарламалау",
                type: "lab",
                group: "АИТ-21-01",
                room: "ФИТ, 323 (комп. класс)",
                credits: 3
            },
            "2_0": { // Сәрсенбі, 08:00
                id: 3,
                subject: "Деректер қоры",
                type: "lab",
                group: "АИТ-21-02",
                room: "ФИТ, 216",
                credits: 2
            },
            "2_1": { // Сәрсенбі, 09:40
                id: 4,
                subject: "Деректер қоры",
                type: "lecture",
                group: "АИТ-21-02",
                room: "ФИТ, 402",
                credits: 2
            },
            "3_1": { // Бейсенбі, 09:40
                id: 5,
                subject: "Веб-бағдарламалау",
                type: "practice",
                group: "АИТ-20-03",
                room: "ФИТ, 515",
                credits: 4
            },
            "1_2": { // Сейсенбі, 11:20
                id: 6,
                subject: "Компьютерлік желілер",
                type: "seminar",
                group: "АИТ-22-01",
                room: "ФИТ, 233",
                credits: 3
            },
            "3_2": { // Бейсенбі, 11:20
                id: 7,
                subject: "Веб-бағдарламалау",
                type: "lecture",
                group: "АИТ-20-03",
                room: "ФИТ, 116а",
                credits: 4
            },
            "2_3": { // Сәрсенбі, 13:30
                id: 8,
                subject: "Компьютерлік желілер",
                type: "lab",
                group: "АИТ-22-01",
                room: "ФИТ, 233 (комп. класс)",
                credits: 3
            },
            "3_4": { // Бейсенбі, 15:10
                id: 9,
                subject: "Мобильді қосымшалар",
                type: "practice",
                group: "АИТ-19-04",
                room: "ФИТ, 310",
                credits: 5
            }
        };
        
        // Инициализация расписания
        function initSchedule() {
            // Загружаем данные из localStorage или используем начальные
            const savedData = localStorage.getItem(`teacher_schedule_week_${currentWeek}`);
            if (savedData) {
                scheduleData = JSON.parse(savedData);
            } else {
                scheduleData = JSON.parse(JSON.stringify(initialSchedule));
            }
            
            renderSchedule();
            updateStats();
            updateScheduleStatus();
        }
        
        // Отрисовка расписания
        function renderSchedule() {
            const scheduleBody = document.getElementById('scheduleBody');
            scheduleBody.innerHTML = '';
            
            // Создаем строки для каждого временного интервала
            timeSlots.forEach((timeSlot, timeIndex) => {
                const row = document.createElement('tr');
                
                // Ячейка времени
                const timeCell = document.createElement('td');
                timeCell.className = 'time-column';
                timeCell.innerHTML = `${timeSlot.start}<br>${timeSlot.end}`;
                row.appendChild(timeCell);
                
                // Ячейки для каждого дня
                days.forEach((day, dayIndex) => {
                    const cell = document.createElement('td');
                    const cellId = `${dayIndex}_${timeIndex}`;
                    
                    // Если есть занятие в этой ячейке
                    if (scheduleData[cellId]) {
                        const lesson = scheduleData[cellId];
                        const lessonType = lessonTypes[lesson.type];
                        
                        cell.className = 'current-week';
                        cell.innerHTML = `
                            <div class="lesson-card ${lessonType.class} draggable" data-cell-id="${cellId}">
                                <div class="lesson-actions">
                                    <button class="lesson-action-btn edit-btn" title="Өңдеу">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="lesson-action-btn delete-btn" title="Жою">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <span class="subject-type ${lessonType.badge}">${lessonType.name}</span>
                                <h6 class="mb-1">${lesson.subject}</h6>
                                <p class="mb-1"><i class="fas fa-users me-1"></i>Топ: ${lesson.group}</p>
                                <p class="mb-1"><i class="fas fa-door-closed me-1"></i>${lesson.room}</p>
                                <span class="room-badge">${lesson.credits} кредит</span>
                            </div>
                        `;
                    } else {
                        // Пустая ячейка с кнопкой добавления
                        cell.innerHTML = `
                            <div class="add-lesson-btn" data-cell-id="${cellId}">
                                <i class="fas fa-plus"></i>
                                <small>Сабақ қосу</small>
                            </div>
                        `;
                    }
                    
                    row.appendChild(cell);
                });
                
                scheduleBody.appendChild(row);
            });
            
            // Добавляем обработчики событий
            attachEventListeners();
        }
        
        // Обновление статистики
        function updateStats() {
            let totalLessons = 0;
            let lectureHours = 0;
            let labHours = 0;
            let practiceHours = 0;
            
            Object.values(scheduleData).forEach(lesson => {
                totalLessons++;
                switch(lesson.type) {
                    case 'lecture': lectureHours++; break;
                    case 'lab': labHours++; break;
                    case 'practice': practiceHours++; break;
                    case 'seminar': lectureHours++; break;
                }
            });
            
            const statsHtml = `
                <div class="col-md-3 mb-3">
                    <div class="stat-number">${totalLessons}</div>
                    <div class="stat-label">Апталық сабақ</div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stat-number">${lectureHours}</div>
                    <div class="stat-label">Дәріс сағаттары</div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stat-number">${labHours}</div>
                    <div class="stat-label">Зертханалық сағат</div>
                </div>
                <div class="col-md-3 mb-3">
                                    <div class="stat-number">${practiceHours}</div>
                    <div class="stat-label">Практика сағаттары</div>
                </div>
            `;
            
            document.getElementById('lessonStats').innerHTML = statsHtml;
        }
        
        // Обновление статуса расписания
        function updateScheduleStatus() {
            const statusBadge = document.getElementById('scheduleStatus');
            if (hasUnsavedChanges) {
                statusBadge.className = 'badge bg-warning text-dark ms-2';
                statusBadge.textContent = 'Сақталмаған өзгерістер бар';
            } else {
                statusBadge.className = 'badge bg-success ms-2';
                statusBadge.textContent = 'Барлық өзгерістер сақталды';
            }
        }
        
        // Добавление обработчиков событий
        function attachEventListeners() {
            // Кнопки добавления занятия
            document.querySelectorAll('.add-lesson-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const cellId = this.getAttribute('data-cell-id');
                    openLessonModal(null, cellId);
                });
            });
            
            // Кнопки редактирования занятия
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const cellId = this.closest('.lesson-card').getAttribute('data-cell-id');
                    openLessonModal(cellId, cellId);
                });
            });
            
            // Кнопки удаления занятия
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const cellId = this.closest('.lesson-card').getAttribute('data-cell-id');
                    deleteLesson(cellId);
                });
            });
            
            // Перетаскивание занятий
            document.querySelectorAll('.lesson-card').forEach(card => {
                card.setAttribute('draggable', 'true');
                card.addEventListener('dragstart', handleDragStart);
            });
            
            document.querySelectorAll('td').forEach(cell => {
                cell.addEventListener('dragover', handleDragOver);
                cell.addEventListener('drop', handleDrop);
                cell.addEventListener('dragenter', handleDragEnter);
                cell.addEventListener('dragleave', handleDragLeave);
            });
        }
        
        // Открытие модального окна занятия
        function openLessonModal(cellId, targetCellId = null) {
            const modal = document.getElementById('lessonModal');
            const modalTitle = document.getElementById('lessonModalLabel');
            const deleteBtn = document.getElementById('deleteLessonBtn');
            
            if (cellId && scheduleData[cellId]) {
                // Режим редактирования
                editMode = true;
                currentLessonId = cellId;
                const lesson = scheduleData[cellId];
                
                modalTitle.textContent = 'Сабақты өңдеу';
                deleteBtn.style.display = 'block';
                
                // Заполняем форму
                document.getElementById('lessonId').value = lesson.id;
                document.getElementById('cellId').value = targetCellId || cellId;
                document.getElementById('lessonSubject').value = lesson.subject;
                document.getElementById('lessonType').value = lesson.type;
                document.getElementById('lessonGroup').value = lesson.group;
                document.getElementById('lessonRoom').value = lesson.room;
                document.getElementById('lessonCredits').value = lesson.credits;
                
                // Устанавливаем день и время
                if (targetCellId) {
                    const [day, time] = targetCellId.split('_');
                    document.getElementById('lessonDay').value = day;
                    document.getElementById('lessonTime').value = time;
                } else {
                    const [day, time] = cellId.split('_');
                    document.getElementById('lessonDay').value = day;
                    document.getElementById('lessonTime').value = time;
                }
            } else {
                // Режим добавления
                editMode = false;
                currentLessonId = null;
                modalTitle.textContent = 'Жаңа сабақ қосу';
                deleteBtn.style.display = 'none';
                
                // Сбрасываем форму
                document.getElementById('lessonForm').reset();
                document.getElementById('lessonId').value = '';
                document.getElementById('cellId').value = targetCellId;
                
                if (targetCellId) {
                    const [day, time] = targetCellId.split('_');
                    document.getElementById('lessonDay').value = day;
                    document.getElementById('lessonTime').value = time;
                }
            }
            
            // Показываем модальное окно
            const modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();
        }
        
        // Сохранение занятия
        function saveLesson() {
            const form = document.getElementById('lessonForm');
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }
            
            const cellId = document.getElementById('cellId').value;
            const lessonId = document.getElementById('lessonId').value || Date.now();
            const subject = document.getElementById('lessonSubject').value;
            const type = document.getElementById('lessonType').value;
            const group = document.getElementById('lessonGroup').value;
            const room = document.getElementById('lessonRoom').value;
            const credits = parseInt(document.getElementById('lessonCredits').value);
            
            // Если редактируем и ячейка изменилась, удаляем старое занятие
            if (editMode && currentLessonId && currentLessonId !== cellId) {
                delete scheduleData[currentLessonId];
            }
            
            // Сохраняем новое занятие
            scheduleData[cellId] = {
                id: lessonId,
                subject: subject,
                type: type,
                group: group,
                room: room,
                credits: credits
            };
            
            hasUnsavedChanges = true;
            updateScheduleStatus();
            
            // Закрываем модальное окно
            const modal = bootstrap.Modal.getInstance(document.getElementById('lessonModal'));
            modal.hide();
            
            // Обновляем расписание
            renderSchedule();
            updateStats();
            
            // Показываем уведомление
            showNotification('Сабақ сәтті сақталды!', 'success');
        }
        
        // Удаление занятия
        function deleteLesson(cellId) {
            if (confirm('Бұл сабақты жойғыңыз келе ме?')) {
                delete scheduleData[cellId];
                hasUnsavedChanges = true;
                updateScheduleStatus();
                renderSchedule();
                updateStats();
                showNotification('Сабақ сәтті жойылды!', 'warning');
            }
        }
        
        // Сохранение всего расписания
        function saveSchedule() {
            localStorage.setItem(`teacher_schedule_week_${currentWeek}`, JSON.stringify(scheduleData));
            hasUnsavedChanges = false;
            updateScheduleStatus();
            showNotification('Кесте сәтті сақталды!', 'success');
            
            // В реальном приложении здесь будет отправка на сервер
            console.log('Расписание сохранено:', scheduleData);
        }
        
        // Очистка всего расписания
        function clearSchedule() {
            if (confirm('Барлық сабақтарды жойғыңыз келе ме? Бұл әрекетті қайтару мүмкін емес.')) {
                scheduleData = {};
                hasUnsavedChanges = true;
                updateScheduleStatus();
                renderSchedule();
                updateStats();
                showNotification('Кесте тазартылды!', 'info');
            }
        }
        
        // Функции для drag & drop
        let draggedLesson = null;
        
        function handleDragStart(e) {
            draggedLesson = this.getAttribute('data-cell-id');
            e.dataTransfer.setData('text/plain', draggedLesson);
            e.dataTransfer.effectAllowed = 'move';
            this.style.opacity = '0.4';
        }
        
        function handleDragOver(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
        }
        
        function handleDrop(e) {
            e.preventDefault();
            const targetCell = e.target.closest('td');
            
            if (!targetCell || !draggedLesson) return;
            
            const addBtn = targetCell.querySelector('.add-lesson-btn');
            if (!addBtn) return;
            
            const newCellId = addBtn.getAttribute('data-cell-id');
            
            if (newCellId && scheduleData[draggedLesson]) {
                // Перемещаем занятие
                scheduleData[newCellId] = { ...scheduleData[draggedLesson] };
                delete scheduleData[draggedLesson];
                
                hasUnsavedChanges = true;
                updateScheduleStatus();
                renderSchedule();
                
                showNotification('Сабақ орыны ауыстырылды!', 'success');
            }
            
            draggedLesson = null;
        }
        
        function handleDragEnter(e) {
            e.preventDefault();
            const targetCell = e.target.closest('td');
            if (targetCell && targetCell.querySelector('.add-lesson-btn')) {
                targetCell.style.backgroundColor = 'rgba(50, 64, 107, 0.1)';
            }
        }
        
        function handleDragLeave(e) {
            e.preventDefault();
            const targetCell = e.target.closest('td');
            if (targetCell) {
                targetCell.style.backgroundColor = '';
            }
        }
        
        // Показать уведомление
        function showNotification(message, type = 'info') {
            // Создаем уведомление
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
            
            // Удаляем уведомление через 3 секунды
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 3000);
        }
        
        // Инициализация при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            initSchedule();
            
            // Обработчики кнопок
            document.getElementById('saveScheduleBtn').addEventListener('click', saveSchedule);
            document.getElementById('clearAllBtn').addEventListener('click', clearSchedule);
            document.getElementById('saveLessonBtn').addEventListener('click', saveLesson);
            document.getElementById('deleteLessonBtn').addEventListener('click', function() {
                const cellId = document.getElementById('cellId').value;
                deleteLesson(cellId);
                
                const modal = bootstrap.Modal.getInstance(document.getElementById('lessonModal'));
                modal.hide();
            });
            
            // Предыдущая/следующая неделя
            document.getElementById('prevWeekBtn').addEventListener('click', function() {
                if (currentWeek > 1) {
                    // Сохраняем текущую неделю
                    if (hasUnsavedChanges) {
                        if (confirm('Сақталмаған өзгерістер бар. Алдымен сақтағыңыз келе ме?')) {
                            saveSchedule();
                        }
                    }
                    
                    currentWeek--;
                    document.getElementById('weekSelector').value = currentWeek;
                    initSchedule();
                }
            });
            
            document.getElementById('nextWeekBtn').addEventListener('click', function() {
                // В реальном приложении здесь проверка максимальной недели
                if (hasUnsavedChanges) {
                    if (confirm('Сақталмаған өзгерістер бар. Алдымен сақтағыңыз келе ме?')) {
                        saveSchedule();
                    }
                }
                
                currentWeek++;
                document.getElementById('weekSelector').value = currentWeek;
                initSchedule();
            });
            
            // Выбор недели
            document.getElementById('weekSelector').addEventListener('change', function() {
                if (hasUnsavedChanges) {
                    if (confirm('Сақталмаған өзгерістер бар. Алдымен сақтағыңыз келе ме?')) {
                        saveSchedule();
                    }
                }
                
                currentWeek = parseInt(this.value);
                initSchedule();
            });
            
            // Навигация
            const currentPage = 'teacher_keste.php';
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