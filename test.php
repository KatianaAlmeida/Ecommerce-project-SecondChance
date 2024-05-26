<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .file-input-container {
  position: relative;
  display: inline-block;
  overflow: hidden;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
}

.file-input {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  cursor: pointer;
}

.file-label {
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  color: #333;
  cursor: pointer;
}

.file-icon {
  font-size: 24px;
  margin-right: 5px;
}
  </style>
</head>
<body>
<div class="file-input-container">
  <input type="file" id="file-input" class="file-input" multiple>
  <label for="file-input" class="file-label">
    <span class="file-icon">+</span>
    <span class="file-text">Add File</span>
  </label>
</div>
<script>
  const fileInput = document.getElementById('file-input');
const fileLabel = document.querySelector('.file-label');

fileInput.addEventListener('change', () => {
  const files = fileInput.files;
  if (files.length > 0) {
    fileLabel.querySelector('.file-text').textContent = `${files.length} File(s) Selected`;
  } else {
    fileLabel.querySelector('.file-text').textContent = 'Add File';
  }
});
</script>
</body>
</html>