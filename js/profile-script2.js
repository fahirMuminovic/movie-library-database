const file = document.getElementById('upload-profile-pic-button');
const date = document.getElementById('dob');
const textArea = document.getElementById('about');

file.addEventListener("blur", checkFileUpload);

function checkFileUpload() {

    const fileValue = file.value.trim();


    if (empty(fileValue)) {
        document.getElementById('profile-pic').style.border = "3px solid #e74c3c";
        document.getElementById('upload-profile-pic-button').style.color = "#e74c3c";
    } else {
        document.getElementById('profile-pic').style.border = "3px solid #02c39a";
        document.getElementById('upload-profile-pic-button').style.color = "#02c39a";
    }
}

date.addEventListener("blur", checkDate);

function checkDate(){

    const dateValue = date.value.trim();

    if(empty(dateValue)){
        document.getElementById("small-error-date").style.visibility = "visible";
        document.getElementById("dob").style.border = "3px solid #e74c3c";
    }else{
        document.getElementById("small-error-date").style.visibility = "hidden";
        document.getElementById("dob").style.border = "3px solid #02c39a";
    }
}


textArea.addEventListener("blur", checktextArea);

function checktextArea(){

    const textAreaValue = textArea.value.trim();

    if(empty(textAreaValue)){
       document.getElementById("small-error-textarea").style.visibility = "visible";
       document.getElementById('about').style.border = "3px solid #e74c3c";
    }else{
        document.getElementById("small-error-textarea").style.visibility = "hidden";
        document.getElementById('about').style.border = "3px solid #02c39a";
    }
}

const targetContainer = document.getElementById("target1");
const targetContainer2 = document.getElementById("target2");
const targetContainer3 = document.getElementById("showAdminRequestsContainer");
const showAdminRequestForm = document.getElementById("showAdminRequestForm");
const showUserInfo = document.getElementById("showUserInfo");
const showAdminRequests = document.getElementById("showAdminRequests");

const showAdminRequestFormValue = showAdminRequestForm.value;
const showUserInfoValue = showUserInfo.value;
const showAdminRequestsValue = showAdminRequests.value;

if (showAdminRequestFormValue == 1) {
    targetContainer.className = 'profile-container-4 active';
}else if (showAdminRequestFormValue == 0) {
    targetContainer.className = 'profile-container-4';
}

if (showUserInfoValue == 1) {
    targetContainer2.className = 'profile-container-2 active';
}else if (showUserInfoValue == 0) {
    targetContainer2.className = 'profile-container-2';
}

if (showAdminRequestsValue == 1) {
    targetContainer3.className = 'container-3 active';
}else if (showAdminRequestsValue == 0) {
    targetContainer3.className = 'container-3';
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