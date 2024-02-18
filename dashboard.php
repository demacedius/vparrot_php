<?php
require("includes/connect.php");
session_start();

$sql = "SELECT * FROM `commentaire`";

$requete = $db->query($sql);

$commentaires = $requete->fetchAll();

include_once("includes/header.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez l'ID du commentaire depuis le formulaire
    $commentaire_id = $_POST['commentaire_id'];

    // Mettez à jour la valeur "valider" dans la base de données
    $sql_update = "UPDATE `commentaire` SET `valider` = 1 WHERE `id` = :commentaire_id";
    $stmt = $db->prepare($sql_update);
    $stmt->bindParam(':commentaire_id', $commentaire_id, PDO::PARAM_INT);
    
    // Exécutez la requête de mise à jour
    $stmt->execute();

    // Redirigez l'utilisateur vers la page d'origine ou une autre page après la validation
    header("Location: dashboard.php"); 
    exit();
}
?>

<body class="bg-primary text-secondary">
    <?php
    include_once("includes/nav.php");
    ?>
    <h1 class="text-center text-xl font-primary font-bold py-8">Bonjour
        <?= $_SESSION["user"]["email"] ?>
    </h1>
    <main class=" flex flex-col items-center gap-8 md:grid md:grid-cols-2 max-w-[1024px] mx-auto ">
        <div>

            <?php if ($_SESSION["user"]["email"] == "vparrot@vparrot.com") {
                include_once("inscription.php");
            }
            ?>
        </div>
        <div>
            <?php
            include_once("createCar.php");
            ?>
        </div>
        <div class="md:grid md:grid-cols-2 gap-8 w-full">
            <?php foreach ($commentaires as $commentaire): ?>
                <?php if ($commentaire['valider'] == 0): ?>
                    <div
                        class="border-solid border border-secondary p-8 md:rounded-lg md:flex flex-col md:items-center md:justify-between ">
                        <h1 class="text-center text-xl font-bold font-primary">
                            <?php echo $commentaire['nom'] ?>
                        </h1>
                        <p class="text-left text-sm md:text-base py-4 px-4 ">
                            <?php echo $commentaire['commentaire'] ?>
                        </p>
                        <div class="flex items-center justify-center ">
                            <?php for ($i = 0; $i < $commentaire['note']; $i++): ?>
                                <img class="p-2 " src="./image/Vector.png" alt="">
                            <?php endfor ?>
                        </div>
                        <form method="post">
                            <input type="hidden" name="commentaire_id" value="<?= $commentaire['id'] ?>">
                            <button type="submit" class="bg-cta hover:bg-ctaHover duration-500 ease-in-out text-secondary font-bold w-full font-primary p-2 rounded-full">Valider ce commentaire</button>
                        </form>
                    </div>
                <?php endif ?>
            <?php endforeach; ?>
        </div>
    </main>
    <?php
    include("includes/footer.php");
    ?>
</body>

</html>