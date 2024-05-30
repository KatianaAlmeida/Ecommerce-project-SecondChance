document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.expand_btn').forEach(button => {
    button.addEventListener('click', function() {
      const index = this.getAttribute('data-index');
      const detailsRow = document.getElementById(`details-${index}`);
      if (detailsRow.classList.contains('details_off')) {
        detailsRow.classList.remove('details_off');
        detailsRow.classList.add('details_on');
        this.textContent = 'Collapse';
      } else {
        detailsRow.classList.remove('details_on');
        detailsRow.classList.add('details_off');
        this.textContent = 'Expand';
      }
    });
  });
});
