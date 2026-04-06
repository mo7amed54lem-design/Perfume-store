<?php
// 1. بدء الجلسة عشان نعرف نوصل للسلة
session_start();

// 2. استقبال البيانات المبعوتة من الـ AJAX
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    
    $id = $_POST['product_id'];
    $qty = $_POST['quantity'];

    // 3. لو السلة مش موجودة، ننشئها كـ "مصفوفة" (Array) فاضية
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // 4. إضافة المنتج للسلة (أو تحديث الكمية لو موجود أصلاً)
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] += $qty;
    } else {
        $_SESSION['cart'][$id] = $qty;
    }

    // 5. حساب إجمالي عدد القطع في السلة عشان نبعته للـ Header
    $total_items = array_sum($_SESSION['cart']);

    // 6. الرد على الـ AJAX بنتيجة العملية (بصيغة JSON)
    echo json_encode([
        "status" => "success",
        "message" => "تم إضافة العطر بنجاح",
        "cart_count" => $total_items
    ]);

} else {
    echo json_encode(["status" => "error", "message" => "بيانات غير مكتملة"]);
}
?>