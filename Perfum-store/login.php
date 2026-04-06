<?php include 'includes/header.php'; ?>

<div class="auth-container">
    <div class="auth-box">
        <h2>تسجيل الدخول</h2>
        
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
            <p style="color: green; text-align: center;">تم إنشاء الحساب بنجاح! سجل دخولك الآن.</p>
        <?php endif; ?>

        <form action="actions/login_action.php" method="POST">
            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" required placeholder="example@mail.com">
            </div>
            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="password" required placeholder="********">
            </div>
            <button type="submit" class="auth-btn">دخول</button>
        </form>
        <p>ليس لديك حساب؟ <a href="register.php">أنشئ حساباً جديداً</a></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>