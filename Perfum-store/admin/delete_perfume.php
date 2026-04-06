<?php
include '../includes/db_connect.php';

// 1. حماية الصفحة
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// 2. التأكد إن فيه ID مبعوث في الرابط
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 3. قبل ما نمسح، لازم نجيب اسم الصورة عشان نمسحها من الفولدر
    $sql_img = "SELECT image FROM perfumes WHERE id = $id";
    $res_img = mysqli_query($conn, $sql_img);
    $row_img = mysqli_fetch_assoc($res_img);
    $image_path = "../assets/images/" . $row_img['image'];

    // 4. حذف الصورة من الفولدر (لو موجودة)
    if (file_exists($image_path)) {
        unlink($image_path); // دالة المسح الفيزيائي للملف
    }

    // 5. حذف البيانات من قاعدة البيانات
    $sql_delete = "DELETE FROM perfumes WHERE id = $id";
    
    if (mysqli_query($conn, $sql_delete)) {
        header("Location: index.php?msg=deleted");
    } else {
        echo "خطأ أثناء الحذف: " . mysqli_error($conn);
    }
}