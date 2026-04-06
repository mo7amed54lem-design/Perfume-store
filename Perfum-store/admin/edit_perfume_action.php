<?php
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id          = $_POST['id'];
    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price       = $_POST['price'];

    // 1. جلب اسم الصورة القديمة من القاعدة
    $sql_old = "SELECT image FROM perfumes WHERE id = $id";
    $res_old = mysqli_query($conn, $sql_old);
    $old_data = mysqli_fetch_assoc($res_old);
    $image_name = $old_data['image']; // افتراضياً هنستخدم القديمة

    // 2. هل المستخدم رفع صورة جديدة؟
    if ($_FILES['image']['name'] != "") {
        // مسح الصورة القديمة من الهارد
        if (file_exists("../assets/images/" . $image_name)) {
            unlink("../assets/images/" . $image_name);
        }
        
        // رفع الصورة الجديدة
        $image_name = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/" . $image_name);
    }

    // 3. تحديث البيانات في القاعدة (استخدام UPDATE بدلاً من INSERT)
    $sql_update = "UPDATE perfumes SET 
                    name = '$name', 
                    description = '$description', 
                    price = '$price', 
                    image = '$image_name' 
                   WHERE id = $id";

    if (mysqli_query($conn, $sql_update)) {
        header("Location: index.php?msg=updated");
    } else {
        echo "خطأ في التحديث: " . mysqli_error($conn);
    }
}