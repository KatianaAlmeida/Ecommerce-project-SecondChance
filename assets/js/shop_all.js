document.addEventListener('DOMContentLoaded', () => {
  const rows = document.querySelectorAll('.product-row');
  const prevButton = document.getElementById('prev-button');
  const nextButton = document.getElementById('next-button');
  const pageInfo = document.getElementById('page-info');
  let currentPage = 1;
  const rowsPerPage = 2;

  const updatePagination = () => {
    rows.forEach((row, index) => {
      row.style.display = (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) ? 'flex' : 'none';
    });
    pageInfo.textContent = currentPage;
    prevButton.disabled = currentPage === 1;
    nextButton.disabled = currentPage === Math.ceil(rows.length / rowsPerPage);
  };

  prevButton.addEventListener('click', () => {
    if (currentPage > 1) {
      currentPage--;
      updatePagination();
    }
  });

  nextButton.addEventListener('click', () => {
    if (currentPage < Math.ceil(rows.length / rowsPerPage)) {
      currentPage++;
      updatePagination();
    }
  });

  updatePagination();
});