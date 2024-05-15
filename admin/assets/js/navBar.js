function navigate() {
  var select = document.getElementById("pages");
  var selectedOption = select.options[select.selectedIndex];
  var url = selectedOption.value;
  if (url) {
    window.location.href = url;
  }
}