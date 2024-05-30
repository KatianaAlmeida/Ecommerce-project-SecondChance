<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show/Hide Div with Radio Buttons</title>
    <style>
        #helloMessage {
            display: none;
        }
    </style>
</head>
<body>
    <form>
        <label>
            <input type="radio" name="toggle" value="show" onclick="toggleMessage()"> Show Message
        </label>
        <label>
            <input type="radio" name="toggle" value="hide" onclick="toggleMessage()"> Hide Message
        </label>
    </form>

    <div id="helloMessage">Hello, this is a message!</div>

    <script>
        function toggleMessage() {
            const showRadio = document.querySelector('input[name="toggle"][value="show"]');
            const messageDiv = document.getElementById('helloMessage');
            
            if (showRadio.checked) {
                messageDiv.style.display = 'block';
            } else {
                messageDiv.style.display = 'none';
            }
        }
    </script>
</body>
</html>