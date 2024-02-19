<?php
session_start();
require_once("includes/connect.php");

$sql = "SELECT * FROM `voiture`";

$requete = $db->query($sql);

$voitures = $requete->fetchAll();

$titre = 'accueil';

include("includes/header.php");



?>

<body class="bg-primary text-secondary">
    <?php
    include_once("includes/nav.php");
    ?>
    <main>

        <div class="md:grid md:grid-cols-3 max-w-[1024px] mx-auto gap-8 ">
            <?php foreach ($voitures as $voiture): ?>
                <div class="border-solid border border-secondary md:rounded-lg md:flex flex-col md:items-left md:justify-between md:p-8">
                    <a href="voiture.php?id=<?= $voiture["id"]; ?>">
                        <div class="flex items-center justify-center">
                            <img class="p-4 rounded-md" src="uploads/<?php echo $voiture['image']; ?>" alt="Image de la voiture">
                        </div>
                        <h1 class="text-center text-2xl font-bold font-primary">
                            <?php echo $voiture['nom'] ?>
                        </h1>
                        <div class="text-left text-sm md:text-base py-4 px-4 border border-secondary">
                            <p>Prix de la voiture:</p>
                            <p>
                                <?php echo $voiture['prix'] ?> €
                            </p>

                        </div>
                        <div class="text-left text-sm md:text-base py-4 px-4 border border-b-2 border-secondary  ">
                            <p>kilomètre:</p>
                            <p>
                                <?php echo $voiture['kilometrage'] ?> km
                            </p>
                        </div>
                        <div class="text-left text-sm md:text-base py-4 px-4 border border-b-2 border-secondary  ">
                            <p>année de mise en circulation:</p>
                            <p class="text-left text-sm md:text-base py-4 px-4 ">
                                <?php echo $voiture['annee'] ?>
                            </p>
                        </div>
                        <div class="text-left text-sm md:text-base py-4 px-4 ">
                            <p>description du véhicule:</p>
                            <p class="text-left text-sm md:text-base py-4 px-4 ">
                                <?php echo $voiture['description'] ?>
                            </p>
                        </div>

                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <?php
    include_once('includes/footer.php');
    ?>
</body>