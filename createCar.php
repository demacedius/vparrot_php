<?php
require("includes/connect.php");

if (isset($_POST["sub"])) {
    $prix = $_POST["prix"];
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $kilometrage = $_POST["kilometrage"];
    $annee = $_POST["annee"];

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $dossier = 'uploads/';
        $temp_name = $_FILES['image']['tmp_name'];
        if (!is_uploaded_file($temp_name)) {
            exit('le fichier est introuvable');
        }
        if ($_FILES['image']['size'] >= 2000000) {
            exit("Erreur: le fichier est trop volumineux");
        }

        $infofichier = pathinfo($_FILES['image']['name']);
        $extension_upload = $infofichier['extension'];

        $extension_upload = strtolower($extension_upload);
        $extension_autorisee = array('png', 'jpg', 'jpeg');
        if (!in_array($extension_upload, $extension_autorisee)) {
            exit(`Veuillez inserer une image s'il vous plait`);
        }
        $nom_photo = $nom . "." . $extension_upload;

        if (!move_uploaded_file($temp_name, $dossier . $nom_photo)) {
            $error_message = ("Probleme dans le téléchargement de l'image réessayez");
            if ($error = error_get_last()) {
                $error_message .= " Détails de l'erreur : " . print_r($error, true);
            }
            exit($error_message);
        }

        $ph_name = $nom_photo;

        $sql = "INSERT INTO `voiture` (`prix`,`kilometrage`,`annee`,`image`,`nom`,`description`) VALUES ('$prix','$kilometrage','$annee','$ph_name','$nom', '$description')";
        $query = $db->prepare($sql);
        $query->execute();
        $id = $db->lastInsertId();

        header('location: index.php');

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