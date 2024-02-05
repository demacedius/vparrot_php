<?php
    if(!empty($_POST)){

        if(isset($_POST["nom"], $_POST["commentaire"]) && !empty($_POST["nom"]) && !empty($_POST["commentaire"])){

            $nom = strip_tags($_POST["nom"]);
            $commentaires = htmlspecialchars($_POST["commentaire"]);
            $note = strip_tags($_POST["note"]);

            require_once("../includes/connect.php");

            $sql = "INSERT INTO `commentaire` (`nom`, `commentaire`, `note`) VALUES (:nom, :commentaire, :note )";

            $query=$db->prepare($sql);

            $query->bindValue(":nom", $nom, PDO::PARAM_STR);
            $query->bindValue(":commentaire", $commentaires, PDO::PARAM_STR);
            $query->bindValue("note", $note, PDO::PARAM_INT);

            if( !$query->execute() ){
                die("Une erreur c'est produite");
            }

            $id= $db->lastInsertId();
        }else{
            die("Le formulaire n'est pas complet") ;
        }
    }
?>

<form method="post" class="flex items-center flex-col">
    <div class="flex flex-col py-4 px-4">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" placeholder="Entrer votre nom">
    </div>

    <div class="flex flex-col py-4 px-4">
        <label for="commentaire">Commentaire</label>
        <textarea name="commentaire" id="commentaire" placeholder="Écrivez votre commentaire ici"></textarea>
    </div>

    <div class="py-4 px-4 ">
        <label for="note" class="text-sm font-medium leading-6 text-gray-900">Note</label>
        <select name="note" id="note"  class=" rounded-md border-0 py-1.5 text-[#000000] shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" >
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>

        </select>
    </div>
    <button class="bg-cta text-secondary font-bold font-primary p-2 rounded-full" type="submit">Enregistrez</button>
</form>