<?php 
include '../includes/db_connect.php'; 

// 1. حماية الصفحة
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// 2. جلب بيانات العطر الحالي بناءً على الـ ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM perfumes WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل عطر: <?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h2>تعديل بيانات العطر</h2>
            <form action="edit_perfume_action.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                
                <div class="form-group">
                    <label>اسم العطر</label>
                    <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label>وصف العطر</label>
                    <textarea name="description" rows="4" style="width: 100%; border-radius: 8px;"><?php echo $product['description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>السعر</label>
                    <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
                </div>
                <div class="form-group">
                    <label>الصورة الحالية</label><br>
                    <img src="../assets/images/<?php echo $product['image']; ?>" width="100" style="border-radius: 5px;"><br>
                    <label>تغيير الصورة (اتركه فارغاً للإبقاء على الحالية)</label>
                    <input type="file" name="image" accept="image/*">
                </div>
                <button type="submit" class="auth-btn">تحديث البيانات</button>
            </form>
            <br>
            <a href="index.php">إلغاء والعودة</a>
        </div>
    </div>
</body>
</html>