
const $ = (element) => document.querySelector(element);
const $$ = (element) => [...document.querySelectorAll(element)];
const toInt = (number) => parseInt(number.replace(/[^0-9]/g, ""))

const ctrls = document.querySelector(".videoCtrlHide")
const hide = document.querySelector(".videoCtrl")
const video = document.querySelector("video")


ctrls.addEventListener('click', (e) => {
  if (e.target.classList.contains("ctrl01")) {
    video.play()
  }

  if (e.target.classList.contains("ctrl02")) {
    video.pause()
  }

  if (e.target.classList.contains("ctrl03")) {
    video.pause()
    video.currentTime = 0
  }

  if (e.target.classList.contains("ctrl04")) {
    video.currentTime -= 10
  }

  if (e.target.classList.contains("ctrl05")) {
    video.currentTime += 10
  }

  if (e.target.classList.contains("ctrl06")) {
    video.playbackRate -= 0.1
  }

  if (e.target.classList.contains("ctrl07")) {
    video.playbackRate += 0.1
  }

  if (e.target.classList.contains("ctrl08")) {
    video.playbackRate = 1
  }
})

ctrls.addEventListener("change", () => {
  hide.style.display = $("#hide").checked ? "none" : "block";
  video.loop = $("#loop").checked ? true : false;
  if ($("#auto").checked) {
    localStorage.setItem("auto", true)
    video.play()
  } else {
    localStorage.setItem("auto", false)
    video.pause()
  }
})

if (localStorage.getItem("auto") == "true") {
  video.muted = true
  video.play()
  $("#auto").checked = true;
}


let dropZone = $(".drop")
let cateZone = $(".cateZone")


function drag() {

  dropZone.addEventListener("dragover", (e) => {
    e.preventDefault();
  })

  $("body").addEventListener("dragover", (e) => {
    e.preventDefault();
  })

  dropZone.addEventListener("drop", (item) => {
    let check = null
    const itemHTML = item.dataTransfer.getData("text/html")
    const newBox = document.createElement("div")
    let selectBox = null;
    newBox.innerHTML += itemHTML

    try {
      check = Array.from(dropZone.children).filter((e) => e.getAttribute("data-id") == newBox.querySelector('.item').getAttribute("data-id"));



      if (check.length === 0) {

        dropZone.insertAdjacentHTML('afterbegin', itemHTML);
        selectBox = $(`.drop [data-id="${newBox.querySelector('.item').getAttribute("data-id")}"]`)


        selectBox.querySelector(".item-content").innerHTML += `<div class="itemCount">
          <input type="number" value="1" min="1" />
          <div>가격: <span class="countTotal">${selectBox.querySelector(".price").textContent}</span>원</div>
          </div>`
      } else {
        selectBox = $(`.drop [data-id="${newBox.querySelector('.item').getAttribute("data-id")}"]`)
        selectBox.querySelector('[type="number"]').value = parseInt(parseInt(selectBox.querySelector('[type="number" ]').value)) + 1


        selectBox.querySelector('.countTotal').textContent = (toInt(selectBox.querySelector(".price").textContent) * toInt(selectBox.querySelector('[type="number"]').value)).toLocaleString("en-us")


      }
    } catch (error) {
    } finally {
      checkDrop()

    }






    priceTotal()
  })

  $("body:not(.drop)").addEventListener("drop", (e) => {

    if (!e.target.closest(".drop")) {
      const delItem = e.dataTransfer.getData('text/plain')
      console.log(delItem)
      console.log($(`.drop .item[data-id="${delItem}"]`))
    }


  })


}

function checkDrop() {
  const dataId = $$(".drop .item").map((e) => e.getAttribute("data-id"))


  $$(".cateZone .item").forEach((e) => {
    if (dataId.includes(e.getAttribute("data-id"))) {
      e.style.opacity = 0.5
    }

  })



}


async function category(cate) {
  const box = $(".cateZone")
  box.innerHTML = ""
  return fetch("./product.json")
    .then((res) => res.json())
    .then((data) => {
      const data1 = data["product"]


      const item = data1[cate]





      Object.keys(item).forEach((e2) => {



        if (item[e2]["discount"] == "0") {

          box.innerHTML +=
            `
            <div class="item">
              <div class="img-cover">
                <img src="../asset/A-Module/images/${cate}/${e2}.PNG" alt="" />
              </div>

              <div class="item-content">
                <div class="item-title">${item[e2]["title"]}</div>
                <div class="item-about">
            
                  <div class="item-price">가격: <span class="price" >${item[e2]["price"]}</span></div>
                </div>
              </div>


      
        `

        } else {
          box.innerHTML +=
            `

            <div class="item">
              <div class="img-cover">
                <img src="../asset/A-Module/images/${cate}/${e2}.PNG" alt="" />
              </div>

              <div class="item-content">
                <div class="item-title">${item[e2]["title"]}</div>
                <div class="item-about">
            
                  <div class="item-price">가격: <span style="text-decoration: line-through;">${item[e2]["price"]}</span> -> <span class="price">${item[e2]["discount"]}</span> </div>
    
                </div>
              </div>

        `


        }
      })




    })


}


