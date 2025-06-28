const $closesignup = document.querySelector(".closesignup");
const $opensignup = document.querySelector(".signup");
const $signupLayer = document.querySelector(".signupLayer");

const $closelogin = document.querySelector(".closeLogin");
const $openlogin = document.querySelector(".login");
const $loginLayer = document.querySelector(".loginLayer");

// $closelogin.addEventListener("click", () => {
//   $loginLayer.style.display = 'none'
// });

// $openlogin.addEventListener("click", () => {
//   $loginLayer.style.display = 'flex'
// })

// $closesignup.addEventListener("click", () => {
//   $signupLayer.style.display = 'none'
// });

// $opensignup.addEventListener("click", () => {
//   $signupLayer.style.display = 'flex'
// })


function logout() {
  location.href = "loginAction.php?type=logout";
}


let index = 1
let page = 0
let maxPage = 6;

function noticeSlide() {
  const lBtn = document.querySelector(".notice-left")
  const rBtn = document.querySelector(".notice-right")
  const nMove = document.querySelector(".notice-slide >li")

  lBtn.addEventListener("click", () => {
    if (index <= 1) return;
    nMove.setAttribute("style", `transform: translateX(${page += 1200}px)`)
    index--
    console.log(index)
  })

  rBtn.addEventListener("click", () => {
    if (index >= maxPage) return;
    index++
    nMove.setAttribute("style", `transform: translateX(${page -= 1200}px)`)
    console.log(index)

  })


}


function renderNotice(url) {
  const nMove = document.querySelector(".notice-slide >li")
  nMove.setAttribute("style", `transform: translateX(0px)`)
  index = 1;
  page = 0;
  nMove.innerHTML = ''

  fetch(url)
    .then(res => res.json())
    .then(data => {

      Object.keys(data).forEach((e) => {
        const value = data[e]
        nMove.innerHTML +=
          `
          <ul  >
                      <span>${value["type"]}</span>
                      <span>${value["title"]}</span>
                      <span>${value["date"]}</span>
                    </ul>
        `
      })


      maxPage = Math.ceil(data.length / 6)
    }
    )

}


document.addEventListener("DOMContentLoaded", () => {
  noticeSlide()

  renderNotice("../noticeFetch.php?type=order&con=asc")
})


function ASC() {

  const aBtn = document.querySelector('.ASC')
  aBtn.addEventListener("click", () => {

    renderNotice("../noticeFetch.php?type=order&con=asc")
  })

}



function DESC() {

  const dBtn = document.querySelector('.DESC')
  dBtn.addEventListener("click", () => {
    renderNotice("../noticeFetch.php?type=order&con=desc")
  })

}


function fnEvent() {
  const dBtn = document.querySelector('.event')
  dBtn.addEventListener("click", () => {
    renderNotice("../noticeFetch.php?type=type&con=이벤트")
  })

}


function general() {
  const eBtn = document.querySelector('.general')
  eBtn.addEventListener("click", () => {
    renderNotice("../noticeFetch.php?type=type&con=일반")
  })

}

DESC()
ASC()
fnEvent()
general()