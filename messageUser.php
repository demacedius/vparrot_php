<?php
session_start();
require_once("includes/connect.php");
if (isset($_POST["subMessage"])) {
    if (
        isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["numero_telephone"], $_POST["message"], $_POST["voiture_id"]) &&
        !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) &&
        !empty($_POST["numero_telephone"]) && !empty($_POST["message"]) && !empty($_POST["voiture_id"])
    ) {

        $email = strip_tags($_POST["email"]);
        $message = htmlspecialchars($_POST["message"]);
        $nom = strip_tags($_POST["nom"]);
        $prenom = strip_tags($_POST["prenom"]);
        $telephone = strip_tags($_POST["numero_telephone"]);
        $voiture_id = $_POST["voiture_id"];

        $sql = "INSERT INTO messageUtilisateur (`nom`, `prenom`, `email`, `numero_telephone`, `message`, `voiture_id`) 
                VALUES (:nom, :prenom, :email, :numero_telephone, :message, :voiture_id)";

        echo "Email: " . $email . "<br>";
        echo "Message: " . $message . "<br>";
        echo "Nom: " . $nom . "<br>";
        echo "Prénom: " . $prenom . "<br>";
        echo "Téléphone: " . $telephone . "<br>";
        echo "Voiture ID: " . $voiture_id . "<br>";


        $query = $db->prepare($sql);

        $query->bindValue(":email", $email, PDO::PARAM_STR);
        $query->bindValue(":message", $message, PDO::PARAM_STR);
        $query->bindValue(":nom", $nom, PDO::PARAM_STR);
        $query->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $query->bindValue(":numero_telephone", $telephone, PDO::PARAM_STR);
        $query->bindValue(":voiture_id", $voiture_id, PDO::PARAM_INT);

        if (!$query->execute()) {
            die("Erreur d'exécution de la requête : " . print_r($query->errorInfo(), true));
        }

        $id = $db->lastInsertId();
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
                    type="text" name="email" id="email" placeholder="Entrer votre adresse mail">
            </div>
            <div class="flex flex-col ">
                <label for="telephone">téléphone:</label>
                <input
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" name="numero_telephone" id="telephone" placeholder="Entrer votre numéro de téléhone">
            </div>
            <div class="flex flex-col ">
                <label for="commentaire">Commentaire</label>
                <textarea
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="message" id="commentaire" placeholder="Écrivez votre commentaire ici"></textarea>
            </div>
            <button
                class="bg-cta hover:bg-ctaHover duration-500 ease-in-out text-secondary font-bold w-full font-primary p-2 rounded-full"
                type="submit" name="subMessage">Enregistrez</button>
        </div>
    </form>
</section>