<?php
session_start();
require_once ("includes/connect.php");
require_once ("classe/messageUtilistateur.php");

if (isset($_POST["subMessage"])) {
    // Vérification des champs
    $requiredFields = ["nom", "prenom", "email", "numero_telephone", "message", "voiture_id"];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            die("Le champ $field est requis");
        }
    }

    // Récupération des données du formulaire
    $nom = strip_tags($_POST["nom"]);
    $prenom = strip_tags($_POST["prenom"]);
    $email = strip_tags($_POST["email"]);
    $telephone = strip_tags($_POST["numero_telephone"]);
    $message = htmlspecialchars($_POST["message"]);
    $voiture_id = $_POST["voiture_id"];



    // Création d'une instance de la classe MessageUtilisateur
    $messageUtilisateur = new MessageUtilisateur($db);

    $result = $messageUtilisateur->insertMessage($nom, $prenom, $email, $telephone, $message, $voiture_id);

    // Vérification du résultat de l'insertion
    // Exécute la requête SQL
    if ($result === true) {
        echo "<script>alert('Message enregistré avec succès');</script>";

    } else {
        echo "<script>alert('Erreur lors de l\\'enregistrement du message');</script>";

    }

}
?>

<section>
    <form method="POST">
        <div class="flex flex-col items-left p-8 gap-4 max-w-[1024px] mx-auto">
            <input type="hidden" name="voiture_id" value="<?php echo $annonce_id; ?>">
            <div class="flex flex-col ">
                <label for="nom">Nom:</label>
                <input
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" name="nom" id="nom" placeholder="Entrer votre nom">
            </div>
            <div class="flex flex-col ">
                <label for="prenom">Prénom:</label>
                <input
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" name="prenom" id="prenom" placeholder="Entrer votre prénom">
            </div>
            <div class="flex flex-col ">
                <label for="email">email:</label>
                <input
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" name="email" id="email" placeholder="Entrer votre adresse mail" required
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
            </div>
            <div class="flex flex-col ">
                <label for="telephone">téléphone:</label>
                <input
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" name="numero_telephone" id="telephone" placeholder="Entrer votre numéro de téléphone"
                    required pattern="[0-9]+" maxlength="10">
            </div>
            <div class="flex flex-col ">
                <label for="commentaire">Commentaire</label>
                <textarea
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="message" id="commentaire" placeholder="Écrivez votre commentaire ici"></textarea>
            </div>
            <button
                class="bg-cta hover:bg-ctaHover duration-500 ease-in-out text-secondary font-bold w-full font-primary p-2 rounded-full"
                type="submit" name="subMessage">Enregistrer</button>
        </div>
    </form>
</section>