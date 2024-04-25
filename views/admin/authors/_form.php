<form method="POST" enctype="multipart/form-data">
    <fieldset class="uk-fieldset">

        <div class="uk-margin">
            <label class="uk-form-label" for="BUTDANH">Bút danh tác giả</label>
            <div class="uk-form-controls">
                <input class="uk-input" name="BUTDANH" type="text" placeholder="Nhập bút danh"
                    value="<?php echo $author["BUTDANH"] ?>">
            </div>
        </div>

        <div class="uk-margin">
            <input id="xacnhan-btn" class="uk-button uk-button-primary" type="submit" value="<?php echo $headTitle ?>">
            <a id="return-btn" class="uk-button uk-button-danger" href="/admin/authors">Quay lại</a>
        </div>
    </fieldset>
</form>