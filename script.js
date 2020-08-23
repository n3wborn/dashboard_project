// Elements  we will have to look for
const deleteLinks = document.getElementsByClassName('dellinks');
const noBtn = document.getElementById('modal-btn-no');
const yesBtn = document.getElementById('modal-btn-yes');
const modal = document.getElementById('modal');

// functions needed
function removeReadyToDelete() {
	const elementsToDelete = document.getElementsByClassName('readyToDelete')
	for (elementToDelete of elementsToDelete) {
		elementToDelete.classList.toggle('readyToDelete')
	}
}


// Keep an eye on delete links
// if click, show modal and permit element deletion
for (deleteLink of deleteLinks) {
	deleteLink.addEventListener('click', function(e){
		e.preventDefault();

		modal.classList.toggle('hidden');
		this.classList.toggle('readyToDelete');
	})
}


// When element are ready to  be deleted
// Avoid element deletion if clicked on noBtn
noBtn.addEventListener('click', function() {
	modal.classList.toggle('hidden');

	// and remove class permitting deletion
	removeReadyToDelete();
})


// When element are ready to  be deleted
// Act as noBtn
modal.addEventListener('click', function() {
	if (!modal.classList.contains('hidden')) {
		modal.classList.toggle('hidden');
		removeReadyToDelete();
	}
})


// When element are ready to  be deleted
// Confirm deletion if clicked on modal yesBtn
yesBtn.addEventListener('click', function() {
	const elementsToDelete = document.getElementsByClassName('readyToDelete')

	for (elementToDelete of elementsToDelete) {
		location.href = elementToDelete.getAttribute('href');
	}
})

