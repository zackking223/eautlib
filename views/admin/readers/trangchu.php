<?php $headTitle = 'Quản trị bạn đọc' ?>
<h2>DANH SÁCH BẠN ĐỌC</h2>
<div class="uk-flex">
    <form class="uk-search uk-search-default uk-margin-auto-right">
        <a href="" uk-search-icon></a>
        <input class="uk-search-input" type="search" name="search" placeholder="Tìm bạn đọc" value="<?php echo $search ?>" aria-label="Search">
    </form>
    <a href="/admin/readers/create" class="uk-button uk-button-primary">Thêm mới</a>
</div>
<br>
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
                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($readers as $i => $reader) : ?>
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
                    <td class="uk-flex">
                        <a class="uk-button uk-button-small uk-button-primary uk-padding-remove uk-margin-small-right" href="/admin/readers/update?id=<?php echo $reader["MABANDOC"] ?>">
                            <span uk-icon="file-edit"></span>
                        </a>
                        <form action="/admin/readers/delete" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                            <input type="hidden" name="MABANDOC" value="<?php echo $reader["MABANDOC"] ?>">
                            <button type="submit" class="uk-button uk-button-small uk-button-danger uk-padding-remove"><span uk-icon="trash"></span></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>