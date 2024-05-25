<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Auto-submit Form on Number Input Change</title>
</head>
<body>
  <form id="numberForm" action="functions/handle_cart.php" method="POST">
    <label for="numberInput">Enter a number:</label>
    <input type="number" id="numberInput" name="number" min="0" max="100">
  </form>

  <script>
    document.getElementById('numberInput').addEventListener('input', function() {
      document.getElementById('numberForm').submit();
    });
  </script>
</body>
</html>