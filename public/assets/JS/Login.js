
const passwordInputField = document.querySelector(
    '.input-info input[type="password"]'
);
const showPasswordIcon = document.querySelector("#show-password i");
//allowing to see the password field
function togglePasswordVisibility() {
    // Toggle the password input's type between password and text
    passwordInputField.type =
        passwordInputField.type === "password" ? "text" : "password";
    // Toggle the show password icon's class between 'fa-eye-slash' and 'fa-eye'
    showPasswordIcon.classList.toggle("uil-eye-slash");
    showPasswordIcon.classList.toggle("uil-eye");
}

showPasswordIcon.addEventListener("click", togglePasswordVisibility);
