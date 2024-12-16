function switchForm(formType) {
    const patientForm = document.getElementById('patientForm');
    const doctorForm = document.getElementById('doctorForm');
    const patientTab = document.getElementById('patientTab');
    const doctorTab = document.getElementById('doctorTab');
  
    if (formType === 'patient') {
      patientForm.style.display = 'block';
      doctorForm.style.display = 'none';
      patientTab.classList.add('active');
      doctorTab.classList.remove('active');
    } else {
      doctorForm.style.display = 'block';
      patientForm.style.display = 'none';
      doctorTab.classList.add('active');
      patientTab.classList.remove('active');
    }
  }
  
  function togglePassword(inputId) {
    const passwordField = document.getElementById(inputId);
    if (passwordField.type === 'password') {
      passwordField.type = 'text';
    } else {
      passwordField.type = 'password';
    }
  }