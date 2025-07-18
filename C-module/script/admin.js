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

        </tr>
        `
      })

    })

}

function delProdcut(cate, num) {
  const conatiner = document.querySelector(".prodcuts-container");
  conatiner.innerHTML = ''
  const data = new URLSearchParams();
  data.append("cate", cate)
  data.append("id", num)
  fetch('../productDel.php', {
    method: "post",
    body: data
  })
    .then(res => res.json())

    .then(data => {
      const fitlerData = data.reduce((a, b) => {
        if (!a[b.cate]) {
          a[b.cate] = []
        }
        a[b.cate].push(b)
        return a;
      }, {})

      Object.keys(fitlerData).forEach((e) => {
        const newBox = document.createElement("div")
        newBox.classList.add("items")
        fitlerData[e].forEach((e2) => {
          if (e2.img != null) {
            newBox.innerHTML +=
              `
          <div class="item">
              <div class="img-cover">
                <img src="../asset/A-Module/images/else/${e2.img}" alt="" />
              </div>

              <div class="item-content">
                <div class="item-title">
                  0상품명: 이뮨 멀티비타민&amp;미네랄6
                </div>
                <div class="item-about">
                  <div class="item-price">
                    가격:
                    <span style="text-decoration: line-through">75,000</span>
                    -&gt; <span class="price">65,000</span>
                  </div>
                </div>
              </div>

          `
          } else {
            newBox.innerHTML +=
              `
          <div class="item">
              <div class="img-cover">
                <img src="../asset/A-Module/images/${e2.cate}/${e2.itemNum}.PNG" alt="" />
              </div>

              <div class="item-content">
                <div class="item-title">
                  0상품명: 이뮨 멀티비타민&amp;미네랄6
                </div>
                <div class="item-about">
                  <div class="item-price">
                    가격:
                    <span style="text-decoration: line-through">75,000</span>
                    -&gt; <span class="price">65,000</span>
                  </div>
                </div>
              </div>

          `
          }

        })
        conatiner.innerHTML += newBox.outerHTML
      })

      // Object.keys(fitlerData).forEach((e) => {
      // })

    }

    )




}

function imgPreview() {
  if (location.pathname != "/prodctAdd.php" || location.pathname != "/prodctEdit_remove.php") return;
  console.log("work")

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

function productAdd() {
  location.href = `../prodctAdd.php?isAdd=add`;
}

function ifChange() {
  const discount = document.querySelector(".discount")
  if (document.getElementById("isPop").checked) {
    discount.style.display = "flex"
  } else {
    discount.style.display = "none"
    Array.from(discount.children).forEach((e) => {
      e.checked = false
      console.log(e.checked)
    })
  }

}