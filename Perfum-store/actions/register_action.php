<?php
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // تشفير كلمة المرور
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // التأكد إن الإيميل مش مستخدم قبل كدة
    $check_email = "SELECT id FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($res) > 0) {
        echo "هذا البريد الإلكتروني مسجل بالفعل!";
    } else {
        // إضافة المستخدم الجديد
        $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hashed_password')";
        if (mysqli_query($conn, $sql)) {
            header("Location: ../login.php?msg=success");
        } else {
            echo "حدث خطأ أثناء التسجيل.";
        }
    }
}