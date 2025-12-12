<?php
// register.php - Қарапайым тіркелу беті
session_start();

// Өңделген мәндерді сақтау
function old($field) {
    return $_SESSION['old'][$field] ?? '';
}

// Қателерді көрсету
function error($field) {
    return $_SESSION['register_errors'][$field] ?? '';
}
?>
<!DOCTYPE html>
<html lang="kz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тіркелу | UNIVER</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .register-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            padding: 30px;
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .univer-logo {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--univer-blue);
            margin-bottom: 10px;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--univer-light);
            box-shadow: 0 0 0 0.25rem rgba(0, 86, 179, 0.25);
        }
        
        .btn-register {
            background: linear-gradient(135deg, var(--univer-blue), var(--univer-light));
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 86, 179, 0.3);
        }
        
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
        }
        
        .password-requirements {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 5px;
        }
        
        .user-type-selector {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .user-type-btn {
            flex: 1;
            padding: 15px;
            text-align: center;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
        }
        
        .user-type-btn:hover {
            border-color: var(--univer-light);
        }
        
        .user-type-btn.active {
            border-color: var(--univer-light);
            background-color: var(--univer-accent);
        }
        
        .user-type-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        
        .student-icon {
            color: #1a73e8;
        }
        
        .teacher-icon {
            color: #32406b;
        }
        
        @media (max-width: 768px) {
            .register-container {
                padding: 20px;
            }
            
            .user-type-selector {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <div class="univer-logo">
                <i class="fas fa-graduation-cap me-2"></i>UNIVER
            </div>
            <h4>Жаңа аккаунтты тіркеу</h4>
            <p class="text-muted">Барлық өрістерді толтырыңыз</p>
        </div>
        
        <?php if (isset($_SESSION['register_error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['register_error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['register_error']); ?>
        <?php endif; ?>
        
        <form action="process_register.php" method="POST">
            <!-- Рөл таңдау -->
            <div class="mb-4">
                <label class="form-label fw-bold">Сіз кімсіз? *</label>
                <div class="user-type-selector">
                    <div class="user-type-btn" id="studentBtn" onclick="selectUserType('student')">
                        <div class="user-type-icon student-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div>Студент</div>
                    </div>
                    <div class="user-type-btn" id="teacherBtn" onclick="selectUserType('teacher')">
                        <div class="user-type-icon teacher-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div>Оқытушы</div>
                    </div>
                </div>
                <input type="hidden" id="user_type" name="user_type" value="<?php echo old('user_type'); ?>" required>
                <?php if (error('user_type')): ?>
                    <div class="text-danger small mt-1"><?php echo error('user_type'); ?></div>
                <?php endif; ?>
            </div>
            
            <!-- Жеке ақпарат -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Тегі *</label>
                    <input type="text" class="form-control <?php echo error('last_name') ? 'is-invalid' : ''; ?>" 
                           id="last_name" name="last_name" value="<?php echo old('last_name'); ?>" required>
                    <?php if (error('last_name')): ?>
                        <div class="invalid-feedback"><?php echo error('last_name'); ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label for="first_name" class="form-label">Аты *</label>
                    <input type="text" class="form-control <?php echo error('first_name') ? 'is-invalid' : ''; ?>" 
                           id="first_name" name="first_name" value="<?php echo old('first_name'); ?>" required>
                    <?php if (error('first_name')): ?>
                        <div class="invalid-feedback"><?php echo error('first_name'); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" class="form-control <?php echo error('email') ? 'is-invalid' : ''; ?>" 
                       id="email" name="email" value="<?php echo old('email'); ?>" required>
                <?php if (error('email')): ?>
                    <div class="invalid-feedback"><?php echo error('email'); ?></div>
                <?php endif; ?>
            </div>
            
            <div class="mb-3">
                <label for="phone" class="form-label">Телефон *</label>
                <input type="tel" class="form-control <?php echo error('phone') ? 'is-invalid' : ''; ?>" 
                       id="phone" name="phone" value="<?php echo old('phone'); ?>" required>
                <?php if (error('phone')): ?>
                    <div class="invalid-feedback"><?php echo error('phone'); ?></div>
                <?php endif; ?>
            </div>
            
            <div class="mb-3">
                <label for="username" class="form-label">Логин *</label>
                <input type="text" class="form-control <?php echo error('username') ? 'is-invalid' : ''; ?>" 
                       id="username" name="username" value="<?php echo old('username'); ?>" required>
                <?php if (error('username')): ?>
                    <div class="invalid-feedback"><?php echo error('username'); ?></div>
                <?php endif; ?>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label">Пароль *</label>
                    <input type="password" class="form-control <?php echo error('password') ? 'is-invalid' : ''; ?>" 
                           id="password" name="password" required>
                </div>
                <div class="col-md-6">
                    <label for="confirm_password" class="form-label">Парольді растау *</label>
                    <input type="password" class="form-control <?php echo error('confirm_password') ? 'is-invalid' : ''; ?>" 
                           id="confirm_password" name="confirm_password" required>
                </div>
            </div>
            
            <?php if (error('password')): ?>
                <div class="alert alert-warning py-2">
                    <small><?php echo error('password'); ?></small>
                </div>
            <?php endif; ?>
            
            <?php if (error('confirm_password')): ?>
                <div class="alert alert-warning py-2">
                    <small><?php echo error('confirm_password'); ?></small>
                </div>
            <?php endif; ?>
            
            <div class="password-requirements">
                <small>Пароль талаптары: кемінде 8 символ, бір бас әріп, бір сан</small>
            </div>
            
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                <label class="form-check-label" for="agreeTerms">
                    Мен <a href="#" class="text-decoration-none">пайдаланушы келісімімен</a> келісемін
                </label>
            </div>
            
            <button type="submit" class="btn btn-register mb-3">
                <i class="fas fa-user-plus me-2"></i>Тіркелу
            </button>
            
            <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">
                <i class="fas fa-arrow-left me-2"></i>Кіру бетіне оралу
            </button>
        </form>
        
        <div class="text-center mt-4">
            <p class="mb-0">Аккаунтыңыз бар ма? <a href="index.php" class="text-decoration-none">Жүйеге кіру</a></p>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Рөл таңдау
        function selectUserType(type) {
            // Кнопкаларды белгілеу
            document.getElementById('studentBtn').classList.remove('active');
            document.getElementById('teacherBtn').classList.remove('active');
            document.getElementById(type + 'Btn').classList.add('active');
            
            // Скрытое полеға мән беру
            document.getElementById('user_type').value = type;
        }
        
        // Егер алдын ала таңдалған рөл болса
        document.addEventListener('DOMContentLoaded', function() {
            const selectedType = document.getElementById('user_type').value;
            if (selectedType) {
                selectUserType(selectedType);
            }
            
            // Парольді көрсету/жасыру
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('confirm_password');
            
            addToggleButton(passwordInput);
            addToggleButton(confirmInput);
            
            // Формаға фокус
            if (!selectedType) {
                document.getElementById('last_name').focus();
            }
        });
        
        function addToggleButton(input) {
            const toggleBtn = document.createElement('button');
            toggleBtn.type = 'button';
            toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
            toggleBtn.className = 'btn btn-outline-secondary border-start-0 position-absolute end-0 top-0 h-100';
            toggleBtn.style.borderTopLeftRadius = '0';
            toggleBtn.style.borderBottomLeftRadius = '0';
            
            const parent = input.parentElement;
            parent.style.position = 'relative';
            input.style.paddingRight = '50px';
            
            toggleBtn.addEventListener('click', function() {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
            
            parent.appendChild(toggleBtn);
        }
    </script>
</body>
</html>

<?php
// Сессия деректерін тазалау
unset($_SESSION['old']);
unset($_SESSION['register_errors']);
?>