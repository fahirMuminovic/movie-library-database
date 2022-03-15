// PROVJERA FORME ZA MIJENJANJE ŠIFRE
const password = document.getElementById('new_pass');
const passwordRepeat = document.getElementById('new_pass_repeat');



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

// PROVJERA FORME ZA BRISANJE RACUNA
const userAcc = document.getElementById('user-acc');
const userPass = document.getElementById('user-pass');
const deleteAccBtn = document.getElementById('acc-delete-submit-btn');

userAcc.addEventListener("blur", checkUserAcc);


function checkUserAcc() {

    const userAccValue = userAcc.value.trim();


    if (empty(userAccValue)) {
        setErrorFor(userAcc, 'molimo unesite vaše korisničko ime ili email');

    } else {
        setSuccessFor(userAcc);
    }


}

userPass.addEventListener("blur", checkUserPass);

function checkUserPass() {

    const userPassValue = userPass.value.trim();


    if (empty(userPassValue)) {
        setErrorFor(userPass, 'molimo unesite vašu šifru');

    } else {
        setSuccessFor(userPass);
    }


}

const userAccValue = userAcc.value.trim();
const userPassValue = userPass.value.trim();

if (empty(userAccValue) !== true && empty(userPassValue) !== true) {
    deleteAccBtn.addEventListener("click", (e) => {
        const text = "Jeste li sigurni da želite obrisati svoj račun";
        if (confirm(text) == false) {
            e.preventDefault();
        }
    });
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