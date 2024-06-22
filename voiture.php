<?php
session_start();
require_once("includes/database.php");
require_once("classe/annonce.php");
require_once("classe/messageUtilistateur.php");
require_once("classe/template.php");

$dbInstance = new Database();
$db = $dbInstance->getConnection();

$annonceInstance = new Annonce($db);
$messageInstance = new MessageUtilisateur($db);

if (!empty($_POST)) {
    if (isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["telephone"], $_POST["message"], $_POST["voiture_id"]) && 
        !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && 
        !empty($_POST["telephone"]) && !empty($_POST["message"]) && !empty($_POST["voiture_id"])) {
        
        $email = strip_tags($_POST["email"]);
        $message = htmlspecialchars($_POST["message"]); 
        $nom = strip_tags($_POST["nom"]);
        $prenom = strip_tags($_POST["prenom"]);
        $telephone = strip_tags($_POST["telephone"]);
        $voiture_id = $_POST["voiture_id"];

        $messageInstance->insertMessage($nom, $prenom, $email, $telephone, $message, $voiture_id);

        $id = $db->lastInsertId();
    }
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $annonce_id = $_GET['id'];

    $annonce = $annonceInstance->getAnnonceById($annonce_id);

    if ($annonce) {
        $titre = $annonce['nom'];
        Template::header($titre);
?>

        <body class="bg-primary text-secondary">
            <?php Template::nav(); ?>
            <main>
                <div class="md:grid md:grid-cols-2 max-w-[1024px] mx-auto gap-8 items-center md:pt-8">
                    <img class="md:border-2 md:rounded-lg" src="uploads/<?php echo $annonce['image']; ?>"
                        alt="Image de la voiture">

                    <h1 class="text-center text-2xl font-bold font-primary py-8">
                        <?php echo $annonce['nom'] ?>
                    </h1>
                    <div class="text-left text-sm md:text-base py-4 px-4 border border-secondary">
                        <p>Prix de la voiture:</p>
                        <p>
                            <?php echo $annonce['prix'] ?> €
                        </p>

                    </div>
                    <div class="text-left text-sm md:text-base py-4 px-4 border border-secondary  ">
                        <p>kilomètre:</p>
                        <p>
                            <?php echo $annonce['kilometrage'] ?> km
                        </p>
                    </div>
                    <div class="text-left text-sm md:text-base py-4 px-4 border border-secondary  ">
                        <p>année de mise en circulation:</p>
                        <p class="text-left text-sm md:text-base py-4 px-4 ">
                            <?php echo $annonce['annee'] ?>
                        </p>
                    </div>
                    <div class="text-left text-sm md:text-base py-4 px-4 border border-secondary">
                        <p>description du véhicule:</p>
                        <p class="text-left text-sm md:text-base py-4 px-4 ">
                            <?php echo $annonce['description'] ?>
                        </p>
                    </div>

                </div>
                <?php 
                include("messageUser.php")
                ?>
            </main>

            <?php Template::footer(); ?>
            <script src="./script/script.js"></script>
        </body>
        <?php
    } else {
        // Gérer le cas où l'annonce avec l'ID spécifié n'est pas trouvée
        echo "Annonce non trouvée.";
    }
} else {
    // Gérer le cas où l'ID n'est pas spécifié ou n'est pas valide
    echo "ID d'annonce non spécifié ou non valide.";
}
?>
