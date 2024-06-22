document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('myForm').addEventListener('submit', function(event) {
        const nomInput = document.getElementById('nom');
        const commentaireInput = document.getElementById('commentaire');

        // Regex to allow only alphanumeric characters, apostrophes, and double quotes
        const validRegex = /^[a-zA-Z0-9'" ]*$/;

        if (!validRegex.test(nomInput.value) || !validRegex.test(commentaireInput.value)) {
            alert('Seuls les caractères alphanumériques, les apostrophes et les guillemets simples ou doubles sont autorisés.');
            event.preventDefault();
            return false;
        }

        return true;
    });
});
