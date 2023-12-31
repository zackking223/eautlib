<form method="POST" onkeydown="return event.key != 'Enter';">
    <fieldset class="uk-fieldset">

        <div class="uk-margin">
            <label class="uk-form-label" for="MABANDOC">Bạn đọc</label>
            <div class="uk-form-controls">
                <select class="uk-select" name="MABANDOC" value="<?php echo $card["MABANDOC"] ?>">
                    <?php foreach ($readers as $reader) : ?>
                        <?php if ($card["MABANDOC"] === $reader["MABANDOC"]) : ?>
                            <option value="<?php echo $reader["MABANDOC"] ?>" selected>
                                <?php echo $reader["HOTEN"] ?>
                            </option>
                        <?php else : ?>
                            <option value="<?php echo $reader["MABANDOC"] ?>">
                                <?php echo $reader["HOTEN"] ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="MAADMIN">Thủ thư</label>
            <div class="uk-form-controls">
                <select class="uk-select" name="MAADMIN" value="<?php echo $card["MAADMIN"] ?>">
                    <?php foreach ($admins as $admin) : ?>
                        <?php if ($card["MAADMIN"] === $admin["MAADMIN"]) : ?>
                            <option value="<?php echo $admin["MAADMIN"] ?>" selected>
                                <?php echo $admin["USERNAME"] ?>
                            </option>
                        <?php elseif ($_SESSION["role"] === "QUAN_TRI") : ?>
                            <option value="<?php echo $admin["MAADMIN"] ?>">
                                <?php echo $admin["USERNAME"] ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="NGAYMUON">Ngày mượn</label>
            <div class="uk-form-controls">
                <input class="uk-input" name="NGAYMUON" type="date" value="<?php echo $card["NGAYMUON"] ?>">
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="NGAYTRA">Ngày trả</label>
            <div class="uk-form-controls">
                <input class="uk-input" name="NGAYTRA" type="date" value="<?php echo $card["NGAYTRA"] ?>">
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="SACHMUON[]">Sách mượn</label>
            <section class="uk-margin-small-bottom">
                <input class="uk-input uk-form-width-medium uk-width-small uk-form-small" type="number" placeholder="Mã sách" id="themsach" aria-label="Small">
                <button id="themsachbtn" type="button" class="uk-button uk-button-small">Thêm</button>
            </section>

            <div class="uk-form-controls" id="danhsachsach" style="border: 1px solid grey; padding: 4px;">
                <!-- Danh sách sách -->
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="TINHTRANG">Tình trạng</label>
            <div class="uk-form-controls">
                <?php $stats = array("Chưa trả", "Quá hạn", "Đã trả") ?>
                <select class="uk-select" name="TINHTRANG" value="<?php echo $card["TINHTRANG"] ?>">
                    <?php foreach ($stats as $stat) : ?>
                        <?php if ($card["TINHTRANG"] === $stat) : ?>
                            <option value="<?php echo $stat ?>" selected>
                                <?php echo $stat ?>
                            </option>
                        <?php else : ?>
                            <option value="<?php echo $stat ?>">
                                <?php echo $stat ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="uk-margin">
            <input class="uk-button uk-button-primary" type="submit" value="<?php echo $headTitle ?>">
            <a class="uk-button uk-button-danger" href="/admin/borrows">Quay lại</a>
        </div>
    </fieldset>
</form>