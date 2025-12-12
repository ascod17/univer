<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Восстановление пароля</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        :root {
            --univer-blue: #003366;
            --univer-dark: #123456; /* Бұл өзгермейді, бірақ қолданылмайды */
            --univer-light: #0056b3;
            --univer-accent: #e9f2ff;
        }
        
        /* Фон мен ортаға орналастыру */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Градиент фоны (көбірек көгілдір реңктерге ауыстырылды) */
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); 
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
        }
        
        /* Контейнерді ортаға орналастыру үшін "register-container" стилін қолданамыз */
        .register-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px; /* Кішірек форма үшін аздап азайттық */
            padding: 30px;
            box-sizing: border-box;
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .univer-logo {
            font-size: 1.8rem; /* Тақырыпты кішірейту */
            font-weight: bold;
            color: var(--univer-blue);
            margin-bottom: 5px;
        }
        
        /* Форма элементтері */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-control {
            width: 100%;
            box-sizing: border-box; /* padding енге кіреді */
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--univer-light);
            box-shadow: 0 0 0 0.25rem rgba(0, 86, 179, 0.25);
            outline: none;
        }
        
        /* Батырма стилі */
        .btn-register {
            background: linear-gradient(135deg, var(--univer-blue), var(--univer-light));
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
            cursor: pointer;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 86, 179, 0.3);
        }

        /* Төменгі сілтеме стилі */
        .login-links {
            text-align: center;
            margin-top: 20px;
        }

        .login-links a {
            color: var(--univer-light);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .login-links a:hover {
            color: var(--univer-blue);
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="register-container">
        <div class="register-header">
            <h2 class="univer-logo"><i class="fas fa-redo-alt"></i> Восстановление пароля</h2>
            <p>Введите ваш Email, код подтверждения и новый пароль.</p>
        </div>
        
        <form action="sent_reset_link.php" method="post">
            
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Ваш Email" required>
            </div>
            
            <div class="form-group">
                <input type="text" name="code" class="form-control" placeholder="Введите код из письма" required>
            </div>
            
            <div class="form-group">
                <input type="password" name="new_password" class="form-control" placeholder="Новый пароль" required>
            </div>
            
            <button type="submit" class="btn-register">Сменить пароль</button>
        </form>

        <div class="login-links">
            <a href="index.php">
                <i class="fas fa-arrow-left me-1"></i> Вернуться к входу
            </a>
        </div>
    </div>

</body>
</html>