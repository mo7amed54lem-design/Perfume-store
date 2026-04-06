<?php
include '../includes/db_connect.php';

// 1. حماية أمنية: التأكد إن اللي باعت البيانات هو الأدمن فعلاً
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 2. استقبال البيانات النصية وتأمينها
    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price       = $_POST['price'];

    // 3. التعامل مع الصورة (File Upload Logic)
    $image_name = $_FILES['image']['name'];      // اسم الصورة الأصلي
    $temp_name  = $_FILES['image']['tmp_name'];  // مكان الصورة المؤقت في السيرفر
    $folder     = "../assets/images/" . $image_name; // المكان النهائي اللي هننقلها فيه

    // 4. تنفيذ الرفع الفعلي للملف
    if (move_uploaded_file($temp_name, $folder)) {
        // 5. لو الصورة اترفعت صح، نسجل البيانات في قاعدة البيانات
        $sql = "INSERT INTO perfumes (name, description, price, image) 
                VALUES ('$name', '$description', '$price', '$image_name')";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php?msg=added"); // ارجع للوحة التحكم برسالة نجاح
        } else {
            echo "خطأ في تسجيل البيانات في القاعدة: " . mysqli_error($conn);
        }
    } else {
        echo "فشل في رفع الصورة.. تأكد من صلاحيات المجلد.";
    }
}