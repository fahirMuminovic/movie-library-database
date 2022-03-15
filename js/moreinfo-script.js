// popup prozor ili modal za prikaz forme za izmjenu podataka
const openModalButton = document.getElementById("edit");
const closeModalButton = document.getElementById("close-modal-button");
const overlay = document.getElementById("overlay");

openModalButton.addEventListener('click', () => {
  const modal = document.getElementById("modal");
  openModal(modal, overlay);
})

closeModalButton.addEventListener('click', () => {
  const modal = closeModalButton.closest('.modal');
  closeModal(modal, overlay);
})


function openModal(modal, overlay) {

  if (modal == null) {
    return
  }

  modal.classList.add('active');
  overlay.classList.add('active');
}

function closeModal(modal, overlay) {

  if (modal == null) {
    return
  }

  modal.classList.remove('active');
  overlay.classList.remove('active');
}





// poruka uspjeha ako su podatci u bazi izmijenjeni
document.getElementById("update-submit").addEventListener("click", toggleSuccessMsg);

const moviename = document.getElementById('update-moviename');
const movieyear = document.getElementById('update-movieyear');
const director = document.getElementById('update-director');
const actors = document.getElementById('update-actors');
const imdblink = document.getElementById('update-imdblink');
const trailerlink = document.getElementById('update-trailerlink');
const descr = document.getElementById('update-descr');
const fileupload = document.getElementById('update-fileupload');


function toggleSuccessMsg() {
  if (moviename.value !== '' || movieyear.value !== '' || director.value !== '' || actors.value !== '' || imdblink.value !== '' || trailerlink.value !== '' || descr.value !== '' || fileupload.value !== '') {
    alert("PODATCI SU USPJEŠNO PROMIJENJENI");
  } else {
    alert("NISTE UNIJELI PODATKE ZA PROMJENU!!!");
  }

}

// poruka ako se obriše film u bazi
document.getElementById("delete-submit").addEventListener("click", toggleMsg);

function toggleMsg() {
  alert("FILM USPJEŠNO IZBRISAN IZ BAZE PODATAKA!!!");
}