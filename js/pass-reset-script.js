const username = document.getElementById('user_name');
const password = document.getElementById('new_pass');
const passwordRepeat = document.getElementById('new_pass_repeat');


username.addEventListener("blur", checkUsername);

function checkUsername() {

    const usernameValue = username.value.trim();

    if (empty(usernameValue)) {
        setErrorFor(username, 'molimo unesite korisničko ime');

    } else {
        setSuccessFor(username);
    }
}

password.addEventListener("blur", checkPassword);

function checkPassword() {

    const passwordValue = password.value.trim();


    if (empty(passwordValue)) {
        setErrorFor(password, 'molimo unesite šifru');

    } else {
        setSuccessFor(password);
    }


}

passwordRepeat.addEventListener("blur", () => {
    checkPasswordRepeat();
    checkPasswordMatch();
    checkInputOrder();
});

function checkPasswordRepeat() {

    const passwordRepeatValue = passwordRepeat.value.trim();

    if (empty(passwordRepeatValue)) {
        setErrorFor(passwordRepeat, 'molimo ponovite šifru');
    }
    else {
        setSuccessFor(passwordRepeat);
    }
    
}

function checkPasswordMatch() {

    const passwordValue = password.value.trim();
    const passwordRepeatValue = passwordRepeat.value.trim();

    if (empty(passwordValue) === false && empty(passwordRepeatValue) === false && passwordValue !== passwordRepeatValue) {
        setErrorFor(passwordRepeat, 'unesene šifre nisu iste');
    }
}

function checkInputOrder() {

    const passwordValue = password.value.trim();
    const passwordRepeatValue = passwordRepeat.value.trim();

    if(empty(passwordValue) === true && empty(passwordRepeatValue) === false ){
        setErrorFor(passwordRepeat, 'prvo popunite polje iznad');
        passwordRepeat.value = '';
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