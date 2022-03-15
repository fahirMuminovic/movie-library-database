// popup prozor ili modal za prikaz forme za brisanje podataka
const openDeleteModalButton = document.getElementById("delete");
const closeDeleteModalButton = document.getElementById("close-delete-modal-button");
const closeDeleteModalButton2 = document.getElementById("close-delete-modal-button2");

openDeleteModalButton.addEventListener('click', () => {
  const deleteModal = document.getElementById("delete-modal");
  openModal(deleteModal);
})

closeDeleteModalButton.addEventListener('click', () => {
  const deleteModal = closeDeleteModalButton.closest('.modal');
  closeModal(deleteModal);
})



closeDeleteModalButton2.addEventListener('click', (e) => {
  e.preventDefault();
  const deleteModal = closeDeleteModalButton.closest('.modal');
  closeModal(deleteModal);
})


function openModal(deleteModal) {

  if (deleteModal == null) {
    return
  }
  const overlay = document.getElementById("overlay");

  deleteModal.classList.add('active');
  overlay.classList.add('active');
}

function closeModal(deleteModal) {

  if (deleteModal == null) {
    return
  }
  const overlay = document.getElementById("overlay");

  deleteModal.classList.remove('active');
  overlay.classList.remove('active');
}

