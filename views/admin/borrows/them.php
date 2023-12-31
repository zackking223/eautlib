<?php $headTitle="Thêm thẻ" ?>
<h2>THÊM THẺ</h2>
<?php include_once "_form.php"; ?>
<script>
    <?php
    $json = array();
    foreach ($card["SACHMUON"] as $book) {
        $json[] = $book;
    }
    ?>
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
        newCheckbox.value = book.MASACH;
        newCheckbox.checked = "checked";
        newCheckbox.addEventListener("change", (event) => {
            if (!event.target.checked) {
                removeBook(parseInt(event.target.id));
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
        borrowed = borrowed.filter(book => book.MASACH !== bookId);
        renderList();
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
            fetch(window.location.protocol + "//" + window.location.host + "/api/book?id=" + bookId)
                .then(res => res.json())
                .then(data => {
                    borrowed.push(data);
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
        idBtn.disabled = true;
        idBtn.textContent = "ĐANG TẢI...";

        addBook(parseInt(idInput.value));
    })

    renderList();
</script>