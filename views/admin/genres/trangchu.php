<?php $headTitle = 'Quản trị thể loại' ?>
<h2>DANH SÁCH THỂ LOẠI</h2>
<div class="uk-flex">
    <form class="uk-search uk-search-default uk-margin-auto-right">
        <a href="" uk-search-icon></a>
        <input class="uk-search-input" type="search" name="search" placeholder="Tìm thể loại" value="<?php echo $search ?>" aria-label="Search">
    </form>
    <a href="/admin/genres/create" class="uk-button uk-button-primary">Thêm mới</a>
</div>
<br>
<div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped">
        <thead>
            <tr>
                <th>Mã thể loại</th>
                <th>Tên</th>
                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($genres as $i => $genre) : ?>
                <tr>
                    <td>
                        <?php echo $genre["MATHELOAI"] ?>
                    </td>
                    <td>
                        <?php echo $genre["TEN"] ?>
                    </td>
                    <td class="uk-flex">
                        <a class="uk-button uk-button-small uk-button-primary uk-padding-remove uk-margin-small-right" href="/admin/genres/update?id=<?php echo $genre["MATHELOAI"] ?>">
                            <span uk-icon="file-edit"></span>
                        </a>
                        <form action="/admin/genres/delete" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                            <input type="hidden" name="MATHELOAI" value="<?php echo $genre["MATHELOAI"] ?>">
                            <button type="submit" class="uk-button uk-button-small uk-button-danger uk-padding-remove"><span uk-icon="trash"></span></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>