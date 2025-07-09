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
  const imagePreview = document.querySelector("#imagePreview");

  // fileInput이나 imagePreview가 없을 경우를 대비해 오류를 방지합니다.
  if (!fileInput || !imagePreview) {
    console.error("필요한 HTML 요소(file input 또는 imagePreview)를 찾을 수 없습니다.");
    return;
  }

  fileInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        imagePreview.src = e.target.result;
      }
      reader.readAsDataURL(file);
    }
  });
}

imgPreview();
