<form method="POST" enctype="multipart/form-data">
  <fieldset class="uk-fieldset">
    <input type="hidden" id="MAADMIN" name="MAADMIN" value="<?php echo $account["MAADMIN"] ?>">
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
        <select class="uk-select" name="ROLE" value="<?php echo $account["ROLE"] ?>">
          <?php
            function getRole($role) : string {
              if ($role == "THU_THU") return "Thủ thư";
              if ($role == "QUAN_TRI") return "Quản trị viên";
            }
          ?>
          <?php foreach (array("THU_THU", "QUAN_TRI") as $role) : ?>
            <?php if ($account["ROLE"] == $role) : ?>
              <option value="<?php echo $role; ?>" selected><?php echo getRole($role); ?></option>
            <?php else : ?>
              <option value="<?php echo $role; ?>"><?php echo getRole($role); ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="uk-margin">
      <input id="xacnhan-btn" class="uk-button uk-button-primary" type="submit" value="<?php echo $headTitle ?>">
      <a id="return-btn" class="uk-button uk-button-danger" href="/admin/accounts">Quay lại</a>
    </div>
  </fieldset>
</form>