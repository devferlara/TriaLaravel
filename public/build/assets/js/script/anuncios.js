var textarea = document.getElementById("descripcion");
var descripcion = textarea.value;
var arreglo = document.querySelector("#arreglo");

function drawOutput() {
  arreglo.innerHTML = textarea.value;
}
textarea.addEventListener("input", drawOutput);
window.addEventListener("load", drawOutput);