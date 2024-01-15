<form method="POST" enctype="multipart/form-data">
    <fieldset class="uk-fieldset">

        <div class="uk-margin">
            <label class="uk-form-label" for="HOTEN">Tên bạn đọc</label>
            <div class="uk-form-controls">
                <input class="uk-input" name="HOTEN" type="text" placeholder="Nhập tên bạn đọc"
                    value="<?php echo $reader["HOTEN"] ?>">
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="NGAYSINH">Ngày sinh</label>
            <div class="uk-form-controls">
                <input class="uk-input" name="NGAYSINH" type="date"
                    value="<?php echo $reader["NGAYSINH"] ?>">
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="DIACHI">Địa chỉ</label>
            <div class="uk-form-controls">
                <input class="uk-input" name="DIACHI" type="text" placeholder="Nhập địa chỉ"
                    value="<?php echo $reader["DIACHI"] ?>">
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="SDT">Số điện thoại</label>
            <div class="uk-form-controls">
                <input class="uk-input" name="SDT" type="text" placeholder="Nhập số điện thoại"
                    value="<?php echo $reader["SDT"] ?>">
            </div>
        </div>

        <div class="uk-margin noPrint">
            <input class="uk-button uk-button-primary" type="submit" value="<?php echo $headTitle ?>">
            <a class="uk-button uk-button-danger" href="/admin/readers">Quay lại</a>
        </div>
    </fieldset>
</form>