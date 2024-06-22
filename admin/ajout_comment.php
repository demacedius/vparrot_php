<?php
    if(isset($_POST["comment"])){

        if(isset($_POST["nom"], $_POST["commentaire"]) && !empty($_POST["nom"]) && !empty($_POST["commentaire"])){

            $nom = strip_tags($_POST["nom"]);
            $commentaires = htmlspecialchars($_POST["commentaire"]);
            $note = strip_tags($_POST["note"]);

           require("includes/connect.php");

            $sql = "INSERT INTO `commentaire` (`nom`, `commentaire`, `note`) VALUES (:nom, :commentaire, :note )";

            $query=$dbh->prepare($sql);

            $query->bindValue(":nom", $nom, PDO::PARAM_STR);
            $query->bindValue(":commentaire", $commentaires, PDO::PARAM_STR);
            $query->bindValue(":note", $note, PDO::PARAM_INT);

            if( !$query->execute() ){
                die("Une erreur c'est produite");
            }

            $id= $dbh->lastInsertId();
         
        }else{
            die("le formulaire est incomplet");
        }
    }
?>

<form method="post" class="flex items-start flex-col" id="myForm">
    <div class="flex flex-col items-center p-8 gap-4">

        <div class="flex flex-col ">
            <label for="nom">Nom:</label>
            <input class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="nom" id="nom" placeholder="Entrer votre nom">
        </div>
    
        <div class="flex flex-col ">
            <label for="commentaire" >Commentaire</label>
            <textarea class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="commentaire" id="commentaire" placeholder="Écrivez votre commentaire ici"></textarea>
        </div>
    
        <div class="">
            <label for="note" class="text-sm font-medium leading-6 text-secondary">Note</label>
            <select name="note" id="note"  class=" w-fit rounded-md border-0 py-1.5 text-[#000000] shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" >
                <option class="" value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <button class="bg-cta hover:bg-ctaHover duration-500 ease-in-out text-secondary font-bold w-full font-primary p-2 rounded-full" name="comment" type="submit">Enregistrez</button>
    </div>
</form>


