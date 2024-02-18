<?php
include_once("includes/connect.php");

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
    <form method="POST" enctype="multipart/form-data">
        <label for="nom">Nom de la voiture :</label>
        <input type="text" name="nom" id="nom" required><br>

        <label for="description">description technique</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>

        <label for="prix">Prix :</label>
        <input type="text" name="prix" id="prix" required><br>

        <label for="kilometrage">Kilométrage :</label>
        <input type="text" name="kilometrage" id="kilometrage" required><br>

        <label for="annee">Année de mise en circulation :</label>
        <input type="text" name="annee" id="annee" required><br>

        <label for="image">Image mise en avant :</label>
        <input type="file" name="image" id="image" accept="image/*" required><br>

        <input type="submit" name="sub" value="Envoyer">
    </form>
</div>