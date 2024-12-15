function switchTab(tab) {
    const tabs = document.querySelectorAll('.tab');
    const userTypeInput = document.getElementById('user-type'); // Get the hidden input field

    tabs.forEach(btn => btn.classList.remove('active'));

    if (tab === 'patient') {
        tabs[0].classList.add('active');
        userTypeInput.value = 'patient'; // Update the hidden input value
    } else {
        tabs[1].classList.add('active');
        userTypeInput.value = 'doctor'; // Update the hidden input value
    }
}
  
  // Toggle Password Visibility
  function togglePassword() {
    const passwordField = document.getElementById('password');
    if (passwordField.type === 'password') {
      passwordField.type = 'text';
    } else {
      passwordField.type = 'password';
    }
  }