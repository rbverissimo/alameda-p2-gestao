const chipGroup = document.querySelector('.chip-group');

chipGroup.addEventListener('change', function(event) {
  const clickedCheckbox = event.target;
  if (clickedCheckbox.checked) {
    const clickedLabel = clickedCheckbox.parentElement; // Get the parent label
    clickedLabel.style.backgroundColor = '#9ad768';
  } else {
    clickedCheckbox.parentElement.style.backgroundColor = '#fff';
  }
});