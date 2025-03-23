document.addEventListener("DOMContentLoaded", function () {


    // Configuring validation of emailInput
    const emailInput = document.getElementById('emailInput');
    const emailIcon = document.getElementById('emailIcon');
    const emailError = document.getElementById('emailError');
  
    emailInput.addEventListener('input', function () {
  
      const error = getEmailError(emailInput);
  
      if (error === '') {
        emailIcon.classList.remove('invalid');
        emailIcon.classList.add('valid');
        emailIcon.innerHTML = '<i class="fas fa-check-circle"></i>';
        emailError.classList.add('d-none');
        emailError.classList.remove('d-block');
      } else {
        emailIcon.classList.remove('valid');
        emailIcon.classList.add('invalid');
        emailIcon.innerHTML = '<i class="fas fa-times-circle"></i>';
        emailError.innerText = error;
        emailError.classList.remove('d-none');
        emailError.classList.add('d-block');
      }
    });
  
  
    // Configuring validation of passwordInput
    const passwordInput = document.getElementById('passwordInput');
    const passwordIcon = document.getElementById('passwordIcon');
    const passwordError = document.getElementById('passwordError');
  
    passwordInput.addEventListener('input', function () {
      
      const error = getPasswordError(passwordInput);
  
      if (error === '') {
        passwordIcon.classList.remove('invalid');
        passwordIcon.classList.add('valid');
        passwordIcon.innerHTML = '<i class="fas fa-check-circle"></i>';
        passwordError.classList.add('d-none');
        passwordError.classList.remove('d-block');
      } else {
        passwordIcon.classList.remove('valid');
        passwordIcon.classList.add('invalid');
        passwordIcon.innerHTML = '<i class="fas fa-times-circle"></i>';
        passwordError.innerText = error;
        passwordError.classList.remove('d-none');
        passwordError.classList.add('d-block');
      }
    });
  
    
  
    // Configuring the password view
    const togglePassword = document.getElementById('togglePassword');
  
    togglePassword.addEventListener('mousedown', function () {
      passwordInput.type = 'text';
    });
  
    togglePassword.addEventListener('mouseup', function () {
      passwordInput.type = 'password';
    });
  
    togglePassword.addEventListener('mouseleave', function () {
      passwordInput.type = 'password';
    });
  
    
});
    
  
  
  
// Optional functions for first name and surname
function isFirstLetterUppercase(str) {
    return str.charAt(0) === str.charAt(0).toUpperCase();
}
  
function validName(name) {
    const nameRegex = /^[A-Za-z\s\-']{2,}$/;
    return nameRegex.test(name);
}
  
function getNameError(nameInput) {
    const value = nameInput.value.trim();
  
    if (value.length === 0) return 'Name is required';
    if (value.length < 2) return 'Name must be at least 2 characters';
    if (!isFirstLetterUppercase(value)) return 'Name must start with a capital letter';
    if (!validName(value)) return 'Name can only contain letters, spaces, hyphens and apostrophes';
    return '';
}
  
  
  
// Optional functions for email
function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/;
    return emailPattern.test(email);
}
  
function getEmailError(emailInput) {
    const value = emailInput.value.trim();
  
    if (value.length === 0) return 'Email is required';
    if (!value.includes('@')) return 'Email must contain "@"';
    if (!value.includes('.')) return 'Email must contain "." after "@"';
    if (!validateEmail(value)) return 'Email format is invalid';
  
    return '';
}
  
  
  
  
// Optional functions for password
function hasUppercase(str) {
    return /[A-Z]/.test(str);
}
  
function hasLowercase(str) {
    return /[a-z]/.test(str);
}
  
function hasDigit(str) {
    return /[0-9]/.test(str);
}
  
function hasSpecialChar(str) {
    return /[!@#$%^&*()_\-+=~`[\]{};:'",.<>/?\\|]/.test(str);
}
  
function getPasswordError(passwordInput) {
    const value = passwordInput.value.trim();
  
    if (value.length === 0) return 'Password is required';
    if (value.length < 8) return 'Password must be at least 8 characters';
    if (!hasUppercase(value)) return 'Must include at least one uppercase letter';
    if (!hasLowercase(value)) return 'Must include at least one lowercase letter';
    if (!hasDigit(value)) return 'Must include at least one digit';
    if (!hasSpecialChar(value)) return 'Must include at least one special character';
  
    return '';
}
  
function getRepeatPasswordError(passwordInput, repeatPasswordInput) {
    const pass = passwordInput.value.trim();
    const repeat = repeatPasswordInput.value.trim();
  
    if (repeat.length === 0) return 'Please repeat your password';
    if (repeat !== pass) return 'Passwords do not match';
  
    return '';
}
