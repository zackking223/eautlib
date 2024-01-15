<?php $headTitle = "Sửa bạn đọc" ?>
<h2 class="hiddenPrint">Thẻ bạn đọc</h2>
<div class="uk-flex noPrint" style="align-items: center;">
  <h2 class="noPrint uk-margin-right" style="margin-bottom: 0px;">SỬA BẠN ĐỌC</h2>
  <button onclick="window.print();" class="uk-button uk-button-primary uk-button-small">In <span uk-icon="file-text"></span></button>
</div>
<span class="uk-badge uk-margin" style="font-size: 16px; padding: 8px 14px; box-sizing: content-box;">
  Mã: <?php echo $reader["MABANDOC"] ?>
</span>
<?php include_once "_form.php"; ?>