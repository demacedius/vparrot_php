<?php
session_start();
require_once("includes/database.php");
require_once("classe/voiture.php");
require_once("classe/template.php");

$dbInstance = new Database();
$db = $dbInstance->getConnection();

$voitureInstance = new Voiture($db);

$tri = isset($_GET['tri']) ? $_GET['tri'] : 'nom';

$voitures = $voitureInstance->getAllVoitures($tri);

$titre = 'nos_voiture';

Template::header($titre);
?>

<body class="bg-primary text-secondary ">
    <?php Template::nav(); ?>
    <main class="max-w-[1024px] mx-auto">
        <div class="flex items-center justify-evenly p-8">
            <a class="bg-cta hover:bg-ctaHover p-4 rounded-lg" href="?tri=nom" class="text-secondary mr-4">Nom</a>
            <a class="bg-cta hover:bg-ctaHover p-4 rounded-lg" href="?tri=prix" class="text-secondary mr-4">Prix</a>
            <a class="bg-cta hover:bg-ctaHover p-4 rounded-lg" href="?tri=kilometrage" class="text-secondary mr-4">Kilométrage</a>
            <a class="bg-cta hover:bg-ctaHover p-4 rounded-lg" href="?tri=annee" class="text-secondary">Année</a>
        </div>
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
    <?php Template::footer(); ?>
</body>
