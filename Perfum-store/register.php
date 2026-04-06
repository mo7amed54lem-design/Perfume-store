<?php include 'includes/header.php'; ?>

<div class="auth-container">
    <div class="auth-box">
        <h2>إنشاء حساب جديد</h2>
        <form action="actions/register_action.php" method="POST">
            <div class="form-group">
                <label>الاسم بالكامل</label>
                <input type="text" name="fullname" required placeholder="أدخل اسمك الثلاثي">
            </div>
            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" required placeholder="example@mail.com">
            </div>
            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="password" required placeholder="********">
            </div>
            <button type="submit" class="auth-btn">تسجيل الحساب</button>
        </form>
        <p>لديك حساب بالفعل؟ <a href="login.php">سجل دخولك هنا</a></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>