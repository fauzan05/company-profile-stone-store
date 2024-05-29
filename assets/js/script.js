// Input Password
// Mendapatkan elemen input password dan tombol show password
const passwordInputs = document.getElementsByClassName('password-input');
const showPasswordButtons = document.getElementsByClassName('show-password-button');
if (passwordInputs && showPasswordButtons) {
    Array.from(showPasswordButtons).forEach((showPasswordButton, index) => {
        showPasswordButton.innerHTML = '<i class="fa-solid fa-eye-slash"></i>'
        showPasswordButton.addEventListener("click", () => {
            if (passwordInputs[index].type === 'password') {
                passwordInputs[index].type = 'text';
                showPasswordButton.innerHTML = '<i class="fa-solid fa-eye"></i>'
            } else {
                passwordInputs[index].type = 'password';
                showPasswordButton.innerHTML = '<i class="fa-solid fa-eye-slash"></i>'
            }
        })
    })
}