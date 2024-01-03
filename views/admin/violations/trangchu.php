<?php $headTitle = 'Quản trị vi phạm' ?>
<h2>DANH SÁCH VI PHẠM</h2>
<div class="uk-flex" style="align-items: center;">
    <form class="uk-flex" style="align-items: center;">
        <div class="uk-width-1-2 uk-margin-right">
            <input class="uk-input" type="search" name="noidung" placeholder="Nội dung" value="<?php echo $search["noidung"] ?>" aria-label="Search">
            <input class="uk-input" type="search" name="username" placeholder="Tên thủ thư" value="<?php echo $search["username"] ?>" aria-label="Search">
            <input class="uk-input" type="search" name="hoten" placeholder="Tên bạn đọc" value="<?php echo $search["hoten"] ?>" aria-label="Search">
        </div>
        <input type="submit" value="Lọc" class="uk-button uk-button-secondary">
    </form>
    <a href="/admin/violations/create" class="uk-button uk-button-primary">Thêm mới</a>
</div>
<br>
<section id="total"><?php $total = 0; ?></section>
<div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped">
        <thead>
            <tr>
                <th>Mã vi phạm</th>
                <th>Tên bạn đọc</th>
                <th>Tên thủ thư</th>
                <th>Nội dung</th>
                <th>Ngày thêm</th>
                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($violations as $i => $violation) : ?>
                <?php $total++; ?>
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
                    <td class="uk-flex">
                        <a class="uk-button uk-button-small uk-button-primary uk-padding-remove uk-margin-small-right" href="/admin/violations/update?id=<?php echo $violation["MAVIPHAM"] ?>">
                            <span uk-icon="file-edit"></span>
                        </a>
                        <form action="/admin/violations/delete" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                            <input type="hidden" name="MAVIPHAM" value="<?php echo $violation["MAVIPHAM"] ?>">
                            <button type="submit" class="uk-button uk-button-small uk-button-danger uk-padding-remove"><span uk-icon="trash"></span></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if ($total > 0) : ?>
    <script>
        document.getElementById("total").textContent = "Tổng cộng: " + "<?php echo json_encode($total) ?>";
    </script>
<?php endif; ?>