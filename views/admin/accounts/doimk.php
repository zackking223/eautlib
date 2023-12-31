<?php $headTitle = "Đổi mật khẩu" ?>
<h2>ĐỔI MẬT KHẨU</h2>
<form method="POST" enctype="multipart/form-data">
  <fieldset class="uk-fieldset">
    <div class="uk-margin">
      <label class="uk-form-label" for="MATKHAUMOI">Mật khẩu mới</label>
      <div class="uk-form-controls">
        <input class="uk-input" name="MATKHAUMOI" type="password" placeholder="Nhập mật khẩu mới">
      </div>
    </div>

    <div class="uk-margin">
      <input class="uk-button uk-button-primary" type="submit" value="<?php echo $headTitle ?>">
      <a class="uk-button uk-button-danger" href="/admin/accounts">Quay lại</a>
    </div>
  </fieldset>
</form>