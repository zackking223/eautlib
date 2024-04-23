<?php $headTitle = "Đăng nhập"; ?>

<?php if (!empty($errors)) : ?>
  <script type="text/javascript">
    let errors = <?php echo json_encode($errors); ?>;
    errors.forEach(msg => {
      UIkit.notification({
        message: "<span uk-icon='icon: ban'></span> " + msg,
        status: 'danger',
        pos: 'top-center',
        timeout: 5000
      });
    })
</script>
<?php endif; ?>

<div class="uk-section uk-section-muted uk-flex uk-flex-middle uk-animation-fade" uk-height-viewport>
  <div class="uk-width-1-1">
    <div class="uk-container">
      <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
        <div class="uk-width-1-1@m">
          <div class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
            <h3 class="uk-card-title uk-text-center">Quản trị</h3>
            <form method="POST">
              <div class="uk-margin">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon" uk-icon="icon: user"></span>
                  <input class="uk-input uk-form-large" type="text" name="USERNAME" placeholder="Tên đăng nhập" value="<?php if ($_POST) echo trim($_POST["USERNAME"]) ?>">
                </div>
              </div>
              <div class="uk-margin">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon" uk-icon="icon: lock"></span>
                  <input class="uk-input uk-form-large" type="password" name="MATKHAU" placeholder="Mật khẩu">
                </div>
              </div>
              <div class="uk-margin">
                <button class="uk-button uk-button-primary uk-button-large uk-width-1-1">Đăng nhập</button>
              </div>
              <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                <label><input class="uk-checkbox" type="checkbox" name="remember_password"> Ghi nhớ đăng nhập</label>
                <a href="/" class="uk-button uk-button-danger uk-margin-auto-left uk-button-small"><span uk-icon="arrow-left"></span> Hủy</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>