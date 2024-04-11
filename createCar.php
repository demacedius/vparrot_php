<?php
session_start();
require_once("includes/database.php");
require_once("classe/voiture_manager.php");
require_once("classe/template.php");

$dbInstance = new Database();
$db = $dbInstance->getConnection();

$voitureManager = new VoitureManager($db);

if (isset($_POST["sub"])) {
    $prix = $_POST["prix"];
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $kilometrage = $_POST["kilometrage"];
    $annee = $_POST["annee"];

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Traitement de l'image
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $image = basename($_FILES['image']['name']);

            // Ajout de la voiture
            $voitureManager->addVoiture($prix, $nom, $description, $kilometrage, $annee, $image);

            echo "Voiture ajoutée avec succès";

            header('location: index.php');
            exit();
        } else {
            echo "Erreur lors de l'upload du fichier";
        }
    }
}

?>

<div>

    <h2>Ajouter une annonce de voiture d'occasion</h2>
    <form method="POST" enctype="multipart/form-data"
        class="flex flex-col items-left border-2 rounded-lg p-8 text-primary">
        <div class="flex flex-col py-2">

            <label class="text-secondary text-lg font-secondary font-bold" for="name">Nom de la voiture :</label>
            <input type="text" name="nom" id="name" required class="md:rounded-lg"><br>
        </div>
        <div class="flex flex-col py-2">

            <label class="text-secondary text-lg font-secondary font-bold" for="description">description
                technique</label>
            <textarea name="description" id="description" cols="30" rows="10" class="md:rounded-lg"></textarea>
        </div>
        <div class="flex flex-col py-2">

            <label class="text-secondary text-lg font-secondary font-bold" for="prix">Prix :</label>
            <input type="text" name="prix" id="prix" required class="md:rounded-lg"><br>
        </div>

        <div class="flex flex-col py-2">

            <label class="text-secondary text-lg font-secondary font-bold" for="kilometrage">Kilométrage :</label>
            <input type="text" name="kilometrage" id="kilometrage" required class="md:rounded-lg"><br>
        </div>
        <div class="flex flex-col py-2">

            <label class="text-secondary text-lg font-secondary font-bold" for="annee">Année de mise en circulation
                :</label>
            <input type="text" name="annee" id="annee" required class="md:rounded-lg"><br>
        </div>
        <div class="flex flex-col py-2">

            <label class="block mb-2 text-sm font-medium text-secondary dark:text-white" for="image">Image mise en avant :</label>
            <input type="file" name="image" id="image" accept="image/*" required class="block w-full text-md text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-500 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 md:rounded-lg"> photo de couverture<br>
        </div>

        <button type="submit" name="sub"
            class="bg-cta hover:bg-ctaHover duration-500 ease-in-out text-secondary font-bold w-full font-primary p-2 rounded-full">Confirmer</button>
    </form>
</div>


