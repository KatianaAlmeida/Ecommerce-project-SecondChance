function openTab(event, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tab-content");
  for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
      tabcontent[i].classList.remove("active");
  }
  tablinks = document.getElementsByClassName("tab-link");
  for (i = 0; i < tablinks.length; i++) {
      tablinks[i].classList.remove("active");
  }
  document.getElementById(tabName).style.display = "block";
  document.getElementById(tabName).classList.add("active");
  if (event) {
      event.currentTarget.classList.add("active");
  } else {
      document.querySelector(`.tab-buttons button[onclick*="${tabName}"]`).classList.add("active");
  }
}

function checkHash() {
  const hash = window.location.hash.substring(1); // Remove the '#' character
  if (hash) {
      openTab(null, hash);
  }
}

// Check the URL hash when the page loads
window.onload = checkHash;