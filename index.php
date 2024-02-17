<?php
session_start();
require_once("includes/connect.php");

$sql = "SELECT * FROM `commentaire`";

$requete = $db->query($sql);

$commentaires = $requete->fetchAll();

$titre = 'accueil';

include("includes/header.php");



?>

<body class="bg-primary text-secondary ">
    <?php include("includes/nav.php"); ?>
    <main class="lg:max-w-[1024px] lg:mx-auto lg:pt-4">
        <header class="md:flex md:items-center">
            <img src="./image/voiture_collection.jpg" alt="une voiture de collection dans un garage">
            <div class="max-lg:flex max-lg:flex-col max-lg:items-center">
                <h1 class="pt-4 text-center font-primary text-2xl font-bold">Bienvenue au garage Vincent Parrot</h1>
                <p class="pt-2 pl-4 font-secondary text-base font-light  ">Mécanicien et vente de véhicules d’occasion
                </p>
            </div>
        </header>
        <section class="pt-8 ">
            <h2 class="text-center text-2xl font-bold font-primary">Nos services</h2>
            <div class="md:grid md:grid-cols-2 md:gap-16 py-8">

                <div class="py-8">
                    <h3 class="text-xl font-bold font-primary">Mécanique</h3>
                    <p>Notre équipe de mécaniciens hautement qualifiés assure des réparations et des entretiens
                        mécaniques exceptionnels. De la maintenance régulière aux réparations complexes, nous veillons à
                        ce que votre véhicule fonctionne de manière optimale.</p>
                </div>
                <img class="w-full py-4" src="./image/mécanicien.jpg"
                    alt="image d'un mécanicien de face travaillant dans une baie moteur">
                <img class="py-4 w-full" src="./image/phare.png"
                    alt="image d'un mécanicien de face travaillant dans une baie moteur">
                <div class="py-4">
                    <h3 class="text-right text-xl font-bold font-primary">Carrosserie</h3>
                    <p class="text-right"> Redonnez à votre voiture son éclat d'origine avec notre service de réparation
                        de carrosserie. Des dommages mineurs aux réparations majeures, notre équipe compétente utilise
                        des techniques avancées pour restaurer l'apparence de votre véhicule.</p>
                </div>
                <div class="py-4">
                    <h3 class="text-xl font-bold font-primary">Vente de Véhicules</h3>
                    <p class=""> Explorez notre sélection de véhicules d'occasion de qualité. Avec des inspections
                        approfondies et des garanties disponibles, nous offrons des options fiables pour répondre à vos
                        besoins et garantir une expérience d'achat en toute confiance.</p>
                </div>
                <img class="w-full py-4" src="./image/avant_lomborghini.png" alt="">

            </div>
        </section>

    </main>
    <div class="md:grid md:grid-cols-3 max-w-[1024px] mx-auto gap-8">
        <?php foreach ($commentaires as $commentaire): ?>
            <?php if ($commentaire['valider'] == 1): ?>
                <div
                    class="border-solid border border-secondary py-8 md:rounded-lg md:flex flex-col md:items-center md:justify-between ">
                    <h1 class="text-center text-2xl font-bold font-primary">
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
<?php
include('includes/footer.php')
?>
</body>
</html>