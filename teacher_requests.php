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
            color: #287abdff; /* Жарқын түс үшін иконка */
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
            color: white !important; /* Қосылды */
        }
        
        .user-dropdown:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        /* Основной контент */
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

        /* Кесте стилі */
        .grades-table thead th {
            text-align: center;
            vertical-align: middle;
            background-color: var(--univer-accent);
            color: var(--teacher-color);
            font-weight: 600;
            border-color: #dee2e6;
        }

        .grades-table th.student-cell {
            position: sticky;
            left: 0;
            z-index: 10;
            background-color: #f8f9fa;
            color: #495057;
        }

        .grades-table td {
            padding: 0;
            vertical-align: middle;
        }

        .grades-table td input[type="number"] {
            width: 100%;
            height: 100%;
            border: none;
            text-align: center;
            padding: 8px 5px;
            background-color: transparent;
            font-size: 0.9rem;
        }

        .grades-table td input[type="number"]:focus {
            background-color: #fffacd;
            box-shadow: none;
            border-color: #ffc107;
        }

        .grades-table .final-score,
        .grades-table .final-letter {
            text-align: center;
            font-weight: bold;
            background-color: #e9f2ff;
        }

        .grade-a { color: #198754; } /* A, A- */
        .grade-b { color: #0d6efd; } /* B+, B, B- */
        .grade-c { color: #ffc107; } /* C+, C, C- */
        .grade-d { color: #6f42c1; } /* D+, D */
        .grade-f { color: #dc3545; background-color: #f8d7da !important; } /* F, NB */
        
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                align-items: stretch;
            }
            .action-buttons .btn-group, .action-buttons .d-flex {
                width: 100%;
                justify-content: space-between;
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
                    <i class="fas fa-envelope ms-3 me-1"></i> <a href="mailto:info@univer.kz" style="text-decoration: none;">info@univer.kz</a>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <i class="fas fa-university me-1"></i> Әл-фараби атындағы Қазақ ұлттық университеті
                </div>
            </div>
        </div>
    </div>
    
    <nav class="navbar navbar-expand-lg main-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
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
                        <a class="nav-link active" aria-current="page" href="teacher_grades.php">
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
                        <a href="#" class="nav-link user-dropdown dropdown-toggle text-white" data-bs-toggle="dropdown">
                            <i class="fas fa-user-tie me-1"></i> Досымбек А.М.
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
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
    
    <main class="container my-4">
        <div class="action-buttons mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h4 class="mb-1"><i class="fas fa-chart-bar me-2 teacher-highlight"></i>Бағалау жүйесі</h4>
                    <p class="text-muted mb-0">Студенттердің бағаларын басқару</p>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <button type="button" class="btn btn-primary btn-sm" id="saveAllBtn">
                        <i class="fas fa-save me-1"></i> Барлығын сақтау
                    </button>
                    <button class="btn btn-success btn-sm" id="calculateFinalBtn">
                        <i class="fas fa-calculator me-1"></i> Қорытынды баллды есептеу
                    </button>
                </div>
            </div>
        </div>
        
        <div class="card p-3 mb-4 shadow-sm">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="courseSelect" class="form-label fw-bold">Курс таңдау</label>
                    <select class="form-select" id="courseSelect">
                        <option value="database">Деректер қоры жүйелерін әзірлеу (АИТ-21-02)</option>
                        <option value="python" selected>Python бағдарламалау (АИТ-21-01)</option>
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label for="studentSearch" class="form-label fw-bold">Студент бойынша іздеу</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="studentSearch" placeholder="Аты-жөні немесе ID...">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card content-card shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-users me-2 teacher-highlight"></i>Студенттердің бағалары - <span id="currentCourseTitle">Python бағдарламалау (АИТ-21-01)</span>
                    <small class="text-muted ms-2">25 студент, 1-ші семестр</small>
                </h5>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height: 70vh; overflow: auto;">
                    <table class="table table-bordered table-striped grades-table" id="gradesTable">
                        <thead>
                            <tr>
                                <th class="student-cell" rowspan="2">№</th>
                                <th class="student-cell" rowspan="2">Студент</th>
                                <th class="student-cell" rowspan="2">ID</th>
                                <th colspan="7">Лабораториялық жұмыстар (70 балл)</th>
                                <th colspan="2">СРС (30 балл)</th>
                                <th rowspan="2" title="Қатыспаған сағаттар саны">НБ сағат</th>
                                <th rowspan="2" title="Ағымдағы жинақталған балл">Жинақталған балл (max 100)</th>
                                <th rowspan="2" title="Қорытынды әріптік баға">Әріптік баға</th>
                                <th class="student-cell" rowspan="2" style="z-index: 11; position: sticky; right: 0; background-color: var(--univer-accent);">Өзгерту</th>
                            </tr>
                            <tr>
                                <th title="Лаб 1 (10 балл)">Л1</th>
                                <th title="Лаб 2 (10 балл)">Л2</th>
                                <th title="Лаб 3 (10 балл)">Л3</th>
                                <th title="Лаб 4 (10 балл)">Л4</th>
                                <th title="Лаб 5 (10 балл)">Л5</th>
                                <th title="Лаб 6 (10 балл)">Л6</th>
                                <th title="Лаб 7 (10 балл)">Л7</th>
                                
                                <th title="СРС 1 (15 балл)">СРС1</th>
                                <th title="СРС 2 (15 балл)">СРС2</th>
                            </tr>
                        </thead>
                        <tbody id="gradesTableBody">
                            </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">
                        <i class="fas fa-info-circle me-1"></i>
                        Бағалау бағандарындағы максималды баллдар әр тапсырма үшін көрсетілген. Барлығы 100 балл (Лаб: 70, СРС: 30).
                    </span>
                </div>
            </div>
        </div>
    </main>
    
    <div class="modal fade" id="editFinalModal" tabindex="-1" aria-labelledby="editFinalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFinalModalLabel">
                        <i class="fas fa-edit me-2"></i>Қорытынды бағаны өзгерту
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Жабу"></button>
                </div>
                <div class="modal-body">
                    <p>Студент: <strong id="studentNameModal"></strong> (<span id="studentIDModal"></span>)</p>
                    <div class="mb-3">
                        <label for="newFinalGrade" class="form-label">Жаңа әріптік баға</label>
                        <select class="form-select" id="newFinalGrade">
                            <option value="A">A (95-100)</option>
                            <option value="A-">A- (90-94)</option>
                            <option value="B+">B+ (85-89)</option>
                            <option value="B">B (80-84)</option>
                            <option value="B-">B- (75-79)</option>
                            <option value="C+">C+ (70-74)</option>
                            <option value="C">C (65-69)</option>
                            <option value="C-">C- (60-64)</option>
                            <option value="D+">D+ (55-59)</option>
                            <option value="D">D (50-54)</option>
                            <option value="F">F (0-49)</option>
                            <option value="NB">НБ (Сабаққа қатыспау)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="changeReason" class="form-label">Өзгерту себебі (міндетті)</label>
                        <textarea class="form-control" id="changeReason" rows="2" placeholder="Себебін көрсетіңіз..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Болдырмау</button>
                    <button type="button" class="btn btn-primary" id="applyNewGrade">Бағаны сақтау</button>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="footer">
        <div class="container">
            <div class="text-center small">
                <p class="mb-0">&copy; 2025 UNIVER. Барлық құқықтар қорғалған. | Әзірлеуші: Ақпараттық технологиялар факультеті</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Деректерді симуляциялау (Жаңа баллдарға сәйкес)
        function getStudentData() {
            // Лаб. работы: 7 * 10 = 70. СРС: 2 * 15 = 30. Итого: 100
            return [
                // [Л1-Л7] (max 10), [СРС1-СРС2] (max 15). 
                { id: 1001, name: "Абдуллаева Г.К.", lab: [10, 8, 9, 7, 10, 9, 10], srs: [13, 15], nb: 0 }, // Жинақ: 73 + 28 = 91 -> A-
                { id: 1002, name: "Бақытжанұлы Д.А.", lab: [10, 10, 10, 10, 10, 10, 10], srs: [15, 15], nb: 0 }, // Жинақ: 70 + 30 = 100 -> A
                { id: 1003, name: "Ермекова Л.С.", lab: [0, 'НБ', 0, 0, 'НБ', 0, 0], srs: [0, 0], nb: 15 }, // Жинақ: 0 -> NB (15 сағат)
                { id: 1004, name: "Жанұзақов М.Т.", lab: [8, 9, 8, 7, 6, 8, 9], srs: [10, 12], nb: 0 }, // Жинақ: 55 + 22 = 77 -> B-
                { id: 1005, name: "Қанатұлы Н.А.", lab: ['НБ', 6, 7, 8, 9, 7, 8], srs: [11, 13], nb: 4 }, // Жинақ: 45 + 24 = 69 -> C
                { id: 1006, name: "Сәдуақасов Б.Т.", lab: [7, 7, 7, 7, 7, 7, 7], srs: [10, 10], nb: 0 }, // Жинақ: 49 + 20 = 69 -> C
            ];
        }

        // Баллдарды әріптік бағаға ауыстыру логикасы (стандартты ҚазҰУ шкаласы)
        function calculateLetterGrade(score) {
            if (score >= 95) return { letter: 'A', class: 'grade-a' };
            if (score >= 90) return { letter: 'A-', class: 'grade-a' };
            if (score >= 85) return { letter: 'B+', class: 'grade-b' };
            if (score >= 80) return { letter: 'B', class: 'grade-b' };
            if (score >= 75) return { letter: 'B-', class: 'grade-b' };
            if (score >= 70) return { letter: 'C+', class: 'grade-c' };
            if (score >= 65) return { letter: 'C', class: 'grade-c' };
            if (score >= 60) return { letter: 'C-', class: 'grade-c' };
            if (score >= 55) return { letter: 'D+', class: 'grade-d' };
            if (score >= 50) return { letter: 'D', class: 'grade-d' };
            return { letter: 'F', class: 'grade-f' };
        }

        /**
         * Функция для пересчета итоговых баллов.
         * Логика: Лаб (7 * 10 = 70) + СРС (2 * 15 = 30) = 100
         * Учитывает 'НБ' (Не был/а).
         */
        function updateStudentGrades(row) {
            let totalScore = 0; // max 100
            
            const labInputs = row.querySelectorAll('[data-type="lab"]'); // max 10
            const srsInputs = row.querySelectorAll('[data-type="srs"]'); // max 15
            
            const nbInput = row.querySelector('.nb-input');
            const finalScoreCell = row.querySelector('.final-score');
            const finalLetterCell = row.querySelector('.final-letter');

            // 1. Лаб балдарын есептеу (7 * max 10 = 70)
            labInputs.forEach(input => {
                const value = input.value.trim().toUpperCase();
                if (value !== 'НБ') {
                    totalScore += parseInt(value) || 0;
                }
            });
            
            // 2. СРС балдарын есептеу (2 * max 15 = 30)
            srsInputs.forEach(input => {
                const value = input.value.trim().toUpperCase();
                if (value !== 'НБ') {
                    totalScore += parseInt(value) || 0;
                }
            });

            // Убеждаемся, что итоговый балл не превышает 100 (на случай ручного ввода)
            totalScore = Math.min(totalScore, 100); 

            const nbHours = parseInt(nbInput.value) || 0;

            // 3. Обновляем итоговый балл
            finalScoreCell.textContent = totalScore;
            
            // 4. Проверяем НБ и минимальный балл (условное правило: 10 сағаттан көп немесе 50 балдан аз)
            if (nbHours > 10) { 
                finalLetterCell.textContent = 'НБ'; // Указываем 'НБ' как факт отсутствия
                finalLetterCell.className = 'final-letter grade-f';
            } else {
                const finalGrade = calculateLetterGrade(totalScore);
                finalLetterCell.textContent = finalGrade.letter;
                finalLetterCell.className = 'final-letter ' + finalGrade.class;
            }
        }

        // Таблицаны деректермен толтыру
        function populateTable(data) {
            const tbody = document.getElementById('gradesTableBody');
            tbody.innerHTML = '';
            
            const srsMax = [15, 15];
            const labMax = 10;
            
            data.forEach((student, index) => {
                let row = tbody.insertRow();
                row.setAttribute('data-id', student.id);

                // No, Student Name, ID
                row.innerHTML += `<td class="student-cell">${index + 1}</td>`;
                row.innerHTML += `<td class="student-cell">${student.name}</td>`;
                row.innerHTML += `<td class="student-cell">${student.id}</td>`;

                // Lab Grades (7 * 10)
                student.lab.forEach((grade, i) => {
                    const value = (grade === 'НБ' || grade === 0) ? grade : parseInt(grade);
                    row.innerHTML += `<td><input type="text" class="form-control grade-input lab-grade" data-type="lab" data-index="${i+1}" data-max="${labMax}" value="${value}" pattern="[0-9]|10|НБ|нб"></td>`;
                });

                // SRS Grades (2 * 15)
                student.srs.forEach((grade, i) => {
                    const value = (grade === 'НБ' || grade === 0) ? grade : parseInt(grade);
                    row.innerHTML += `<td><input type="text" class="form-control grade-input srs-grade" data-type="srs" data-index="${i+1}" data-max="${srsMax[i]}" value="${value}" pattern="[0-9]{1,2}|1[0-5]|НБ|нб"></td>`;
                });

                // NB Hours (Учебные часы)
                row.innerHTML += `<td><input type="number" class="form-control grade-input nb-input" data-type="nb" min="0" max="30" value="${student.nb}"></td>`;


                // Final Score and Letter Grade
                row.innerHTML += `<td class="final-score">0</td>`; 
                row.innerHTML += `<td class="final-letter"></td>`; 
                
                // Edit Button
                row.innerHTML += `<td class="student-cell" style="position: sticky; right: 0; background-color: #f8f9fa;"><button class="btn btn-sm btn-outline-info edit-final-grade" data-bs-toggle="modal" data-bs-target="#editFinalModal">Өзгерту</button></td>`;

                updateStudentGrades(row); // Сразу же считаем итоговый балл
            });

            // Навешиваем обработчики событий
            $('.grade-input').on('input', function() {
                const type = $(this).data('type');
                const maxVal = parseInt($(this).attr('data-max'));
                let currentVal = $(this).val().trim().toUpperCase();

                if (currentVal === 'НБ') {
                    // OK, это НБ
                } else {
                    // Проверка числового значения
                    currentVal = parseInt(currentVal);
                    if (isNaN(currentVal) || currentVal < 0) {
                        $(this).val(0);
                    } else if (currentVal > maxVal) {
                        $(this).val(maxVal);
                    } else {
                        $(this).val(currentVal); // Очистка, если было что-то нечисловое (кроме НБ)
                    }
                }
                
                updateStudentGrades(this.closest('tr'));
            });

            // Открытие модального окна для редактирования
            $('.edit-final-grade').on('click', function() {
                const row = $(this).closest('tr');
                const studentName = row.find('.student-cell').eq(1).text();
                const studentID = row.data('id');
                
                $('#studentNameModal').text(studentName);
                $('#studentIDModal').text(studentID);
                $('#applyNewGrade').data('student-id', studentID);
            });
            
            // Логика сохранения из модального окна
            $('#applyNewGrade').on('click', function() {
                const studentID = $(this).data('student-id');
                const newGrade = $('#newFinalGrade').val();
                const reason = $('#changeReason').val();
                
                if (reason.trim() === '') {
                    alert('Өзгерту себебін көрсету міндетті!');
                    return;
                }
                
                // Находим нужную строку и обновляем оценку
                const row = $(`#gradesTableBody tr[data-id="${studentID}"]`)[0];
                if (row) {
                    const finalLetterCell = row.querySelector('.final-letter');
                    
                    if (newGrade === 'NB' || newGrade === 'F' || newGrade === 'НБ') {
                        finalLetterCell.textContent = 'НБ';
                        finalLetterCell.className = 'final-letter grade-f';
                    } else {
                        // Используем обратное вычисление для цвета
                        const gradeInfo = calculateLetterGrade(getScoreFromLetter(newGrade)); 
                        finalLetterCell.textContent = newGrade;
                        finalLetterCell.className = 'final-letter ' + gradeInfo.class;
                    }
                    
                    // Условное отображение, что оценка была изменена вручную
                    row.querySelector('.edit-final-grade').classList.add('btn-info');
                    row.querySelector('.edit-final-grade').classList.remove('btn-outline-info');
                }

                // Закрываем модальное окно
                const modalElement = document.getElementById('editFinalModal');
                const modal = bootstrap.Modal.getInstance(modalElement);
                modal.hide();
                alert(`Студент ${row.querySelector('.student-cell:nth-child(2)').textContent} үшін баға ${newGrade} болып өзгертілді. Себебі: ${reason.trim()}`);
            });
        }
        
        // Әріптік бағадан шамалы баллды алу (тек класс түсін алу үшін)
        function getScoreFromLetter(letter) {
            switch(letter) {
                case 'A': return 95;
                case 'A-': return 90;
                case 'B+': return 85;
                case 'B': return 80;
                case 'B-': return 75;
                case 'C+': return 70;
                case 'C': return 65;
                case 'C-': return 60;
                case 'D+': return 55;
                case 'D': return 50;
                default: return 0;
            }
        }

        // Страница жүктелгенде
        $(document).ready(function() {
            populateTable(getStudentData());
            
            // "Қорытынды баллды есептеу" кнопкасы
            $('#calculateFinalBtn').on('click', function() {
                $('#gradesTableBody tr').each(function() {
                    updateStudentGrades(this);
                });
                alert('Барлық студенттердің қорытынды баллдары қайта есептелді!');
            });

            // "Барлығын сақтау" симуляциясы
            $('#saveAllBtn').on('click', function() {
                // Мұнда AJAX арқылы деректерді серверге жіберу логикасы болуы керек
                alert('Бағалар серверге сәтті сақталды!');
            });
            
            // Бағалау кестесінің тіркелу мәселесін шешу (horizontal scroll)
            // Бұл код `th.student-cell` және `td.student-cell` ұяшықтарының 
            // сол жақта және оң жақта "қатып қалуын" қамтамасыз етеді.
            function updateStickyPositions() {
                const stickyCells = document.querySelectorAll('.student-cell');
                stickyCells.forEach(cell => {
                    const row = cell.closest('tr');
                    if (!row) return;

                    const index = Array.from(row.children).indexOf(cell);
                    let leftOffset = 0;
                    
                    if (index > 0 && cell.previousElementSibling && cell.previousElementSibling.classList.contains('student-cell')) {
                        leftOffset = cell.previousElementSibling.offsetLeft + cell.previousElementSibling.offsetWidth;
                    }

                    if (cell.closest('thead')) {
                        if (cell.hasAttribute('rowspan')) {
                            // Для верхних заголовков, которые 'закреплены'
                            cell.style.left = leftOffset + 'px';
                        }
                    } else if (index < 3) {
                         // Для ячеек в <tbody> (№, Студент, ID)
                        cell.style.left = leftOffset + 'px';
                    }
                    
                    if (cell.style.right === '0px') {
                        // Для кнопки "Өзгерту" справа
                        cell.style.right = '0';
                    }
                });
            }

            // Вызов при загрузке и изменении размера
            updateStickyPositions();
            window.addEventListener('resize', updateStickyPositions);
            
            // Дополнительная обработка для обеспечения работы паттерна 'НБ'
            $('.grade-input').on('keydown', function(e) {
                // Разрешить ввод 'Н'
                if (e.key.toUpperCase() === 'Н' || e.key.toUpperCase() === 'B') return true;
                // Разрешить ввод 'Б'
                if (e.key.toUpperCase() === 'Б' || e.key.toUpperCase() === 'B') return true;
                
                // Проверка на числа и управляющие клавиши
                if (e.key.length === 1 && !/\d/.test(e.key) && !e.ctrlKey && !e.altKey && !e.metaKey) {
                    if (e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab' && e.key !== 'Enter' && e.key !== 'ArrowLeft' && e.key !== 'ArrowRight') {
                        e.preventDefault();
                    }
                }
            });
            
        });
    </script>
</body>
</html>