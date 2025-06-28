"use strict";

var box = document.querySelector(".prodcuts-container");
fetch("product.json").then(function (res) {
  return res.json();
}).then(function (data) {
  var data1 = data["product"];
  Object.keys(data1).forEach(function (e) {
    var item = data1[e];
    var box2 = document.createElement("div");
    box2.classList.add("items");
    Object.keys(item).forEach(function (e2) {
      console.log(e2);

      if (item[e2]["discount"] == "0") {
        box2.innerHTML += "\n            <div class=\"item\">\n              <div class=\"img-cover\">\n                <img src=\"../asset/A-Module/images/".concat(e, "/").concat(e2, ".PNG\" alt=\"\" />\n              </div>\n\n              <div class=\"item-content\">\n                <div class=\"item-title\">").concat(item[e2]["title"], "</div>\n                <div class=\"item-about\">\n            \n                  <div class=\"item-price\">\uAC00\uACA9: <span >").concat(item[e2]["price"], "</span></div>\n                  <div class=\"item-btn\">\n                    <a href=\"#\">\uAD6C\uB9E4\uD558\uAE30</a>\n                    <a href=\"#\">\uC7A5\uBC14\uAD6C\uB2C8\uB2F4\uAE30</a>\n                  </div>\n                </div>\n              </div>\n\n\n      \n        ");
      } else {
        box2.innerHTML += "\n\n            <div class=\"item\">\n              <div class=\"img-cover\">\n                <img src=\"../asset/A-Module/images/".concat(e, "/").concat(e2, ".PNG\" alt=\"\" />\n              </div>\n\n              <div class=\"item-content\">\n                <div class=\"item-title\">").concat(item[e2]["title"], "</div>\n                <div class=\"item-about\">\n            \n                  <div class=\"item-price\">\uAC00\uACA9: <span style=\"text-decoration: line-through;\">").concat(item[e2]["price"], "</span> -> <span class=\"discount\">").concat(item[e2]["discount"], "</span> </div>\n                  <div class=\"item-btn\">\n                    <a href=\"#\">\uAD6C\uB9E4\uD558\uAE30</a>\n                    <a href=\"#\">\uC7A5\uBC14\uAD6C\uB2C8\uB2F4\uAE30</a>\n                  </div>\n                </div>\n              </div>\n\n        ");
      }
    });
    box.innerHTML += box2.outerHTML;
  });
});