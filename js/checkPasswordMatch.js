function checkPasswordMatch() {
    var password = document.getElementById('password');
    var confirmPassword = document.getElementById('confirmPassword');
    var alert = document.getElementById('passwordMatchAlert')

    if (password.value == confirmPassword.value) {
        alert.style.color = '#00ff00';
        alert.textContent = 'passwords match';
    } else {
        alert.style.color = '#ff0000';
        alert.textContent = 'passwords do not match';
    }
}