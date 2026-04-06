<?php
// 1. تعريف معلومات السيرفر وقاعدة البيانات
$servername = "localhost";
$username   = "root";
$password   = ""; // في XAMPP الباسورد الافتراضي بيكون فاضي
$dbname     = "perfume_store";

// 2. إنشاء الاتصال
$conn = mysqli_connect($servername, $username, $password, $dbname);

// 3. التأكد من نجاح الاتصال
if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

// 4. بدء الجلسة (Session) - مهم جداً عشان سلة المشتريات
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ضبط الترميز عشان اللغة العربية تظهر صح
mysqli_set_charset($conn, "utf8");
?>