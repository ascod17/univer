<?php
// PHP конфигурациясы
session_start();

// Рөлді анықтау (тест үшін GET параметрін қалдырамыз)
// Нақты жүйеде: $isTeacher = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'teacher';
$isTeacher = isset($_GET['role']) && $_GET['role'] === 'teacher';
$currentUser = $isTeacher ? "Нұрлан С. (Мұғалім)" : "Әлия Қ. (Студент)";
$uploadMessage = '';
$uploadError = '';
$jsonFile = 'library_files.json';
$uploadDir = 'uploads/library/';


// --- ҚОСЫМША ФУНКЦИЯЛАР ---

/**
 * Файл өлшемін оңай оқылатын форматқа ауыстырады
 * @param int $bytes - Файлдың өлшемі байтпен
 * @return string - Форматталған өлшем
 */
function formatFileSize($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        return $bytes . ' байт';
    } else {
        return '0 байт';
    }
}

// --- ФАЙЛ ЖҮКТЕУ ЛОГИКАСЫ (МҰҒАЛІМ) ---

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isTeacher && isset($_FILES['library_file'])) {
    
    // Егер uploads директориясы болмаса, жасау
    if (!file_exists($uploadDir)) {
        // 0777 рұқсатымен (мұқият қолданыңыз!)
        mkdir($uploadDir, 0777, true); 
    }
    
    $fileNameOriginal = basename($_FILES['library_file']['name']);
    $fileSize = $_FILES['library_file']['size'];
    $fileTmp = $_FILES['library_file']['tmp_name'];
    $fileType = strtolower(pathinfo($fileNameOriginal, PATHINFO_EXTENSION));
    $fileDisplayName = !empty($_POST['file_name']) ? htmlspecialchars(trim($_POST['file_name'])) : $fileNameOriginal;
    
    // Рұқсат етілген файл түрлері
    $allowedTypes = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'txt', 'jpg', 'jpeg', 'png', 'zip', 'rar'];
    $maxSize = 10 * 1024 * 1024; // 10MB
    
    if ($fileSize > $maxSize) {
        $uploadError = 'Файлдың өлшемі 10MB-тан аспауы керек';
    } elseif (!in_array($fileType, $allowedTypes)) {
        $uploadError = 'Рұқсат етілмеген файл түрі: ' . $fileType;
    } else {
        // Бірегей файл аты
        $uniqueName = time() . '_' . uniqid() . '.' . $fileType;
        // Серверде сақтау жолы
        $uploadPath = $uploadDir . $uniqueName; 
        
        if (move_uploaded_file($fileTmp, $uploadPath)) {
            $uploadMessage = 'Файл сәтті жүктелді! Атауы: ' . $fileDisplayName;
            
            // Жаңа файл деректерін дайындау
            $fileData = [
                'id' => uniqid(),
                'name' => $fileDisplayName, // Көрсетілетін атау
                'path' => $uniqueName,      // Сервердегі бірегей атау
                'size' => $fileSize,
                'type' => $fileType,
                'upload_date' => date('d.m.Y H:i'),
                'uploader' => $currentUser,
                'downloads' => 0,
                'category' => $_POST['category'] ?? 'other',
                'description' => $_POST['description'] ?? ''
            ];
            
            // Файлдар тізімін сақтау (JSON)
            $filesList = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
            array_unshift($filesList, $fileData);
            file_put_contents($jsonFile, json_encode($filesList, JSON_PRETTY_PRINT));
            
            // Жүктеуден кейін бетті жаңарту (Post/Redirect/Get pattern)
            header("Location: " . $_SERVER['PHP_SELF'] . "?role=teacher");
            exit();
            
        } else {
            $uploadError = 'Файлды жүктеу кезінде қате орын алды. Сервер рұқсатын тексеріңіз.';
        }
    }
}


// --- ФАЙЛДАР ТІЗІМІН ЖҮКТЕУ ---
// Бұл блок JSON-нан деректерді оқиды.
$filesList = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];

