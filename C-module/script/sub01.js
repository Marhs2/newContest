const mottos = [...document.querySelector(".mottos").children]
const Dess = document.querySelectorAll(".mottoDes div")
mottos.forEach((e) => {
  e.addEventListener("mouseover", () => {
    Dess[e.className.replace(/[^1-9]/g, "") - 1].style.opacity = "1"

    mottos.forEach((item) => {
      item.style.backgroundImage = `url(/images/${e.className}.png)`
    })
  })

  e.addEventListener("mouseleave", () => {
    Dess[e.className.replace(/[^1-9]/g, "") - 1].style.opacity = "0"
    mottos.forEach((item) => {
      item.style.backgroundImage = `url(/images/${item.className}.png)`
    })
  })


})
