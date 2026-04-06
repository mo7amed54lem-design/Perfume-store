<?php include '../includes/db_connect.php'; 

// حماية الصفحة
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة عطر جديد</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h2>إضافة منتج جديد</h2>
            <form action="add_perfume_action.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>اسم العطر</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>وصف العطر</label>
                    <textarea name="description" rows="4" style="width: 100%; border-radius: 8px; border: 1px solid #ddd;"></textarea>
                </div>
                <div class="form-group">
                    <label>السعر</label>
                    <input type="number" name="price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label>الصورة</label>
                    <input type="file" name="image" accept="image/*" required>
                </div>
                <button type="submit" class="auth-btn">حفظ العطر</button>
            </form>
            <br>
            <a href="index.php">العودة للوحة التحكم</a>
        </div>
    </div>
</body>
</html>