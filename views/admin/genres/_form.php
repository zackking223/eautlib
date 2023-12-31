<form method="POST" enctype="multipart/form-data">
    <fieldset class="uk-fieldset">

        <div class="uk-margin">
            <label class="uk-form-label" for="TEN">Tên thể loại</label>
            <div class="uk-form-controls">
                <input class="uk-input" name="TEN" type="text" placeholder="Nhập tên thể loại"
                    value="<?php echo $genre["TEN"] ?>">
            </div>
        </div>

        <div class="uk-margin">
            <input class="uk-button uk-button-primary" type="submit" value="<?php echo $headTitle ?>">
            <a class="uk-button uk-button-danger" href="/admin/genres">Quay lại</a>
        </div>
    </fieldset>
</form>