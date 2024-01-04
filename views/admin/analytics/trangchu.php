<?php $headTitle = "Thống kê" ?>
<div class="uk-child-width-expand@s uk-margin-remove uk-grid-small" uk-grid>
  <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
    <h3 class="uk-card-title">Số sách chưa trả</h3>
    <p><?php echo $data["SACHCHUATRA"] ?></p>
  </div>
  <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
    <h3 class="uk-card-title">Số sách quá hạn</h3>
    <p><?php echo $data["SACHQUAHAN"] ?></p>
  </div>
  <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
    <h3 class="uk-card-title">Số bạn đọc thêm tháng này</h3>
    <p><?php echo $data["BANDOCTHANGNAY"] ?></p>
  </div>
  <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
    <h3 class="uk-card-title">Số sách thêm tháng này</h3>
    <p><?php echo $data["SACHTHANGNAY"] ?></p>
  </div>
  <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
    <h3 class="uk-card-title">Số vi phạm tháng này</h3>
    <p><?php echo $data["VPTHANGNAY"] ?></p>
  </div>
</div>