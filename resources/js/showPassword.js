let btnShowPassword = document.getElementById('btn-show-password')
let password = document.getElementById('password');
let passwordConfirmation = document.getElementById('password-confirmation');

btnShowPassword.onclick = togglePassword;

function togglePassword() {
    const isPassword = password.type === 'password';
    const isPasswordConfirmation = passwordConfirmation.type === 'password';
    password.type = isPassword ? 'text' : 'password';
    passwordConfirmation.type = isPasswordConfirmation ? 'text' : 'password';
}