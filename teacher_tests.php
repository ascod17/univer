<?php
session_start();

// Қолданылатын файлдар
$testsFile = 'tests_data.json';
$questionsFile = 'questions_data.json';

// Файлдарды оқу функциялары
function loadData($filename) {
    if (file_exists($filename)) {
        $data = file_get_contents($filename);
        return json_decode($data, true) ?: [];
    }
    return [];
}

// Файлдарға жазу функциялары
function saveData($filename, $data) {
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($filename, $json);
}

// Деректерді жүктеу
$subjects = loadData($testsFile);
$testQuestions = loadData($questionsFile);

// Мұғалімнің аты (бұл жерде сіздің студенттер кодыңызда көрсетілген мұғалім атын қолданамыз)
$currentUser = "Нұрлан С."; // Немесе авторизациядан алынған нақты мұғалім аты

// Мұғалімнің тек өзінің тесттерін сүзу
$teacherSubjects = array_filter($subjects, function($subject) use ($currentUser) {
    return $subject['teacher'] === $currentUser;
});

// Қазіргі әрекетті анықтау
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$subjectId = isset($_GET['subject']) ? $_GET['subject'] : null;
$currentSubject = $subjectId && isset($subjects[$subjectId]) ? $subjects[$subjectId] : null;


// --- POST Өңдеу Логикасы ---

// 1. Жаңа тест құру
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_test'])) {
    $newId = strtolower(str_replace(' ', '_', trim($_POST['subject_id'])));
    
    if (isset($subjects[$newId])) {
        // ID бұрыннан бар
        $message = "Қате: '$newId' ID-мен тест бұрыннан бар.";
        $messageType = 'danger';
    } else {
        $newSubject = [
            'id' => $newId,
            'name' => trim($_POST['subject_name']),
            'code' => trim($_POST['subject_code']),
            'teacher' => $currentUser,
            'description' => trim($_POST['description']),
            'time_limit' => (int)$_POST['time_limit'],
            'total_questions' => 0,
            'total_score' => 0
        ];

        $subjects[$newId] = $newSubject;
        if (saveData($testsFile, $subjects)) {
            // Жаңа тестке арналған бос сұрақтар массивін инициализациялау
            $testQuestions[$newId] = [];
            saveData($questionsFile, $testQuestions);
            $message = "Тест **'{$newSubject['name']}'** сәтті құрылды. Енді сұрақтар қосуға болады.";
            $messageType = 'success';
            // Жаңа тестті өңдеу бетіне бағыттау
            header("Location: teacher_tests.php?action=edit&subject={$newId}&msg=" . urlencode($message));
            exit;
        } else {
            $message = "Қате: Тестті сақтау мүмкін болмады. Файлға жазу рұқсатын тексеріңіз.";
            $messageType = 'danger';
        }
    }
}

// 2. Сұрақ қосу
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_question']) && $currentSubject) {
    $currentSubjectId = $currentSubject['id'];
    
    $newQuestion = [
        'id' => count($testQuestions[$currentSubjectId]) + 1,
        'question' => trim($_POST['question']),
        'options' => [
            'a' => trim($_POST['option_a']),
            'b' => trim($_POST['option_b']),
            'c' => trim($_POST['option_c']),
            'd' => trim($_POST['option_d']),
        ],
        'correct' => trim($_POST['correct_answer']),
        'score' => (int)$_POST['score']
    ];

    // Сұрақты қосу
    $testQuestions[$currentSubjectId][] = $newQuestion;
    
    // Тесттің жалпы статистикасын жаңарту
    $totalQuestions = count($testQuestions[$currentSubjectId]);
    $totalScore = array_sum(array_column($testQuestions[$currentSubjectId], 'score'));

    $subjects[$currentSubjectId]['total_questions'] = $totalQuestions;
    $subjects[$currentSubjectId]['total_score'] = $totalScore;

    if (saveData($questionsFile, $testQuestions) && saveData($testsFile, $subjects)) {
        $message = "Сұрақ сәтті қосылды. Жалпы сұрақтар: {$totalQuestions}, Жалпы балл: {$totalScore}";
        $messageType = 'success';
    } else {
        $message = "Қате: Сұрақты немесе тест статистикасын сақтау мүмкін болмады.";
        $messageType = 'danger';
    }

    // Қайта бағыттау: POST деректерін қайта жіберуді болдырмау үшін
    header("Location: teacher_tests.php?action=edit&subject={$currentSubjectId}&msg=" . urlencode($message));
    exit;
}

