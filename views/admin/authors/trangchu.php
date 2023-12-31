<?php $headTitle = 'Quản trị tác giả' ?>
<h2>DANH SÁCH TÁC GIẢ</h2>
<div class="uk-flex">
    <form class="uk-search uk-search-default uk-margin-auto-right">
        <a href="" uk-search-icon></a>
        <input class="uk-search-input" type="search" name="search" placeholder="Tìm tác giả" value="<?php echo $search ?>"
            aria-label="Search">
    </form>
    <a href="/admin/authors/create" class="uk-button uk-button-primary">Thêm mới</a>
</div>
<br>
<div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped">
        <thead>
            <tr>
                <th class="uk-width-small">Mã tác giả</th>
                <th>Bút danh</th>
                <th>Ngày thêm</th>
                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($authors as $i => $author): ?>
                <tr>
                    <td>
                        <?php echo $author["MATACGIA"] ?>
                    </td>
                    <td>
                        <?php echo $author["BUTDANH"] ?>
                    </td>
                    <td>
                        <?php echo $author["NGAYTHEM"] ?>
                    </td>
                    <td class="uk-flex">
                        <a class="uk-button uk-button-small uk-button-primary uk-padding-remove uk-margin-small-right"
                            href="/admin/authors/update?id=<?php echo $author["MATACGIA"] ?>">
                            <span uk-icon="file-edit"></span>
                        </a>
                        <form action="/admin/authors/delete" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                            <input type="hidden" name="MATACGIA" value="<?php echo $author["MATACGIA"] ?>">
                            <button type="submit" class="uk-button uk-button-small uk-button-danger uk-padding-remove"><span
                                    uk-icon="trash"></span></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>