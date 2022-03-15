const moviename = document.getElementById('moviename');
const movieyear = document.getElementById('movieyear');
const director = document.getElementById('director');
const actors = document.getElementById('actors');
const imdblink = document.getElementById('imdblink');
const trailerlink = document.getElementById('trailerlink');
const descr = document.getElementById('descr');
const fileupload = document.getElementById('fileupload');


moviename.addEventListener("blur", checkMovieName);


function checkMovieName() {

    const movienameValue = moviename.value.trim();
    if (empty(movienameValue)) {
        setErrorFor(moviename, 'molimo unesite ime filma');

    } else {
        setSuccessFor(moviename);
    }
}


movieyear.addEventListener("blur", checkYear);

function checkYear() {

    const movieyearValue = movieyear.value.trim();

    if (empty(movieyearValue)) {
        setErrorFor(movieyear, 'molimo unesite godinu izdavanja filma');

    } else {
        setSuccessFor(movieyear);
    }
}


director.addEventListener("blur", checkDirector);

function checkDirector() {

    const directorValue = director.value.trim();


    if (empty(directorValue)) {
        setErrorFor(director, 'molimo unesite režisera');

    } else {
        setSuccessFor(director);
    }


}

actors.addEventListener("blur", checkActors);

function checkActors() {

    const actorsValue = actors.value.trim();


    if (empty(actorsValue)) {
        setErrorFor(actors, 'molimo unesite glumce');

    } else {
        setSuccessFor(actors);
    }


}

imdblink.addEventListener("blur", checkImdbLink);

function checkImdbLink() {

    const imdblinkValue = imdblink.value.trim();


    if (empty(imdblinkValue)) {
        setErrorFor(imdblink, 'molimo unesite link za IMDB stranicu Filma');

    } else {
        setSuccessFor(imdblink);
    }


}

trailerlink.addEventListener("blur", checkTrailerLink);

function checkTrailerLink() {

    const trailerlinkValue = trailerlink.value.trim();


    if (empty(trailerlinkValue)) {
        setErrorFor(trailerlink, 'molimo unesite link za trailer Filma');

    } else {
        setSuccessFor(trailerlink);
    }


}

descr.addEventListener("blur", checkDescr);

function checkDescr() {

    const descrValue = descr.value.trim();


    if (empty(descrValue)) {
        setErrorFor(descr, 'molimo unesite kratki opis Filma');

    } else {
        setSuccessFor(descr);
    }


}

fileupload.addEventListener("change", checkFileUpload);

function checkFileUpload() {

    const fileuploadValue = fileupload.value.trim();


    if (empty(fileuploadValue)) {
        document.getElementById('poster-prompt').style.color = "#e74c3c";

    } else {
        document.getElementById('poster-prompt').style.color = "#02c39a";
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
