<?php
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // 1. البحث عن المستخدم بالإيميل
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // 2. مقارنة الباسورد اللي كتبه بالهاش المتخزن في القاعدة
        if (password_verify($password, $user['password'])) {
            // نجاح الدخول! نفتح جلسة للمستخدم
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fullname'];
            $_SESSION['user_role'] = $user['role'];

            header("Location: ../index.php"); // حوله للرئيسية وهو منور
        } else {
            echo "كلمة المرور غير صحيحة!";
        }
    } else {
        echo "هذا البريد الإلكتروني غير مسجل!";
    }
}