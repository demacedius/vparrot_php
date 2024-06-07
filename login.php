<?php

include_once("includes/header.php");
include_once("classe/autentification.php");

?>

<body class="bg-primary text-secondary">
    <?php include_once("includes/nav.php"); ?>

    <main class="flex flex-col items-center justify-between">
        <h1 class="font-primary font-bold text-xl p-8 ">Bienvenue sur votre tableau de bord</h1>
        <form method="post" class="flex flex-col items-center gap-8 border-2 rounded-lg p-8">
            <div class="flex flex-col py-2">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="text-primary px-4 py-2 rounded-lg " required
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
            </div>
            <div class="flex flex-col py-2">
                <label for="password">Mot de Passe</label>
                <input type="password" name="password" id="password" class="text-primary px-4 py-2 rounded-lg ">
            </div>
            <button type="submit" class="bg-cta hover:bg-ctaHover duration-500 ease-in-out text-secondary font-bold w-full font-primary p-2 rounded-full">Se connecter</button>
        </form>
    </main>

    <?php include_once("includes/footer.php"); ?>

    <?php AuthController::login(); ?>
</body>
</html>
