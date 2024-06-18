const chipGroupLabels = document.querySelectorAll('.chip-group label');

  chipGroupLabels.forEach(label => {
    label.addEventListener('click', function() {
      const checkbox = this.querySelector('input[type="checkbox"]');
      checkbox.checked = !checkbox.checked; 
    });
  });