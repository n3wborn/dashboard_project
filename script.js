// select needed elements
const deleteLinks = document.getElementsByClassName('dellinks');
const noBtn = document.getElementById('modal-btn-no');
const yesBtn = document.getElementById('modal-btn-yes');


// For each delete links
for (deleteLink of deleteLinks) {
	// toogle hidden and readyToDelete classes
	deleteLink.addEventListener('click', function(e){
		e.preventDefault();
		const modal = document.getElementById('modal');
		modal.classList.toggle('hidden');

		this.classList.toggle('readyToDelete');
	})
}


// Do not confirm deletion if clicked on modal noBtn
noBtn.addEventListener('click', function() {
		const modal = document.getElementById('modal');
		modal.classList.toggle('hidden');
		const elementsToDelete = document.getElementsByClassName('readyToDelete')

		for (elementToDelete of elementsToDelete) {
			elementToDelete.classList.toggle('readyToDelete')
		}
})


// Confirm deletion if clicked on modal yesBtn
yesBtn.addEventListener('click', function() {
	const elementsToDelete = document.getElementsByClassName('readyToDelete')

	for (elementToDelete of elementsToDelete) {
		location.href = elementToDelete.getAttribute('href');
	}
})

