const chipGroup = document.querySelector('.chip-group');

chipGroup.addEventListener('change', function(event) {
  const clickedCheckbox = event.target;
  const clickedLabel = clickedCheckbox.parentElement;
  if (clickedCheckbox.checked) {
    clickedLabel.style.backgroundColor = '#9ad768';
  } else {
    clickedLabel.style.backgroundColor = '#fff';
  }
});