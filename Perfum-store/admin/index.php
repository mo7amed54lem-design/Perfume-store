<?php 
include '../includes/db_connect.php'; 

// حماية الصفحة: لو المستخدم مش أدمن، اطرده بره!
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم - متجر العطور</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <h2>لوحة التحكم</h2>
            <ul>
                <li><a href="index.php">الرئيسية</a></li>
                <li><a href="add_perfume.php">إضافة عطر جديد</a></li>
                <li><a href="../index.php">العودة للمتجر</a></li>
            </ul>
        </aside>

        <main class="admin-content">
            <h1>إدارة العطور</h1>
            <table class="cart-table"> <thead>
                    <tr>
                        <th>ID</th>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>السعر</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM perfumes";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)):
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><img src="../assets/images/<?php echo $row['image']; ?>" width="50"></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?> جنيه</td>
                        <td>
                            <a href="edit_perfume.php?id=<?php echo $row['id']; ?>" style="color: blue;">تعديل</a> | 
                            <a href="delete_perfume.php?id=<?php echo $row['id']; ?>" style="color: red;">حذف</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>