<!DOCTYPE html>
<html lang="kz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оқу материалдары | UNIVER - Оқытушы</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --univer-blue: #003366;
            --univer-dark: #123456;
            --univer-light: #0056b3;
            --univer-accent: #e9f2ff;
            --teacher-color: #32406bff;
            --course-python: #28a745;
            --course-db: #17a2b8;
            --course-web: #ffc107;
            --course-network: #9c27b0;
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
        
        /* Карточки курсов */
        .course-card {
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s;
            height: 100%;
        }
        
        .course-card:hover {
            transform: translateY(-5px);
        }
        
        .course-python {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            border-left: 5px solid var(--course-python);
        }
        
        .course-db {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-left: 5px solid var(--course-db);
        }
        
        .course-web {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            border-left: 5px solid var(--course-web);
        }
        
        .course-network {
            background: linear-gradient(135deg, #f3e5f5, #e1bee7);
            border-left: 5px solid var(--course-network);
        }
        
        .course-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        /* Файлы */
        .file-item {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            background-color: white;
            transition: all 0.3s;
        }
        
        .file-item:hover {
            border-color: var(--teacher-color);
            box-shadow: 0 4px 8px rgba(50, 64, 107, 0.1);
        }
        
        .file-icon {
            font-size: 2rem;
            margin-right: 15px;
            width: 50px;
            text-align: center;
        }
        
        .file-icon.pdf { color: #e74c3c; }
        .file-icon.docx { color: #2b579a; }
        .file-icon.pptx { color: #d24726; }
        .file-icon.xlsx { color: #217346; }
        .file-icon.zip { color: #f39c12; }
        .file-icon.jpg { color: #9b59b6; }
        .file-icon.txt { color: #7f8c8d; }
        
        /* Загрузка файлов */
        .upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            background-color: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .upload-area:hover {
            border-color: var(--teacher-color);
            background-color: #e9f2ff;
        }
        
        /* Табы */
        .course-tabs {
            border-bottom: 2px solid #dee2e6;
            margin-bottom: 25px;
        }
        
        .course-tab {
            padding: 10px 20px;
            border: none;
            background: none;
            font-weight: 600;
            color: #6c757d;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        
        .course-tab.active {
            color: var(--teacher-color);
            border-bottom: 3px solid var(--teacher-color);
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
        
        /* Статистика */
        .stat-card {
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            margin-bottom: 15px;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        /* Адаптивность */
        @media (max-width: 768px) {
            .file-item {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .file-icon {
                margin-bottom: 10px;
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
                            <i class="fas fa-chart-bar me-1"></i> Бағалау
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="teacher_materials.php">
                            <i class="fas fa-folder-open me-1"></i> Материалдар
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="teacher_requests.php">
                            <i class="fas fa-file-alt me-1"></i> Өтініштер
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
        <!-- Заголовок и статистика -->
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <div>
                <h2 class="mb-1"><i class="fas fa-folder-open me-2 teacher-highlight"></i>Оқу материалдары</h2>
                <p class="text-muted mb-0">Курс материалдарын басқару және жүктеу</p>
            </div>
            <div class="d-flex gap-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="fas fa-upload me-1"></i> Жаңа материал
                </button>
                <a href="library.php?role=teacher" class="btn btn-outline-primary">
                    <i class="fas fa-external-link-alt me-1"></i> Толық кітапхана
                </a>
            </div>
        </div>
        
        <!-- Быстрая статистика -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="stat-card" style="background-color: #e3f2fd;">
                    <div class="stat-number text-primary">42</div>
                    <div class="stat-label">Барлық материалдар</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card" style="background-color: #e8f5e9;">
                    <div class="stat-number text-success">18</div>
                    <div class="stat-label">Лекциялар</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card" style="background-color: #fff3cd;">
                    <div class="stat-number text-warning">12</div>
                    <div class="stat-label">Зертханалық жұмыстар</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card" style="background-color: #f3e5f5;">
                    <div class="stat-number text-purple">4.2 GB</div>
                    <div class="stat-label">Жалпы көлем</div>
                </div>
            </div>
        </div>
        
        <!-- Табы курсов -->
        <div class="course-tabs">
            <button class="course-tab active" data-course="python">
                <i class="fas fa-code me-1"></i> Python бағдарламалау
            </button>
            <button class="course-tab" data-course="database">
                <i class="fas fa-database me-1"></i> Деректер қоры
            </button>
            <button class="course-tab" data-course="web">
                <i class="fas fa-globe me-1"></i> Веб-бағдарламалау
            </button>
            <button class="course-tab" data-course="network">
                <i class="fas fa-network-wired me-1"></i> Компьютерлік желілер
            </button>
        </div>
        
        <!-- Контент курсов -->
        <div id="pythonContent" class="course-content">
            <!-- Python курс -->
            <div class="content-card card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-code me-2 text-success"></i>Python бағдарламалау - АИТ-21-01
                        <small class="text-muted ms-2">25 студент, 5 кредит</small>
                    </h5>
                    <span class="badge bg-success">4 жаңа жүктеу</span>
                </div>
                <div class="card-body">
                    <!-- Типы материалов -->
                    <div class="row mb-4">
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="course-card course-python">
                                <div class="course-icon text-success">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <h5>Лекциялар</h5>
                                <p class="mb-2">8 файл</p>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="course-card course-python">
                                <div class="course-icon text-success">
                                    <i class="fas fa-flask"></i>
                                </div>
                                <h5>Зертханалық жұмыстар</h5>
                                <p class="mb-2">10 файл</p>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-success" style="width: 80%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="course-card course-python">
                                <div class="course-icon text-success">
                                    <i class="fas fa-tasks"></i>
                                </div>
                                <h5>Тапсырмалар</h5>
                                <p class="mb-2">6 файл</p>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-success" style="width: 60%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="course-card course-python">
                                <div class="course-icon text-success">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h5>Емтихан материалдары</h5>
                                <p class="mb-2">3 файл</p>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-success" style="width: 40%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Последние файлы -->
                    <h6 class="mb-3"><i class="fas fa-history me-2"></i>Соңғы жүктелген файлдар</h6>
                    <div id="pythonFiles">
                        <!-- Файлы будут загружены через JavaScript -->
                    </div>
                </div>
            </div>
        </div>
        
        <div id="databaseContent" class="course-content" style="display: none;">
            <!-- Database курс -->
            <div class="content-card card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-database me-2 text-info"></i>Деректер қоры жүйелері - АИТ-21-02
                        <small class="text-muted ms-2">20 студент, 5 кредит</small>
                    </h5>
                    <span class="badge bg-info">2 жаңа жүктеу</span>
                </div>
                <div class="card-body">
                    <!-- Типы материалов -->
                    <div class="row mb-4">
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="course-card course-db">
                                <div class="course-icon text-info">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <h5>Лекциялар</h5>
                                <p class="mb-2">6 файл</p>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-info" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="course-card course-db">
                                <div class="course-icon text-info">
                                    <i class="fas fa-flask"></i>
                                </div>
                                <h5>Зертханалық жұмыстар</h5>
                                <p class="mb-2">8 файл</p>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-info" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="course-card course-db">
                                <div class="course-icon text-info">
                                    <i class="fas fa-tasks"></i>
                                </div>
                                <h5>Тапсырмалар</h5>
                                <p class="mb-2">4 файл</p>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-info" style="width: 50%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="course-card course-db">
                                <div class="course-icon text-info">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h5>Емтихан материалдары</h5>
                                <p class="mb-2">2 файл</p>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-info" style="width: 30%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="databaseFiles">
                        <!-- Файлы будут загружены через JavaScript -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Остальные курсы аналогично... -->
        
        <!-- Быстрая ссылка на общую библиотеку -->
        <div class="content-card card mt-4">
            <div class="card-body text-center">
                <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                <h4>Толық кітапханаға өту</h4>
                <p class="text-muted mb-3">Барлық факультеттер мен курстардың материалдарын көру үшін</p>
                <a href="library.php?role=teacher" class="btn btn-lg btn-primary">
                    <i class="fas fa-external-link-alt me-2"></i> Кітапханаға өту
                </a>
            </div>
        </div>
    </main>
    
    <!-- Модальное окно загрузки файла -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">
                        <i class="fas fa-upload me-2"></i>Жаңа материал жүктеу
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Жабу"></button>
                </div>
                <div class="modal-body">
                    <form id="uploadForm" action="library.php?role=teacher" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="uploadCourse" class="form-label">Курс *</label>
                                <select class="form-select" id="uploadCourse" name="course" required>
                                    <option value="">Таңдаңыз...</option>
                                    <option value="python">Python бағдарламалау (АИТ-21-01)</option>
                                    <option value="database">Деректер қоры (АИТ-21-02)</option>
                                    <option value="web">Веб-бағдарламалау (АИТ-20-03)</option>
                                    <option value="network">Компьютерлік желілер (АИТ-22-01)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="uploadType" class="form-label">Материал түрі *</label>
                                <select class="form-select" id="uploadType" name="type" required>
                                    <option value="">Таңдаңыз...</option>
                                    <option value="lecture">Лекция</option>
                                    <option value="lab">Зертханалық жұмыс</option>
                                    <option value="practice">Практикалық жұмыс</option>
                                    <option value="exam">Емтихан материалдары</option>
                                    <option value="book">Оқулық</option>
                                    <option value="other">Басқа</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="uploadFile" class="form-label">Файл *</label>
                            <div class="upload-area" onclick="document.getElementById('fileInput').click()" id="dropArea">
                                <i class="fas fa-cloud-upload-alt fa-2x mb-3 text-primary"></i>
                                <h5>Файлды таңдаңыз</h5>
                                <p class="text-muted">PDF, DOC, PPT, XLS, JPG, PNG, ZIP, RAR (макс. 10MB)</p>
                                <input type="file" name="library_file" id="fileInput" class="d-none" required>
                                <div id="selectedFileName" class="mt-3 small"></div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="uploadTitle" class="form-label">Атауы *</label>
                            <input type="text" class="form-control" id="uploadTitle" name="file_name" required placeholder="Материалдың атауын енгізіңіз...">
                        </div>
                        
                        <div class="mb-3">
                            <label for="uploadDescription" class="form-label">Сипаттама</label>
                            <textarea class="form-control" id="uploadDescription" name="description" rows="3" placeholder="Материал туралы сипаттама..."></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="uploadWeek" class="form-label">Апта</label>
                                <input type="number" class="form-control" id="uploadWeek" name="week" min="1" max="15" placeholder="1-15">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="uploadTopic" class="form-label">Тақырып</label>
                                <input type="text" class="form-control" id="uploadTopic" name="topic" placeholder="Материал тақырыбы...">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Жабу</button>
                    <button type="submit" form="uploadForm" class="btn btn-primary">
                        <i class="fas fa-upload me-1"></i> Жүктеу
                    </button>
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
        // Данные файлов из библиотеки (в реальной системе это будет запрос к серверу)
        const libraryFiles = <?php 
            $jsonFile = 'library_files.json';
            $filesList = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
            echo json_encode($filesList);
        ?>;
        
        // Группировка файлов по курсам
        function groupFilesByCourse(files) {
            const courses = {
                python: [],
                database: [],
                web: [],
                network: []
            };
            
            // Простая логика группировки (в реальной системе будет поле course в JSON)
            files.forEach(file => {
                const name = file.name.toLowerCase();
                if (name.includes('python') || name.includes('питон')) {
                    courses.python.push(file);
                } else if (name.includes('database') || name.includes('деректер') || name.includes('қор')) {
                    courses.database.push(file);
                } else if (name.includes('web') || name.includes('веб')) {
                    courses.web.push(file);
                } else if (name.includes('network') || name.includes('желі')) {
                    courses.network.push(file);
                } else {
                    // По умолчанию добавляем в Python
                    courses.python.push(file);
                }
            });
            
            return courses;
        }
        
        // Функция для отображения файлов курса
        function displayCourseFiles(courseId, files) {
            const container = document.getElementById(courseId + 'Files');
            if (!container) return;
            
            if (files.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-folder-open fa-2x text-muted mb-3"></i>
                        <p class="text-muted">Әлі материалдар жоқ</p>
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                            <i class="fas fa-plus me-1"></i> Бірінші материалды жүктеу
                        </button>
                    </div>
                `;
                return;
            }
            
            let html = '';
            files.slice(0, 5).forEach(file => {
                const icon = getFileIcon(file.type);
                const size = formatFileSize(file.size);
                
                html += `
                    <div class="file-item">
                        <div class="d-flex align-items-center">
                            <div class="file-icon ${file.type}">
                                <i class="fas ${icon}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">${file.name}</h6>
                                <div class="d-flex flex-wrap small text-muted">
                                    <span class="me-3"><i class="fas fa-hdd me-1"></i> ${size}</span>
                                    <span class="me-3"><i class="fas fa-calendar me-1"></i> ${file.upload_date}</span>
                                    <span class="me-3"><i class="fas fa-download me-1"></i> ${file.downloads}</span>
                                    <span class="badge bg-secondary">${file.category}</span>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="download.php?id=${file.id}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="library.php?role=teacher&action=delete&id=${file.id}" 
                                   class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Файлды жойғыңыз келе ме?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            if (files.length > 5) {
                html += `
                    <div class="text-center mt-3">
                        <a href="library.php?role=teacher" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-eye me-1"></i> Барлығын көру (${files.length})
                        </a>
                    </div>
                `;
            }
            
            container.innerHTML = html;
        }
        
        // Функция для получения иконки файла
        function getFileIcon(fileType) {
            const type = fileType.toLowerCase();
            if (type === 'pdf') return 'fa-file-pdf';
            if (['doc', 'docx'].includes(type)) return 'fa-file-word';
            if (['ppt', 'pptx'].includes(type)) return 'fa-file-powerpoint';
            if (['xls', 'xlsx'].includes(type)) return 'fa-file-excel';
            if (['jpg', 'jpeg', 'png'].includes(type)) return 'fa-file-image';
            if (['zip', 'rar'].includes(type)) return 'fa-file-archive';
            if (type === 'txt') return 'fa-file-alt';
            return 'fa-file';
        }
        
        // Функция для форматирования размера файла
        function formatFileSize(bytes) {
            if (bytes >= 1073741824) return (bytes / 1073741824).toFixed(2) + ' GB';
            if (bytes >= 1048576) return (bytes / 1048576).toFixed(2) + ' MB';
            if (bytes >= 1024) return (bytes / 1024).toFixed(2) + ' KB';
            return bytes + ' байт';
        }
        
        // Функция переключения между курсами
        function switchCourse(courseId) {
            // Скрываем все содержимое курсов
            document.querySelectorAll('.course-content').forEach(content => {
                content.style.display = 'none';
            });
            
            // Убираем активный класс со всех кнопок
            document.querySelectorAll('.course-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Показываем выбранный курс
            const activeContent = document.getElementById(courseId + 'Content');
            if (activeContent) {
                activeContent.style.display = 'block';
            }
            
            // Активируем кнопку
            const activeButton = document.querySelector(`[data-course="${courseId}"]`);
            if (activeButton) {
                activeButton.classList.add('active');
            }
            
            // Загружаем файлы для выбранного курса
            loadCourseFiles(courseId);
        }
        
        // Загрузка файлов для курса
        function loadCourseFiles(courseId) {
            const groupedFiles = groupFilesByCourse(libraryFiles);
            displayCourseFiles(courseId, groupedFiles[courseId] || []);
        }
        
        // Обработчики для табов курсов
        document.querySelectorAll('.course-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                const courseId = this.getAttribute('data-course');
                switchCourse(courseId);
            });
        });
        
        // Загрузка файла
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const display = document.getElementById('selectedFileName');
            
            if (file) {
                display.innerHTML = `
                    <div class="alert alert-success py-2">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Таңдалды:</strong> ${file.name} (${formatFileSize(file.size)})
                    </div>
                `;
                
                // Автоматически заполняем название
                const titleInput = document.getElementById('uploadTitle');
                if (titleInput.value === '') {
                    const nameWithoutExt = file.name.replace(/\.[^/.]+$/, "");
                    titleInput.value = nameWithoutExt;
                }
            }
        });
        
        // Drag & Drop для загрузки
        const dropArea = document.getElementById('dropArea');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            dropArea.classList.add('dragover');
        }
        
        function unhighlight() {
            dropArea.classList.remove('dragover');
        }
        
        dropArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            const fileInput = document.getElementById('fileInput');
            
            if (files.length > 0) {
                fileInput.files = files;
                
                // Триггерим событие change
                const event = new Event('change', { bubbles: true });
                fileInput.dispatchEvent(event);
            }
        }
        
        // Автоматическое заполнение формы при выборе курса
        document.getElementById('uploadCourse').addEventListener('change', function() {
            const course = this.value;
            const titleInput = document.getElementById('uploadTitle');
            
            // Если название пустое, предлагаем варианты
            if (titleInput.value === '') {
                const suggestions = {
                    python: 'Python бағдарламалау - ',
                    database: 'Деректер қоры жүйелері - ',
                    web: 'Веб-бағдарламалау - ',
                    network: 'Компьютерлік желілер - '
                };
                
                if (suggestions[course]) {
                    titleInput.placeholder = suggestions[course] + 'Лекция 1';
                }
            }
        });
        
        // Инициализация при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            // Загружаем файлы для первого курса
            loadCourseFiles('python');
            
            // Навигация
            const currentPage = 'teacher_materials.php';
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPage) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
            
            // Уведомление об успешной загрузке
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('upload_success')) {
                showNotification('Файл сәтті жүктелді!', 'success');
            }
            
            // Связь с общей библиотекой
            console.log('Жалпы кітапханадағы файлдар саны:', libraryFiles.length);
            console.log('Топтастырылған файлдар:', groupFilesByCourse(libraryFiles));
        });
        
        // Функция показа уведомлений
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
    </script>
</body>
</html>