// Егер нақты файлдар жоқ болса, мысалдық деректерді қосу.
if (empty($filesList) && !file_exists($uploadDir . 'Компьютерлік желілер оқулығы.pdf')) {
    // Ескерту: Нақты жүйеде бұл "path" элементі сервердегі нақты файлға сілтеуі керек.
    // Мен "download.php" скриптіне сілтеу үшін id қолданамын.
    $filesList = [
        [
            'id' => '1',
            'name' => 'Компьютерлік желілер оқулығы.pdf',
            'path' => 'example_network.pdf', // Мысалдық файлдың атауы
            'size' => '2456789',
            'type' => 'pdf',
            'upload_date' => '15.04.2025 10:30',
            'uploader' => 'Айгүл М.',
            'downloads' => 45,
            'category' => 'book',
            'description' => 'Негізгі курс бойынша оқулық.'
        ],
        // ... (сіздің басқа мысалдық файлдарыңыз)
    ];
}

// Файлды жою логикасы
if ($isTeacher && isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $fileIdToDelete = $_GET['id'];
    $key = -1;
    
    // Файлды тізімнен табу
    foreach ($filesList as $index => $file) {
        if ($file['id'] === $fileIdToDelete) {
            $key = $index;
            break;
        }
    }

    if ($key !== -1) {
        // Файлды серверден жою
        $filePath = $uploadDir . $filesList[$key]['path'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Файлды тізімнен жою
        array_splice($filesList, $key, 1);
        file_put_contents($jsonFile, json_encode($filesList, JSON_PRETTY_PRINT));
        $uploadMessage = "Файл сәтті жойылды.";
    } else {
        $uploadError = "Жойылатын файл табылмады.";
    }

    // Жоюдан кейін бетті жаңарту
    header("Location: " . $_SERVER['PHP_SELF'] . "?role=teacher");
    exit();
}

?>

<!DOCTYPE html>
<html lang="kz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Электронды кітапхана | UNIVER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Сіздің CSS стильдеріңіз осы жерде қалады */
        :root {
            --univer-blue: #003366;
            --univer-dark: #123456;
            --univer-light: #0056b3;
            --univer-accent: #e9f2ff;
            --univer-success: #28a745;
        }
        
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; }
        .top-info-bar { background-color: var(--univer-dark); color: white; padding: 8px 0; font-size: 0.9rem; }
        .main-navbar { background-color: var(--univer-blue); box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        .navbar-brand { font-weight: bold; font-size: 1.5rem; color: white !important; }
        .nav-link { color: white !important; padding: 10px 15px !important; margin: 0 2px; border-radius: 4px; transition: all 0.3s; }
        .nav-link:hover { background-color: rgba(255, 255, 255, 0.15); }
        .nav-link.active { background-color: var(--univer-light) !important; }
        .user-dropdown { background-color: rgba(255, 255, 255, 0.1); border-radius: 20px; padding: 5px 15px; }
        .library-card { border-radius: 10px; border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); transition: transform 0.3s; margin-bottom: 25px; }
        .library-card:hover { transform: translateY(-3px); }
        .card-header { background-color: var(--univer-accent) !important; border-bottom: 1px solid rgba(0, 0, 0, 0.05); font-weight: 600; }
        .file-item { border: 1px solid #e9ecef; border-radius: 8px; padding: 15px; margin-bottom: 10px; transition: all 0.3s; background-color: white; }
        .file-item:hover { border-color: var(--univer-light); background-color: #f8f9ff; }
        .file-icon { font-size: 2.5rem; margin-right: 15px; }
        .file-icon.pdf { color: #e74c3c; }
        .file-icon.docx, .file-icon.doc { color: #2b579a; }
        .file-icon.pptx, .file-icon.ppt { color: #d24726; }
        .file-icon.xlsx, .file-icon.xls { color: #217346; }
        .file-icon.zip, .file-icon.rar { color: #f39c12; }
        .file-icon.jpg, .file-icon.png, .file-icon.jpeg { color: #9b59b6; }
        .file-icon.txt { color: #7f8c8d; }
        .file-size, .file-downloads { font-size: 0.9rem; }
        .file-downloads { color: var(--univer-light); font-weight: 600; }
        .upload-area { border: 2px dashed #dee2e6; border-radius: 10px; padding: 30px; text-align: center; background-color: #f8f9fa; cursor: pointer; transition: all 0.3s; }
        .upload-area:hover { border-color: var(--univer-light); background-color: #e9f2ff; }
        .upload-area.dragover { border-color: var(--univer-success); background-color: #e8f5e9; }
        .teacher-badge { background-color: var(--univer-success); color: white; padding: 3px 10px; border-radius: 15px; font-size: 0.8rem; font-weight: 600; }
        .student-badge { background-color: #6c757d; color: white; padding: 3px 10px; border-radius: 15px; font-size: 0.8rem; font-weight: 600; }
        .role-switcher { background-color: #e9ecef; border-radius: 5px; padding: 10px; margin-bottom: 20px; }
        .footer { background-color: var(--univer-dark); color: white; padding: 20px 0; margin-top: 40px; }
        
        @media (max-width: 768px) {
            .file-item { display: block; }
            .ms-3 { margin-top: 10px; }
            .file-icon { margin-bottom: 10px; }
            .dropdown-toggle::after { margin-left: 0.255em; }
        }
    </style>
</head>
<body>
    
    <div class="top-info-bar">...</div>
    <nav class="navbar navbar-expand-lg main-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="main.php"><i class="fas fa-graduation-cap me-2"></i>UNIVER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"><i class="fas fa-bars text-white"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="main.php"><i class="fas fa-home me-1"></i> Басты бет</a></li>
                    <li class="nav-item"><a class="nav-link active" href="library.php"><i class="fas fa-book-open me-1"></i> Кітапхана</a></li>
                    </ul>
                <div class="d-flex align-items-center">
                    <span class="me-3 <?php echo $isTeacher ? 'teacher-badge' : 'student-badge'; ?>">
                        <i class="fas <?php echo $isTeacher ? 'fa-chalkboard-teacher' : 'fa-user-graduate'; ?> me-1"></i>
                        <?php echo $isTeacher ? 'Мұғалім' : 'Студент'; ?>
                    </span>
                    <div class="dropdown">
                        <a href="#" class="nav-link user-dropdown dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> <?php echo $currentUser; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="student_logout.php"><i class="fas fa-sign-out-alt me-2"></i>Шығу</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <main class="container my-4">
        <div class="alert alert-info library-card" role="alert">
            <div class="d-flex align-items-center justify-content-between">
                <div>...</div>
                <div class="role-switcher">
                    <small class="text-muted d-block mb-1">Рөлді өзгерту (тест үшін):</small>
                    <div class="btn-group btn-group-sm">
                        <a href="library.php?role=teacher" class="btn <?php echo $isTeacher ? 'btn-success' : 'btn-outline-success'; ?>"><i class="fas fa-chalkboard-teacher"></i> Мұғалім</a>
                        <a href="library.php?role=student" class="btn <?php echo !$isTeacher ? 'btn-secondary' : 'btn-outline-secondary'; ?>"><i class="fas fa-user-graduate"></i> Студент</a>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if($isTeacher): ?>
        <div class="library-card card mb-4" id="uploadSection">
            <div class="card-header"><h5 class="mb-0"><i class="fas fa-cloud-upload-alt me-2"></i>Файл жүктеу</h5></div>
            <div class="card-body">
                <?php if($uploadMessage && !isset($_GET['action'])): ?><div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i> <?php echo $uploadMessage; ?><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div><?php endif; ?>
                <?php if($uploadError): ?><div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle me-2"></i> <?php echo $uploadError; ?><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div><?php endif; ?>
                
                <form action="library.php?role=teacher" method="POST" enctype="multipart/form-data">
                    <div class="upload-area" id="dropArea" onclick="document.getElementById('fileInput').click()">
                        <i class="fas fa-file-upload fa-3x mb-3 text-primary"></i>
                        <h5>Файлды осы жерге тартыңыз немесе басыңыз</h5>
                        <p class="text-muted">PDF, DOC, PPT, XLS, JPG, PNG, ZIP, RAR (макс. 10MB)</p>
                        <input type="file" name="library_file" id="fileInput" class="d-none" required accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.jpg,.jpeg,.png,.zip,.rar,.txt">
                        <div id="selectedFile" class="mt-3"></div>
                    </div>
                    
                    <div class="mt-3">
                        <div class="mb-3">
                            <label for="fileName" class="form-label">Файл атауы (міндетті емес)</label>
                            <input type="text" class="form-control" id="fileName" name="file_name" placeholder="Файлдың жаңа атауын енгізіңіз...">
                        </div>
                        <div class="mb-3">
                            <label for="fileCategory" class="form-label">Санат</label>
                            <select class="form-select" id="fileCategory" name="category">
                                <option value="lecture">Лекция</option>
                                <option value="lab">Зертханалық жұмыс</option>
                                <option value="practice">Практикалық жұмыс</option>
                                <option value="exam">Емтихан материалдары</option>
                                <option value="book">Оқулық</option>
                                <option value="other">Басқа</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fileDescription" class="form-label">Сипаттама (міндетті емес)</label>
                            <textarea class="form-control" id="fileDescription" name="description" rows="2" placeholder="Файл туралы қысқаша сипаттама..."></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-upload me-2"></i> Файлды жүктеу
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="library-card card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Қолжетімді файлдар</h5>
                <div>
                    <span class="badge bg-primary">Барлығы: <?php echo count($filesList); ?></span>
                </div>
            </div>
            <div class="card-body">
                <div id="filesList">
                    <?php 
                    $fileFilterType = isset($_GET['filter']) ? $_GET['filter'] : 'all';
                    foreach($filesList as $file): 
                        $fileExtension = strtolower($file['type']);
                        $iconClass = "fa-file";
                        
                        if (in_array($fileExtension, ['pdf'])) $iconClass = "fa-file-pdf";
                        elseif (in_array($fileExtension, ['doc', 'docx'])) $iconClass = "fa-file-word";
                        elseif (in_array($fileExtension, ['ppt', 'pptx'])) $iconClass = "fa-file-powerpoint";
                        elseif (in_array($fileExtension, ['xls', 'xlsx'])) $iconClass = "fa-file-excel";
                        elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png'])) $iconClass = "fa-file-image";
                        elseif (in_array($fileExtension, ['zip', 'rar'])) $iconClass = "fa-file-archive";
                        elseif (in_array($fileExtension, ['txt'])) $iconClass = "fa-file-alt";
                        
                        $fileSizeFormatted = formatFileSize($file['size']);
                        
                        // Файлдың оқу (View) және жүктеу (Download) сілтемелері
                        $downloadLink = "download.php?id=" . $file['id'];
                        $viewLink = "#"; // Көбінесе PDF үшін ғана жұмыс істейді
                        
                        // PDF болса, View сілтемесін береміз
                        if ($fileExtension === 'pdf' && file_exists($uploadDir . $file['path'])) {
                            // Ескерту: Нақты жол: /uploads/library/unique_filename.pdf
                            // Бірақ біз id арқылы динамикалық жол береміз.
                            $viewLink = $uploadDir . $file['path']; // Браузер тікелей оқуға тырысады
                        }
                    ?>
                    <div class="file-item" data-type="<?php echo $fileExtension; ?>" data-name="<?php echo htmlspecialchars($file['name']); ?>">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="file-icon <?php echo $fileExtension; ?>"><i class="fas <?php echo $iconClass; ?>"></i></div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><?php echo htmlspecialchars($file['name']); ?> 
                                        <span class="badge bg-info text-dark ms-2"><?php echo strtoupper($fileExtension); ?></span>
                                    </h6>
                                    <div class="d-flex flex-wrap small text-muted">
                                        <span class="me-3"><i class="fas fa-hdd me-1"></i> <?php echo $fileSizeFormatted; ?></span>
                                        <span class="me-3"><i class="fas fa-calendar me-1"></i> <?php echo $file['upload_date']; ?></span>
                                        <span class="me-3"><i class="fas fa-user me-1"></i> <?php echo $file['uploader']; ?></span>
                                        <span class="file-downloads me-3"><i class="fas fa-download me-1"></i> <?php echo $file['downloads']; ?></span>
                                        <span class="badge bg-secondary"><i class="fas fa-tag me-1"></i> <?php echo ucfirst($file['category']); ?></span>
                                    </div>
                                    <?php if (!empty($file['description'])): ?>
                                        <p class="small text-secondary mt-1 mb-0">Сипаттама: <?php echo htmlspecialchars($file['description']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="ms-3 d-flex flex-column flex-md-row align-items-stretch">
                                <?php if ($fileExtension === 'pdf' && file_exists($uploadDir . $file['path'])): ?>
                                <a href="<?php echo $viewLink; ?>" class="btn btn-sm btn-outline-primary mb-1 mb-md-0 me-md-2" title="Қарау" target="_blank">
                                    <i class="fas fa-eye me-1"></i> Оқу
                                </a>
                                <?php else: ?>
                                <button class="btn btn-sm btn-outline-secondary mb-1 mb-md-0 me-md-2 disabled" title="Онлайн оқу мүмкін емес" disabled>
                                    <i class="fas fa-eye-slash me-1"></i> Оқу
                                </button>
                                <?php endif; ?>

                                <a href="<?php echo $downloadLink; ?>" class="btn btn-sm btn-success mb-1 mb-md-0 me-md-2" title="Жүктеп алу">
                                    <i class="fas fa-download me-1"></i> Жүктеу
                                </a>

                                <?php if($isTeacher): ?>
                                    <a href="library.php?role=teacher&action=delete&id=<?php echo $file['id']; ?>" class="btn btn-sm btn-outline-danger mt-1 mt-md-0" title="Жою" onclick="return confirm('Сіз шынымен де бұл файлды жойғыңыз келеді ме?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <?php if(empty($filesList)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                            <h5>Файлдар табылмады</h5>
                            <p class="text-muted">Кітапханада әлі файлдар жоқ</p>
                            <?php if($isTeacher): ?>
                            <a href="#uploadSection" class="btn btn-primary"><i class="fas fa-upload me-1"></i> Бірінші файлды жүктеу</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                </div>
        </div>
    </main>
    
    <footer class="footer">...</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ... (Файл жүктеу Drag&Drop және іздеу/сүзгілеу скрипттері) ...
        
        // Файл атауын көрсету скрипті
        document.getElementById('fileInput').addEventListener('change', function() {
            const fileInput = this;
            const selectedFileDiv = document.getElementById('selectedFile');
            const fileNameInput = document.getElementById('fileName');
            if (fileInput.files.length > 0) {
                selectedFileDiv.innerHTML = `<i class="fas fa-file-alt me-2 text-success"></i> <strong>Таңдалған файл:</strong> ${fileInput.files[0].name} (${(fileInput.files[0].size / 1024 / 1024).toFixed(2)} MB)`;
                // Файл атын автоматты түрде енгізу (егер бұрын енгізілмесе)
                if (fileNameInput.value.trim() === '') {
                    fileNameInput.value = fileInput.files[0].name.split('.').slice(0, -1).join('.');
                }
            } else {
                selectedFileDiv.innerHTML = '';
            }
        });

        // Search and Filter Logic (Сіздің кодыңыздан)
        function filterFiles() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const filterSelect = document.getElementById('filterSelect').value;
            const fileItems = document.querySelectorAll('#filesList .file-item');

            fileItems.forEach(item => {
                const fileName = item.getAttribute('data-name').toLowerCase();
                const fileType = item.getAttribute('data-type');
                
                let matchesSearch = fileName.includes(searchInput);
                let matchesFilter = filterSelect === 'all' || fileType === filterSelect || (filterSelect === 'doc' && (fileType === 'doc' || fileType === 'docx')) || (filterSelect === 'ppt' && (fileType === 'ppt' || fileType === 'pptx')) || (filterSelect === 'xls' && (fileType === 'xls' || fileType === 'xlsx')) || (filterSelect === 'image' && (fileType === 'jpg' || fileType === 'jpeg' || fileType === 'png')) || (filterSelect === 'archive' && (fileType === 'zip' || fileType === 'rar'));

                if (matchesSearch && matchesFilter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        document.getElementById('searchInput').addEventListener('input', filterFiles);
        document.getElementById('filterSelect').addEventListener('change', filterFiles);
        document.getElementById('clearSearch').addEventListener('click', () => {
             document.getElementById('searchInput').value = '';
             filterFiles();
        });
    </script>
</body>
</html>