<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dropdown Menu</title>
<style>
/* Style for dropdown menu */
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  margin-top: 10px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-item {
  padding: 12px 16px;
  text-decoration: none;
  color: #333;
  display: block;
}

.dropdown-item:hover {
  background-color: red;
}
.dropdown_on{
  display: block;
}
</style>
</head>
<body>

<div class="dropdown">
  <span >Hover over me</span>
  <div class="dropdown-content">
    <a class="dropdown-item" href="#">Link 1</a>
    <a class="dropdown-item"  href="#">Link 2</a>
    <a class="dropdown-item" href="#">Link 3</a>
  </div>
</div>

<script>
const dropdown = document.querySelector('.dropdown');

dropdown.addEventListener('click', function() {
  const dropdown_content = document.querySelector('.dropdown-content'); 
  if(!dropdown_content.classList.contains('dropdown_on')){
    dropdown_content.classList.add('dropdown_on');

  } else{
    dropdown_content.classList.remove('dropdown_on');
  }
});
  </script>

</body>
</html>