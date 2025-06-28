"use strict";

fetch("./prodcut.json").then(function (res) {
  return res.json;
}).then(function (data) {
  return console.log(data);
});