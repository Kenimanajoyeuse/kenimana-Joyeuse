<?php

// Liste des universités par pays
$universites = [

    "Burundi" => [
        "Université du Burundi",
        "Université Lumière de Bujumbura",
        "Université du Lac Tanganyika",
        "Université Espoir d'Afrique",
        "Université de Ngozi",
        "Université de Gitega",
        "Université du Grand Lac",
        "Université Martin Luther King",
        "Université Sagesse d'Afrique",
        "Université de Mwaro",
        "Université Polytechnique de Gitega",
        "Université de Kiriri",
        "Université Shalom de Bujumbura",
        "Université de Bujumbura",
        "Université du Paysan",
        "Université des Grands Lacs du Burundi",
        "Université du Sud",
        "Université des Martyrs",
        "Université Lumière de Ngozi",
        "Université de Muyinga"
    ],

    "Rwanda" => [
        "University of Rwanda",
        "Kigali Independent University",
        "University of Kigali",
        "Adventist University of Central Africa",
        "Mount Kigali University",
        "Rwanda Polytechnic",
        "African Leadership University Rwanda",
        "INES Ruhengeri",
        "Catholic University of Rwanda",
        "Protestant Institute of Arts and Social Sciences",
        "University of Lay Adventists of Kigali",
        "Kepler",
        "Adventist University of Rwanda",
        "East African University Rwanda",
        "Carnegie Mellon University Africa",
        "African Institute for Mathematical Sciences",
        "University of Global Health Equity",
        "Kigali Health Institute",
        "Rwanda Institute for Conservation Agriculture",
        "University of Tourism, Technology and Business Studies"
    ],

    "France" => [
        "Sorbonne Université",
        "Université Paris Cité",
        "Université Paris-Saclay",
        "Université Paris 1 Panthéon-Sorbonne",
        "Université Paris-Panthéon-Assas",
        "Université de Strasbourg",
        "Université de Lyon",
        "Université de Bordeaux",
        "Université de Lille",
        "Université de Nantes",
        "Université de Montpellier",
        "Université de Rennes",
        "Université de Toulouse",
        "Université de Grenoble Alpes",
        "Université de Lorraine",
        "Université de Caen Normandie",
        "Université de Rouen Normandie",
        "Université de Nice Côte d'Azur",
        "Université de Tours",
        "Université de Poitiers"
    ],

    "Canada" => [
        "Université de Montréal",
        "Université Laval",
        "Université de Sherbrooke",
        "Université du Québec à Montréal",
        "Université du Québec à Trois-Rivières",
        "Université du Québec en Outaouais",
        "Université du Québec à Chicoutimi",
        "Université d'Ottawa",
        "Université de Toronto",
        "Université McGill",
        "Université de Waterloo",
        "Université Western",
        "Université Queen's",
        "Université de Calgary",
        "Université de l'Alberta",
        "Université de la Colombie-Britannique",
        "Université du Manitoba",
        "Université Dalhousie",
        "Université de Victoria",
        "Université Concordia"
    ]
];

$nom = "";
$prenom = "";
$paysChoisi = "";
$universiteChoisie = "";
$message = "";

// Récupérer les données envoyées
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = htmlspecialchars($_POST["nom"] ?? "");
    $prenom = htmlspecialchars($_POST["prenom"] ?? "");
    $paysChoisi = $_POST["pays"] ?? "";
    $universiteChoisie = $_POST["universite"] ?? "";

    // Si l'utilisateur valide la candidature
    if (isset($_POST["valider"])) {

        if ($nom != "" && $prenom != "" && $paysChoisi != "" && $universiteChoisie != "") {

            $message = "Candidature envoyée avec succès !";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Formulaire de candidature</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Formulaire de candidature</h1>

    <?php if ($message != ""): ?>
        <div class="success">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php">

        <!-- Nom -->
        <label for="nom">Nom :</label>

        <input
            type="text"
            id="nom"
            name="nom"
            value="<?php echo $nom; ?>"
            placeholder="Entrez votre nom"
            required
        >


        <!-- Prénom -->
        <label for="prenom">Prénom :</label>

        <input
            type="text"
            id="prenom"
            name="prenom"
            value="<?php echo $prenom; ?>"
            placeholder="Entrez votre prénom"
            required
        >


        <!-- Pays -->
        <label for="pays">Choisissez votre pays :</label>

        <select
            name="pays"
            id="pays"
            onchange="this.form.submit()"
            required
        >

            <option value="">-- Choisir un pays --</option>

            <?php foreach ($universites as $pays => $liste): ?>

                <option
                    value="<?php echo htmlspecialchars($pays); ?>"
                    <?php
                    if ($paysChoisi == $pays) {
                        echo "selected";
                    }
                    ?>
                >
                    <?php echo htmlspecialchars($pays); ?>
                </option>

            <?php endforeach; ?>

        </select>


        <!-- Université -->
        <?php if ($paysChoisi != "" && isset($universites[$paysChoisi])): ?>

            <label for="universite">
                Choisissez une université :
            </label>

            <select
                name="universite"
                id="universite"
                required
            >

                <option value="">
                    -- Choisir une université --
                </option>

                <?php foreach ($universites[$paysChoisi] as $universite): ?>

                    <option
                        value="<?php echo htmlspecialchars($universite); ?>"
                        <?php
                        if ($universiteChoisie == $universite) {
                            echo "selected";
                        }
                        ?>
                    >
                        <?php echo htmlspecialchars($universite); ?>
                    </option>

                <?php endforeach; ?>

            </select>

            <button type="submit" name="valider">
                Envoyer la candidature
            </button>

        <?php endif; ?>

    </form>

</div>

</body>
</html>