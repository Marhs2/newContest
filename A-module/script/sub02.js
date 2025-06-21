
const $ = (element) => document.querySelector(element);
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


const dropZone = $(".drop")


async function drag(cate) {
  await category(cate)
  const dragItme = [...document.querySelectorAll(".cateZone .item")]

  console.log(dragItme)

  dragItme.forEach((e, idx) => {
    e.setAttribute("draggable", true)
    e.setAttribute("data-id", idx)


    e.addEventListener("dragstart", (item) => {
      item.dataTransfer.setData('text/html', e.outerHTML)
    })


  })

  dropZone.addEventListener("dragover", (e) => {
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

      if (!check.length >= 1) {

        dropZone.insertAdjacentHTML('afterbegin', itemHTML);
        selectBox = $(`.drop [data-id="${newBox.querySelector('.item').getAttribute("data-id")}"]`)


        selectBox.querySelector(".item-content").innerHTML += `<div class="itemCount">
    <input type="number" value="1" min="1" />
    <div>가격: <span class="countTotal">${selectBox.querySelector(".price").textContent}</span>원</div>
    </div>`
      } else {
        selectBox = $(`.drop [data-id="${newBox.querySelector('.item').getAttribute("data-id")}"]`)
        selectBox.querySelector('[type="number"]').value = parseInt(selectBox.querySelector('[type="number"]').value) + 1

        selectBox.querySelector('.countTotal').textContent = (toInt(selectBox.querySelector(".price").textContent) * toInt(selectBox.querySelector('[type="number"]').value)).toLocaleString("en-us")


      }
    } catch (error) {
    }






    priceTotal()
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


    }).catch(error => {
      console.error("Error fetching product data:", error);
      throw error;
    });

}


function priceTotal() {
  const total = document.querySelector(".total")
  let sum = 0;
  Array.from(dropZone.children).forEach((e) => {
    sum += parseInt(e.querySelector(".countTotal").innerText.replace(/[^0-9]/g, ""))
  })

  total.textContent = sum.toLocaleString("en-us")
}

function itemPrice() {
  dropZone.addEventListener("change", (e) => {
    e.currentTarget.querySelector(".countTotal").textContent = (toInt(e.currentTarget.querySelector(".price").textContent) * toInt(e.target.value)).toLocaleString("en-us")
    priceTotal()
  })

  dropZone.addEventListener("input", (e) => {
    e.currentTarget.querySelector(".countTotal").textContent = (toInt(e.currentTarget.querySelector(".price").textContent) * toInt(e.target.value)).toLocaleString("en-us")
    priceTotal()
  })
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

drag("디지털")
