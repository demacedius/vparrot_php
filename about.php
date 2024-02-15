<?php
session_start();
$titre = "A propos";
include_once("includes/header.php");
?>

<body class="bg-primary text-secondary ">
    <?php
    include_once("includes/nav.php");
    ?>
    <main class="font-primary lg:max-w-[1024px] lg:mx-auto lg:pt-4">


        <h1 class="text-base md:text-xl lg:text-4xl pb-4 md:pb-8">Qui Sommes nous ?</h1>

        <section class="flex flex-col gap-8 text-sm md:text-base">

            <p>Bienvenue chez le Garage Vincent Parrot, l'adresse incontournable pour une expérience automobile
                exceptionnelle.
                Forts d'une expertise inégalée dans l'industrie, nous sommes bien plus qu'un simple garage - nous sommes
                votre
                partenaire de confiance pour tous vos besoins automobiles.</p>

            <p>Notre équipe passionnée de mécaniciens hautement qualifiés est dédiée à assurer la performance optimale
                de votre
                véhicule. Que ce soit pour des réparations mécaniques minutieuses, des services de carrosserie de
                pointe, ou la
                recherche de votre prochain véhicule d'occasion, nous mettons tout en œuvre pour dépasser vos attentes.
            </p>

            <p>Chez Vincent Parrot, nous croyons en la transparence, l'intégrité, et le service personnalisé. Chaque
                visite est une opportunité de vous offrir une expérience exceptionnelle, alliant professionnalisme et
                convivialité. Explorez notre gamme complète de services, découvrez la qualité de notre travail, et
                laissez-nous prendre soin de votre véhicule comme s'il était le nôtre.</p>

            <p>Restez avec nous, explorez notre site pour en savoir plus sur nos services diversifiés, et n'hésitez pas
                à nous contacter pour toute question ou pour planifier une visite. Chez Vincent Parrot, votre
                satisfaction est notre priorité, et nous sommes impatients de vous accueillir dans notre communauté
                automobile passionnée. Bien plus qu'un garage, nous sommes votre partenaire de route.</p>
        </section>
    </main>
    <?php
    include_once("includes/footer.php");
    ?>
</body>