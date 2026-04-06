<?php 
include 'includes/header.php'; 

// 1. استقبال الـ ID من الرابط (URL)
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // 2. استعلام لجلب بيانات عطر واحد فقط بناءً على الـ ID
    $sql = "SELECT * FROM perfumes WHERE id = $product_id";
    $result = mysqli_query($conn, $sql);

    // 3. التأكد إن العطر موجود في القاعدة
    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "<h2>العطر غير موجود!</h2>";
        include 'includes/footer.php';
        exit;
    }
} else {
    header("Location: index.php"); // لو مفيش ID رجعه للرئيسية
    exit;
}
?>

<div class="product-detail-container">
    <div class="product-image">
        <img src="assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    </div>
    
    <div class="product-info">
        <h1><?php echo $product['name']; ?></h1>
        <p class="category">النوع: <span><?php echo $product['category']; ?></span></p>
        <p class="description-full"><?php echo $product['description']; ?></p>
        <p class="price-detail"><?php echo $product['price']; ?> جنيه</p>
        
        <div class="purchase-section">
            <input type="number" id="quantity" value="1" min="1">
            <button class="add-to-cart-btn big-btn" data-id="<?php echo $product['id']; ?>">إضافة للسلة</button>
        </div>
    </div>
</div>

<?php 
include 'includes/footer.php'; 
?>