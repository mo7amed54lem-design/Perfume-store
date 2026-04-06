<?php 
// استدعاء ملف الاتصال بقاعدة البيانات عشان يكون متاح في كل الصفحات
include 'db_connect.php'; 
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>متجر عطور - فخامة وأناقة</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    <nav class="navbar">
        <div class="logo">
            <a href="index.php">متجر العطور</a>
        </div>
	<ul class="nav-links">
    <li><a href="index.php">الرئيسية</a></li>
    <li><a href="perfumes.php">العطور</a></li>
    <li><a href="cart.php">السلة (<span id="cart-count"><?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?></span>)</a></li>
    
    <?php if(isset($_SESSION['user_id'])): ?>
        <li><a href="#">مرحباً، <?php echo $_SESSION['user_name']; ?></a></li>

        <?php if($_SESSION['user_role'] == 'admin'): ?>
            <li><a href="admin/index.php" style="color: #fdbb2d;">لوحة التحكم</a></li>
        <?php endif; ?>

        <li><a href="logout.php" style="color: #ff4d4d;">خروج</a></li>
    <?php else: ?>
        <li><a href="login.php">تسجيل الدخول</a></li>
    <?php endif; ?>
</ul>
    </nav>
</header>

<main class="container">
