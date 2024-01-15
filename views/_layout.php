<?php $roles = [
  "QUAN_TRI" => "Quản trị viên",
  "THU_THU" => "Thủ thư"
]; ?>
<!DOCTYPE html>
<html>

<?php include "../includes/head.php" ?>

<body>
  <?php if (isset($_SESSION["auth"])) : ?>
    <div class="uk-section uk-section-secondary uk-padding-small">
      <p class="uk-align-center uk-text-primary uk-text-center">
        User: <?php echo $_SESSION["username"] ?>. Vai trò: <?php echo $roles[$_SESSION["role"]] ?>
      </p>
    </div>
  <?php endif; ?>

  <div class="uk-container uk-container-expand uk-section-primary uk-box-shadow-medium">
    <nav class="uk-navbar" uk-navbar style="align-items: center;">

      <div class="uk-navbar-left">
        <a class="uk-navbar-item uk-logo uk-text-bold uk-visible@l" href="/" aria-label="Back to Home">
          <img src="/public/eaut_logo.png" class="uk-margin-tiny-right uk-border-circle" width="60" height="60" alt="UIkit">
          EAUT Library
        </a>
        <a class="uk-navbar-item uk-logo uk-text-bold uk-hidden@l" style="font-size: 20px !important;" href="/" aria-label="Back to Home">
          <img src="/public/eaut_logo.png" class="uk-margin-tiny-right uk-border-circle" width="40" height="40" alt="UIkit">
          EAUT Library
        </a>
      </div>

      <div class="uk-navbar-right">
        <?php if (isset($_SESSION["auth"])) : ?>
          <a class="uk-button uk-button-text uk-visible@l" href="/admin">Quản trị</a>
          <a class="uk-button uk-button-text uk-visible@l" href="/admin/borrows">Mượn trả</a>
        <?php endif; ?>
        <section class="uk-visible@l">
          <button class="uk-button uk-button-text" type="button">Thể loại</button>
          <div class="uk-background-secondary" uk-dropdown>
            <ul class="uk-nav uk-dropdown-nav uk-section uk-section-secondary">
              <li class="uk-nav-header uk-text-primary uk-text-bold">Chuyên ngành</li>
              <li class="uk-nav-divider"></li>
              <li><a href="/?genre=9">HTTT</a></li>
              <li><a href="/?genre=10">CNPM</a></li>
              <li><a href="/?genre=11">QTKD</a></li>
              <li><a href="/?genre=12">KTĐT</a></li>
              <li class="uk-nav-header uk-text-primary uk-text-bold">Phổ biến</li>
              <li class="uk-nav-divider"></li>
              <li><a href="/?genre=2">Tình cảm</a></li>
              <li><a href="/?genre=13">Bí ẩn</a></li>
              <li><a href="/?genre=1">Kinh dị</a></li>
              <li><a href="/?genre=14">Lịch sử</a></li>
              <li><a href="/?genre=15">Khoa học</a></li>
              <li class="uk-nav-header uk-text-primary uk-text-bold">Truyện tranh</li>
              <li class="uk-nav-divider"></li>
              <li><a href="/?genre=16">Manga</a></li>
              <li><a href="/?genre=17">Manhua</a></li>
              <li><a href="/?genre=18">Manhwa</a></li>
              <li><a href="/?genre=19">Comic</a></li>
            </ul>
          </div>
        </section>

        <section class="uk-visible@l">
          <button class="uk-button uk-button-text" type="button">Tác giả</button>
          <div class="uk-background-secondary" uk-dropdown>
            <ul class="uk-nav uk-dropdown-nav uk-section uk-section-secondary">
              <li class="uk-nav-header uk-text-primary uk-text-bold">Nhà văn</li>
              <li class="uk-nav-divider"></li>
              <li><a href="/?author=1">Tô Hoài</a></li>
              <li><a href="/?author=2">Kim Lân</a></li>
              <li><a href="/?author=8">Xuân Diệu</a></li>
              <li><a href="/?author=6">Đăng Khoa</a></li>
              <li class="uk-nav-header uk-text-primary uk-text-bold">Giáo sư</li>
              <li class="uk-nav-divider"></li>
              <li><a href="/?author=9">Lân Dũng</a></li>
              <li><a href="/?author=10">Văn Thọ</a></li>
            </ul>
          </div>
        </section>

        <form class="uk-search uk-search-default uk-visible@l">
          <a href="" class="uk-search-icon-flip" uk-search-icon></a>
          <input class="uk-search-input" type="search" name="name" placeholder="Tìm kiếm sách" aria-label="Search" value="<?php if ($search["name"]) echo $search["name"] ?>">
        </form>

        <?php if (isset($_SESSION["auth"])) : ?>
          <a class="uk-button uk-button-default uk-visible@l" href="/auth/logout">Đăng xuất</a>
        <?php else : ?>
          <a class="uk-button uk-button-default uk-visible@l" href="/auth/login">Đăng nhập</a>
        <?php endif; ?>

        <button class="uk-button uk-text-primary uk-text-bold uk-hidden@l uk-padding-remove noPrint" type="button" uk-toggle="target: #offcanvas-overlay" uk-icon="icon: menu; ratio: 1.2"></button>

        <!-- SIDEBAR -->
        <div class="uk-hidden@l" id="offcanvas-overlay" uk-offcanvas="overlay: true; flip: true">
          <div class="uk-offcanvas-bar uk-background-primary">

            <button class="uk-offcanvas-close uk-padding uk-text-primary" type="button" uk-close></button>

            <?php if (isset($_SESSION["auth"])) : ?>
              <a class="uk-button uk-button-default" href="/auth/logout">Đăng xuất</a>
            <?php else : ?>
              <a class="uk-button uk-button-default" href="/auth/login">Đăng nhập</a>
            <?php endif; ?>

            <hr>

            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> -->
            <form class="uk-search uk-search-navbar uk-hidden@l">
              <a href="" class="uk-search-icon-flip" uk-search-icon></a>
              <input class="uk-search-input" type="search" name="name" placeholder="Tìm kiếm sách" aria-label="Search" value="<?php if ($search["name"]) echo $search["name"] ?>">
            </form>

            <hr>

            <ul uk-accordion>
              <li class="uk-open">
                <a class="uk-accordion-title" href>Chuyên ngành</a>
                <div class="uk-accordion-content">
                  <ul class="uk-nav uk-dropdown-nav">
                    <li><a href="/?genre=9">HTTT</a></li>
                    <li><a href="/?genre=10">CNPM</a></li>
                    <li><a href="/?genre=11">QTKD</a></li>
                    <li><a href="/?genre=12">KTĐT</a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a class="uk-accordion-title" href>Phổ biến</a>
                <div class="uk-accordion-content">
                  <ul class="uk-nav uk-dropdown-nav">
                    <li><a href="/?genre=2">Tình cảm</a></li>
                    <li><a href="/?genre=13">Bí ẩn</a></li>
                    <li><a href="/?genre=1">Kinh dị</a></li>
                    <li><a href="/?genre=14">Lịch sử</a></li>
                    <li><a href="/?genre=15">Khoa học</a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a class="uk-accordion-title" href>Truyện tranh</a>
                <div class="uk-accordion-content">
                  <ul class="uk-nav uk-dropdown-nav">
                    <li><a href="/?genre=16">Manga</a></li>
                    <li><a href="/?genre=17">Manhua</a></li>
                    <li><a href="/?genre=18">Manhwa</a></li>
                    <li><a href="/?genre=19">Comic</a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a class="uk-accordion-title" href>Nhà văn</a>
                <div class="uk-accordion-content">
                  <ul class="uk-nav uk-dropdown-nav">
                    <li><a href="/?author=1">Tô Hoài</a></li>
                    <li><a href="/?author=2">Kim Lân</a></li>
                    <li><a href="/?author=8">Xuân Diệu</a></li>
                    <li><a href="/?author=6">Đăng Khoa</a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a class="uk-accordion-title" href>Giáo sư</a>
                <div class="uk-accordion-content">
                  <ul class="uk-nav uk-dropdown-nav">
                    <li><a href="/?author=9">Lân Dũng</a></li>
                    <li><a href="/?author=10">Văn Thọ</a></li>
                  </ul>
                </div>
              </li>
              <?php if (isset($_SESSION["auth"])) : ?>
                <li>
                  <a class="uk-button uk-button-small uk-button-secondary uk-hidden@l" href="/admin">Quản trị</a>
                  <a class="uk-button uk-button-small uk-button-secondary uk-hidden@l" href="/admin/borrows">Mượn trả</a>
                </li>
              <?php endif; ?>
            </ul>

          </div>
        </div>
        <!-- SIDEBAR -->

      </div>
    </nav>
  </div>
  <?php echo $content ?>
</body>

</html>