// Жою логикасы (сұрақ немесе тест)
if (isset($_GET['delete_question']) && $currentSubject) {
    $qIdToDelete = (int)$_GET['delete_question'];
    $currentSubjectId = $currentSubject['id'];
    
    // Сұрақты массивтен жою
    $updatedQuestions = [];
    $newQuestionId = 1;
    $deleted = false;
    foreach ($testQuestions[$currentSubjectId] as $question) {
        if ($question['id'] !== $qIdToDelete) {
            $question['id'] = $newQuestionId++; // ID-ді реттеу
            $updatedQuestions[] = $question;
        } else {
            $deleted = true;
        }
    }
    
    if ($deleted) {
        $testQuestions[$currentSubjectId] = $updatedQuestions;

        // Тесттің жалпы статистикасын жаңарту
        $totalQuestions = count($testQuestions[$currentSubjectId]);
        $totalScore = array_sum(array_column($testQuestions[$currentSubjectId], 'score'));
        $subjects[$currentSubjectId]['total_questions'] = $totalQuestions;
        $subjects[$currentSubjectId]['total_score'] = $totalScore;

        if (saveData($questionsFile, $testQuestions) && saveData($testsFile, $subjects)) {
            $message = "Сұрақ сәтті жойылды.";
            $messageType = 'success';
        } else {
            $message = "Қате: Сұрақты жою кезінде деректерді сақтау мүмкін болмады.";
            $messageType = 'danger';
        }
    } else {
        $message = "Қате: Сұрақ табылмады.";
        $messageType = 'danger';
    }
    
    header("Location: teacher_tests.php?action=edit&subject={$currentSubjectId}&msg=" . urlencode($message));
    exit;
}

if (isset($_GET['delete_test'])) {
    $tIdToDelete = $_GET['delete_test'];
    
    if (isset($subjects[$tIdToDelete])) {
        if ($subjects[$tIdToDelete]['teacher'] === $currentUser) {
            unset($subjects[$tIdToDelete]);
            unset($testQuestions[$tIdToDelete]);
            
            if (saveData($testsFile, $subjects) && saveData($questionsFile, $testQuestions)) {
                $message = "Тест сәтті жойылды.";
                $messageType = 'success';
            } else {
                $message = "Қате: Тестті жою кезінде деректерді сақтау мүмкін болмады.";
                $messageType = 'danger';
            }
        } else {
             $message = "Қате: Сіз бұл тестті жоя алмайсыз, себебі оны басқа мұғалім құрған.";
             $messageType = 'danger';
        }
    } else {
        $message = "Қате: Тест табылмады.";
        $messageType = 'danger';
    }
    
    header("Location: teacher_tests.php?msg=" . urlencode($message));
    exit;
}

// Хабарламаларды өңдеу
$message = isset($_GET['msg']) ? urldecode($_GET['msg']) : null;
$messageType = isset($_GET['msg_type']) ? $_GET['msg_type'] : 'success'; // msg_type қоспадық, бірақ осылай іске асыруға болады
if ($message && !isset($messageType)) {
    // Егер msg_type қойылмаса, POST логикасындағыдай әдепкі мән қолданамыз
    $messageType = (strpos($message, 'Қате') !== false || strpos($message, 'Error') !== false) ? 'danger' : 'success';
}

// Тесттер тізімін жаңарту (қайта бағыттаудан кейін)
$teacherSubjects = array_filter($subjects, function($subject) use ($currentUser) {
    return $subject['teacher'] === $currentUser;
});

?>

