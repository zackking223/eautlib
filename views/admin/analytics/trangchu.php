<?php $headTitle = "Thống kê" ?>

<div class="">
  <center class="uk-margin">
    <a href="/admin/analytics/download?target=all" target="_blank" class="uk-button uk-button-big uk-button-primary">Lưu tất cả<span uk-icon="download"></span></a>
  </center>
  <div class="uk-flex" style="align-items: center;">
    <h3 class="uk-card-title" style="width: max-content; margin: auto; font-weight: bold">Số sách chưa trả</h3>
    <?php if ($data["SACHCHUATRA_ROWS"] === 0) : ?>
      <button onclick="alert('Không có dữ liệu!')" class="uk-button uk-button-small uk-button-disable">Lưu <span uk-icon="download"></button>
    <?php else : ?>
      <a href="/admin/analytics/download?target=chuatra" target="_blank" class="uk-button uk-button-small uk-button-primary">Lưu <span uk-icon="download"></span></a>
    <?php endif; ?>
  </div>
  <p id="chuatra">Số lượng: <?php echo $data["SACHCHUATRA_ROWS"] ?></p>

  <div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped">
      <thead>
        <tr>
          <th style="width: 50px">Mã thẻ</th>
          <th>Mã sách</th>
          <th>Tên sách</th>
          <th>Bạn đọc</th>
          <th>Thủ thư</th>
          <th>Ngày mượn</th>
          <th>Ngày trả</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($data["SACHCHUATRA_ROWS"] === 0) : ?>
          <tr>
            <td colspan="7" class="uk-text-danger" style="text-align: center;">
              Không có
            </td>
          </tr>
        <?php endif; ?>
        <?php foreach ($data["SACHCHUATRA"] as $book) : ?>
          <tr>
            <td>
              <?php echo $book["MATHEMUON"] ?>
            </td>
            <td>
              <?php echo $book["MASACH"] ?>
            </td>
            <td>
              <?php echo $book["TENSACH"] ?>
            </td>
            <td>
              (<?php echo $book["MABANDOC"] ?>) <?php echo $book["HOTEN"] ?>
            </td>
            <td>
              <?php echo $book["USERNAME"] ?>
            </td>
            <td>
              <?php echo $book["NGAYMUON"] ?>
            </td>
            <td>
              <?php echo $book["NGAYTRA"] ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</div>
<br>
<div class="">
  <div class="uk-flex" style="align-items: center;">
    <h3 class="uk-card-title" style="width: max-content; margin: auto; font-weight: bold">Số sách quá hạn</h3>
    <?php if ($data["SACHQUAHAN_ROWS"] === 0) : ?>
      <button onclick="alert('Không có dữ liệu!')" class="uk-button uk-button-small uk-button-disable">Lưu <span uk-icon="download"></button>
    <?php else : ?>
      <a href="/admin/analytics/download?target=quahan" target="_blank" class="uk-button uk-button-small uk-button-primary">Lưu <span uk-icon="download"></span></a>
    <?php endif; ?>
  </div>
  <p id="quahan">Số lượng: <?php echo $data["SACHQUAHAN_ROWS"] ?></p>

  <div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped">
      <thead>
        <tr>
          <th style="width: 50px">Mã thẻ</th>
          <th>Mã sách</th>
          <th>Tên sách</th>
          <th>Bạn đọc</th>
          <th>Thủ thư</th>
          <th>Ngày mượn</th>
          <th>Ngày trả</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($data["SACHQUAHAN_ROWS"] === 0) : ?>
          <tr>
            <td colspan="7" class="uk-text-danger" style="text-align: center;">
              Không có
            </td>
          </tr>
        <?php endif; ?>
        <?php foreach ($data["SACHQUAHAN"] as $book) : ?>
          <tr>
            <td>
              <?php echo $book["MATHEMUON"] ?>
            </td>
            <td>
              <?php echo $book["MASACH"] ?>
            </td>
            <td>
              <?php echo $book["TENSACH"] ?>
            </td>
            <td>
              (<?php echo $book["MABANDOC"] ?>) <?php echo $book["HOTEN"] ?>
            </td>
            <td>
              <?php echo $book["USERNAME"] ?>
            </td>
            <td>
              <?php echo $book["NGAYMUON"] ?>
            </td>
            <td>
              <?php echo $book["NGAYTRA"] ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<br>
