<?php
session_start();
require_once("includes/database.php");
require_once("classe/autentification.php");

if (!empty($_POST)) {
    if (isset($_POST["email"], $_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        $dbInstance = new Database();
        $db = $dbInstance->getConnection();

        $auth = new AuthController($db);
        $result = $auth->login($_POST["email"], $_POST["password"]);

        if ($result === true) {
            // Redirection ou autre traitement après la connexion réussie
            header("Location: index.php"); // Redirige vers la page d'accueil par exemple
            exit();
        } else {
            // Affichage de l'erreur
            echo $result;
        }
    }
}
?>

<main class="flex flex-col items-center py-16 text-secondary">
    <div class="border-secondary border p-8 rounded-lg shadow-md max-w-md w-full mx-auto">
        <h2 class="text-2xl  font-bold mb-6">Connexion</h2>
        <form action="login_process.php" method="post">
            <div class="mb-4">
                <label for="email" class="block  text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" class="border text-primary rounded px-3 py-2 w-full"
                    required>
            </div>
            <div class="mb-4">
                <label for="password" class="block  text-sm font-bold mb-2">Mot de passe:</label>
                <input type="password" id="password" name="password"
                    class="border text-primary rounded px-3 py-2 w-full" required>
            </div>
            <button type="submit"
                class="bg-cta hover:bg-ctaHover duration-500 ease-in-out  font-bold w-full font-primary p-2 rounded-full">
                Connexion
            </button>
        </form>
    </div>
</main>
