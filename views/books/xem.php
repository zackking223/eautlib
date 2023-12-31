<?php $headTitle = $book["TENSACH"] ?>
<div class="uk-padding-small" style="display: flex; flex-direction: column; gap: 24px;">
  <section style="display: flex; align-items: center; gap: 12px">
    <h3 class="uk-margin-remove uk-text-bold"><?php echo $book["TENSACH"] ?></h3>
    <span class="uk-badge"><?php if ($book["SOLUONG"] > 0) {
                              echo "Còn sách";
                            } else {
                              echo "Hết sách";
                            } ?></span>
  </section>
  <div class="uk-flex" style="gap: 12px">
    <img src="<?php echo $book["ANHSACH"] ?>" alt="" class="uk-width-medium">
    <div>
      <section>
        <p class="uk-text-bold">Tác giả</p>
        <p>
          <a href="/?author=<?php echo urlencode($book["MATACGIA"]) ?>">
            <?php echo $book["BUTDANH"] ?>
          </a>
        </p>
      </section>
      <section>
        <p class="uk-text-bold">Thể loại</p>
        <p>
          <a href="/?genre=<?php echo urlencode($book["MATHELOAI"]) ?>">
            <?php echo $book["TEN"] ?>
          </a>
        </p>
      </section>
      <section>
        <p class="uk-text-bold">Tóm tắt</p>
        <p><?php echo $book["TOMTAT"] ?></p>
      </section>
      <section>
        <p class="uk-text-bold">Vị trí</p>
        <p><?php echo $book["VITRI"] ?></p>
      </section>
      <section>
        <p class="uk-text-bold">Số lượng</p>
        <p><?php echo $book["SOLUONG"] ?></p>
      </section>
    </div>
  </div>
</div>