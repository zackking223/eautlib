<?php $headTitle = 'Quản trị tài khoản' ?>
<h2>DANH SÁCH TÀI KHOẢN QUẢN TRỊ</h2>
<div class="uk-flex">
  <form class="uk-search uk-search-default" style="margin-right: auto;">
    <a href="" uk-search-icon></a>
    <input class="uk-search-input" type="search" name="search" placeholder="Tìm tài khoản" value="<?php echo $search ?>" aria-label="Search">
  </form>
  <?php if ($_SESSION["role"] === "QUAN_TRI") : ?>
    <a href="/admin/accounts/create" class="uk-button uk-button-primary uk-margin-small-right">Thêm mới</a>
  <?php endif; ?>
  <a href="/admin/accounts/changepassword?id=<?php echo $_SESSION["maadmin"] ?>" class="uk-button uk-button-danger">Đổi mật khẩu</a>
</div>
<br>
<div class="uk-overflow-auto">
  <table class="uk-table uk-table-striped">
    <thead>
      <tr>
        <th class="uk-width-small">Mã tài khoản</th>
        <th>Chức vụ</th>
        <th>Username</th>
        <th>Ngày thêm</th>
        <th>Tùy chọn</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($accounts as $i => $account) : ?>
        <tr>
          <td>
            <?php echo $account["MAADMIN"] ?>
          </td>
          <td>
            <?php echo $account["ROLE"] ?>
          </td>
          <td>
            <?php echo $account["USERNAME"] ?>
          </td>
          <td>
            <?php echo $account["NGAYTHEM"] ?>
          </td>
          <td class="uk-flex">
            <a class="uk-button uk-button-small uk-button-primary uk-padding-remove uk-margin-small-right" href="/admin/accounts/update?id=<?php echo $account["MAADMIN"] ?>">
              <span uk-icon="file-edit"></span>
            </a>
            <form action="/admin/accounts/delete" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
              <input type="hidden" name="MAADMIN" value="<?php echo $account["MAADMIN"] ?>">
              <button type="submit" class="uk-button uk-button-small uk-button-danger uk-padding-remove"><span uk-icon="trash"></span></button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>