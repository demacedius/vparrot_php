document.getElementById('myForm').addEventListener('submit',function(event){

	const nomInput = document.getElementById('nom');
	const commentaireInput = document.getElementById('commentaire');

	const validRegex = /^[a-zA-Z0-9'" ]*$/;

	if(!validRegex.text(nomInput.value) || validRegex.test(commentaireInput.value)){
		alert('seul les caractère alphanumérique, les apostrophes, et les guillemets simple ou double sont autorisés');
		event.preventDefault();
		return false;
	}

	return true;

});