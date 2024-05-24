<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div id="description_laptop"></div>
<div id="description_phone"></div>

<script>
  // Embedding PHP variable into JavaScript
  const productDescription = `<?= addslashes($product["product_description"]); ?>`;
  window.addEventListener('resize', function() {
    const content = `<p>${productDescription}</p>`;
    const description_laptop = document.querySelector('#description_laptop');
    const description_phone = document.querySelector('#description_phone');
    
    if (description_laptop && description_phone) { // Check if elements exist
      if (window.innerWidth < 788) { // Mobile view
        description_laptop.innerHTML = 'a';
        description_phone.innerHTML = content;
      } else { // Desktop view
        description_phone.innerHTML = 'a';
        description_laptop.innerHTML = content;
      }
    }
  });

  // Initial call to handle the content display based on current window size
  window.dispatchEvent(new Event('resize'));
</script>

</body>
</html>