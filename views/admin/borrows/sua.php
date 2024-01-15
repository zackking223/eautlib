<?php $headTitle = "Sửa thẻ" ?>
<h2 class="hiddenPrint">Thẻ mượn sách</h2>
<div class="uk-flex uk-margin-bottom noPrint" style="align-items: center;">
  <h2 class="noPrint uk-margin-right" style="margin-bottom: 0px;">SỬA THẺ</h2>
  <button onclick="window.print();" class="uk-button uk-button-primary uk-button-small">In <span uk-icon="file-text"></span></button>
</div>
<?php include_once "_form.php"; ?>
<script>
  <?php
  $json = array();
  foreach ($card["SACHMUON"] as $book) {
    $json[] = $book;
  }
  ?>
  let cardId = <?php echo json_encode($card["MATHEMUON"]); ?>;
  let borrowed = <?php echo json_encode($json); ?>;
  const list = document.getElementById("danhsachsach");
  const idInput = document.getElementById("themsach");
  const idBtn = document.getElementById("themsachbtn");

  function createChild(book) {
    let newContainer = document.createElement("div");
    newContainer.classList.add("uk-margin-small");

    let newCheckbox = document.createElement("input");
    newCheckbox.type = "checkbox";
    newCheckbox.name = "SACHMUON[]";
    newCheckbox.id = book.MASACH;
    newCheckbox.checked = "checked";
    newCheckbox.value = book.MASACH;
    newCheckbox.addEventListener("change", (event) => {
      if (!event.target.checked) {
        if (confirm("Bạn có chắc muốn xóa?")) {
          removeBook(parseInt(event.target.id));
        } else {
          event.target.checked = true;
        }
      }
    })

    let newLabel = document.createElement("label");
    newLabel.for = book.MASACH;
    newLabel.textContent = book.TENSACH;

    newContainer.appendChild(newCheckbox);
    newContainer.appendChild(newLabel);

    list.appendChild(newContainer);
  }

  function renderList() {
    list.textContent = '';
    borrowed.forEach(book => {
      createChild(book);
    });
  }

  function removeBook(bookId) {
    fetch(window.location.protocol + "//" + window.location.host + "/api/book/return", {
        method: "POST",
        body: JSON.stringify({
          bookid: bookId,
          cardid: cardId
        })
      }).then(res => {
        borrowed = borrowed.filter(book => book.MASACH !== bookId);
        renderList();
      })
      .catch(err => {
        UIkit.notification({
          message: "Xóa thất bại!",
          status: 'danger',
          pos: 'top-center',
          timeout: 5000
        });
      });
  }

  function turnOnBtn() {
    idBtn.disabled = false;
    idBtn.textContent = "THÊM";
  }

  function checkExisted(bookId) {
    const result = borrowed.find(el => el.MASACH === parseInt(bookId));
    return !!result;
  }

  function addBook(bookId) {
    if (!checkExisted(bookId)) {
      fetch(window.location.protocol + "//" + window.location.host + "/api/book/borrow", {
          method: "POST",
          body: JSON.stringify({
            bookid: bookId,
            cardid: cardId
          })
        })
        .then(res => res.json())
        .then(data => {
          borrowed.push(data.book);
          renderList();
          turnOnBtn();
        }).catch(err => {
          UIkit.notification({
            message: "Sách không tồn tại!",
            status: 'danger',
            pos: 'top-center',
            timeout: 5000
          });
          turnOnBtn();
        });
    } else {
      UIkit.notification({
        message: "Sách đã được chọn!",
        status: 'danger',
        pos: 'top-center',
        timeout: 5000
      });
      turnOnBtn();
    }
  }

  idBtn.addEventListener("click", () => {
    if (confirm("Bạn có chắc muốn thêm sách?")) {
      idBtn.disabled = true;
      idBtn.textContent = "ĐANG TẢI...";

      addBook(parseInt(idInput.value));
    }
  });

  renderList();
</script>