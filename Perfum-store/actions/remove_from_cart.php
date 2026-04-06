<?php
session_start();
// 1. لازم نربط ملف قاعدة البيانات عشان نعرف أسعار العطور اللي لسه موجودة
include '../includes/db_connect.php'; 

if (isset($_POST['product_id'])) {
    $id = $_POST['product_id'];

    // 2. حذف المنتج من السيشن
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }

    // --- بداية التعديل الجديد لحساب السعر ---
    $new_total_price = 0;

    // بنلف على كل المنتجات اللي "فضلت" في السلة
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $c_id => $qty) {
            // بنجيب سعر العطر من القاعدة
            $sql = "SELECT price FROM perfumes WHERE id = $c_id";
            $res = mysqli_query($conn, $sql);
            if ($p = mysqli_fetch_assoc($res)) {
                // بنضرب السعر في الكمية ونجمعه على الإجمالي
                $new_total_price += ($p['price'] * $qty);
            }
        }
    }
    // --- نهاية التعديل ---

    // حساب عدد القطع الكلي
    $total_items = array_sum($_SESSION['cart']);

    // نبعت الرد للـ AJAX وفيه "السعر الجديد"
    echo json_encode([
        "status" => "success",
        "cart_count" => $total_items,
        "new_total" => $new_total_price // ضفنا السعر هنا عشان الـ JS يستلمه
    ]);
}
?>