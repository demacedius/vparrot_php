<?php
    

if (!empty($_POST)) {
    if (isset($_POST["email"], $_POST["password"])
        && !empty($_POST["email"] && !empty($_POST["password"]))
    ){
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("ce n'est pas une adresse email");
        }

        require("includes/connect.php");

        $sql = "SELECT * FROM `users` WHERE `email` = :email";

        $query = $db->prepare($sql);

        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

        $query->execute();

        $user = $query->fetch();

        if (!$user) {
            die("L'utilisateur et/ou le mot de passe est incorrect");
        }

        if (!password_verify($_POST["password"], $user["password"])) {
            die("L'utilisateur et/ou le mot de passe est incorrect");
        }

        session_start();

        $_SESSION["user"] = [
            "id" => $user["id"],
            "email" => $user["email"]
        ];

        
    }
}
?>


<main class="flex flex-col items-center py-16 text-secondary">

    <div class="border-secondary border p-8 rounded-lg shadow-md max-w-md w-full mx-auto">
        <h2 class="text-2xl  font-bold mb-6">connection</h2>

        <form action="login_process.php" method="post">
            <div class="mb-4">
                <label for="email" class="block  text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" class="border text-primary rounded px-3 py-2 w-full"
                    required>
            </div>

            <div class="mb-4">
                <label for="password" class="block  text-sm font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password"
                    class="border text-primary rounded px-3 py-2 w-full" required>
            </div>

            <button type="submit"
                class="bg-cta hover:bg-ctaHover duration-500 ease-in-out  font-bold w-full font-primary p-2 rounded-full">
                Login
            </button>
        </form>
    </div>
</main>