<!DOCTYPE html>
<html lang="kz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ДОЖ Moodle | Мұғалім тесттері</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --univer-blue: #003366;
            --univer-dark: #123456;
            --univer-light: #0056b3;
            --moodle-purple: #9800ff;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; }
        .main-navbar { background-color: var(--univer-blue); box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        .navbar-brand { font-weight: bold; font-size: 1.5rem; color: white !important; }
        .nav-link { color: white !important; padding: 10px 15px !important; margin: 0 2px; border-radius: 4px; transition: all 0.3s; }
        .nav-link:hover { background-color: rgba(255, 255, 255, 0.15); }
        .nav-link.active { background-color: var(--univer-light) !important; }
        .user-dropdown { background-color: rgba(255, 255, 255, 0.1); border-radius: 20px; padding: 5px 15px; }

        .moodle-card { border-radius: 10px; border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); margin-bottom: 25px; }
        .moodle-header { background: linear-gradient(135deg, var(--moodle-purple), #6a11cb); color: white; border-radius: 10px 10px 0 0; padding: 20px; }
        .test-item-card { border: 1px solid #e9ecef; transition: all 0.3s; }
        .test-item-card:hover { border-color: var(--moodle-purple); box-shadow: 0 5px 15px rgba(152, 0, 255, 0.1); }
        .question-card { border: 1px solid #dee2e6; border-left: 5px solid #0d6efd; border-radius: 8px; padding: 20px; margin-bottom: 15px; background-color: #ffffff; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg main-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="main_teacher.php">
                <i class="fas fa-graduation-cap me-2"></i>UNIVER
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"><i class="fas fa-bars text-white"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="teacher_tests.php">
                            <i class="fas fa-chalkboard-teacher me-1"></i> Мұғалім парақшасы
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="nav-link user-dropdown dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> <?php echo $currentUser; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Шығу</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <main class="container my-4">
        <div class="moodle-card">
            <div class="moodle-header">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-laptop-code fa-3x"></i>
                    </div>
                    <div>
                        <h2 class="mb-1">Тесттерді басқару жүйесі</h2>
                        <p class="mb-0">Құрметті <?php echo $currentUser; ?>, өз тесттеріңізді құру, өңдеу және жою парақшасы.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                <i class="fas fa-<?php echo $messageType === 'success' ? 'check-circle' : 'exclamation-triangle'; ?> me-2"></i>
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($action === 'list'): ?>
            <div class="row mb-4">
                <div class="col-12">
                    <a href="?action=create" class="btn btn-lg btn-success">
                        <i class="fas fa-plus-circle me-2"></i> Жаңа тест құру
                    </a>
                </div>
            </div>

            <div class="moodle-card p-3">
                <h4 class="card-title mb-4"><i class="fas fa-list-alt me-2"></i> Менің тесттерім (<?php echo count($teacherSubjects); ?>)</h4>
                
                <?php if (empty($teacherSubjects)): ?>
                    <div class="alert alert-info text-center py-4">
                        <i class="fas fa-info-circle fa-2x mb-2"></i>
                        <p class="mb-0">Сіз әлі ешқандай тест құрған жоқсыз.</p>
                    </div>
                <?php else: ?>
                    <div class="list-group">
                        <?php foreach($teacherSubjects as $subject): ?>
                            <div class="list-group-item list-group-item-action test-item-card mb-3 p-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1 text-primary"><?php echo $subject['name']; ?> <small class="text-muted">(<?php echo $subject['code']; ?>)</small></h5>
                                    <p class="mb-1 small text-muted"><?php echo $subject['description']; ?></p>
                                    <span class="badge bg-info me-2"><i class="fas fa-clock"></i> <?php echo $subject['time_limit']; ?> мин</span>
                                    <span class="badge bg-warning me-2"><i class="fas fa-question-circle"></i> <?php echo $subject['total_questions']; ?> сұрақ</span>
                                    <span class="badge bg-success"><i class="fas fa-award"></i> <?php echo $subject['total_score']; ?> балл</span>
                                </div>
                                <div>
                                    <a href="?action=edit&subject=<?php echo $subject['id']; ?>" class="btn btn-sm btn-primary me-2" title="Сұрақтарды өңдеу/қосу">
                                        <i class="fas fa-edit"></i> Өңдеу
                                    </a>
                                    <a href="?delete_test=<?php echo $subject['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Сіз шынымен де «<?php echo $subject['name']; ?>» тестін жойғыңыз келеді ме?')" title="Тестті толығымен жою">
                                        <i class="fas fa-trash-alt"></i> Жою
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($action === 'create'): ?>
            <div class="moodle-card p-4">
                <h4 class="card-title mb-4"><i class="fas fa-file-alt me-2"></i> Жаңа Тест Құру</h4>
                <form action="teacher_tests.php" method="POST">
                    <div class="mb-3">
                        <label for="subject_name" class="form-label">Пәннің атауы (мысалы: Python-да бағдарламалау)</label>
                        <input type="text" class="form-control" id="subject_name" name="subject_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Тест ID (ағылшынша, кішкентай әріппен, бірегей ID, мысалы: python)</label>
                        <input type="text" class="form-control" id="subject_id" name="subject_id" pattern="[a-z0-9_]+" title="Тек кішкентай латын әріптері мен астын сызуға рұқсат етіледі" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject_code" class="form-label">Пән коды (мысалы: CS-403)</label>
                        <input type="text" class="form-control" id="subject_code" name="subject_code" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Қысқаша сипаттама</label>
                        <textarea class="form-control" id="description" name="description" rows="2" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="time_limit" class="form-label">Уақыт шектеуі (минут)</label>
                        <input type="number" class="form-control" id="time_limit" name="time_limit" value="20" min="5" required>
                    </div>
                    
                    <button type="submit" name="create_test" class="btn btn-success me-2"><i class="fas fa-plus-circle me-1"></i> Тестті құру</button>
                    <a href="teacher_tests.php" class="btn btn-secondary">Артқа</a>
                </form>
            </div>
        <?php endif; ?>

        <?php if ($action === 'edit' && $currentSubject): ?>
            <?php 
                $currentQuestions = isset($testQuestions[$currentSubject['id']]) ? $testQuestions[$currentSubject['id']] : [];
            ?>
            <h3 class="mb-3"><i class="fas fa-edit me-2"></i> "<?php echo $currentSubject['name']; ?>" тестін өңдеу</h3>
            <div class="alert alert-info">
                <strong>Тест ақпараты:</strong> Сұрақтар: **<?php echo count($currentQuestions); ?>** | Жалпы балл: **<?php echo $currentSubject['total_score']; ?>** | Уақыт: **<?php echo $currentSubject['time_limit']; ?> мин**
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="moodle-card p-4 mb-4">
                        <h5 class="card-title mb-3 text-primary"><i class="fas fa-plus me-2"></i> Жаңа сұрақ қосу</h5>
                        <form action="teacher_tests.php?action=edit&subject=<?php echo $currentSubject['id']; ?>" method="POST">
                            <input type="hidden" name="subject_id" value="<?php echo $currentSubject['id']; ?>">
                            
                            <div class="mb-3">
                                <label for="question" class="form-label">Сұрақ мәтіні</label>
                                <textarea class="form-control" id="question" name="question" rows="3" required></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="option_a" class="form-label">А жауабы</label>
                                    <input type="text" class="form-control" id="option_a" name="option_a" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="option_b" class="form-label">В жауабы</label>
                                    <input type="text" class="form-control" id="option_b" name="option_b" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="option_c" class="form-label">С жауабы</label>
                                    <input type="text" class="form-control" id="option_c" name="option_c" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="option_d" class="form-label">D жауабы</label>
                                    <input type="text" class="form-control" id="option_d" name="option_d" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="correct_answer" class="form-label">Дұрыс жауап (a, b, c немесе d)</label>
                                    <select class="form-select" id="correct_answer" name="correct_answer" required>
                                        <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="score" class="form-label">Балл</label>
                                    <input type="number" class="form-control" id="score" name="score" value="1" min="1" required>
                                </div>
                            </div>

                            <button type="submit" name="add_question" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Сұрақты қосу</button>
                            <a href="teacher_tests.php" class="btn btn-outline-secondary">Артқа</a>
                        </form>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="moodle-card p-4">
                        <h5 class="card-title mb-3 text-success"><i class="fas fa-clipboard-list me-2"></i> Барлық сұрақтар</h5>
                        
                        <?php if (empty($currentQuestions)): ?>
                            <div class="alert alert-warning text-center">
                                <i class="fas fa-exclamation-triangle me-2"></i> Бұл тестте әлі сұрақ жоқ.
                            </div>
                        <?php else: ?>
                            <?php foreach($currentQuestions as $q): ?>
                                <div class="question-card">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="mb-1">**<?php echo $q['id']; ?>. <?php echo $q['question']; ?>**</h6>
                                            <p class="mb-1"><span class="badge bg-secondary me-2">Ұпай: <?php echo $q['score']; ?></span></p>
                                            <ul class="list-unstyled mt-2 small">
                                                <?php foreach($q['options'] as $key => $option): ?>
                                                    <li class="<?php echo $key === $q['correct'] ? 'text-success fw-bold' : ''; ?>">
                                                        **<?php echo strtoupper($key); ?>:** <?php echo $option; ?>
                                                        <?php if ($key === $q['correct']): ?> <i class="fas fa-check-circle"></i> (Дұрыс жауап)<?php endif; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div>
                                            <a href="?action=edit&subject=<?php echo $currentSubject['id']; ?>&delete_question=<?php echo $q['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Сұрақты жоюды растаңыз?')">
                                                <i class="fas fa-trash-alt"></i> Жою
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        <?php elseif ($action === 'edit' && !$currentSubject): ?>
             <div class="alert alert-danger text-center py-5">
                <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                <h5>Қате: Тест табылмады.</h5>
                <a href="teacher_tests.php" class="btn btn-primary mt-3">Тесттер тізіміне оралу</a>
            </div>
        <?php endif; ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>