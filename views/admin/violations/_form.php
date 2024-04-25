<form method="POST" enctype="multipart/form-data">
    <fieldset class="uk-fieldset">

        <div class="uk-margin">
            <label class="uk-form-label" for="NOIDUNG">Nội dung</label>
            <div class="uk-form-controls">
                <input class="uk-input" name="NOIDUNG" type="text" placeholder="Nhập nội dung"
                    value="<?php echo $violation["NOIDUNG"] ?>">
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="MABANDOC">Bạn đọc</label>
            <div class="uk-form-controls">
                <select class="uk-select" name="MABANDOC" value="<?php echo $violation["MABANDOC"] ?>">
                    <?php foreach ($readers as $reader): ?>
                        <option value="<?php echo $reader["MABANDOC"] ?>">
                            <?php echo $reader["HOTEN"] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="MAADMIN">Thủ thư</label>
            <div class="uk-form-controls">
                <select class="uk-select" name="MAADMIN" value="<?php echo $violation["MAADMIN"] ?>">
                    <?php foreach ($admins as $admin): ?>
                        <option value="<?php echo $admin["MAADMIN"] ?>">
                            <?php echo $admin["USERNAME"] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="uk-margin">
            <input id="xacnhan-btn" class="uk-button uk-button-primary" type="submit" value="<?php echo $headTitle ?>">
            <a id="return-btn" class="uk-button uk-button-danger" href="/admin/violations">Quay lại</a>
        </div>
    </fieldset>
</form>