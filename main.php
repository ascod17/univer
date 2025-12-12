<?php
// student/main.php басына қосыңыз
session_start();

// Егер қолданушы кірмеген болса, немесе рөлі студент болмаса, кіру бетіне бағыттау
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'student') {
    // Бір деңгей жоғары шығып, index.php-ге бағыттау
    header("Location: ../index.php"); 
    exit;
}

// Сессиядан студенттің жеке деректерін алу
$user_full_name = $_SESSION['full_name'] ?? 'Құрметті студент';
$user_id = $_SESSION['user_id'] ?? 'N/A';
$user_username = $_SESSION['username'] ?? 'N/A';

// Егер бәрі дұрыс болса, код әрі қарай (HTML-ді көрсетуге) жалғасады.
?>



<!DOCTYPE html>
<html lang="kz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Басты бет | UNIVER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --univer-blue: #003366;
            --univer-dark: #123456;
            --univer-light: #0056b3;
            --univer-accent: #e9f2ff;
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
            color: #a3d5ff;
            text-decoration: none;
        }
        
        .top-info-bar a:hover {
            color: white;
            text-decoration: underline;
        }
        
        /* Основная навигация */
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
        
        .user-dropdown:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        /* Основной контент */
        .welcome-card {
            border-left: 5px solid var(--univer-light);
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
            background-color: var(--univer-accent);
            border-color: var(--univer-light);
            transform: scale(1.03);
        }
        
        .resource-btn i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--univer-light);
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
            color: var(--univer-light);
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .footer {
            background-color: var(--univer-dark);
            color: white;
            padding: 20px 0;
            margin-top: 40px;
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
                        <a class="nav-link active" href="main.php">
                            <i class="fas fa-home me-1"></i> Басты бет
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="oqu_process.html">
                            <i class="fas fa-book me-1"></i> Оқу процесі
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
                            <i class="fas fa-user-circle me-1"></i>  С.
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="students_profile.html"><i class="fas fa-user me-2"></i>Профиль</a></li>
                            <li><a class="dropdown-item" href="settings.php"><i class="fas fa-cog me-2"></i>Баптаулар</a></li>
                            <li><hr class="dropdown-divider"></li>
<li><a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i>Шығу</a></li>                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Основной контент -->
    <main class="container my-4">
        <!-- Приветствие -->
        <div class="alert alert-success welcome-card" role="alert">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <i class="fas fa-user-graduate fa-2x"></i>
                </div>
                <div>
                    <h5 class="alert-heading mb-1">Құрметті студент, <strong></strong>!</h5>
                    <p class="mb-0">Жүйеге қош келдіңіз! Қазіргі уақытта жүйе тестілеу кезеңінде өтуде. 
                    Кез-келген қателіктер байқалса, <a href="mailto:it@kaznu.kz" class="alert-link">it@kaznu.kz</a> мекенжайына хабарласыңыз.</p>
                </div>
            </div>
        </div>
        
        <!-- Ресурсы -->
        <div class="content-card card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-link me-2"></i>Қажетті ресурстар</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-3 col-sm-6">
                        <a href="library.php" class="btn btn-outline-primary resource-btn">
                            <i class="fas fa-book-open"></i>
                            <span>Электронды кітапхана</span>
                            <small class="text-muted mt-2">Оқу материалдары</small>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="moodle.php" class="btn btn-outline-primary resource-btn">
                            <i class="fas fa-laptop-code"></i>
                            <span>ДОЖ Moodle</span>
                            <small class="text-muted mt-2">Онлайн тестілеу</small>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="schedule.php" class="btn btn-outline-primary resource-btn">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Сабақ кестесі</span>
                            <small class="text-muted mt-2">Оқу процесі</small>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="payments.php" class="btn btn-outline-primary resource-btn">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <span>Төлемдер</span>
                            <small class="text-muted mt-2">Академиялық қарыздар</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Новости и уведомления -->
        <div class="row">
            <div class="col-lg-8">
                <div class="content-card card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-bullhorn me-2"></i>Соңғы жаңалықтар</h5>
                        <span class="badge bg-primary">Жаңа</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="news-item">
                            <div class="d-flex">
                                <div class="news-date me-3">10.05.2025</div>
                                <div>
                                    <h6>Сессия басталды</h6>
                                    <p class="mb-0">Күзгі семестрдің экзамендік сессиясы басталды. Барлық студенттерге академиялық қарыздарын тексеру ұсынылады.</p>
                                </div>
                            </div>
                        </div>
                        <div class="news-item">
                            <div class="d-flex">
                                <div class="news-date me-3">05.05.2025</div>
                                <div>
                                    <h6>Стипендия төлемдері</h6>
                                    <p class="mb-0">Мамыр айының стипендиясы 15 мамырға дейін төленеді. Төлемдер туралы ақпаратты жеке кабинеттен қараңыз.</p>
                                </div>
                            </div>
                        </div>
                        <div class="news-item">
                            <div class="d-flex">
                                <div class="news-date me-3">28.04.2025</div>
                                <div>
                                    <h6>Жазғы практика</h6>
                                    <p class="mb-0">Жазғы оқу-өндірістік практикаға қатысушы студентлерге тіркелу 30 мамырға дейін жалғасуда.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="news.php" class="btn btn-sm btn-outline-primary">Барлық жаңалықтар <i class="fas fa-arrow-right ms-1"></i></a>
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
                                <p class="mb-0 small">"Физика" пәнінен лабораториялық жұмыстардың мерзімі 20 мамырға дейін созылды.</p>
                            </div>
                        </div>
                        
                        <div class="alert alert-info d-flex align-items-start">
                            <i class="fas fa-info-circle me-3 mt-1"></i>
                            <div>
                                <strong>Ақпарат</strong> 
                                <p class="mb-0 small">Жаңа оқу жылына тіркелу 1 тамыздан басталады.</p>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <a href="tasks.php" class="btn btn-primary btn-sm">
                                <i class="fas fa-tasks me-1"></i> Менің тапсырмаларым
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="content-card card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Академиялық көрсеткіштер</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Орташа балл (GPA):</span>
                            <strong class="text-primary">3.75</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Алынған кредиттер:</span>
                            <strong class="text-primary">120</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Академиялық қарыз:</span>
                            <strong class="text-success">0 ₸</strong>
                        </div>
                        <div class="progress mt-3" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="text-center small text-muted mt-2">Оқу жылының 85% өтті</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Футер -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5><i class="fas fa-graduation-cap me-2"></i>UNIVER</h5>
                    <p class="small">Біз білім берудің сапасын арттыруға және болашақ мамандарды даярлауға баса назар аударамыз.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Байланыс ақпараты</h5>
                    <ul class="list-unstyled small">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Алматы, Тәуелсіздік көшесі 123</li>
                        <li><i class="fas fa-phone me-2"></i> 8 (727) 123-45-67</li>
                        <li><i class="fas fa-envelope me-2"></i> info@univer.kz</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Жүйе туралы</h5>
                    <p class="small">Бұл студенттер порталының прототипі. Нақты мәліметтер қолжетімді емес.</p>
                    <div class="small text-muted">
                        © 2025 UNIVER. Барлық құқықтар қорғалған.
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
            const currentPage = 'main.php';
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPage) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
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
        });
    </script>
</body>
</html>