function priceTotal() {
  dropZone = $(".drop");
  const total = document.querySelector(".total")
  let sum = 0;
  Array.from(dropZone.children).forEach((e) => {
    // console.log(e.querySelector(".countTotal"))
    sum += parseInt(e.querySelector(".countTotal").innerText.replace(/[^0-9]/g, ""))
  })

  total.textContent = sum.toLocaleString("en-us")
}

function itemPrice() {
  dropZone.addEventListener("change", (e) => {
    if (e.target.type === "number" && e.target.closest(".item")) {
      const itemElement = e.target.closest(".item");
      const priceText = itemElement.querySelector(".price").textContent;
      const quantityValue = e.target.value;

      itemElement.querySelector(".countTotal").textContent =
        (toInt(priceText) * toInt(quantityValue)).toLocaleString("en-us");
      priceTotal();
    }
  });

  dropZone.addEventListener("input", (e) => {
    if (e.target.type === "number" && e.target.closest(".item")) {
      const itemElement = e.target.closest(".item");
      const priceText = itemElement.querySelector(".price").textContent;
      const quantityValue = e.target.value;

      itemElement.querySelector(".countTotal").textContent =
        (toInt(priceText) * toInt(quantityValue)).toLocaleString("en-us");
      priceTotal();
    }
  });
}

itemPrice()

const userId = document.querySelector(".userId")
function genId() {
  const ids = ["1234567890QWERTYUIOPASDFGHJKLZXCVBNM"].join("").split("")
  for (let i = 0; i < 5; i++) {
    userId.textContent += ids[Math.floor(Math.random() * ids.length)]
  }
}

genId()


async function draggable(cate) {
  await category(cate)
  const dragItme = [...document.querySelectorAll(".cateZone .item")]
  const dropDrag = $$(".drop .item")


  dragItme.forEach((e, idx) => {
    e.setAttribute("draggable", true)
    e.setAttribute("data-id", cate + idx)


    e.addEventListener("dragstart", (item) => {
      item.dataTransfer.setData('text/html', e.outerHTML)
      item.dataTransfer.setData('text/plain', e.closest(".item").getAttribute("data-id"))



    })
  })

  dropDrag.forEach((e) => {
    e.setAttribute("draggable", true)
  })

  checkDrop()


}


function setcate() {
  [...$$('.ctaegory div:not(:nth-child(1))')].forEach((e) => {
    e.addEventListener('click', () => {
      draggable(e.textContent)

    })
  })
}


$(".noneUserBtn").addEventListener("click", () => {
  $(".noneUser-cart").style.display = "flex"
})

$(".close").addEventListener("click", () => {
  $(".noneUser-cart").style.display = "none"
})

$(".checkoutBtn").addEventListener("click", () => {
  $(".userBuyAlert .id").textContent = $(".userId").textContent.replace(/[ㄱ-ㅎㅏ-ㅣ가-힣|:|\s]/g, "")
  $(".userBuyAlert .buy").textContent = $(".total").textContent
  $(".userBuyAlert").style.visibility = "visible"
  $(".noneUser-cart").style.display = "none"
  setTimeout(() => {

    $(".userBuyAlert").style.visibility = "hidden"
  }, 3000);
})



setcate()
draggable("건강식품")
drag('건강식품')


function addDbCart() {
  $$(".item-btn span").forEach((e) => {

    e.addEventListener('click', (event) => {
      const data = new URLSearchParams();
      data.append("id", "1")
      data.append("item-cate", event.target.closest(".item").getAttribute('data-cate'))
      data.append("item-id", event.target.closest(".item").getAttribute('data-idx'))
      data.append("title", event.target.closest(".item").querySelector('.item-title').textContent.replace(/["상품명: "]/g, ""))
      data.append("price", event.target.closest(".item").querySelector('.item-price span').textContent)
      if (event.target.closest(".item").querySelector('.discount')) {
        data.append("discount", event.target.closest(".item").querySelector('.discount').textContent)
      } else {
        data.append("discount", "0")

      }


      fetch('../addCart.php', {
        method: "post",
        body: data
      })
        .then(res => res.json())

        .then(data =>
          alert(data)
        )


    })

  })

}

addDbCart()