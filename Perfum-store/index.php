<?php 
include 'includes/header.php'; 
?>

<section class="hero">
    <h1>أهلاً بك في عالم الفخامة</h1>
    <p>اكتشف مجموعتنا المختارة من أرقى العطور العالمية.</p>
</section>

<section class="products-grid">
    <h2>أحدث العطور</h2>
    
    <div class="perfume-container">
        <?php
        // 1. أمر الاستعلام: "هات كل العطور من الجدول"
        $sql = "SELECT * FROM perfumes";
        $result = mysqli_query($conn, $sql);

        // 2. التأكد إن فيه بيانات رجعت أصلاً
        if (mysqli_num_rows($result) > 0) {
            // 3. الـ Loop السحري: بيلف على كل صف في القاعدة ويطلعه كأنه "مكعب" HTML
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="product-card">
                    <img src="assets/images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    <h3><a href="product_details.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></h3>
                    <p class="description"><?php echo $row['description']; ?></p>
                    <p class="price"><?php echo $row['price']; ?> جنيه</p>
                    <button class="add-to-cart-btn" data-id="<?php echo $row['id']; ?>">إضافة للسلة</button>
                </div>
                <?php
            }
        } else {
            echo "<p>لا يوجد عطور متاحة حالياً.</p>";
        }
        ?>
    </div>
</section>

<?php 
include 'includes/footer.php'; 
?>