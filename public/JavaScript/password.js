
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('toggle-password').addEventListener('click', function (e) {
        const passwordField = document.getElementById('password-field');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
});
