<?php
session_start();
require_once __DIR__ . '/includes/database.php';
require_once ("./classe/voiture.php");
require_once ("./classe/template.php");


$dbInstance = Database::getInstance();
$db = $dbInstance->getConnection();

$voitureInstance = new Voiture($db);

$tri = isset($_GET['tri']) ? $_GET['tri'] : 'nom';

$voitures = $voitureInstance->getAllVoitures($tri);

$titre = 'nos_voiture';

Template::header($titre);
?>

<body class="bg-primary text-secondary">
    <?php Template::nav(); ?>
    <main class="max-w-[1024px] mx-auto">
        <div class="flex items-center justify-evenly p-8">
            <a class="bg-cta hover:bg-ctaHover p-4 rounded-lg" href="#" data-tri="nom">Nom</a>
            <a class="bg-cta hover:bg-ctaHover p-4 rounded-lg" href="#" data-tri="prix">Prix</a>
            <a class="bg-cta hover:bg-ctaHover p-4 rounded-lg" href="#" data-tri="kilometrage">Kilométrage</a>
            <a class="bg-cta hover:bg-ctaHover p-4 rounded-lg" href="#" data-tri="annee">Année</a>
        </div>
        <div id="voitures-list" class="md:grid md:grid-cols-3 max-w-[1024px] mx-auto gap-8">
            <?php foreach ($voitures as $voiture): ?>
                <div
                    class="border-solid border border-secondary md:rounded-lg md:flex flex-col md:items-left md:justify-between md:p-8">
                    <a href="voiture.php?id=<?= $voiture["id"]; ?>">
                        <div class="flex items-center justify-center">
                            <img class="p-4 rounded-md" src="uploads/<?php echo $voiture['image']; ?>"
                                alt="Image de la voiture">
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
                        <div class="text-left text-sm md:text-base py-4 px-4 border border-b-2 border-secondary">
                            <p>kilomètre:</p>
                            <p>
                                <?php echo $voiture['kilometrage'] ?> km
                            </p>
                        </div>
                        <div class="text-left text-sm md:text-base py-4 px-4 border border-b-2 border-secondary">
                            <p>année de mise en circulation:</p>
                            <p class="text-left text-sm md:text-base py-4 px-4">
                                <?php echo $voiture['annee'] ?>
                            </p>
                        </div>
                        <div class="text-left text-sm md:text-base py-4 px-4">
                            <p>description du véhicule:</p>
                            <p class="text-left text-sm md:text-base py-4 px-4">
                                <?php echo $voiture['description'] ?>
                            </p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <?php Template::footer(); ?>

    <script>
        document.querySelectorAll('a[data-tri]').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const tri = this.getAttribute('data-tri');

                fetch(`classe/tri_voiture.php?tri=${tri}`)
                    .then(response => response.json())
                    .then(data => {
                        const voituresList = document.getElementById('voitures-list');
                        voituresList.innerHTML = '';
                        data.forEach(voiture => {
                            const voitureDiv = document.createElement('div');
                            voitureDiv.className = 'border-solid border border-secondary md:rounded-lg md:flex flex-col md:items-left md:justify-between md:p-8';
                            voitureDiv.innerHTML = `
                                <a href="voiture.php?id=${voiture.id}">
                                    <div class="flex items-center justify-center">
                                        <img class="p-4 rounded-md" src="uploads/${voiture.image}" alt="Image de la voiture">
                                    </div>
                                    <h1 class="text-center text-2xl font-bold font-primary">
                                        ${voiture.nom}
                                    </h1>
                                    <div class="text-left text-sm md:text-base py-4 px-4 border border-secondary">
                                        <p>Prix de la voiture:</p>
                                        <p>${voiture.prix} €</p>
                                    </div>
                                    <div class="text-left text-sm md:text-base py-4 px-4 border border-b-2 border-secondary">
                                        <p>kilomètre:</p>
                                        <p>${voiture.kilometrage} km</p>
                                    </div>
                                    <div class="text-left text-sm md:text-base py-4 px-4 border border-b-2 border-secondary">
                                        <p>année de mise en circulation:</p>
                                        <p class="text-left text-sm md:text-base py-4 px-4">${voiture.annee}</p>
                                    </div>
                                    <div class="text-left text-sm md:text-base py-4 px-4">
                                        <p>description du véhicule:</p>
                                        <p class="text-left text-sm md:text-base py-4 px-4">${voiture.description}</p>
                                    </div>
                                </a>`;
                            voituresList.appendChild(voitureDiv);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
    <script src="./script/script.js"></script>
</body>