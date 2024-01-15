<?php $headTitle = "Sửa sách" ?>
<h2 class="hiddenPrint">Thẻ sách. <span>Mã sách: <?php echo $book["MASACH"] ?></span></h2>
<div class="uk-flex noPrint" style="align-items: center;">
  <h2 class="noPrint uk-margin-right" style="margin-bottom: 0px;">SỬA SÁCH</h2>
  <button onclick="window.print();" class="uk-button uk-button-primary uk-button-small">In <span uk-icon="file-text"></span></button>
</div>
<span class="uk-badge noPrint uk-margin" style="font-size: 16px; padding: 8px 14px; box-sizing: content-box;">
  Mã: <?php echo $book["MASACH"] ?>
</span>
<?php include_once "_form.php"; ?>