<div class="">

  <div class="uk-flex" style="align-items: center;">
    <h3 class="uk-card-title" style="width: max-content; margin: auto; font-weight: bold">Bạn đọc mới tháng này</h3>
    <?php if ($data["BANDOCTHANGNAY_ROWS"] === 0) : ?>
      <button onclick="alert('Không có dữ liệu!')" class="uk-button uk-button-small uk-button-disable">Lưu <span uk-icon="download"></button>
    <?php else : ?>
      <a href="/admin/analytics/download?target=bandoc" target="_blank" class="uk-button uk-button-small uk-button-primary">Lưu <span uk-icon="download"></span></a>
    <?php endif; ?>
  </div>
  <p id="bandoc">Số lượng: <?php echo $data["BANDOCTHANGNAY_ROWS"] ?></p>

  <div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped">
      <thead>
        <tr>
          <th>Mã bạn đọc</th>
          <th>Họ tên</th>
          <th>Ngày sinh</th>
          <th>Địa chỉ</th>
          <th>Số điện thoại</th>
          <th>Ngày thêm</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($data["BANDOCTHANGNAY_ROWS"] === 0) : ?>
          <tr>
            <td colspan="6" class="uk-text-danger" style="text-align: center;">
              Không có
            </td>
          </tr>
        <?php endif; ?>
        <?php foreach ($data["BANDOCTHANGNAY"] as $reader) : ?>
          <tr>
            <td>
              <?php echo $reader["MABANDOC"] ?>
            </td>
            <td>
              <?php echo $reader["HOTEN"] ?>
            </td>
            <td>
              <?php echo $reader["NGAYSINH"] ?>
            </td>
            <td>
              <?php echo $reader["DIACHI"] ?>
            </td>
            <td>
              <?php echo $reader["SDT"] ?>
            </td>
            <td>
              <?php echo $reader["NGAYTHEM"] ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</div>
<br>
<div class="">

  <div class="uk-flex" style="align-items: center;">
    <h3 class="uk-card-title" style="width: max-content; margin: auto; font-weight: bold">Sách mới tháng này</h3>
    <?php if ($data["SACHTHANGNAY_ROWS"] === 0) : ?>
      <button onclick="alert('Không có dữ liệu!')" class="uk-button uk-button-small uk-button-disable">Lưu <span uk-icon="download"></button>
    <?php else : ?>
      <a href="/admin/analytics/download?target=sach" target="_blank" class="uk-button uk-button-small uk-button-primary">Lưu <span uk-icon="download"></span></a>
    <?php endif; ?>
  </div>
  <p id="sach">Số lượng: <?php echo $data["SACHTHANGNAY_ROWS"] ?></p>

  <div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped">
      <thead>
        <tr>
          <th>Mã sách</th>
          <th>Thể loại</th>
          <th>Tác giả</th>
          <th>Tên sách</th>
          <th>Số lượng</th>
          <th>Vị trí</th>
          <th class="uk-width-small">Tóm tắt</th>
          <th class="uk-width-small">Ảnh sách</th>
          <th>Sửa đổi</th>
          <th>Ngày thêm</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($data["SACHTHANGNAY_ROWS"] === 0) : ?>
          <tr>
            <td colspan="10" class="uk-text-danger" style="text-align: center;">
              Không có
            </td>
          </tr>
        <?php endif; ?>
        <?php foreach ($data["SACHTHANGNAY"] as $book) : ?>
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
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</div>
<br>
<div class="">

  <div class="uk-flex" style="align-items: center;">
    <h3 class="uk-card-title" style="width: max-content; margin: auto; font-weight: bold">Vi phạm mới tháng này</h3>
    <?php if ($data["VPTHANGNAY_ROWS"] === 0) : ?>
      <button onclick="alert('Không có dữ liệu!')" class="uk-button uk-button-small uk-button-disable">Lưu <span uk-icon="download"></button>
    <?php else : ?>
      <a href="/admin/analytics/download?target=vipham" target="_blank" class="uk-button uk-button-small uk-button-primary">Lưu <span uk-icon="download"></span></a>
    <?php endif; ?>
  </div>
  <p id="vipham">Số lượng: <?php echo $data["VPTHANGNAY_ROWS"] ?></p>

  <div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped">
      <thead>
        <tr>
          <th>Mã vi phạm</th>
          <th>Tên bạn đọc</th>
          <th>Tên thủ thư</th>
          <th>Nội dung</th>
          <th>Ngày thêm</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($data["VPTHANGNAY_ROWS"] === 0) : ?>
          <tr>
            <td colspan="5" class="uk-text-danger" style="text-align: center;">
              Không có
            </td>
          </tr>
        <?php endif; ?>
        <?php foreach ($data["VPTHANGNAY"] as $violation) : ?>
          <tr>
            <td>
              <?php echo $violation["MAVIPHAM"] ?>
            </td>
            <td>
              (<?php echo $violation["MABANDOC"] ?>) <?php echo $violation["HOTEN"] ?>
            </td>
            <td>
              <?php echo $violation["USERNAME"] ?>
            </td>
            <td>
              <?php echo $violation["NOIDUNG"] ?>
            </td>
            <td>
              <?php echo $violation["NGAYTHEM"] ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>