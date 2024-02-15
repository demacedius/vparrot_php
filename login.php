<?php
     session_start();

if (!empty($_POST)) {
    if (isset($_POST["email"], $_POST["password"]) && !empty($_POST["password"]) && !empty($_POST["password"])) {
        $email = strip_tags($_POST["email"]);
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("l'adresse email est incorect");
        }

        require_once("includes/connect.php");

        $sql = "SELECT * FROM `users` WHERE `email` = :email";

        $query = $db->prepare($sql);
        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

        $query->execute();

        $user = $query->fetch();

        if (!$user) {
            die("L'utilisateur et/ou le mot de passe sont incorrect");
        }

        if (!password_verify($_POST["password"], $user["password"])) {
            die("L'utilisateur et/ou le mot de passe sont incorrect");
        }

   
        $_SESSION["user"] = ["id" => $user["id"], "email" => $user["email"]];

        header("location: dashboard.php");
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
                class="bg-cta hover:bg-ctaHover duration-500 ease-in-out text-secondary font-bold w-full font-primary p-2 rounded-full">Ce
                connecter</button>
        </form>
    </main>

    <?php
    include_once("includes/footer.php")
    ?>
</body>