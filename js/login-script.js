const username = document.getElementById('user_name');
const password = document.getElementById('password');




username.addEventListener("blur", checkUsername);

function checkUsername() {

    const usernameValue = username.value.trim();
   
    if (empty(usernameValue)) {

        setErrorFor(username, 'Molimo unesite korisničko ime');
       
    } else {
        setSuccessFor(username);
    }

}


password.addEventListener("blur", checkPassword);

function checkPassword() {

    const passwordValue = password.value.trim();
   
    if (empty(passwordValue)) {

        setErrorFor(password, 'Molimo unesite vašu šifru');
       
    } else {
        setSuccessFor(password);
    }

}


function empty(value) {
    if (value === '') {
        return true;
    } else return false;
}

function setErrorFor(input, message) {
    const inputControl = input.parentElement;
    const small = inputControl.querySelector('small');
    inputControl.className = 'input-control error';
    small.innerText = message;
    return false;
}

function setSuccessFor(input) {
    const inputControl = input.parentElement;
    inputControl.className = 'input-control success';
    return true;

}

