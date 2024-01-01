<form method="POST" enctype="multipart/form-data">
  <fieldset class="uk-fieldset">
    <?php if ($book["ANHSACH"]) : ?>
      <img src="<?php echo $book["ANHSACH"] ?>" alt="<?php echo $book["TENSACH"] ?>" style="max-width: 500px; width: 100%">
    <?php endif; ?>

    <div class="uk-margin">
      <label class="uk-form-label" for="imageFile">Ảnh sách</label>
      <div class="uk-form-controls">
        <input class="uk-input" name="imageFile" type="file" placeholder="Ảnh sách">
      </div>
    </div>

    <div class="uk-margin">
      <label class="uk-form-label" for="TENSACH">Tên sách</label>
      <div class="uk-form-controls">
        <input class="uk-input" name="TENSACH" type="text" placeholder="Nhập tên sách" value="<?php echo $book["TENSACH"] ?>">
      </div>
    </div>

    <div class="uk-margin">
      <label class="uk-form-label" for="SOLUONG">Số lượng</label>
      <div class="uk-form-controls">
        <input class="uk-input" name="SOLUONG" type="number" placeholder="100" value="<?php echo $book["SOLUONG"] ?>">
      </div>
    </div>

    <div class="uk-margin">
      <label class="uk-form-label" for="MATACGIA">Tác giả</label>
      <div class="uk-form-controls">
        <select class="uk-select" name="MATACGIA" value="<?php echo $book["MATACGIA"] ?>">
          <?php foreach ($authors as $author) : ?>
            <?php if ($author["MATACGIA"] === $book["MATACGIA"]) : ?>
              <option value="<?php echo $author["MATACGIA"] ?>" selected><?php echo $author["BUTDANH"] ?></option>
            <?php else : ?>
              <option value="<?php echo $author["MATACGIA"] ?>"><?php echo $author["BUTDANH"] ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="uk-margin">
      <label class="uk-form-label" for="MATHELOAI">Thể loại</label>
      <div class="uk-form-controls">
        <select class="uk-select" name="MATHELOAI" value="<?php echo $book["MATHELOAI"] ?>">
          <?php foreach ($genres as $genre) : ?>
            <?php if ($genre["MATHELOAI"] === $book["MATHELOAI"]) : ?>
              <option value="<?php echo $genre["MATHELOAI"] ?>" selected><?php echo $genre["TEN"] ?></option>
            <?php else : ?>
              <option value="<?php echo $genre["MATHELOAI"] ?>"><?php echo $genre["TEN"] ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="uk-margin">
      <label class="uk-form-label" for="TOMTAT">Tóm tắt</label>
      <div class="uk-form-controls">
        <textarea name="TOMTAT" class="uk-textarea" rows="5" placeholder="Textarea" aria-label="Textarea"><?php echo $book["TOMTAT"] ?></textarea>
      </div>
    </div>

    <div class="uk-margin">
      <label class="uk-form-label" for="VITRI">Vị trí</label>
      <div class="uk-form-controls">
        <textarea name="VITRI" class="uk-textarea" rows="5" placeholder="Textarea" aria-label="Textarea"><?php echo $book["VITRI"] ?></textarea>
      </div>
    </div>

    <div class="uk-margin">
      <input class="uk-button uk-button-primary" type="submit" value="<?php echo $headTitle ?>">
      <a class="uk-button uk-button-danger" href="/admin/books">Quay lại</a>
    </div>
  </fieldset>
</form>