<!DOCTYPE html>
<html>

<?php include "../includes/head.php" ?>

<body>
  <?php if ($_SESSION["auth"]) : ?>
    <div class="uk-section uk-section-secondary uk-padding-small">
      <p class="uk-align-center uk-text-primary uk-text-center">
        Đã đăng nhập! <a class="uk-text-danger" href="/auth/logout">Đăng xuất</a> hoặc <a class="uk-text-warning" href="/">Về trang chủ</a>
      </p>
    </div>
  <?php endif; ?>
  <?php echo $content ?>
</body>

</html>