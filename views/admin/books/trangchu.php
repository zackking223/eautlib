<?php $headTitle = 'Quản trị sách' ?>
<h2>DANH SÁCH SÁCH</h2>

<section class="uk-flex" style="align-items: center;">
  <form class="uk-flex uk-margin-auto-right" style="align-items: center;">
    <div class="uk-width-1-2 uk-margin-right">
      <input class="uk-input" type="search" name="name" placeholder="Tên sách" value="<?php echo $search["name"] ?>" aria-label="Search">
      <select class="uk-select" name="author" value="<?php echo $search["author"] ?>">
        <option value="">Chọn tác giả</option>
        <?php foreach ($authors as $author) : ?>
          <?php if ($author["MATACGIA"] === $search["author"]) : ?>
            <option value="<?php echo $author["MATACGIA"] ?>" selected><?php echo $author["BUTDANH"] ?></option>
          <?php else : ?>
            <option value="<?php echo $author["MATACGIA"] ?>"><?php echo $author["BUTDANH"] ?></option>
          <?php endif; ?>
        <?php endforeach; ?>
      </select>
      <select class="uk-select" name="genre" value="<?php echo $search["genre"] ?>">
        <option value="">Chọn thể loại</option>
        <?php foreach ($genres as $genre) : ?>
          <?php if ($genre["MATHELOAI"] === $search["genre"]) : ?>
            <option value="<?php echo $genre["MATHELOAI"] ?>" selected><?php echo $genre["TEN"] ?></option>
          <?php else : ?>
            <option value="<?php echo $genre["MATHELOAI"] ?>"><?php echo $genre["TEN"] ?></option>
          <?php endif; ?>
        <?php endforeach; ?>
      </select>
    </div>
    <input type="submit" value="Lọc" class="uk-button uk-button-secondary">
  </form>
  <a href="/admin/books/create" class="uk-button uk-button-primary">Thêm mới</a>
</section>
<br>
<?php $individual = 0;
$total = 0 ?>
<section class="uk-flex" style="gap: 12px">
  <div id="books">Sách: 0</div>
  <div id="total">Tổng sách: 0</div>
</section>
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
        <?php
        $individual += 1;
        $total += $book["SOLUONG"];
        ?>
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
            <a id="<?php echo $book["MASACH"] . "update-btn" ?>" class="uk-button uk-button-small uk-button-primary uk-padding-remove uk-margin-small-right" href="/admin/books/update?id=<?php echo $book["MASACH"] ?>">
              <span uk-icon="file-edit"></span>
            </a>
            <form action="/admin/books/delete" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
              <input type="hidden" name="MASACH" value="<?php echo $book["MASACH"] ?>">
              <button id="<?php echo $book["MASACH"] . "delete-btn" ?>" type="submit" class="uk-button uk-button-small uk-button-danger uk-padding-remove"><span uk-icon="trash"></span></button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
  document.getElementById("books").textContent = "Sách: " + "<?php echo json_encode($individual)?>";
  document.getElementById("total").textContent = "Tổng sách: " + "<?php echo json_encode($total) ?>";
</script>