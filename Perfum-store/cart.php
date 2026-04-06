<?php 
include 'includes/header.php'; 

// 1. حساب الإجمالي الكلي
$total_price = 0;
?>

<div class="cart-container">
    <h1>سلة المشتريات</h1>

    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>العطر</th>
                    <th>السعر</th>
                    <th>الكمية</th>
                    <th>المجموع</th>
                    <th>حذف</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // 2. اللف على المنتجات الموجودة في السلة (السيشن)
                foreach ($_SESSION['cart'] as $id => $qty): 
                    // جلب بيانات العطر من القاعدة بناءً على الـ ID المخزن في السلة
                    $sql = "SELECT * FROM perfumes WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                    $product = mysqli_fetch_assoc($result);
                    
                    $subtotal = $product['price'] * $qty;
                    $total_price += $subtotal;
                ?>
                <tr>
                    <td>
                        <div class="cart-product-info">
                            <img src="assets/images/<?php echo $product['image']; ?>" width="50">
                            <span><?php echo $product['name']; ?></span>
                        </div>
                    </td>
                    <td><?php echo $product['price']; ?> جنيه</td>
                    <td><?php echo $qty; ?></td>
                    <td><?php echo $subtotal; ?> جنيه</td>
                    <td><button class="remove-btn" data-id="<?php echo $id; ?>">❌</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="cart-summary">
            <h3>الإجمالي الكلي: <span id="total-price"><?php echo $total_price; ?></span> جنيه</h3>
            <button class="checkout-btn">إتمام الشراء</button>
        </div>

    <?php else: ?>
        <div class="empty-cart">
            <p>سلتك فارغة حالياً.. اذهب وتسوق أرقى العطور!</p>
            <a href="index.php" class="back-btn">العودة للمتجر</a>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>