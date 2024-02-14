<?php

if (!empty($_POST)) {
    if (isset($_POST["email"], $_POST["password"]) && !empty($_POST["password"]) && !empty($_POST["password"])) {
        $email = strip_tags($_POST["email"]);
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            die("l'adres emai lest incorect");
        }

        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        require_once("includes/connect.php");

        $sql = "INSERT INTO `users`(`email`,`password`) VALUES (:email, '$password')";
        
        $query = $db->prepare($sql);
        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
        try {
            $query->execute();
            
        } catch (PDOException $e) {
            die("Erreur d'insertion utilisateur : " . $e->getMessage());
        }
        
        $id = $db->lastInsertId();

    }else{
        die("le formulaire est incomplet");
    }
}


include_once("includes/header.php");


?>

<body class="bg-primary text-secondary">
    <?php
    include_once("includes/nav.php")
        ?>

    <h1>bienvenue sur votre tableau de bord</h1>
    <main class="flex flex-col items-center justify-between">
        <form method="post" class="flex flex-col items-center gap-8 border-2 rounded-lg p-8">
            <div class="flex flex-col py-2">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="text-primary px-4 py-2 rounded-lg ">
            </div>
            <div class="flex flex-col py-2">
                <label for="password">Mot de Passe</label>
                <input type="password" name="password" id="password" class="text-primary px-4 py-2 rounded-lg ">
            </div>
            <button type="submit"
                class="bg-cta hover:bg-ctaHover duration-500 ease-in-out text-secondary font-bold w-full font-primary p-2 rounded-full">Confirmer</button>
        </form>
    </main>
</body>