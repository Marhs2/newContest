const box = document.querySelector(".prodcuts-container")

fetch("product.json")
  .then((res) => res.json())
  .then((data) => {
    const data1 = data["product"]

    Object.keys(data1).forEach((e) => {
      const item = data1[e]


      const box2 = document.createElement("div")

      box2.classList.add("items")


      Object.keys(item).forEach((e2) => {



        console.log(e2)
        if (item[e2]["discount"] == "0") {

          box2.innerHTML +=
            `
            <div class="item">
              <div class="img-cover">
                <img src="../asset/A-Module/images/${e}/${e2}.PNG" alt="" />
              </div>

              <div class="item-content">
                <div class="item-title">${item[e2]["title"]}</div>
                <div class="item-about">
            
                  <div class="item-price">가격: <span >${item[e2]["price"]}</span></div>
                  <div class="item-btn">
                    <a href="#">구매하기</a>
                    <a href="#">장바구니담기</a>
                  </div>
                </div>
              </div>


      
        `

        } else {
          box2.innerHTML +=
            `

            <div class="item">
              <div class="img-cover">
                <img src="../asset/A-Module/images/${e}/${e2}.PNG" alt="" />
              </div>

              <div class="item-content">
                <div class="item-title">${item[e2]["title"]}</div>
                <div class="item-about">
            
                  <div class="item-price">가격: <span style="text-decoration: line-through;">${item[e2]["price"]}</span> -> <span class="discount">${item[e2]["discount"]}</span> </div>
                  <div class="item-btn">
                    <a href="#">구매하기</a>
                    <a href="#">장바구니담기</a>
                  </div>
                </div>
              </div>

        `

        }
      })

      box.innerHTML += box2.outerHTML
    })

  })