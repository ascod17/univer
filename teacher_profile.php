
<!DOCTYPE html>
<html lang="kz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Менің профилім | UNIVER - Оқытушы</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --univer-blue: #003366;
            --univer-dark: #123456;
            --univer-light: #0056b3;
            --univer-accent: #e9f2ff;
            --teacher-color: #32406bff;
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
        
        /* Аватар */
        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.3s;
        }
        
        .profile-avatar:hover {
            transform: scale(1.05);
        }
        
        .avatar-upload {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
        
        .avatar-upload-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
            color: white;
        }
        
        .avatar-upload:hover .avatar-upload-overlay {
            opacity: 1;
        }
        
        /* Статистика */
        .stat-card {
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            height: 100%;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.8;
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
        
        /* Таблицы */
        .table-hover tbody tr:hover {
            background-color: rgba(50, 64, 107, 0.05);
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
        
        /* Тэги специализаций */
        .specialty-tag {
            display: inline-block;
            padding: 5px 12px;
            background-color: #e9ecef;
            border-radius: 20px;
            margin: 3px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        
        .specialty-tag:hover {
            background-color: var(--teacher-color);
            color: white;
        }
        
        /* Прогресс бар */
        .progress {
            height: 8px;
            border-radius: 4px;
        }
        
        /* Адаптивность */
        @media (max-width: 768px) {
            .profile-avatar {
                width: 120px;
                height: 120px;
            }
            
            .stat-card {
                padding: 15px;
            }
            
            .stat-icon {
                font-size: 2rem;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
        }
        
        /* Табы профиля */
        .profile-tabs {
            border-bottom: 2px solid #dee2e6;
            margin-bottom: 25px;
        }
        
        .profile-tab {
            padding: 10px 25px;
            border: none;
            background: none;
            font-weight: 600;
            color: #6c757d;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        
        .profile-tab.active {
            color: var(--teacher-color);
            border-bottom: 3px solid var(--teacher-color);
        }
        
        /* Информационные карточки */
        .info-card {
            border-left: 4px solid var(--teacher-color);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: white;
        }
        
        /* Социальные иконки */
        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .social-icon:hover {
            transform: translateY(-3px);
            color: white;
        }
        
        .email { background-color: #ea4335; }
        .phone { background-color: #34a853; }
        .telegram { background-color: #0088cc; }
        .whatsapp { background-color: #25d366; }
        
        /* Академические звания */
        .academic-badge {
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
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
                        <a class="nav-link" href="teacher_requests.php">
                            <i class="fas fa-file-alt me-1"></i> Өтініштер
                        </a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="nav-link user-dropdown dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user-tie me-1"></i> 
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
        <!-- Заголовок профиля -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1"><i class="fas fa-user-tie me-2 teacher-highlight"></i>Менің профилім</h2>
                <p class="text-muted mb-0">Жеке ақпарат, статистика және академиялық қызмет</p>
            </div>
            <button class="btn btn-primary" id="editProfileBtn">
                <i class="fas fa-edit me-1"></i> Профильді өңдеу
            </button>
        </div>
        
        <!-- Основная информация -->
        <div class="row">
            <!-- Левая колонка - аватар и основная информация -->
            <div class="col-lg-4">
                <div class="content-card card mb-4">
                    <div class="card-body text-center">
                        <!-- Аватар -->
                        <div class="avatar-upload mb-4" data-bs-toggle="modal" data-bs-target="#avatarModal">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Профиль суреті" class="profile-avatar" id="profileAvatar">
                            <div class="avatar-upload-overlay">
                                <div>
                                    <i class="fas fa-camera fa-2x mb-2"></i>
                                    <br>
                                    <small>Суретті өзгерту</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- ФИО и должность -->
<h3 class="mb-2"><?php echo $display_name; ?></h3>                        <div class="academic-badge d-inline-block mb-3">
                            <i class="fas fa-user-graduate me-1"></i> Доцент, PhD
                        </div>
                        
                        <!-- Контактная информация -->
                        <div class="info-card">
                            <h6><i class="fas fa-id-card me-2 teacher-highlight"></i>Жеке ақпарат</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="fas fa-envelope text-muted me-2"></i>
                                    <strong>Email:</strong> d.murat@kaznu.kz
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-phone text-muted me-2"></i>
                                    <strong>Телефон:</strong> +7 (777) 123-45-67
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-calendar-alt text-muted me-2"></i>
                                    <strong>Туған күні:</strong> 15.03.1985
                                </li>
                                <li>
                                    <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                    <strong>Мекен-жайы:</strong> Алматы, Абай көшесі 78
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Социальные сети -->
                        <h6 class="mt-4 mb-3">Байланыс құралдары</h6>
                        <div class="d-flex justify-content-center gap-3 mb-4">
                            <a href="mailto:d.murat@kaznu.kz" class="social-icon email" title="Email">
                                <i class="fas fa-envelope"></i>
                            </a>
                            <a href="tel:+77771234567" class="social-icon phone" title="Телефон">
                                <i class="fas fa-phone"></i>
                            </a>
                            <a href="https://t.me/dosymbek_m" class="social-icon telegram" title="Telegram">
                                <i class="fab fa-telegram"></i>
                            </a>
                            <a href="https://wa.me/77771234567" class="social-icon whatsapp" title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Специализации -->
                <div class="content-card card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-star me-2"></i>Мамандықтар</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            <span class="specialty-tag">Python бағдарламалау</span>
                            <span class="specialty-tag">Деректер қоры жүйелері</span>
                            <span class="specialty-tag">Жасанды интеллект</span>
                            <span class="specialty-tag">Машиналық оқыту</span>
                            <span class="specialty-tag">Веб-технологиялар</span>
                            <span class="specialty-tag">Киберқауіпсіздік</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Правая колонка - детальная информация -->
            <div class="col-lg-8">
                <!-- Статистика -->
                <div class="row mb-4">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="stat-card" style="background-color: #e3f2fd;">
                            <div class="stat-icon text-primary">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="stat-number text-primary">4</div>
                            <div class="stat-label">Белсенді курс</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="stat-card" style="background-color: #f3e5f5;">
                            <div class="stat-icon text-purple">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-number text-purple">142</div>
                            <div class="stat-label">Студенттер</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="stat-card" style="background-color: #e8f5e9;">
                            <div class="stat-icon text-success">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="stat-number text-success">16</div>
                            <div class="stat-label">Апталық сабақ</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="stat-card" style="background-color: #fff3cd;">
                            <div class="stat-icon text-warning">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="stat-number text-warning">8</div>
                            <div class="stat-label">Жыл тәжірибе</div>
                        </div>
                    </div>
                </div>
                
                <!-- Табы профиля -->
                <div class="profile-tabs">
                    <button class="profile-tab active" data-tab="academic">Академиялық ақпарат</button>
                    <button class="profile-tab" data-tab="advisor">Эдвайзер ретінде</button>
                    <button class="profile-tab" data-tab="research">Ғылыми жұмыс</button>
                    <button class="profile-tab" data-tab="schedule">Кесте және кездесулер</button>
                </div>
                
                <!-- Содержимое табов -->
                <div id="academicContent" class="tab-content">
                    <!-- Академическая информация -->
                    <div class="content-card card">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="fas fa-university me-2"></i>Академиялық ақпарат</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <h6><i class="fas fa-graduation-cap me-2"></i>Білімі</h6>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2">
                                                <strong>PhD:</strong> Компьютерлік ғылымдар<br>
                                                <small class="text-muted">КазНУ, 2015-2018</small>
                                            </li>
                                            <li class="mb-2">
                                                <strong>Магистр:</strong> Ақпараттық жүйелер<br>
                                                <small class="text-muted">КазНУ, 2012-2014</small>
                                            </li>
                                            <li>
                                                <strong>Бакалавр:</strong> Компьютерлік инженерия<br>
                                                <small class="text-muted">КазНУ, 2008-2012</small>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <h6><i class="fas fa-briefcase me-2"></i>Қызметі</h6>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2">
                                                <strong>Доцент:</strong> Ақпараттық технологиялар кафедрасы<br>
                                                <small class="text-muted">2018 жылдан бастап</small>
                                            </li>
                                            <li class="mb-2">
                                                <strong>Аға оқытушы:</strong> АИТ факультеті<br>
                                                <small class="text-muted">2015-2018</small>
                                            </li>
                                            <li>
                                                <strong>Оқытушы:</strong> ФИТ факультеті<br>
                                                <small class="text-muted">2012-2015</small>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Текущие курсы -->
                            <h6 class="mt-4 mb-3"><i class="fas fa-book-open me-2"></i>Ағымдағы курс тізімі</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Курс атауы</th>
                                            <th>Факультет</th>
                                            <th>Топ</th>
                                            <th>Студенттер</th>
                                            <th>Семестр</th>
                                            <th>Статус</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Python бағдарламалау</td>
                                            <td>АИТ</td>
                                            <td>АИТ-21-01</td>
                                            <td>25</td>
                                            <td>Күзгі 2025</td>
                                            <td><span class="badge bg-success">Белсенді</span></td>
                                        </tr>
                                        <tr>
                                            <td>Деректер қоры жүйелері</td>
                                            <td>АИТ</td>
                                            <td>АИТ-21-02</td>
                                            <td>20</td>
                                            <td>Күзгі 2025</td>
                                            <td><span class="badge bg-success">Белсенді</span></td>
                                        </tr>
                                        <tr>
                                            <td>Веб-бағдарламалау</td>
                                            <td>АИТ</td>
                                            <td>АИТ-20-03</td>
                                            <td>18</td>
                                            <td>Күзгі 2025</td>
                                            <td><span class="badge bg-success">Белсенді</span></td>
                                        </tr>
                                        <tr>
                                            <td>Компьютерлік желілер</td>
                                            <td>АИТ</td>
                                            <td>АИТ-22-01</td>
                                            <td>30</td>
                                            <td>Күзгі 2025</td>
                                            <td><span class="badge bg-success">Белсенді</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Эдвайзер -->
                <div id="advisorContent" class="tab-content" style="display: none;">
                    <div class="content-card card">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="fas fa-user-friends me-2"></i>Эдвайзер ретінде</h6>
                        </div>
                        <div class="card-body">
                            <!-- Информация как эдвайзер -->
                            <div class="alert alert-info mb-4">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Эдвайзер ретінде:</strong> Сіз 3 бакалавр және 2 магистрантқа жетекшілік етесіз.
                            </div>
                            
                            <!-- Подопечные студенты -->
                            <h6 class="mb-3"><i class="fas fa-user-graduate me-2"></i>Жетекшілік ететін студенттер</h6>
                            <div class="row">
                                <!-- Бакалавры -->
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <h6><i class="fas fa-graduation-cap me-2"></i>Бакалавр студенттері</h6>
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Аты-жөні</th>
                                                        <th>Топ</th>
                                                        <th>Курс</th>
                                                        <th>Тема</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Нұрлан С.</td>
                                                        <td>АИТ-21-01</td>
                                                        <td>3</td>
                                                        <td>AI қолдану</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Айгерім Қ.</td>
                                                        <td>АИТ-21-01</td>
                                                        <td>3</td>
                                                        <td>Веб-қосымша</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Әлишер Б.</td>
                                                        <td>АИТ-21-02</td>
                                                        <td>3</td>
                                                        <td>Деректер талдау</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Магистранты -->
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <h6><i class="fas fa-user-graduate me-2"></i>Магистранттар</h6>
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Аты-жөні</th>
                                                        <th>Бағыт</th>
                                                        <th>Жыл</th>
                                                        <th>Тема</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Мадина Т.</td>
                                                        <td>Комп. ғылымдар</td>
                                                        <td>2</td>
                                                        <td>Машиналық оқыту</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Данияр М.</td>
                                                        <td>Ақпараттық жүйелер</td>
                                                        <td>1</td>
                                                        <td>Бұлттық технологиялар</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- График встреч -->
                            <h6 class="mt-4 mb-3"><i class="fas fa-calendar-check me-2"></i>Келесі кездесулер</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Күні</th>
                                            <th>Уақыт</th>
                                            <th>Студент</th>
                                            <th>Тәлім</th>
                                            <th>Орын</th>
                                            <th>Статус</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>12.05.2025</td>
                                            <td>14:00-15:00</td>
                                            <td>Нұрлан С.</td>
                                            <td>Дипломдық жоба</td>
                                            <td>Каб. 305</td>
                                            <td><span class="badge bg-primary">Жоспарланған</span></td>
                                        </tr>
                                        <tr>
                                            <td>14.05.2025</td>
                                            <td>10:00-11:00</td>
                                            <td>Мадина Т.</td>
                                            <td>Магистрлік диссертация</td>
                                            <td>Каб. 402</td>
                                            <td><span class="badge bg-primary">Жоспарланған</span></td>
                                        </tr>
                                        <tr>
                                            <td>15.05.2025</td>
                                            <td>15:00-16:00</td>
                                            <td>Айгерім Қ.</td>
                                            <td>Зертханалық жұмыс</td>
                                            <td>Онлайн</td>
                                            <td><span class="badge bg-warning">Күтілуде</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Прогресс студентов -->
                            <h6 class="mt-4 mb-3"><i class="fas fa-chart-line me-2"></i>Студенттердің прогрессі</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <h6>Нұрлан С.</h6>
                                        <small class="text-muted">Дипломдық жоба: AI қолдану</small>
                                        <div class="progress mt-2">
                                            <div class="progress-bar" style="width: 75%">75%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <h6>Мадина Т.</h6>
                                        <small class="text-muted">Магистрлік диссертация: Машиналық оқыту</small>
                                        <div class="progress mt-2">
                                            <div class="progress-bar" style="width: 60%">60%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Научная работа -->
                <div id="researchContent" class="tab-content" style="display: none;">
                    <div class="content-card card">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="fas fa-flask me-2"></i>Ғылыми жұмыс</h6>
                        </div>
                        <div class="card-body">
                            <!-- Публикации -->
                            <h6 class="mb-3"><i class="fas fa-file-alt me-2"></i>Соңғы жарияланымдар</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Жыл</th>
                                            <th>Атауы</th>
                                            <th>Журнал/Конференция</th>
                                            <th>Түрі</th>
                                            <th>Сілтеме</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2024</td>
                                            <td>Deep Learning Approaches for Image Recognition</td>
                                            <td>IEEE Access</td>
                                            <td>Мақала</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">Қарау</a></td>
                                        </tr>
                                        <tr>
                                            <td>2023</td>
                                            <td>Data Security in Cloud Computing</td>
                                            <td>ACM Conference</td>
                                            <td>Конференция</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">Қарау</a></td>
                                        </tr>
                                        <tr>
                                            <td>2022</td>
                                            <td>Python for Data Science</td>
                                            <td>Springer Book</td>
                                            <td>Кітап</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">Қарау</a></td>
                                        </tr>
                                        <tr>
                                            <td>2021</td>
                                            <td>Web Development Best Practices</td>
                                            <td>International Journal</td>
                                            <td>Мақала</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">Қарау</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Исследовательские проекты -->
                            <h6 class="mt-4 mb-3"><i class="fas fa-project-diagram me-2"></i>Зерттеу жобалары</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <h6>AI for Education</h6>
                                        <small class="text-muted">2023-2025, ҚР БҒМ гранты</small>
                                        <p class="mt-2 mb-0 small">Білім берудегі жасанды интеллектті қолдануды зерттеу.</p>
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-success" style="width: 80%">80%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <h6>Cloud Security</h6>
                                        <small class="text-muted">2022-2024, Өнеркәсіптік жоба</small>
                                        <p class="mt-2 mb-0 small">Бұлттық технологиялардағы қауіпсіздік жүйелері.</p>
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-info" style="width: 95%">95%</div>
                                                                            </div>
                                </div>
                            </div>
                            
                            <!-- Патенты и награды -->
                            <h6 class="mt-4 mb-3"><i class="fas fa-award me-2"></i>Патенттер мен марапаттар</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="info-card text-center">
                                        <i class="fas fa-medal fa-2x text-warning mb-2"></i>
                                        <h6>Жыл оқытушысы</h6>
                                        <small class="text-muted">2023 жыл</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-card text-center">
                                        <i class="fas fa-certificate fa-2x text-primary mb-2"></i>
                                        <h6>Ең үздік ғылыми жоба</h6>
                                        <small class="text-muted">2022 жыл</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-card text-center">
                                        <i class="fas fa-lightbulb fa-2x text-success mb-2"></i>
                                        <h6>Патент №KZ12345</h6>
                                        <small class="text-muted">2021 жыл</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Расписание и встречи -->
                <div id="scheduleContent" class="tab-content" style="display: none;">
                    <div class="content-card card">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Кесте және кездесулер</h6>
                        </div>
                        <div class="card-body">
                            <!-- Консультационные часы -->
                            <h6 class="mb-3"><i class="fas fa-clock me-2"></i>Кеңес сағаттары</h6>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <h6><i class="fas fa-calendar-day me-2"></i>Дүйсенбі</h6>
                                        <p class="mb-1">14:00 - 16:00</p>
                                        <small class="text-muted">Кабинет 402</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <h6><i class="fas fa-calendar-day me-2"></i>Бейсенбі</h6>
                                        <p class="mb-1">10:00 - 12:00</p>
                                        <small class="text-muted">Онлайн (Zoom)</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Ближайшие события -->
                            <h6 class="mb-3"><i class="fas fa-calendar-check me-2"></i>Жақындағы оқиғалар</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Күні</th>
                                            <th>Уақыт</th>
                                            <th>Оқиға</th>
                                            <th>Орын</th>
                                            <th>Түрі</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>15.05.2025</td>
                                            <td>09:00-11:00</td>
                                            <td>Кафедралық жиналыс</td>
                                            <td>Актовый зал</td>
                                            <td><span class="badge bg-primary">Мәжіліс</span></td>
                                        </tr>
                                        <tr>
                                            <td>16.05.2025</td>
                                            <td>14:00-16:00</td>
                                            <td>Дипломдық жобаларды қорғау</td>
                                            <td>Аудитория 305</td>
                                            <td><span class="badge bg-success">Қорғау</span></td>
                                        </tr>
                                        <tr>
                                            <td>20.05.2025</td>
                                            <td>10:00-13:00</td>
                                            <td>Халықаралық конференция</td>
                                            <td>Ғылыми кітапхана</td>
                                            <td><span class="badge bg-info">Конференция</span></td>
                                        </tr>
                                        <tr>
                                            <td>22.05.2025</td>
                                            <td>15:00-17:00</td>
                                            <td>Жобаларды тексеру</td>
                                            <td>Кабинет 402</td>
                                            <td><span class="badge bg-warning">Тексеру</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Календарь -->
                            <h6 class="mt-4 mb-3"><i class="fas fa-calendar me-2"></i>Мамыр айының кестесі</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="table-light">
                                            <th>Дс</th>
                                            <th>Сс</th>
                                            <th>Ср</th>
                                            <th>Бс</th>
                                            <th>Жм</th>
                                            <th>Сб</th>
                                            <th>Жк</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-muted">28</td>
                                            <td class="text-muted">29</td>
                                            <td class="text-muted">30</td>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td class="text-danger">4</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>6</td>
                                            <td>7</td>
                                            <td>8</td>
                                            <td>9</td>
                                            <td class="text-danger">10</td>
                                            <td class="text-danger">11</td>
                                        </tr>
                                        <tr>
                                            <td>12</td>
                                            <td class="bg-primary text-white">13</td>
                                            <td>14</td>
                                            <td class="bg-success text-white">15</td>
                                            <td class="bg-info text-white">16</td>
                                            <td class="text-danger">17</td>
                                            <td class="text-danger">18</td>
                                        </tr>
                                        <tr>
                                            <td>19</td>
                                            <td class="bg-warning text-white">20</td>
                                            <td>21</td>
                                            <td class="bg-secondary text-white">22</td>
                                            <td>23</td>
                                            <td class="text-danger">24</td>
                                            <td class="text-danger">25</td>
                                        </tr>
                                        <tr>
                                            <td>26</td>
                                            <td>27</td>
                                            <td>28</td>
                                            <td>29</td>
                                            <td>30</td>
                                            <td>31</td>
                                            <td class="text-muted">1</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-2 small">
                                    <span class="badge bg-primary me-2">Кафедралық жиналыс</span>
                                    <span class="badge bg-success me-2">Қорғау</span>
                                    <span class="badge bg-info me-2">Конференция</span>
                                    <span class="badge bg-warning me-2">Тексеру</span>
                                    <span class="badge bg-secondary me-2">Жиналыс</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Модальное окно смены аватара -->
    <div class="modal fade" id="avatarModal" tabindex="-1" aria-labelledby="avatarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="avatarModalLabel">
                        <i class="fas fa-camera me-2"></i>Профиль суретін өзгерту
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Жабу"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div id="avatarPreview" class="profile-avatar mx-auto mb-3" style="width: 200px; height: 200px;">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Жаңа сурет" class="w-100 h-100 rounded-circle">
                        </div>
                        <p class="text-muted small">Ұсынылған өлшем: 500x500 пиксель</p>
                    </div>
                    
                    <form id="avatarForm">
                        <div class="mb-3">
                            <label for="avatarInput" class="form-label">Файлды таңдау</label>
                            <input class="form-control" type="file" id="avatarInput" accept="image/*">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Немесе үлгілерден таңдаңыз:</label>
                            <div class="d-flex flex-wrap gap-2">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                                     class="avatar-option rounded-circle" 
                                     style="width: 60px; height: 60px; cursor: pointer;"
                                     data-src="https://randomuser.me/api/portraits/men/32.jpg">
                                <img src="https://randomuser.me/api/portraits/men/67.jpg" 
                                     class="avatar-option rounded-circle" 
                                     style="width: 60px; height: 60px; cursor: pointer;"
                                     data-src="https://randomuser.me/api/portraits/men/67.jpg">
                                <img src="https://randomuser.me/api/portraits/men/86.jpg" 
                                     class="avatar-option rounded-circle" 
                                     style="width: 60px; height: 60px; cursor: pointer;"
                                     data-src="https://randomuser.me/api/portraits/men/86.jpg">
                                <img src="https://randomuser.me/api/portraits/women/65.jpg" 
                                     class="avatar-option rounded-circle" 
                                     style="width: 60px; height: 60px; cursor: pointer;"
                                     data-src="https://randomuser.me/api/portraits/women/65.jpg">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Болдырмау</button>
                    <button type="button" class="btn btn-primary" id="saveAvatarBtn">Сақтау</button>
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
        // Функция для переключения табов
        function switchTab(tabId) {
            // Скрываем все табы
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.style.display = 'none';
            });
            
            // Убираем активный класс со всех кнопок
            document.querySelectorAll('.profile-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Показываем выбранный таб
            const activeTab = document.getElementById(tabId + 'Content');
            if (activeTab) {
                activeTab.style.display = 'block';
            }
            
            // Активируем кнопку
            const activeButton = document.querySelector(`[data-tab="${tabId}"]`);
            if (activeButton) {
                activeButton.classList.add('active');
            }
        }
        
        // Обработчики для табов
        document.querySelectorAll('.profile-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                switchTab(tabId);
            });
        });
        
        // Предпросмотр аватара из файла
        document.getElementById('avatarInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#avatarPreview img').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
        
        // Выбор аватара из шаблонов
        document.querySelectorAll('.avatar-option').forEach(option => {
            option.addEventListener('click', function() {
                const newSrc = this.getAttribute('data-src');
                document.querySelector('#avatarPreview img').src = newSrc;
                
                // Выделяем выбранный вариант
                document.querySelectorAll('.avatar-option').forEach(opt => {
                    opt.style.border = '2px solid transparent';
                });
                this.style.border = '2px solid var(--teacher-color)';
            });
        });
        
        // Сохранение аватара
        document.getElementById('saveAvatarBtn').addEventListener('click', function() {
            const newAvatarSrc = document.querySelector('#avatarPreview img').src;
            
            // Обновляем аватар на странице
            document.getElementById('profileAvatar').src = newAvatarSrc;
            
            // Сохраняем в localStorage
            localStorage.setItem('teacher_avatar', newAvatarSrc);
            
            // Закрываем модальное окно
            const modal = bootstrap.Modal.getInstance(document.getElementById('avatarModal'));
            modal.hide();
            
            // Показываем уведомление
            showNotification('Профиль суреті сәтті өзгертілді!', 'success');
        });
        
        // Загрузка сохраненного аватара при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            const savedAvatar = localStorage.getItem('teacher_avatar');
            if (savedAvatar) {
                document.getElementById('profileAvatar').src = savedAvatar;
            }
            
            // Кнопка редактирования профиля
            document.getElementById('editProfileBtn').addEventListener('click', function() {
                showNotification('Профильді өңдеу мүмкіндігі жақында қосылады', 'info');
            });
            
            // Навигация
            const currentPage = 'teacher_profile.php';
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPage) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
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