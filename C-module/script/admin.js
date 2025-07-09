function del(event) {
  const container = document.querySelector(".noticeContainer tbody")

  const sendData = new URLSearchParams();
  sendData.append("item-id", event.closest(".notice").getAttribute('data-id'))

  fetch(("../noticeDel.php"), {
    method: "post",
    body: sendData
  })
    .then((res) => res.json())
    .then((data) => {
      container.innerHTML = "";
      data.forEach((e) => {
        container.innerHTML +=
          `
        <tr class="notice" data-id="${e.idx}">
          <td>${e.type}</td>
          <td>${e.title}</td>
          <td>${e.date}</td>
          <td><a href="./noticeEdit_Add.php?idx=${e.idx}&type=edit">수정</a> </td>
          <td class="del" onclick="del()">삭제</td>
Z
        </tr>
        `
      })

    })

}

function delProdcut(event) {

}

function imgPreview() {
  if (location.pathname != "/prodctEdit_remove.php") return;

  const fileInput = document.querySelector("[type='file']");
  const imgPreview = document.querySelector("#imgPreview");

  console.log(imgPreview);


  fileInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        imgPreview.src = e.target.result;
      }
      reader.readAsDataURL(file);
    }
  });
}

imgPreview();
