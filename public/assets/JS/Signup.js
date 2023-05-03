const passwordInput = document.querySelector(
    '.input-info input[placeholder="Password"]'
);
const confirmPasswordInput = document.querySelector(
    '.input-info input[placeholder="Confirm Password"]'
);

// Get the password input and the show password icon elements
const showPasswordIcon = document.querySelector("#show-password i");

function togglePasswordVisibilityNew() {
    // Toggle the password input's type between password and text
    passwordInput.type = passwordInput.type === "password" ? "text" : "password";
    // Toggle the show password icon's class between 'fa-eye-slash' and 'fa-eye'
    showPasswordIcon.classList.toggle("uil-eye-slash");
    showPasswordIcon.classList.toggle("uil-eye");
}


// Get the password input and the show password icon elements
const showPasswordIcon2 = document.querySelector("#show-password2 i");

function togglePasswordVisibilityConfirm() {
    // Toggle the password input's type between password and text
    confirmPasswordInput.type =
        confirmPasswordInput.type === "password" ? "text" : "password";
    // Toggle the show password icon's class between 'fa-eye-slash' and 'fa-eye'
    showPasswordIcon2.classList.toggle("uil-eye-slash");
    showPasswordIcon2.classList.toggle("uil-eye");
}
// Add event listener to the show password icon
showPasswordIcon.addEventListener("click", togglePasswordVisibilityNew);
// Add event listener to the show password icon
showPasswordIcon2.addEventListener("click", togglePasswordVisibilityConfirm);
