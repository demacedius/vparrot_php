<?php
session_start();
require_once("includes/connect.php");

$sql = "SELECT * FROM `commentaire`";

$requete = $db->query($sql);

$commentaires = $requete->fetchAll();

include_once("includes/header.php");
?>

<body class="bg-primary text-secondary" >
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
        <div class="md:grid md:grid-cols-2 gap-8 w-full">
            <?php foreach ($commentaires as $commentaire): ?>
                <?php if ($commentaire['valider'] == 0): ?>
                    <div class="border-solid border border-secondary p-8 md:rounded-lg md:flex flex-col md:items-center md:justify-between ">
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
                    </div>
                <?php endif ?>
            <?php endforeach; ?>
        </div>
    </main>
    <?php
    include_once('includes/footer.php');
    ?>
</body>