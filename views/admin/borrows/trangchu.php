<?php $headTitle = 'Quản trị mượn trả' ?>
<h2>DANH SÁCH THẺ MƯỢN</h2>
<div class="uk-flex" style="align-items: center;">
    <form class="uk-flex uk-margin-auto-right" style="align-items: center;">
        <div class="uk-width-1-2 uk-margin-right">
            <input class="uk-input" type="number" name="cardid" placeholder="Mã thẻ mượn" value="<?php echo $search["cardid"] ?>" aria-label="Search">
            <input class="uk-input" type="search" name="username" placeholder="Tên thủ thư" value="<?php echo $search["username"] ?>" aria-label="Search">
            <input class="uk-input" type="search" name="hoten" placeholder="Tên bạn đọc" value="<?php echo $search["hoten"] ?>" aria-label="Search">
        </div>
        <input type="submit" value="Lọc" class="uk-button uk-button-secondary">
    </form>
    <a href="/admin/borrows/create" class="uk-button uk-button-primary">Mượn</a>
</div>
<br>
<form class="uk-margin-auto" action="/admin/borrows/return" method="post" style="width: max-content;">
    <input class="uk-input uk-width-small" type="number" name="MATHEMUON" id="MATHEMUON" type="number" placeholder="Mã thẻ mượn">
    <input type="submit" class="uk-button uk-button-danger" value="Trả">
</form>
<br>
<div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped">
        <thead>
            <tr>
                <th>Mã thẻ</th>
                <th>Tên bạn đọc</th>
                <th>Tên thủ thư</th>
                <th>Ngày mượn</th>
                <th>Ngày trả</th>
                <th>Sách mượn</th>
                <th>Tình trạng</th>
                <th>Ngày cập nhật</th>
                <th>Ngày thêm</th>
                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cards as $i => $card) : ?>
                <tr>
                    <td>
                        <?php echo $card["MATHEMUON"] ?>
                    </td>
                    <td>
                        (<?php echo $card["MABANDOC"] ?>) <?php echo $card["HOTEN"] ?>
                    </td>
                    <td>
                        <?php echo $card["USERNAME"] ?>
                    </td>
                    <td>
                        <?php echo $card["NGAYMUON"] ?>
                    </td>
                    <td>
                        <?php echo $card["NGAYTRA"] ?>
                    </td>
                    <td style="display:flex; flex-direction: column">
                        <?php foreach ($card["SACHMUON"] as $book) : ?>
                            <a class="uk-link" href="/books?id=<?php echo $book["MASACH"] ?>" target="_blank">
                                <?php echo $book["TENSACH"] ?>
                            </a>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <?php echo $card["TINHTRANG"] ?>
                    </td>
                    <td>
                        <?php echo $card["NGAYCAPNHAT"] ?>
                    </td>
                    <td>
                        <?php echo $card["NGAYTHEM"] ?>
                    </td>
                    <td class="uk-flex">
                        <a class="uk-button uk-button-small uk-button-primary uk-padding-remove uk-margin-small-right" href="/admin/borrows/update?id=<?php echo $card["MATHEMUON"] ?>">
                            <span uk-icon="file-edit"></span>
                        </a>
                        <form action="/admin/borrows/delete" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                            <input type="hidden" name="MATHEMUON" value="<?php echo $card["MATHEMUON"] ?>">
                            <button type="submit" class="uk-button uk-button-small uk-button-danger uk-padding-remove"><span uk-icon="trash"></span></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>