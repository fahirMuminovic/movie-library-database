const fullname = document.getElementById('name');
const username = document.getElementById('user_name');
const email = document.getElementById('email');
const password = document.getElementById('password');
const passwordRepeat = document.getElementById('password_repeat');

fullname.addEventListener("blur", checkFullName);

function checkFullName() {

    const fullnameValue = fullname.value.trim();
    if (empty(fullnameValue)) {
        setErrorFor(fullname, 'molimo unesite ime i prezime');

    } else {
        setSuccessFor(fullname);
    }
}


username.addEventListener("blur", checkUsername);

function checkUsername() {

    const usernameValue = username.value.trim();

    if (empty(usernameValue)) {
        setErrorFor(username, 'molimo unesite korisničko ime');

    } else {
        setSuccessFor(username);
    }
}


email.addEventListener("blur", () => {
    checkEmail();
    validateEmail();
});

function checkEmail() {
    const emailValue = email.value.trim();

    if (empty(emailValue)) {
        setErrorFor(email, 'molimo unesite e-mail');

    } else {
        
        if (validateEmail() === false) {
            setErrorFor(email, 'molimo unesite validnu e-mail adresu');
        }else if (validateEmail() === true) {
            setSuccessFor(email);
        }
    }
}

function validateEmail() {

    const emailValue = email.value.trim();

    if (emailValue.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        // setSuccessFor(email);
        return true;
    } else {
        // setErrorFor(email, 'molimo unesite validnu e-mail adresu');
        return false;
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
    } else {
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

    if (empty(passwordValue) === true && empty(passwordRepeatValue) === false) {
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