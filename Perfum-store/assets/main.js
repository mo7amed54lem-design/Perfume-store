// 1. استهداف جميع أزرار "إضافة للسلة" في الصفحة
const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

// 2. إضافة "مراقب أحداث" (Event Listener) لكل زرار
addToCartButtons.forEach(button => {
    button.addEventListener('click', function() {
        
        // جلب الـ ID من خاصية data-id والكمية من حقل المدخلات
        const productId = this.getAttribute('data-id');
        const quantityInput = document.getElementById('quantity');
        const quantity = quantityInput ? quantityInput.value : 1; // لو مفيش حقل كمية (زي صفحة الـ index) نعتبرها 1

        // 3. بدء عملية الـ AJAX باستخدام Fetch API
        fetch('actions/add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}&quantity=${quantity}`
        })
        .then(response => response.json()) // تحويل الرد لنص JSON
        .then(data => {
            if (data.status === 'success') {
                // 4. تحديث رقم السلة في الهيدر بدون Refresh
                const cartCount = document.getElementById('cart-count');
                cartCount.innerText = data.cart_count;

                // تنبيه المستخدم (ممكن نطورها لشكل أشيك بعدين)
                alert(data.message);
            } else {
                alert('عذراً: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ في الاتصال بالسيرفر');
        });
    });
});
// البحث عن كل أزرار الحذف في صفحة السلة
const removeButtons = document.querySelectorAll('.remove-btn');
// ... (جزء إضافة للسلة زي ما هو)

removeButtons.forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        const row = this.closest('tr');

        fetch('actions/remove_from_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `product_id=${productId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                row.style.opacity = '0';
                setTimeout(() => {
                    row.remove();
                    document.getElementById('cart-count').innerText = data.cart_count;
                    
                    // --- التعديل هنا ---
                    const totalPriceElement = document.getElementById('total-price');
                    if (totalPriceElement) {
                        totalPriceElement.innerText = data.new_total; // تحديث السعر الجديد
                    }
                    // ------------------

                    if (data.cart_count === 0) {
                        location.reload();
                    }
                }, 300);
            }
        });
    });
});

