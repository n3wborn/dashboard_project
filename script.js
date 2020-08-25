// Elements  we will have to look for
const deleteLinks = document.getElementsByClassName('dellinks');
const noBtn = document.getElementById('modal_btn-no');
const yesBtn = document.getElementById('modal_btn-yes');
const modal = document.getElementById('modal');


// FUNCTIONS

// Used to toggle readyToDelete class
function removeReadyToDelete() {
	const elementsToDelete = document.getElementsByClassName('readyToDelete')
	for (elementToDelete of elementsToDelete) {
		elementToDelete.classList.toggle('readyToDelete')
	}
}


// Used to Show pictures and manual of our elements
function showFile(src, width, height, alt) {
	var img = document.createElement("img");
	img.src = src;
	img.width = width;
	img.height = height;
	img.alt = file;
}


// Delete links Modal

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


// PICTURES

// constants needed
const modalPic = document.getElementById('modal-pic');
const manLinks = document.getElementsByClassName('manLinks');
const picLinks = document.getElementsByClassName('picLinks');


// Keep an eye on manual links
// show a full width/height modal
// check size (and resize if needed keeping ratio)
// display the image in the modal
for (let manLink of manLinks) {
	manLink.addEventListener('click', function(e) {
		e.preventDefault();
		console.log(manLink);
		console.log(e);
	})
}

// Keep an eye on pictures links
// show a full width/height modal
// check size (and resize if needed keeping ratio)
// display the image in the modal
	for (let link of picLinks) {
	link.addEventListener('click', function(e) {
		e.preventDefault();

		// show modal
		modalPic.classList.toggle('hidden');

		// add img element in picDiv
		let picDiv = document.getElementById('modal-pic_div');
		let img = document.createElement('IMG');

		let xhr = new XMLHttpRequest();
		xhr.open("GET", link.href, true);
		console.log("href -> ", link.href);

		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status == "200") {
				res = xhr.responseText;
				img.setAttribute("id", "productImg")
				img.setAttribute("alt", "Picture");
				img.setAttribute("src", res);
				picDiv.appendChild(img);
				// show response type
				console.log(xhr.responseText);
			}
		}

		// send datas
		xhr.send();
	})
}


// When modalPic is visible, hide it if clicked
modalPic.addEventListener('click', function() {
	if (!modalPic.classList.contains('hidden')) {
		modalPic.classList.toggle('hidden');
	}

	// and remove image displayed
	let picDiv = document.getElementById('modal-pic_div');
	let img = document.getElementById("productImg");
	picDiv.removeChild(img);
})