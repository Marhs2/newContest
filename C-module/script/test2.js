function changeColor(newColor) {
  const elem = document.elementFromPoint(2, 2);
  elem.style.color = newColor;
}

document.querySelectorAll("button").forEach((button) => {
  button.addEventListener("click", (event) => {
    changeColor(event.target.textContent.toLowerCase());
  });
});
