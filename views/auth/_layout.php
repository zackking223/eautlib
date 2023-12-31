<!DOCTYPE html>
<html>

<head>
  <title><?php echo $headTitle ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="/public/eaut_logo.png" sizes="16x16" />
  <!-- UIkit CSS -->
  <link rel="stylesheet" href="/css/uikit.min.css" />

  <!-- UIkit JS -->
  <script src="/js/uikit.min.js"></script>
  <script src="/js/uikit-icons.min.js"></script>
</head>

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