<?php $headTitle = 'Quản trị sách' ?>
<h2>DANH SÁCH SÁCH</h2>

<section class="uk-flex">
  <form class="uk-search uk-search-default uk-margin-auto-right">
    <a href="" uk-search-icon></a>
    <input class="uk-search-input" type="search" name="name" placeholder="Tìm sách" value="<?php echo $search["name"] ?>" aria-label="Search">
  </form>
  <a href="/admin/books/create" class="uk-button uk-button-primary">Thêm mới</a>
</section>
<br>
<div class="uk-overflow-auto">
  <table class="uk-table uk-table-striped">
    <thead>
      <tr>
        <th style="width: 50px">Mã sách</th>
        <th>Thể loại</th>
        <th>Tác giả</th>
        <th>Tên sách</th>
        <th>Số lượng</th>
        <th>Vị trí</th>
        <th class="uk-width-small">Tóm tắt</th>
        <th class="uk-width-small">Ảnh sách</th>
        <th>Sửa đổi</th>
        <th>Ngày thêm</th>
        <th>Tùy chọn</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($books as $i => $book) : ?>
        <tr>
          <td>
            <?php echo $book["MASACH"] ?>
          </td>
          <td>
            <?php echo $book["TEN"] ?>
          </td>
          <td>
            <?php echo $book["BUTDANH"] ?>
          </td>
          <td>
            <?php echo $book["TENSACH"] ?>
          </td>
          <td>
            <?php echo $book["SOLUONG"] ?>
          </td>
          <td>
            <?php echo $book["VITRI"] ?>
          </td>
          <td>
            <?php echo $book["TOMTAT"] ?>
          </td>
          <td>
            <img src="<?php echo $book["ANHSACH"] ?>" alt="<?php echo $book["TENSACH"] ?>">
          </td>
          <td>
            <?php echo $book["NGAYTHEM"] ?>
          </td>
          <td>
            <?php echo $book["NGAYCAPNHAT"] ?>
          </td>
          <td class="uk-flex">
            <a class="uk-button uk-button-small uk-button-primary uk-padding-remove uk-margin-small-right" href="/admin/books/update?id=<?php echo $book["MASACH"] ?>">
              <span uk-icon="file-edit"></span>
            </a>
            <form action="/admin/books/delete" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
              <input type="hidden" name="MASACH" value="<?php echo $book["MASACH"] ?>">
              <button type="submit" class="uk-button uk-button-small uk-button-danger uk-padding-remove"><span uk-icon="trash"></span></button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>