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

document.getElementById('add_card').addEventListener('submit', function(event) {
  const ageInput = document.getElementById('card_number');
  if (isNaN(ageInput.value) || ageInput.value.trim() === '') {
      alert('Please enter a valid number.');
      event.preventDefault();
  }
  const expiry_year = document.getElementById('expiry_year');
  if (isNaN(expiry_year.value) || expiry_year.value.trim() === '') {
      alert('Please enter a valid number.');
      event.preventDefault();
  }
});
