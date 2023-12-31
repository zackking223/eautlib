<form method="POST" enctype="multipart/form-data">
  <fieldset class="uk-fieldset">

    <div class="uk-margin">
      <label class="uk-form-label" for="USERNAME">Username</label>
      <div class="uk-form-controls">
        <input class="uk-input" name="USERNAME" type="text" placeholder="Nhập tên đăng nhập" value="<?php echo $account["USERNAME"] ?>">
      </div>
    </div>

    <?php if ($headTitle !== "Sửa tài khoản") : ?>
      <div class="uk-margin">
        <label class="uk-form-label" for="MATKHAU">Mật khẩu</label>
        <div class="uk-form-controls">
          <input class="uk-input" name="MATKHAU" type="password" placeholder="Nhập mật khẩu" value="<?php echo $account["MATKHAU"] ?>">
        </div>
      </div>
    <?php endif; ?>

    <div class="uk-margin">
      <label class="uk-form-label" for="ROLE">Chức vụ</label>
      <div class="uk-form-controls">
        <select class="uk-select" name="ROLE" value="THU_THU">
          <option value="THU_THU">Thủ thư</option>
          <option value="QUAN_TRI">Quản trị viên</option>
        </select>
      </div>
    </div>

    <div class="uk-margin">
      <input class="uk-button uk-button-primary" type="submit" value="<?php echo $headTitle ?>">
      <a class="uk-button uk-button-danger" href="/admin/accounts">Quay lại</a>
    </div>
  </fieldset>
</form>