<?php
// Егер POST сұрауынан кейін хабарлама болса, оны көрсету үшін
$message = '';
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    $message = '<div class="alert alert-success">Парольді қалпына келтіру сілтемесі сіздің поштаңызға жіберілді.</div>';
}
if (isset($_GET['status']) && $_GET['status'] == 'error') {
    $message = '<div class="alert alert-danger">Қате: Пайдаланушы табылмады немесе пошта жіберілмеді.</div>';
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>Парольді ұмыттыңыз ба?</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4" style="width: 400px;">
        <h3 class="text-center">Парольді қалпына келтіру</h3>
        
        <?php echo $message; ?>

        <form action="send_reset_link.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Электрондық пошта:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Сілтеме жіберу</button>
        </form>

        <div class="login-links text-center mt-3">
             <a href="login.php">
                 <i class="fas fa-arrow-left me-1"></i> Артқа оралу
             </a>
        </div>
    </div>
</div>

</body>
</html>