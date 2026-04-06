<?php
session_start();

// 1. مسح كل البيانات المخزنة في الجلسة (الاسم، الـ ID، إلخ)
session_unset();

// 2. تدمير الجلسة نهائياً من السيرفر
session_destroy();

// 3. توجيه المستخدم لصفحة الرئيسية
header("Location: index.php");
exit;
?>