
const $ = (element) => document.querySelector(element);
const $$ = (element) => [...document.querySelectorAll(element)];
const toInt = (number) => parseInt(number.replace(/[^0-9]/g, ""))





$$(".item").forEach((e) => {
  e.querySelector(".countTotal").textContent = (toInt(e.querySelector(".item-price span").textContent) * e.querySelector("input").value).toLocaleString("en-us")

  e.addEventListener("change", () => {
    e.querySelector(".countTotal").textContent = (toInt(e.querySelector(".item-price span").textContent) * e.querySelector("input").value).toLocaleString("en-us")
    $(".total").textContent = ($$(".countTotal").reduce((a, b) => a += toInt(b.textContent), 0)).toLocaleString("en-us")

    const data = new URLSearchParams();
    data.append("id", "1")
    data.append("item-cate", e.closest(".item").getAttribute('data-cate'))
    data.append("item-id", e.closest(".item").getAttribute('data-id'))
    data.append("type", "cart")
    data.append("count", e.closest(".item").querySelector("input").value)

    fetch('../addCart.php', {
      method: "post",
      body: data
    })
      .then(res => res.json())
      .then(data => console.log(data))


  })




  e.addEventListener("input", () => {
    e.querySelector(".countTotal").textContent = (toInt(e.querySelector(".item-price span").textContent) * e.querySelector("input").value).toLocaleString("en-us")

    $(".total").textContent = ($$(".countTotal").reduce((a, b) => a += toInt(b.textContent), 0)).toLocaleString("en-us")


    console.log(($$(".countTotal").reduce((a, b) => a += toInt(b.textContent), 0)))

    console.log(e.closest(".item").getAttribute('data-cate'))
    console.log(e.closest(".item").getAttribute('data-id'))
    console.log(e.closest(".item").querySelector("input").value)

    const data = new URLSearchParams();
    data.append("id", "1")
    data.append("item-cate", e.closest(".item").getAttribute('data-cate'))
    data.append("item-id", e.closest(".item").getAttribute('data-id'))
    data.append("type", "cart")
    data.append("count", e.closest(".item").querySelector("input").value)

    fetch('../addCart.php', {
      method: "post",
      body: data
    })
      .then(res => res.json())
      .then(data => console.log(data))


  })
})

$(".total").textContent = ($$(".countTotal").reduce((a, b) => a += toInt(b.textContent), 0)).toLocaleString("en-us")


